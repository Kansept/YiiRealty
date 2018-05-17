<?php

namespace app\modules\realty\controllers;

use app\modules\realty\models\Realty;
use app\modules\realty\models\RealtyImage;
use app\modules\realty\models\RealtySearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * RealEstateController implements the CRUD actions for RealEstate model.
 */
class RealtyController extends Controller
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
     * Lists all RealEstate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RealtySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->view->title = "База недвижимости";

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RealEstate model.
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
     * Creates a new RealEstate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Realty();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->actionUpload($model, $model->id);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RealEstate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->actionUpload($model, $model->id);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RealEstate model.
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
     * Finds the RealEstate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Realty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Realty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload($model, $realty_id)
    {
        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload($realty_id)) {
                // file is uploaded successfully
                return true;
            } else {
                return false;
            }
        }

        // return $this->render('upload', ['model' => $model]);
    }

    public function actionDeleteimg()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $img_id = $data['img_id'];
            $result = 1;
            $image = RealtyImage::findOne($img_id);

            // Delete files
            $path = explode('/', $image->path);
            $filename = array_pop($path);
            $dir = implode('/', $path);
            $thumbnail = "{$dir}/thumbnail/{$filename}";
            if (is_file($image->path)) {
                unlink($image->path);
            }
            if (is_file($thumbnail)) {
                unlink($thumbnail);
            }
                
            // Delete from table
            $result = $image->delete();
            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [ 'status' => $result ];
        }
    }

    public function actionCoverimg()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $img_id = $data['img_id'];
            $realestate_id = $data['realty_id'];
            
            $realEstate = Realty::findOne($realestate_id);
            $realEstate->realty_image_id = $img_id;
            $realEstate->save();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        }
    }

}
