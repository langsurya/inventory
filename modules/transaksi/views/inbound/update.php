<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\transaksi\models\Inbound */

$this->title = 'Update Inbound: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Inbounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_inbound, 'url' => ['view', 'id' => $model->id_inbound]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-12">

    <div class="panel panel-info">
        <header class="panel-heading">
            Update Data
        </header>
        <div class="panel-body">
            
            <div class="inbound-update">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>

        </div>
    </div>

</div>
