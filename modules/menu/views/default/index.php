<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\menu\models\MenuType;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MenuTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-type-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить меню', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'content' => function($model) {
                    return Html::a(
                        $model->title, 
                        Url::toRoute(['menu/index', 'menutype' => $model->menutype])
                    );
                }
            ],
            'menutype',
            [         
                'content' => function($model, $key, $index, $column) {
                    $link_edit = Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>', 
                        Url::toRoute(['default/update', 'id' => $model->id], true) 
                            
                    );
                    $link_delete = Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Url::to(['default/delete', 'id' => $model->id], true),
                        [
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]
                    );
                    
                    return $link_edit . ' ' .  $link_delete;
                }
            ],
        ],
    ]); ?>
</div>
