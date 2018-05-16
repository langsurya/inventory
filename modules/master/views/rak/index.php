<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'Raks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rak-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Rak', Url::to('#myModal', false), ['data-toggle'=>'modal', 'class' => 'btn btn-md btn-success']) ?>
    </p>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Create Rak</h4>
                </div>
                <div class="modal-body">

                    <?php $form = ActiveForm::begin([
                        'action' => ['/master/rak/create'],
                        ]); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'gudang_id')->dropDownList(Yii::$app->helperData->listGudang(),['prompt'=>'- Select Gudang -']) ?>

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

            [
                'attribute' => 'name',
                'header' => 'Rak',
                'value' => 'name',
            ],
            'description',
            [
                'attribute' => 'gudang',
                'value' => 'gudang.nama_gudang',
            ],
            [
                'attribute' => 'created_at',
                'header' => 'Created',
                'value' => 'created_at',
                'headerOptions' => ['style' => 'width:155px'],
            ],
            [
                'attribute' => 'updated_at',
                'header' => 'Last Update',
                'value' => 'updated_at',
                'headerOptions' => ['style' => 'width:155px'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
