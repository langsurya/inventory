<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\transaksi\models\Inbound */

$this->title = $model->id_inbound;
$this->params['breadcrumbs'][] = ['label' => 'Inbounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inbound-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_inbound], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_inbound], [
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
            'id_inbound',
            'ref_code',
            'rak_id',
            'item_id',
            'qty',
            'notes:ntext',
            'expr_date',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
