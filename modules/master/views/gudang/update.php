<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\MasterGudang */

$this->title = $model->nama_gudang;
$this->params['breadcrumbs'][] = ['label' => 'Master Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_gudang, 'url' => ['view', 'id' => $model->id_gudang]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-12">

    <div class="panel panel-info">
        <header class="panel-heading">
            Update Data
        </header>
        <div class="panel-body">
            
            <div class="master-gudang-update">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>

        </div>
    </div>

</div>

