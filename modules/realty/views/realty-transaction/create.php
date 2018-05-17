<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\realestate\models\RealEstateType */

$this->title = 'Создать тип сделки';
$this->params['breadcrumbs'][] = ['label' => 'Типы сделок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realty-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
