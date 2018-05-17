<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\realty\models\Realty;
use app\modules\realty\models\RealtyImage;

class RealtyController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $sort = Yii::$app->request->get('sort', 'created_at');
        $type = Yii::$app->request->get('type');

        $query = Realty::find()->orderBy($sort);

        if(!empty($type)) {
            $query = $query->where(['realty_type_id' => $type]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $models = $query
            ->select(['realty.id', 'realty_type_id', 'realty_transaction_id',  'street', 'room', 
                'full_area', 'live_area', 'terra', 'price', 'created_at', 'realty_image.path'])
            ->leftJoin('realty_image', 'realty_image.id = realty.realty_image_id')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->view->title = "База недвижимости";        


        $types = Yii::$app->db->createCommand('
            SELECT t.id, t.name, COUNT(*) count 
            FROM realty r
            INNER JOIN realty_type t ON t.id = r.realty_type_id
            GROUP BY t.id, t.name
            ORDER BY t.id
        ')->queryAll();

        return $this->render('index', [
             'types' => $types,
             'models' => $models,
             'pages' => $pages,
        ]);
    }


    public function actionItem($id)
    {
        $model = Realty::find()->where(['id' => $id])->one();
        if ($model === null) {
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        $images = RealtyImage::find()->where(['realty_id' => $id])->all();

        $this->view->registerCssFile('css/jcarousel.connected-carousels.css');

        $this->view->title = $model->street;
        return $this->render('realty', [
            'id' => $id,
            'model' => $model, 
            'images' => $images,
        ]);
    }
}
