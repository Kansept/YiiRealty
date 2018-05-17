<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\realestate\models\RealtyType */

$this->title = 'Редактирование типа недвижимости: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы недвижимости', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="realty-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
