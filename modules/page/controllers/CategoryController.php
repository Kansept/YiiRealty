<?php

namespace app\modules\page\controllers;

use Yii;
use app\modules\page\models\Category;
use app\modules\page\models\CategorySearch;
use app\modules\menu\Menu;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends \app\modules\admin\controllers\AdminController
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ( $model->load(Yii::$app->request->post()) ) {
            $parent = Category::findOne($model->parent_id);
            $model->appendTo($parent)->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( $model->load(Yii::$app->request->post()) ) {
            $post     = Yii::$app->request->post('Category');
            $parent   = Category::findOne($model->parent_id);
            $position = $post['position'];

            if ($model->parent_id != $model->oldAttributes['parent_id'] && $model->id != $model->parent_id) {
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
             
            return $this->redirect(['index', 'id' => $model->id]);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
