<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Products */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_product], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_product], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_product',
            'product_name',
            [
                'label' => 'Supplier',
                'value' => function($model){
                    return $model->supplier->company_name;
                }
            ],
            [
                'label' => 'Categories',
                'value' => function($model){
                    return $model->category->name;
                }
            ],
            [
                'label' => 'Unit',
                'value' => function($model){
                    return $model->unit->name;
                }
            ],
            'product_code',
            [
                'label' => 'Price',
                'value' => function($model){
                    return 'Rp '. number_format($model->price, 2, ',', '.');
                }
            ],
            [
                'label' => 'Selling Price',
                'value' => function($model){
                    return 'Rp '. number_format($model->selling_price, 2, ',', '.');
                }
            ],
            'alert_quantity',
            'description',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
