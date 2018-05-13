<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\master\models\SuppliersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-body">

        <div class="suppliers-index">
            
            <?php Pjax::begin(); ?>
            <p>
                <?= Html::a('Create Suppliers', Url::to('#myModal', false), ['data-toggle'=>'modal', 'class' => 'btn btn-md btn-success']) ?>
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
                                'action' => ['/master/suppliers/create'],
                                ]); ?>

                            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'supplier_name')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>

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

                    'company_name',
                    'supplier_name',
                    'phone',
                    'email:email',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Aksi',
                            'template' => '{view} {update} {delete}',
                            'contentOptions' => ['style' => 'text-algin: center; width:120px;'],
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-eye"></i>',
                                        Url::toRoute(['view', 'id' => $model->id_supplier]),
                                        ['class' => 'btn btn-success btn-xs aksi']);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-pencil"></i>',
                                    Url::toRoute(['update', 'id' => $model->id_supplier]),
                                    ['class'=>'btn btn-warning btn-xs aksi']);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-trash-o"></i>',
                                    Url::toRoute(['delete', 'id' => $model->id_supplier]),
                                    ['class'=>'btn btn-danger btn-xs aksi','data-method'=>'post', 'data-confirm'=>'Anda Yakin?']);
                                },
                            ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>

    </div>
</div>
