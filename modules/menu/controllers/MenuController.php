<?php

namespace app\modules\menu\controllers;

use Yii;
use app\modules\menu\models\Menu;
use app\modules\menu\models\MenuSearch;
use app\modules\menu\models\MenuType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends \app\modules\admin\controllers\AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex($menutype)
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search($queryParams, $menutype);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'menu_type' => MenuType::findOne(['menutype' => $menutype]),
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($menutype)
    {
        $model = new Menu();

        if ( $model->load(Yii::$app->request->post()) ) {
            $parent = Menu::findOne($model->parent_id);
            $model->appendTo($parent)->save();

            return $this->redirect(['index', 'id' => $model->id, 'menutype' => $menutype]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'menu_type' => MenuType::findOne(['menutype' => $menutype]),                            
            ]);
        }
    }

    public function actionUpdate($id, $menutype)
    {
        $model = $this->findModel($id);

        if ( $model->load(Yii::$app->request->post()) ) {
            $post      = Yii::$app->request->post('Menu');
            $parent    = Menu::findOne($model->parent_id);
            $position  = $post['position'];

            if ($model->parent_id != $model->parentId && $model->id != $model->parent_id) {
                $model->appendTo($parent)->save();
            } else {
                if ($position == -1) {
                    $model->prependTo($parent)->save();
                } else if($position == -2) {
                    $model->appendTo($parent)->save();
                } else if ($position != $model->id) {
                    $modelUp = Menu::findOne(['id' => $position]);
                    $model->insertAfter($modelUp)->save();
                } else {
                    $model->save();
                }
            }
             
            return $this->redirect(['index', 'id' => $model->id, 'menutype' => $menutype]);
        }

        return $this->render('update', [
            'model' => $model,
            'menu_type' => MenuType::findOne(['menutype' => $menutype]),
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $menutype = $model->menutype;

        if ($model->isRoot())
            $model->deleteWithChildren();
        else 
            $model->delete();

        return $this->redirect( ['index', 'menutype' => $menutype] );
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRoot()
    {
        $root = new Menu();
        $root->title = 'Root';
        $root->link = '/';
        $root->makeRoot()->save();
    }


}
