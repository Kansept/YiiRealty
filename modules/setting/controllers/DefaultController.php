<?php

namespace app\modules\setting\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'version' => \app\modules\admin\Module::VERSION,
        ]);
    }

    public function actionCheckVersion() 
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "http://kansept.ru/aginc/version.json");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $src = curl_exec($c);
        curl_close($c);

        $info = json_decode($src, true);
        $currentVersion = \app\modules\admin\Module::VERSION;
        if ( (float)$info['version'] <= (float)$currentVersion) {
            return [];
        } else {
            return $info;
        }
    }

    public function actionUpdate() 
    {
        set_time_limit(60);
        
        $local = Yii::$app->basePath . '/download/update-cms-aginc.zip';
        $url = 'http://kansept.ru/aginc/update-cms-aginc.zip';
        
        $fp = fopen ($local, 'w+');
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        curl_close($ch);

        $zip = new \ZipArchive();
        if ($zip->open($local) === TRUE) {
            $zip->extractTo(Yii::$app->basePath);
            $zip->close();

            return $this->render('update');
        } else {
            echo 'ошибка обновления!';
        }

    }
}
