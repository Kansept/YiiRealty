<?php

namespace app\modules\page\models\query;

use paulzi\nestedsets\NestedSetsQueryTrait;

class CategoryQuery extends \yii\db\ActiveQuery
{
    use NestedSetsQueryTrait;
}

