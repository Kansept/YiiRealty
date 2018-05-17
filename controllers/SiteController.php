<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->registerMetaTag([
            'name' => 'description', 'content' => 'description set'
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'keywords', 'content' => 'Keywords set inside controller',
        ]);

        $this->view->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
        $this->view->registerJsFile('js/yamap.js');
        
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionPage($id)
    {
        $model = \app\modules\page\models\Page::find()->where(['id' => $id])->one();
        if ($model === null) {
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        $this->view->title = $model->name;
        return $this->render('page', ['model' => $model, 'id' => $id]);
    }

    public function actionRealEstateType($id)
    {
        $query = \app\modules\realestate\models\Realty::find()->where(['type' => $id]);
        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        if ($models === null) {
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        return $this->render('real-estate-type', [
            'models' => $models, 
            'pages' => $pages, 
            'id' => $id
        ]);
    }

    public function actionRealEstate($id)
    {
        $model = \app\modules\realestate\models\Realty::find()->where(['id' => $id])->one();
        if ($model === null) {
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        return $this->render('real-estate', ['model' => $model, 'id' => $id]);
    }
}
