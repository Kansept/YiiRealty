<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\page\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'content' => function($model) {
                    $title = str_repeat("|-- ", $model->depth - 1 ) . $model->title;
                    return Html::a(
                        $title, 
                        Url::toRoute(['category/update', 'id' => $model->id])
                    );
                }
            ],
            'alias',
            [
                'attribute' => 'published',
                'filter' => ['1' => 'да', '0' => 'нет'],
                'content' => function ($model) {
                    return ($model->published)? '<span class="glyphicon glyphicon-ok"></span>' : '-';
                },
                'format' => 'html',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
