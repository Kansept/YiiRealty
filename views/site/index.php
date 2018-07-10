<?php

use yii\bootstrap\Carousel;
/* @var $this yii\web\View */

?>
<div class="site-index">

    <?php
    echo Carousel::widget ( [
        'items' => [
            [
                'content' => '<img style="width:100%;" src="\images\slide-big\bg1.jpg"/>',
                'caption' => '
                    <div class="slider-text hidden-xs">
                        <h2>Безопасная сделка</h2>
                        <p>Приобретение недвижимости – это достаточно сложный процесс, требующий обязательного содействия опытных риэлторов и юристов.
                            Мы предоставляем полный спектр услуг по недвижимости, что дает возможность решать сложные вопросы при покупке квартиры.</p>
                    </div>
                ',
                'options' => []
            ],
            [
                'content' => '<img style="width:100%;"  src="\images\slide-big\bg2.jpg"/>',
                'caption' => '
                    <div class="slider-text hidden-xs">
                        <h2>Купить квартиру в новостройке</h2>
                        <p>Агентство недвижимости «Готовый сайт» предлагает эффективную помощь в выборе квартир в новостройках.
                            Наши специалисты проконсультируют вас по вопросам выбора ипотечной программы и подготовят необходимый пакет документов.</p>
                    </div>
                ',
                'options' => []
            ],
            [
                'content' => '<img style="width:100%;"  src="\images\slide-big\bg3.jpg"/>',
                'caption' => '
                    <div class="slider-text hidden-xs">
                        <h2>Оформить разрешение на строительство</h2>
                        <p>Разрешение на строительство объекта будет оформлено в кратчайшие сроки,
                            при этом, что немаловажно, по вполне доступной цене, без лишней документации и поможем Вам сэкономить ваши деньги и время.</p>
                    </div>
                ',
                'options' => []
            ]
        ],
        'options' => [
            'style' => 'width:100%;',
            'class' => 'hidden-xs'
        ]
    ]);
    ?>

    <div class="title">
        <h1>Центр недвижимости PLATINUM</h1>
        <p class="lead">опыт основанный на знаниях, у Вас на службе!</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 info-block">
                <h4>Большой опыт сопровождения сделок</h4>
                <p>За плечами более 120 успешно зарегистрированных переходов права на недвижимость.
                    Вы выбираете недвижимость, мы подготавливаем договора, собираем справки, даём
                    юридическое заключение, обеспечиваем юридическое сопровождение.</p>
            </div>
            <div class="col-lg-4 info-block">
                <h4>Услуги по подбору недвижимости</h4>
                <p>Экономия Вашего времени путем выявления Вашей потребности и демонстрации объектов
                    соответствующих Вашим запросам.</p>
            </div>
            <div class="col-lg-4 info-block">
                <h4>Комфортное и безопасное прохождение сделки</h4>
                <p>К Вашим услугам удобная переговорная в центре Кисловодска!
                    Разработка процедуры безопасной передачи денег.
                    предварительная запись на регистрацию и экспертиза пакета документов, избавят Вас от
                    неожиданностей.</p>
            </div>
            <div class="col-md-12">
                <div class="title">
                    <p class="lead">Высокое качество обслуживания, гарантии конфеденциальности</p>
                </div>
            </div>
        </div>

        <!--
        <div class="row">
            <div class="col-md-12">
            <h3>Квартиры и дома с низкой ценой</h3>
            </div>
        </div>
        -->

        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h3>Месторасположение офиса</h3>
                </div>
                <div id="map" style="width: 100%; height: 450px"></div>
            </div>            
        </div>
    </div>
</div>
