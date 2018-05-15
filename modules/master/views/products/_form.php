<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'supplier_id')->dropDownList(Yii::$app->helperData->listSupplier(),['prompt'=>'- Select Suppliers -']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList(Yii::$app->helperData->listCategory(),['prompt'=>'- Select Categories -']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'unit_id')->dropDownList(Yii::$app->helperData->listUnit(),['prompt'=>'- Select Unit -']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput() ?>                            
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'selling_price')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'alert_quantity')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
