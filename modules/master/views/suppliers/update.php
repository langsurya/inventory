<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Suppliers */

$this->title = 'Update Suppliers: '.$model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company_name, 'url' => ['view', 'id' => $model->id_supplier]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel">
    <div class="panel-body">

        <div class="suppliers-update">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
