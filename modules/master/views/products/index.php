<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Products', Url::to('#myModal', false), ['data-toggle'=>'modal', 'class' => 'btn btn-md btn-success']) ?>
    </p>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Create Suppliers</h4>
                </div>
                <div class="modal-body">

                    <?php $form = ActiveForm::begin([
                        'action' => ['/master/products/create'],
                        ]); ?>

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
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'product_name',
            [
                'attribute' => 'supplier',
                'header' => 'Supplier',
                'value' => 'supplier.company_name',
            ],
            [
                'attribute' => 'category',
                'header' => 'Categories',
                'value' => 'category.name',
            ],
            [
                'attribute' => 'unit',
                'header' => 'Unit',
                'value' => 'unit.name',
            ],
            //'product_code',
            [
                'header' => 'Price',
                'value' => function($model){
                    return 'Rp '. number_format($model->price, 2 , ',', '.');
                }
            ],
            //'selling_price',
            // 'alert_quantity',
            //'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
