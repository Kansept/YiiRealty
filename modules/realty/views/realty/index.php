<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\realty\models\Realty;
use app\modules\realty\models\RealtyImage;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\realestate\models\RealEstateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'База недвижимости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realty-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить объект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'realty_image_id',
                'label' => 'Обложка',
                'content' => function($model) {
                    return Html::img(
                        isset($model->image->path)? RealtyImage::thumbnail($model->image->path) : "/images/no_img.jpg",
                        ['width' => '70px']
                    );
                },
                'filter'=>array("1"=>"Активно","2"=>"Не активно"),
            ],
            [
                'attribute'=>'realty_transaction_id',
                'label'=>'Сделка',
                'format'=>'text',
                'content'=>function($data){
                    return $data->getRealtyTransactionName();
                },
                'filter' => Realty::getRealtyTransactionList()
                ],
            [
                'attribute'=>'realty_type_id',
                'label'=>'Тип',
                'format'=>'text', 
                'content'=>function($data){
                    return $data->getRealtyTypeName();
                },
                'filter' => Realty::getRealtyTypeList()
            ],
            [
                'attribute' => 'street',
                'content' => function($model) {
                    return Html::a(
                        $model->street, 
                        Url::toRoute(['update', 'id' => $model->id])
                    );
                }
            ],
            'price',
            'room',
            'full_area',
            'live_area',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'',
                'headerOptions' => ['width' => '80'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
