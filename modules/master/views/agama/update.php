<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Agama */

$this->title = $model->agama;
$this->params['breadcrumbs'][] = ['label' => 'Agama', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->agama, 'url' => ['view', 'id' => $model->id_agama]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="panel">
    <div class="panel-body">

        <div class="agama-update">
        	
        	<?= $this->render('_form', [
        		'model' => $model,
        	]) ?>

        </div>
        
    </div>
</div>

