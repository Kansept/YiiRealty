<?php
namespace app\assets;

use yii\web\AssetBundle;

class Lightbox2Asset extends AssetBundle
{
    public $sourcePath = 'js/lightbox2/dist';
    public $css = ['css/lightbox.min.css'];
    public $js = ['js/lightbox.min.js'];
    public $depends = ['yii\web\JqueryAsset'];
}