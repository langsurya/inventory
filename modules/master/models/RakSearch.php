<?php

namespace app\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\master\models\Rak;

/**
 * RakSearch represents the model behind the search form of `app\modules\master\models\Rak`.
 */
class RakSearch extends Rak
{
    /**
     * @inheritdoc
     */
    public $gudang;
    
    public function rules()
    {
        return [
            [['id_rak', 'gudang_id', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description', 'gudang', 'created_at', 'updated_at'], 'safe'],
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
        $query = Rak::find();

        // add conditions that should always apply here

        $query->joinWith('gudang');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['gudang'] = [
            'asc' => ['master_gudang.nama_gudang' => SORT_ASC],
            'desc' => ['master_gudang.nama_gudang' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_rak' => $this->id_rak,
            'gudang_id' => $this->gudang_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'master_gudang.nama_gudang', $this->gudang])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
