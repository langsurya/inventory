<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\MasterGudang */

$this->title = $model->nama_gudang;
$this->params['breadcrumbs'][] = ['label' => 'Master Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_gudang, 'url' => ['view', 'id' => $model->id_gudang]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-gudang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
