<?php

namespace app\modules\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\master\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\modules\master\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public $category;
    public $supplier;
    public $unit;

    public function rules()
    {
        return [
            [['id_product', 'supplier_id', 'category_id', 'unit_id', 'price', 'selling_price', 'alert_quantity', 'created_by', 'updated_by'], 'integer'],
            [['product_name', 'category', 'supplier', 'unit', 'product_code', 'description', 'created_at', 'updated_at'], 'safe'],
        ];
    }

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
        $query = Products::find();

        // add conditions that should always apply here

        $query->joinWith(['category', 'supplier', 'unit']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['category'] = [
            'asc' => ['master_category.name' => SORT_ASC],
            'desc' => ['master_category.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['supplier'] = [
            'asc' => ['master_suppliers.company_name' => SORT_ASC],
            'desc' => ['master_suppliers.company_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['unit'] = [
            'asc' => ['master_unit.name' => SORT_ASC],
            'desc' => ['master_unit.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_product' => $this->id_product,
            'supplier_id' => $this->supplier_id,
            'category_id' => $this->category_id,
            'unit_id' => $this->unit_id,
            'price' => $this->price,
            'selling_price' => $this->selling_price,
            'alert_quantity' => $this->alert_quantity,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'master_categories.name', $this->category])
            ->andFilterWhere(['like', 'master_suppliers.company_name', $this->supplier])
            ->andFilterWhere(['like', 'master_unit.name', $this->unit])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
