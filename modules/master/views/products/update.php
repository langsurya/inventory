<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Products */

$this->title = 'Update Products';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_name, 'url' => ['view', 'id' => $model->id_product]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel">
    <div class="panel-body">

        <div class="products-update">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
