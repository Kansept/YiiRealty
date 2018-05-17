<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuType */

$this->title = 'Редактировать меню: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title];
$this->params['breadcrumbs'][] = 'редактировать';
?>
<div class="menu-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
