<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\MasterGudang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-gudang-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nama_gudang')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alamat')->textarea(['rows' => '4', 'maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
