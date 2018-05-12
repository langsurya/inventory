<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Bank */

$this->title = $model->nama_bank;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_bank, 'url' => ['view', 'id' => $model->id_bank]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="panel">
    <div class="panel-body">
        
        <div class="bank-update">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
         
        </div>

    </div>
</div>

