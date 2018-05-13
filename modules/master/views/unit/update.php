<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Unit */

$this->title = 'Update Unit: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel">
    <div class="panel-body">

        <div class="unit-update">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
