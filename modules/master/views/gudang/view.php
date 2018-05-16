<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\MasterGudang */

$this->title = $model->nama_gudang;
$this->params['breadcrumbs'][] = ['label' => 'Master Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">

    <div class="panel panel-info">
        <header class="panel-heading">
        </header>
        <div class="panel-body">
            
            <div class="master-gudang-update">

                <div class="master-gudang-view">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id_gudang], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id_gudang], [
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
                    'id_gudang',
                    'nama_gudang',
                    'alamat',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>

        </div>

            </div>

        </div>
    </div>

</div>