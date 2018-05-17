<?php

namespace app\modules\menu\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\menu\models\MenuType;
use paulzi\nestedsets\NestedSetsBehavior;
use app\modules\menu\models\query\MenuQuery;


/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $menu_type_id
 * @property string $title
 * @property string $link
 * @property integer $parent_id
 * @property integer $level
 * @property string $alias
 * @property integer $component_id
 * @property integer $published
 *
 * @property MenuType $menuType
 */
class Menu extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 0;

    public $position;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    public function behaviors() {
        return [
            [
                'class' => NestedSetsBehavior::className(),
            ]
        ];
    }

    public function transactions() 
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find() {
        return new MenuQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'link'], 'required'],
            [['parent_id', 'component_id', 'published', 'lft', 'rgt', 'depth'], 'integer'],
            [['title', 'link', 'alias', 'menutype'], 'string', 'max' => 255],
            ['component_id', 'default', 'value' => 0],  
            ['published', 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_type_alias' => 'Псевдоним меню',
            'title' => 'Заголовок',
            'link' => 'Ссылка',
            'parent_id' => 'Родитель',
            'alias' => 'Псевдоним',
            'component_id' => 'Component ID',
            'published' => 'Статус',
            'position' => 'Порядок',
        ];
    }

    public function getStatusName() {
        return self::getStatusesArray()[$this->published];
    }

    public static function getStatusesArray()
    {
      return [
          self::STATUS_ACTIVE => 'Активен',
          self::STATUS_BLOCKED => 'Не опубликовано',
      ];
    }

    public function getParentName()
    {
        $parent = $this->parent;
        return $parent ? $parent->title : null;
    }

    public function getParentId()
    {
        $parent = $this->parent;
        return $parent ? $parent->id : null;
    }

    public static function getMenuItems($menutype) 
    {
        $menu_items = Menu::find()
            ->select(['id', 'title', 'link', 'depth', 'parent_id'])
            ->where(['menutype' => $menutype])
            ->andWhere('depth <= 2')
            ->orderBy('lft')
            ->asArray()
            ->all();

        $url = 'index.php?r=';
        $menu = [];
        foreach ($menu_items as $menu_item) {
            if ($menu_item['depth'] == 1) {
                $menu[$menu_item['id']] = [
                    'label' => $menu_item['title'], 'url' => $url . $menu_item['link']
                ];
            } else if ($menu_item['depth'] == 2) {
                $menu[$menu_item['parent_id']]['items'][] = [
                    'label' => $menu_item['title'], 'url' => $url . $menu_item['link']
                ];
            }    
        }
        return $menu;
    }

    public static function getTreeList($menutype)
    { 
        $treeMenu = Menu::find()->
            select('id, title, depth')->
            where(['menutype' => $menutype])->orWhere(['menutype' => ''])->
            orderBy('lft')->
            asArray()->
            all();

        foreach($treeMenu as $key => $value) {
            $treeMenu[$key]['title'] = str_repeat('-', $value['depth']) . ' ' . $value['title']; 
        }

        return $treeMenu;
    }

    public static function getListSort($id, $menutype) 
    {
        $parent = Menu::findOne(['id' => $id]);
        $childs = $parent->children;

        $out = [];
        $out[] = ['id' => -1, 'title' => '-- Самый верх --'];
        foreach ($childs as $child) {
            if ($child['menutype'] === $menutype) {
                $out[] = [ 'id' => $child['id'], 'title' => $child['title'] ];
            }
        }
        $out[] = ['id' => -2, 'title' => '-- Самый низ --'];
        
        return $out;
    }
}
