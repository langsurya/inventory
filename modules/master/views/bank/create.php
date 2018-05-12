<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Bank */

$this->title = 'Tambah Bank';
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-body">
        
        <div class="bank-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?> 

        </div>
        
    </div>
</div>

