<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\Lightbox2Asset;

Lightbox2Asset::register($this);
AppAsset::register($this);

$this->registerMetaTag(['name' => 'description', 'content' => 'ваш дескрипт']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'ваш кейвордс']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

    <div class="wrap">
        <div class="container page">

            <div class="row">
                <div class="header">
                    <div class="col-md-5">
                        <img src="/images/logo.png" alt="Центр недвижимости PLATINUM">
                    </div>
                    <div class="col-md-7">
                        <div class="contact">
                            <div class="worktime hidden-xs">
                                <p>пн-пт: 10:00 - 18:00</p>
                                <p>сб: 10:00 - 16:00</p>
                            </div>
                            <div class="phone">
                                <p class="number"><a href="tel:89289222233">8 (928) 922-22-33</a></p>
                                <p class="desc">бесплатная консультация</p>
                            </div>
                            <div class="feedback hidden-xs">
                                <a href="<?= Url::toRoute('site/contact') ?>" class="btn btn-success">
                                    <span class="glyphicon glyphicon-send"> </span> Напишите нам</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->

            <div class="row">
                <?php
                NavBar::begin([
                    'brandLabel' => '<div class="hidden-sm hidden-md hidden-lg">Меню</div>',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' =>'navbar navbar-default',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => \app\modules\menu\models\Menu::getMenuItems('topmenu'),
                ]);
                NavBar::end();
                ?>
            </div>

            <div class="content">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>

        </div> <!-- container -->

    </div> <!-- wrap -->
    <footer class="footer">
        <div class="container">
            <div class="col-md-12">
                <p><b>&copy; Центр недвижимости PLATINUM <?= date('Y') ?></b></p>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>