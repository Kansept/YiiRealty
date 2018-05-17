<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\Menu\models\Menu;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
$pages = ArrayHelper::map(\app\modules\page\models\Page::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name');
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menutype')->hiddenInput(['value' => $menu_type->menutype])->label(false); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link',
    [
        'template' => '{label}<div class="input-group">{input}<span class="input-group-btn">
        <button class="btn btn-primary" type="button" id="select-link">+</button>
        </span></div>',
    ]
    )->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(
        ArrayHelper::map(Menu::getTreeList($menu_type->menutype), 'id', 'title')
    ) ?>

    <?php
    if (!$model->isNewRecord) {
        echo $form->field($model, 'position')->dropDownList(
            ArrayHelper::map(Menu::getListSort($model->parentId, $menu_type->menutype), 'id', 'title'),
            [ 'options' => [ $model->id => ['selected' => true] ] ]
        );
    }
    ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'published')->dropDownList($model->getStatusesArray()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
Modal::begin([
   'id' => 'modal',
    'closeButton' => false,
]);
?>
<div id='modalContent'>
    <?php $form = ActiveForm::begin([
        'id' => $this->context->id . '-form',
    ]); ?>
    <div class="form-group">
        <?= Html::label('URL', 'form-link'); ?>
        <?= Html::activeInput('text', $model, 'link', ['class' => 'form-control', 'id' => 'form-link']); ?>
    </div>
    <div class="form-group">
        <?= Html::label('Тип', 'form-type'); ?>
        <?= Html::dropDownList('content_id', null, ['site/page' => 'Страница', 'real-estate/index' => 'База недвижимости'],
            [ 'prompt' => '-- Выберите тип --', 'class' => 'form-control', 'id' => 'type-link'] 
        ) ?>
    </div>
    <div class="form-group">
        <?= Html::label('Элемент', 'form-type'); ?>
        <?= Html::dropDownList('item_id', null, $pages, 
            ['prompt' => '-- Выберите элемент-- ', 'class' => 'form-control', 'id' => 'link-item'] 
        ) ?>
    </div>
    <div class="form-group">
        <?= Html::Button('Сохранить', ['class' => 'btn btn-success', 'type' => 'button', 'id' => 'save-link' ]) ?>
        <?= Html::submitButton('Отмена', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php Modal::end(); ?>

<?php
$this->registerJs("

$('#select-link').click( function() {
    $('#modal').modal('show')
});

$('#save-link').click( function() {
    console.log( $('#form-link').val() );
    $('#menu-link').val( $('#form-link').val() );
    $('#modal').modal('hide')
});

$('#type-link').change( function() {
    $('#form-link').val( $('#type-link').val() );
});

$('#link-item').change( function() {
    $('#form-link').val( $('#type-link').val() + '&id=' + $('#link-item').val());
});

");
?>
