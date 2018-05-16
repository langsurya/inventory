<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Customers', Url::to('#myModal', false), ['data-toggle'=>'modal', 'class' => 'btn btn-md btn-success']) ?>
    </p>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Create Customers</h4>
                </div>
                <div class="modal-body">

                    <?php $form = ActiveForm::begin([
                        'action' => ['/master/customer/create'],
                        ]); ?>

                    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>

                    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

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

            'customer_name',
            'email:email',
            [
                'attribute' => 'phone',
                'headerOptions' => ['style' => 'width:150px'],
            ],
            'address:ntext',
            [
                'attribute' => 'city',
                'headerOptions' => ['style' => 'width:150px'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
