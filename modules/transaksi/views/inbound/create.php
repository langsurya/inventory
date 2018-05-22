<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\transaksi\models\Inbound */

$this->title = 'Create Inbound';
$this->params['breadcrumbs'][] = ['label' => 'Inbounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">

    <div class="panel panel-info">
        <header class="panel-heading">
            Update Data
        </header>
        <div class="panel-body">
            
            <div class="inbound-create">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>

        </div>
    </div>

</div>
