<?php
/** @var $this \yii\web\View */
/** @var $name string */
/** @var $email string */
/** @var $subject string */
/** @var $body string */
?>

<p><b>Сообщение с сайта platinum-kmv.ru</b></p>
<p>Сообщение от: <?= $name ?> - <?= $email ?></p>
<p>Тема: <?= $subject ?></p>
<p>Текст сообщения:</p>
<p> <?= $body ?></p>