<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Suppliers */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-body">
        <div class="suppliers-view">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id_supplier], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id_supplier], [
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
                    'id_supplier',
                    'company_name',
                    'supplier_name',
                    'phone',
                    'email:email',
                    'address:ntext',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>

        </div>
    </div>
</div>
