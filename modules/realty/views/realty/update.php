<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\realestate\models\RealEstate */

$this->title = 'Редактирование объекта: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'База недвижимости', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="realty-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
