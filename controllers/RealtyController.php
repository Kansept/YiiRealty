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

        // Search
        $post = Yii::$app->request->post();
        if (Yii::$app->request->getIsPost()) {
            if ( !empty($post['realty_transaction']) ) {
                $query = $query->andWhere(['=', 'realty_transaction_id', $post['realty_transaction']]);
            }
            if ( !empty($post['realty_type']) ) {
                $query = $query->andWhere(['=', 'realty_type_id', $post['realty_type']]);
                $type = $post['realty_type'];
            }
            if ( !empty($post['price_from']) ) {
                $query = $query->andWhere(['>', 'price', $post['price_from']]);
            }  
            if ( !empty($post['price_to']) ) {
                $query = $query->andWhere(['<', 'price', $post['price_to']]);
            }  
            if ( !empty($post['room']) ) {
                $query = $query->andWhere([($post['room'] <= 4)? '=' : '>', 'room', $post['room']]);
            }
            if ( !empty($post['full_area_from']) ) {
                $query = $query->andWhere(['>', 'full_area', $post['full_area_from']]);
            }  
            if ( !empty($post['full_area_to']) ) {
                $query = $query->andWhere(['<', 'full_area', $post['full_area_to']]);
            }  
        }

        if(!empty($type)) {
            $query = $query->andWhere(['realty_type_id' => $type]);
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

        return $this->render('index', [
             'types' => Realty::getCountByType(),
             'models' => $models,
             'pages' => $pages,
             'post' => $post,
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
