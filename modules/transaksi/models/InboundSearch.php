<?php

namespace app\modules\transaksi\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\transaksi\models\Inbound;

/**
 * InboundSearch represents the model behind the search form of `app\modules\transaksi\models\Inbound`.
 */
class InboundSearch extends Inbound
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_inbound', 'rak_id', 'item_id', 'qty', 'status', 'created_by', 'updated_by'], 'integer'],
            [['ref_code', 'notes', 'expr_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = Inbound::find();
        $query->select(['ref_code', 'qty','rak_id', 'item_id']);
        $query->groupBy('ref_code');

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10    ,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    // 'ref_code' => SORT_ASC, 
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_inbound' => $this->id_inbound,
            'rak_id' => $this->rak_id,
            'item_id' => $this->item_id,
            'qty' => $this->qty,
            'expr_date' => $this->expr_date,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'ref_code', $this->ref_code])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
