<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Categories */

$this->title = 'Tambah Categori';
$this->params['breadcrumbs'][] = ['label' => 'Categori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
