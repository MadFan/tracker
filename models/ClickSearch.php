<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Click;

/**
 * ClickSearch represents the model behind the search form about `app\models\Click`.
 */
class ClickSearch extends Click
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ip', 'error', 'bad_domain'], 'integer'],
            [['click_id', 'ua', 'ref', 'param1', 'param2'], 'safe'],
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
        $query = Click::find();

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
            'ip' => $this->ip,
            'error' => $this->error,
            'bad_domain' => $this->bad_domain,
        ]);

        $query->andFilterWhere(['like', 'click_id', $this->click_id])
            ->andFilterWhere(['like', 'ua', $this->ua])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'param1', $this->param1])
            ->andFilterWhere(['like', 'param2', $this->param2]);

        return $dataProvider;
    }
}
