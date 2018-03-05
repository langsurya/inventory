<?php

namespace app\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\master\models\Bank;

/**
 * BankSearch represents the model behind the search form of `app\modules\master\models\Bank`.
 */
class BankSearch extends Bank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bank', 'created_by', 'updated_by'], 'integer'],
            [['nama_bank', 'created_at', 'updated_at'], 'safe'],
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
        $query = Bank::find();

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
            'id_bank' => $this->id_bank,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_bank', $this->nama_bank]);

        return $dataProvider;
    }
}
