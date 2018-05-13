<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\master\models\UnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-body">

        <div class="unit-index">
            
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('Create Unit', Url::to('#myModal', false), ['data-toggle'=>'modal', 'class' => 'btn btn-md btn-success']) ?>
            </p>

            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">Create Unit</h4>
                        </div>
                        <div class="modal-body">

                            <?php $form = ActiveForm::begin([
                                'action' => ['/master/unit/create'],
                                ]); ?>

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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

                    'name',
                    'created_at',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Aksi',
                            'template' => '{view} {update} {delete}',
                            'contentOptions' => ['style' => 'text-algin: center; width:120px;'],
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-eye"></i>',
                                        Url::toRoute(['view', 'id' => $model->id]),
                                        ['class' => 'btn btn-success btn-xs aksi']);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-pencil"></i>',
                                    Url::toRoute(['update', 'id' => $model->id]),
                                    ['class'=>'btn btn-warning btn-xs aksi']);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-trash-o"></i>',
                                    Url::toRoute(['delete', 'id' => $model->id]),
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
