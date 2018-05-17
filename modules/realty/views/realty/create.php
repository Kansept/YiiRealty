<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\realestate\models\RealEstate */

$this->title = 'Добавить объект';
$this->params['breadcrumbs'][] = ['label' => 'База недвижимости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
