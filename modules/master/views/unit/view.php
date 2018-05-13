<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Unit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
