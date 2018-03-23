<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Bank */

$this->title = $model->nama_bank;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_bank], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_bank], [
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
            'id_bank',
            'nama_bank',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
