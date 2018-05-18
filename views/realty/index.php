<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\modules\realty\models\RealtyImage;

/* @var $this yii\web\View */

$realty_type = ArrayHelper::getValue($post, 'realty_type', Yii::$app->request->get('type'));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realty-index">
    <div class="row">

        <div class="col-md-9 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <?= Html::beginForm(['realty/index'], 'post', ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::label('Тип сделки', 'realty_transaction', ['class' => 'control-label col-md-4']) ?>
                                <div class="col-md-8">
                                    <?= Html::DropDownList(
                                        'realty_transaction', 
                                        ArrayHelper::getValue($post, 'realty_transaction'),
                                        ArrayHelper::map(\app\modules\realty\models\RealtyTransaction::find()->all(), 'id', 'name'),
                                        ['prompt' => 'Выберите ...', 'class' => 'form-control'] ) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= Html::label('Тип объекта', 'realty_type', ['class' => 'control-label col-md-4']) ?>
                                <div class="col-md-8">
                                    <?= Html::DropDownList(
                                        'realty_type', 
                                        ArrayHelper::getValue($post, 'realty_type'),
                                        ArrayHelper::map($types, 'id', 'name'),
                                        ['prompt' => 'Выберите ...', 'class' => 'form-control'] ) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= Html::label('Цена', 'price_from', ['class' => 'control-label col-md-4']) ?>
                                <div class="col-md-4">
                                    <?= Html::input('text', 'price_from', ArrayHelper::getValue($post, 'price_from'), 
                                        ['class' => 'form-control', 'placeholder' => 'от']) ?>
                                </div>
                                <div class="col-md-4">
                                    <?= Html::input('text', 'price_to', ArrayHelper::getValue($post, 'price_to'),
                                        ['class' => 'form-control', 'placeholder' => 'до']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::label('Комнат', 'room', ['class' => 'control-label col-md-4']) ?>
                                <div class="col-md-8">
                                    <?= Html::DropDownList(
                                        'room', 
                                        ArrayHelper::getValue($post, 'room'),
                                        ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '5 и более'],
                                        ['prompt' => 'Выберите ...', 'class' => 'form-control'] ) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= Html::label('Общая площадь', 'full_area_from', ['class' => 'control-label col-md-4']) ?>
                                <div class="col-md-4">
                                    <?= Html::input('text', 'full_area_from', ArrayHelper::getValue($post, 'full_area_from'),
                                        ['class' => 'form-control', 'placeholder' => 'от']) ?>
                                </div>
                                <div class="col-md-4">
                                    <?= Html::input('text', 'full_area_to', ArrayHelper::getValue($post, 'full_area_to'),
                                        ['class' => 'form-control', 'placeholder' => 'до']) ?>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <div class="col-md-12">
                                    <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a('Сбросить', ['realty/index'], ['class' => 'btn btn-default']) ?>
                                </div>
                            </div>
                        </div>
                    <?= Html::endForm() ?>
                </div>
            </div>
            
        </div> <!-- col-md-4 -->
        <div class="col-md-9 col-xs-12">

            <div class="realty-type">
                <?php foreach ($types as $type) { ?>
                    <span <?= ($realty_type == $type['id'])? 'class="block_active"' : 'block_type' ?> ?>
                    <?= Html::a(
                        $type['name'] . '('.$type['count'].')', 
                        Url::to(['realty/index', 'type' => $type['id']]),
                        ['class' => ($realty_type == $type['id'])? 'text_active' : 'text_type' ] 
                    ) ?> 

                    <?php if ($realty_type == $type['id']) { 
                        echo Html::a( '<sup>x</sup>', Url::to(['realty/index']), ['class' => 'reset' ] );
                    } ?> 
                    </span>
                <?php } ?>
            </div>

            <div class="order">
                Сортировать по:
                <span><?= Html::a('Дешевле', ['realty/index', 'type' => $realty_type, 'sort' => 'price asc']) ?></span>
                <span><?= Html::a('Дороже', ['realty/index', 'type' => $realty_type, 'sort' => 'price desc']) ?></span>
                <span><?= Html::a('Дата', ['realty/index', 'type' => $realty_type, 'sort' => 'created_at']) ?></span>
            </div>
                    
            <?php foreach ($models as $house) : ?>
            <div class="row block-item">
                <div class="col-md-2">
                    <a href="<?= Url::to(['realty/item', 'id' => $house->id]) ?>">
                        <img src="<?= RealtyImage::thumbnail($house->path) ?>" class="img-thumbnail" width="100" heght="100" />
                    </a>
                </div>
                <div class="col-md-9 item-info">
                    <p class="address"><?= Html::a($house->title, ['realty/item', 'id' => $house['id']], ['class'=>'underline']) ?></p>
                    <p class="price"><span class="sum"><?= Yii::$app->formatter->asInteger($house['price']) ?> Руб.</span></p>
                    <p class="transaction"><?= $house->realtyTransactionName ?></p>
                    <p>
                        <?= (isset($house['full_area']))? 
                            ('<span class="area">общяя ' . $house['full_area'] . ' м<sup>2</sup></span>') : '' ?>
                        <?= (isset($house['live_area']))?
                            ('<span class="area">жилая ' . $house['live_area'] . ' м<sup>2</sup></span>') : '' ?>
                        <?= (isset($house['kitchen_area']))? 
                            ('<span class="area">кухня ' . $house['kitchen_area'] . ' м<sup>2</sup></span>') : '' ?>
                    </p>
                    </p> <span class="createdat"><?= Yii::$app->formatter->asDatetime($house['created_at'], 'dd.MM.Y'); ?></span></p>
                </div>
            </div>

            <?php endforeach ?>

            <?php if (empty($models)) { ?>
            <h3>Ничего не найденно :(</h3>
            <?php } ?>

            <?= LinkPager::widget([
            'pagination' => $pages,
            ]); ?>

            <hr/>
            <p>Продажа и аренда квартир, комнат, коттеджей и земельных участков в Кисловодске. 
                Для получения консультаций и общения с профессионалами рынка недвижимости Вы можете обратиться 
                к нашим специалистам.</p>
        </div> <!-- col-md-9 -->


    </div> <!-- row -->
</div> <!-- realty-index -->
