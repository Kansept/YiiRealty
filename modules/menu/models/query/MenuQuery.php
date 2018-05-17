<?php

namespace app\modules\menu\models\query;

use paulzi\nestedsets\NestedSetsQueryTrait;

class MenuQuery extends \yii\db\ActiveQuery
{
    use NestedSetsQueryTrait;
}
