<?php

namespace app\modules\realty\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\realty\models\Realty;

/**
 * RealEstateSearch represents the model behind the search form about `app\modules\realestate\models\RealEstate`.
 */
class RealtySearch extends Realty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'realty_transaction_id', 'realty_type_id', 'room', 'floor', 'full_floor'], 'integer'],
            [['created_at', 'updated_at', 'city', 'street', 'description'], 'safe'],
            [['price', 'full_area', 'live_area', 'terra'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Realty::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author_id' => $this->author_id,
            'realty_transaction_id' => $this->realty_transaction_id,
            'realty_type_id' => $this->realty_type_id,
            'price' => $this->price,
            'room' => $this->room,
            'full_area' => $this->full_area,
            'live_area' => $this->live_area,
            'terra' => $this->terra,
            'floor' => $this->floor,
            'full_floor' => $this->full_floor,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
