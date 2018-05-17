<?php

namespace app\modules\page\models;

use app\modules\page\models\Category;
use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $status
 * @property string $alias
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['content'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'name' => 'Заголовок',
            'content' => 'Содержание',
            'status' => 'Опубликовано',
            'alias' => 'Плевдоним',
            'category_id' => 'Категория',
            'categoryTitle' => 'Категория',
        ];
    }

    public function getCategory() 
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoryTitle()
    {
        return ($this->category)? $this->category->title : null;
    }
}
