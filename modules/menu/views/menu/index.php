<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\modules\menu\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню: ' . $menu_type->title;

$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['/admin/menu']];
$this->params['breadcrumbs'][] = $menu_type->title;

?>
<div class="menu-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить пункт меню', 
        ['create', 'menutype' => $menu_type->menutype], 
        ['class' => 'btn btn-success']) ?>
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
                        Url::toRoute(['menu/update', 'id' => $model->id, 'menutype' => $model->menutype])
                    );
                }
            ],
            'link',
            [
                'attribute' => 'published',
                'filter' => Menu::getStatusesArray(),
                'value' => 'statusName',
            ],
            [         
                'content' => function($model, $key, $index, $column) {
                    $link_edit = Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>', 
                        Url::toRoute(['menu/update', 'id' => $model->id, 'menutype' => $model->menutype], true) 
                            
                    );
                    $link_delete = Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Url::toRoute(['menu/delete', 'id' => $model->id, 'menutype' => $model->menutype], true),
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
