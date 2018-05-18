<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success">
            Сообщение успешно отправлено!
        </div>
    <?php else: ?>

    <div class="row">
        <div class="col-md-6">
            <h2><?= Html::encode($this->title) ?></h2>
            <p>
            Уважаемые посетители, самый быстрый способ связаться с нами — позвонить. Если же по каким-либо 
            причинам вы не можете позвонить,напишите нам! Мы свяжемся с вами в удобное для вас время!
            </p>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'subject') ?>
            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <?php endif; ?>

        <div class="col-md-6 address">
            <h2>Адрес:</h2>
            <p>г. Кисловодск, 40 лет Октября, д.4</p>
            <p>Телефон: 8 (928) 922-22-33</p>
            <p>Почта: katya.platinum@mail.ru</p>
            <ul>
                <li>Риелтор - Бедненко Екатерина Андреевна 8 (928) 933-33-74</li>
                <li>Юрист - Гояева Эка Николозовна</li>
            </ul>
        </div>
    </div>

</div>
