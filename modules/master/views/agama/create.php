<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Agama */

$this->title = 'Create Agama';
$this->params['breadcrumbs'][] = ['label' => 'Agama', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-body">
        
        <div class="agama-create">

        	<?= $this->render('_form', [
        		'model' => $model,
        	]) ?>

        </div>

    </div>
</div>
