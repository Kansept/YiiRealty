<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\realestate\models\RealEstateTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы сделок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realty-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить тип сделки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
