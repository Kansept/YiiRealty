<?php

namespace app\modules\realty\models;

use app\modules\user\models\User;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\imagine\Image as ImageYii;

/**
 * This is the model class for table "realty".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $author_id
 * @property integer $realty_transaction_id
 * @property string $city
 * @property string $street
 * @property double $price
 * @property string $description
 * @property integer $room
 * @property double $full_area
 * @property double $live_area
 * @property double $kitchen_area
 * @property double $terra
 * @property integer $floor
 * @property integer $full_floor
 */
class Realty extends \yii\db\ActiveRecord
{
    public $imageFiles;
    public $path;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'realty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'realty_transaction_id', 'realty_type_id', 'price'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['author_id', 'realty_transaction_id', 'realty_type_id', 'room', 'floor', 'full_floor'], 'integer'],
            [['price', 'full_area', 'live_area', 'kitchen_area', 'terra'], 'number'],
            [['description'], 'string'],
            [['city', 'street'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'author_id' => 'Author',
            'realty_transaction_id' => 'Тип сделки',
            'realty_type_id' => 'Тип объекта',
            'city' => 'Город',
            'street' => 'Улица',
            'price' => 'Цена',
            'description' => 'Описание',
            'room' => 'Комнат',
            'full_area' => 'Общяя площадь',
            'live_area' => 'Жилая площадь',
            'kitchen_area' => 'Площадь кухни',
            'terra' => 'Участок',
            'floor' => 'Этаж',
            'full_floor' => 'Этажей',
            'authorName' => 'Автор',
            'imageFiles' => 'Фото',
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () { 
                    return date('Y-m-d H:i:s');
                }
            ]
        ];  
    }

    public function getAuthorName()
    {
        if ( isset($this->author_id) ) {
            $author[] = [
                'id' => $this->author_id,
                'name' => User::findIdentity($this->author_id)->username
            ];
        } else {
            $author[] = [
                'id' => \Yii::$app->user->identity->id,
                'name' => \Yii::$app->user->identity->username
            ];
        }

        return $author;
    }

    public function getTitle() 
    {
        return $this->realtyTypeName . ', ' 
            . (isset($this->room)? $this->room . '-к, ' : ' ')
            . (isset($this->full_area)? $this->full_area . ' м<sup>2</sup>, ' : ' ')
            . (isset($this->terra)? $this->terra . ' участок, ' : ' ')
            . $this->street;    
    }
    
    public function getImages()
    {
        $images = RealtyImage::find()->where(['realty_id' => $this->id])->asArray()->all();
        
        return $images;
    }
    
    public function getRealtyType()
    {
        return $this->hasOne(RealtyType::className(), ['id' => 'realty_type_id']);
    }

    
    public function getRealtyTypeName()
    {
        return $this->realtyType->name;
    }
    
    public static function getRealtyTypeList()
    {
        $type = RealtyType::find()->all();
        
        return $type? ArrayHelper::map($type, 'id', 'name') : '';
    }
    
    public function getRealtyTransaction()
    {
        return $this->hasOne(RealtyTransaction::className(), ['id' => 'realty_transaction_id']);
    }
    
    public function getRealtyTransactionName()
    {
        return $this->realtyTransaction->name;
    }
    
    public static function getRealtyTransactionList()
    {
        $transaction = RealtyTransaction::find()->all();
        
        return $transaction? ArrayHelper::map($transaction, 'id', 'name') : '';
    }

    public function getImage()
    {
        return $this->hasOne(RealtyImage::className(), ['id' => 'realty_image_id']);
    }

    public function getRealtyImage()
    {
        return $this->hasMany(RealtyImage::className(), ['realty_id' => 'id']);
    }
    
    public function upload($realty_id)
    {
        if ($this->validate()) {
            $dir = "uploads/realestate/{$realty_id}";
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
                mkdir($dir."/thumbnail", 0777, true);
            }

            $dirThumbnail = "uploads/realestate/{$realty_id}/thumbnail";
            if (!is_dir($dirThumbnail)) {
                mkdir($dirThumbnail, 0777, true);
            }

            $realty = Realty::findOne($realty_id);
            
            foreach ($this->imageFiles as $file) {

                $filename = uniqid() . '.' . $file->extension;

                $path = "{$dir}/{$filename}";
                $file->saveAs($path);

                $image = new RealtyImage([
                    'realty_id' => $realty_id,
                    'path' => $path
                ]);
                $image->save();
                
                if (empty($realty->realty_image_id)) {
                    $realty->realty_image_id = $image->id;
                    $realty->save();
                }

                ImageYii::thumbnail(
                    "{$dir}/{$filename}", 200, 200, \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET
                )->save("{$dir}/thumbnail/{$filename}");
            }
            return true;
        } else {
            return false;
        }
    }
}
