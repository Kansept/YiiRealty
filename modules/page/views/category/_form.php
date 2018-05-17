<?php

use app\modules\Page\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(
        ArrayHelper::map(Category::getTreeList(), 'id', 'title')
    ) ?>

    <?php
    if (!$model->isNewRecord) {
        echo $form->field($model, 'position')->dropDownList(
            ArrayHelper::map(Category::getListSort($model->parent_id), 'id', 'title'),
            [ 'options' => [ $model->id => ['selected' => true] ] ]
        );
    }
    ?>

    <?= $form->field($model, 'published')->dropDownList($model->getStatusesArray()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
