<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Rak */

$this->title = 'Update Rak';
$this->params['breadcrumbs'][] = ['label' => 'Raks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_rak]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="col-md-12">

    <div class="panel panel-info">
        <header class="panel-heading">
            Update Data
        </header>
        <div class="panel-body">
            
            <div class="rak-update">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>

        </div>
    </div>

</div>