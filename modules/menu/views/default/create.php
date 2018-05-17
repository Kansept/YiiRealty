<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuType */

$this->title = 'Создание меню';
$this->params['breadcrumbs'][] = ['label' => 'Menu Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
