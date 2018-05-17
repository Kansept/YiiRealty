<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <p>
        <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'content' => function($model) {
                    return Html::a(
                        $model->name, 
                        Url::toRoute(['default/update', 'id' => $model->id])
                    );
                }
            ],
            'categoryTitle',
            [
                'attribute' => 'status',
                'filter' => ['0' => 'да', '1' => 'нет'],
                'content' => function ($model, $key, $index, $column) {
                    return ($model->status)? '<span class="glyphicon glyphicon-ok"></span>' : '-';
                },
                'format' => 'html',
            ],
            'alias',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
