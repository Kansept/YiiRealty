<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{
    public function actionIndex() 
    {
        $this->actionLogin();
    }

    public function actionLogin()
    {
        $this->layout = "login.php";
       
        if (!Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute('/admin/dashboard/index')); 
        }
        
        $model = new \app\modules\admin\models\LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(Url::toRoute('/admin/dashboard/index')); 
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
    
        return $this->redirect(Url::toRoute('/admin/default/login')); 
    }

}
