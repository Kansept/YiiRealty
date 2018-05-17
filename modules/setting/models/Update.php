<?php

namespace app\modules\page\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $status
 * @property string $alias
 */
class Update
{
    public function getLastVersion() 
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "http://kansept.ru/aginc/version.json");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $src = curl_exec($c);
        curl_close($c);

        $info = json_decode($src, true);
        
        return $info;
    }

    public function isExistNewVersion()
    {
        $currentVersion = \app\modules\admin\Module::VERSION;
        $info = $this->getLastVersion();

        if ( (float)$info['version'] <= (float)$currentVersion) {
            return [];
        } else {
            return $info;
        }
    }

}
