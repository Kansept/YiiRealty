<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */

$this->title = 'Редактировать меню: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['/admin/menu']];
$this->params['breadcrumbs'][] = [
    'label' => $menu_type->title, 
    'url' => ['/admin/menu/menu/index', 'menutype' => $menu_type->menutype]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'menu_type' => $menu_type,
    ]) ?>

</div>
