<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */

$this->title = 'Добавить пункт меню';
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['/admin/menu']];
$this->params['breadcrumbs'][] = [
    'label' => $menu_type->title, 
    'url' => ['/admin/menu/menu/index', 'menu_type_id' => $menu_type->id]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,
        'menu_type' => $menu_type,
    ]) ?>

</div>
