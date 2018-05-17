<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

/**
 * Default controller for the `admin` module
 */
class AdminController extends Controller
{
    public function beforeAction($action) 
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        
        if (Yii::$app->user->isGuest && $action->id !== "login") {
            $this->redirect(Url::toRoute('/admin/default/login')); 
        }

        return true;
    }
/*
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            return '';
        }

        if($exception instanceof ForbiddenHttpException){
            return 'Oops, access forbidden: '.$exception->getMessage();
        }

    }
 */ 
    public function actionError() 
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {

            $code = $exception->statusCode;
            $message = $exception->getMessage();
            return $this->render('error', [
                'code' => $code,
                'message' => $message,
            ]);
        }
    }

}
