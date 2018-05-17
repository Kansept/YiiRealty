<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\modules\realty\models\RealtyImage;

/* @var $this yii\web\View */

$realty_type = Yii::$app->request->get('type');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realty-index">
        <div class="row">
            <div class="col-md-8">

                <div class="realty-type">
                    <?php foreach ($types as $type) { ?>
                        <span <?= ($realty_type == $type['id'])? 'class="block_active"' : 'block_type' ?> ?>
                        <?= Html::a(
                            $type['name'] . '('.$type['count'].')', 
                            Url::to(['realty/index', 'type' => $type['id']]),
                            ['class' => ($realty_type == $type['id'])? 'text_active' : 'text_type' ] 
                        ) ?> 

                        <?php if ($realty_type == $type['id']) {
                            echo Html::a(
                                '<sup>x</sup>', 
                                Url::to(['realty/index']),
                                ['class' => 'reset' ] 
                            );
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

                <?php foreach ($models as $house) { ?>
                <div class="row block-item">
                    <div class="col-md-3">
                        <a href="<?= Url::to(['realty/item', 'id' => $house->id]) ?>">
                        	<img src="<?= RealtyImage::thumbnail($house->path) ?>" width="100" heght="100" />
                        </a>
                    </div>
                    <div class="col-md-9">
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
                        </p> <span class="created_at"><?= Yii::$app->formatter->asDatetime($house['created_at'], 'dd.MM.Y'); ?></span></p>
                    </div>
                </div>
                <hr/>
                <?php } ?>

                <?= LinkPager::widget([
                'pagination' => $pages,
                ]); ?>

                <p>Продажа и аренда квартир, комнат, коттеджей и земельных участков в Кисловодске. 
                    Для получения консультаций и общения с профессионалами рынка недвижимости Вы можете обратиться 
                    к нашим специалистам.</p>
            </div>
        </div>
</div>
