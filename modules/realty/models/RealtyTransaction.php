<?php

namespace app\modules\realty\models;

/**
 * This is the model class for table "real_estate_type".
 *
 * @property integer $id
 * @property string $name
 */
class RealtyTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'realty_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Тип сделки',
        ];
    }
}
