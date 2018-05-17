<?php

namespace app\modules\menu\models;

use Yii;

/**
 * This is the model class for table "menu_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $status
 *
 * @property Menu[] $menus
 */
class MenuType extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'menutype'], 'required'],
            [['status'], 'integer'],
            [['title', 'menutype'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'menutype' => 'Псевдоним',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['menu_type_id' => 'id']);
    }

    public function getStatusName() {
        return self::getStatusesArray()[$this->status];
    }

    public static function getStatusesArray()
    {
      return [
          self::STATUS_ACTIVE => 'Активен',
          self::STATUS_BLOCKED => 'Не опубликовано',
      ];
    }

}
