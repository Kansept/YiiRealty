<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\realty\models\RealtyType;
use app\modules\realty\models\RealtyImage;
use app\modules\realty\models\RealtyTransaction;

/* @var $this yii\web\View */
/* @var $model app\modules\realestate\models\RealEstate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realty-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if ($model->isNewRecord) { 
        $model->author_id = Yii::$app->user->id;
    } ?>

    <?= $form->field($model, 'author_id', [ 'inputOptions' => [ 'enableLabel' => false, ]])->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'realty_transaction_id')->dropDownList(ArrayHelper::map(RealtyTransaction::find()->all(), 'id', 'name' )) ?>
    <?= $form->field($model, 'realty_type_id')->dropDownList(ArrayHelper::map(RealtyType::find()->all(), 'id', 'name' )) ?>
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'room')->textInput() ?>
    <?= $form->field($model, 'full_area')->textInput() ?>
    <?= $form->field($model, 'live_area')->textInput() ?>
    <?= $form->field($model, 'kitchen_area')->textInput() ?>
    <?= $form->field($model, 'terra')->textInput() ?>
    <?= $form->field($model, 'floor')->textInput() ?>
    <?= $form->field($model, 'full_floor')->textInput() ?>
    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false)?>

    <div class="row">
    <?php 
    foreach($model->images as $image) {
    ?>
        <div class="col-md-2 img" id="imgblock_<?= $image['id'] ?>">
            <img src="<?= RealtyImage::thumbnail($image['path']) ?>" id="img_<?= $image['id'] ?>" width="100" height="100" 
                class="realty_thumbnail<?= ($image['id'] == $model->realty_image_id)? ' cover' : '' ?>" />
            <p>
                <a href="#" class="img_cover" id="imgcover_<?= $image['id'] ?>">Обложка</a>
                <a href="#" class="img_delete" id="imgdelete_<?= $image['id'] ?>">Удалить</a>
            </p>
        </div>
    <?php    
    }
    ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    $('a.img_delete').click(function(event) {
        event.preventDefault();
        var img_id = $(this).attr('id').split('_')[1];
        $.post( "/index.php?r=admin/realty/realty/deleteimg", {img_id: img_id})
            .done( function(data) {
                if (data.status == 1 ) {
                    $('div#imgblock_'+img_id).remove();
                }  
            });
    });

    $('a.img_cover').click(function(event) {
        event.preventDefault();
        var img_id = $(this).attr('id').split('_')[1];
        var realty_id = $('#realty-id').val();
        $.post( "/index.php?r=admin/realty/realty/coverimg", {realty_id: realty_id, img_id: img_id})
            .done( function(data) {
                 $('img.cover').removeClass('cover');
                 $('img#img_'+img_id).addClass('cover');
            });
    });

JS;
$this->registerJs($script, \yii\web\View::POS_READY);
?>