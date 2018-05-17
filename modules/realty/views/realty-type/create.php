<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\realestate\models\RealtyType */

$this->title = 'Создание типа недвижимости';
$this->params['breadcrumbs'][] = ['label' => 'Типы нидвижимости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realty-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
