<?php

namespace app\modules\page\models;

use paulzi\nestedsets\NestedSetsBehavior;
use app\modules\page\models\query\CategoryQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property integer $published
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 0;

    public $position;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
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
        return new CategoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['published', 'parent_id', 'lft', 'rgt', 'depth'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'alias' => 'Алиас',
            'description' => 'Описание',
            'published' => 'Статус',
            'parent_id' => 'Родитель',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'created_at' => 'Создано',
            'updated_at' => 'Редактировано',
            'position' => 'Сортировка',
        ];
    }

    public static function getStatusesArray()
    {
      return [
          self::STATUS_ACTIVE => 'Активен',
          self::STATUS_BLOCKED => 'Не опубликовано',
      ];
    }

    public static function getTreeList()
    { 
        $tree = Category::find()->
            select('id, title, depth')->
            // where('depth != 0')->
            orderBy('lft')->
            asArray()->
            all();

        foreach($tree as $key => $value) {
            $tree[$key]['title'] = str_repeat('-', $value['depth']) . ' ' . $value['title']; 
        }

        return $tree;
    }

    public static function getListSort($id)         
    {
        $parent = Category::findOne(['id' => $id]);
        $childs = $parent->children;

        $out = [];
        $out[] = ['id' => -1, 'title' => '-- Самый верх --'];
        foreach ($childs as $child) {
            $out[] = [ 'id' => $child['id'], 'title' => $child['title'] ];
        }
        $out[] = ['id' => -2, 'title' => '-- Самый низ --'];
        
        return $out;
    }
}
