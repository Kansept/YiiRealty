<?php

namespace app\modules\realty\models;

use Yii;
use yii\imagine\Image as ImageYii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $path
 * @property int $realty_id
 *
 * @property RealEstate $realEstate
 */
class RealtyImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'realty_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'realty_id'], 'required'],
            [['realty_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['realty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Realty::className(), 'targetAttribute' => ['realty_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'realty_id' => 'Real Estate ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealEstate()
    {
        return $this->hasOne(Realty::className(), ['id' => 'realty_id']);
    }


    /**
     * @return string
     */
    static public function thumbnail($path)
    {
        $pathParts = explode('/', $path);
        $filename = array_pop($pathParts);
        $dir = implode('/', $pathParts);
        $thumbnail = "/uploads/no_img.jpg";

        if( is_file($path) ) {
            $thumbnail = "{$dir}/thumbnail/{$filename}";
            if (!is_file($thumbnail)) {
                $dirThumbnail = "{$dir}/thumbnail";
                if (!is_dir($dirThumbnail)) {
                    mkdir($dirThumbnail, 0777, true);
                }
                ImageYii::thumbnail(
                    $path, 200, 200, \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET
                )->save($thumbnail);
            }
        } else {
            $thumbnail = '/images/no_img.jpg';
        }

        return $thumbnail;
    }
}
