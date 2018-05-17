<?php

use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

$this->title = "Файл менеджер";
$this->params['breadcrumbs'][] = $this->title;

echo ElFinder::widget([
    'language'         => 'ru',
    'controller'       => 'elfinder', 
    /* 
       будет открыта папка из настроек контроллера с добавлением указанной под деритории  
    */
    //  'path' => '', 
    /* 
       фильтр файлов, можно задать массив фильтров 
       https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
    */
    //  'filter'           => 'image', 
    'callbackFunction' => new JsExpression('function(file, id){}'), // id - id виджета
    'frameOptions' => [
        'style' => 'width: 100%; min-height: 550px; border: 0;'
    ],
]);
