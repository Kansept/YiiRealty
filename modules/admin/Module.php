<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';


    const VERSION = 0.2;
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        Yii::$app->errorHandler->errorAction = 'admin/default/error';
        
        $this->modules = [
            'filemanager' => [
              'class' => 'app\modules\filemanager\FileManager',
            ],
            'user' => [
              'class' => 'app\modules\user\User',
            ],
            'page' => [
                'class' => 'app\modules\page\Page',
            ],
            'menu' => [
                'class' => 'app\modules\menu\Menu',
            ],
            'rbac' => [
                'class' => 'mdm\admin\Module',
            ],
            'setting' => [
                'class' => 'app\modules\setting\Setting',
            ],
            'realty' => [
                'class' => 'app\modules\realty\Realty',
            ],
        ];
        
        $this->layout = 'main.php';
        // custom initialization code goes here
    }
}
