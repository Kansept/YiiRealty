<?php

use app\modules\realty\models\RealtyImage;


$this->params['breadcrumbs'][] = ['label' => 'База недвижимости', 'url' => ['realty/index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="row">
    <div class="col-md-12">
        <h1><?= $model->title ?></h1>
        <p><span class="created_at">Размещено <?= $model->updated_at ?></span></p>

        <?php if (!empty($images)) { ?>
        <div class="connected-carousels">
            <div class="stage">
                <div class="carousel carousel-stage">
                    <ul>
                        <?php foreach($images as $image) { ?>
                        <li><a href="<?= $image->path ?>" data-lightbox="image"><img src="<?= $image->path ?>" alt=""></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
                <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
            </div>

            <div class="navigation">
                <a href="#" class="prev prev-navigation">&lsaquo;</a>
                <a href="#" class="next next-navigation">&rsaquo;</a>
                <div class="carousel carousel-navigation">
                    <ul>
                        <?php foreach($images as $image) { ?>
                        <li><img src="<?= RealtyImage::thumbnail($image->path) ?>" width="70" height="70" alt=""></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<hr/>
<div class="row">
    <div class="col-md-4 info-block">
        <p class="price">Цена: <span class="sum"> <?= Yii::$app->formatter->asInteger($model->price) ?> </span> Руб.</p>
    </div>
    <div class="col-md-4 info-block">
        <p class="type"><?= $model->RealtyTypeName ?></p>
    </div>
    <div class="col-md-4 info-block">
        <p class="type"><?= isset($model->room)? 'Количество комнат: ' . $model->room : '' ?></p>
    </div>
</div>

<hr/>

<div class="row">
    <div class="col-md-4 info-block">
        <p>Тип сделки: <?= $model->realtyTransactionName ?></p>
        <p>Площадь кухни: <?= isset($model->kitchen_area)? ($model->kitchen_area) . ' м<sup>2</sup>' : '' ?></p>
    </div>
    <div class="col-md-4 info-block">
        <p>Общая площадь: <?= isset($model->full_area)? ($model->full_area) . ' м<sup>2</sup>' : '' ?></p>
        <p>Этаж: <?= $model->floor ?></p>
    </div>
    <div class="col-md-4 info-block">
        <p>Жилая площадь: <?= isset($model->live_area)? ($model->live_area) . ' м<sup>2</sup>' : '' ?></p>
        <p>Этажей в доме: <?= $model->full_floor ?></p>
    </div>
</div>
<hr/>
<p><?= $model->description ?></p>
<hr/>