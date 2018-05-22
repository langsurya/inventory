<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;

use app\modules\master\models\Rak;

/* @var $this yii\web\View */
/* @var $model app\modules\transaksi\models\Inbound */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inbound-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ref_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">            
            <?= $form->field($model, 'rak_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Rak::find()->all(), 'id_rak', 'name'),
                    'options' => ['placeholder' => 'Select a Rak ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
        
        <?=  $form->field($model, 'rak_id')->dropDownList(Yii::$app->helperData->getOptions(),['prompt'=>'- Select Rak -']) ?>

    </div>


    <?php 

    $commonAttributeOptions = [
        'enableAjaxValidation'   => true,
        'enableClientValidation' => false,
        'validateOnChange'       => false,
        'validateOnSubmit'       => true,
        'validateOnBlur'         => false,
    ];
    $data = [
        "Gudang ATK" => ["RA01","RA02","RA03", "RA04"],
        "Gudang Pusat" => ["RGP01"],
        "Gudang Mawar" => ["MR01","RGM02"]
    ];
    // dd($data);
    // $data = ArrayHelper::map(\app\modules\master\models\Products::find()->all(), 'id_product', 'product_name');
    echo MultipleInput::widget([
                            'model' => $model,
                            'attribute' => 'experience',
                            'attributeOptions' => $commonAttributeOptions,
                            'max' => 4,
                            'attributeOptions' => [
                                'enableClientValidation' => true,
                                'validateOnChange' => true,
                            ],
                            'columns' => [
                                [
                                    'name' => 'item_id',
                                    'type'  => 'dropDownList',
                                    'title' => 'Products',
                                    'items' => $data,
                                    // 'items' => ArrayHelper::map(\app\modules\master\models\Products::find()->all(), 'id_product', 'product_name'),
                                ],
                                [
                                    'name' => 'qty',
                                    'title' => 'Qty',
                                    'value' => function($data) {
                                        return 0;
                                    },
                                    'options' => [
                                        // 'type' => 'hidden',
                                        // 'style' => 'width: 120px',
                                    ],
                                ],
                                [
                                    'name' => 'notes',
                                    'type' => 'textarea',
                                    'title' => 'Catatan',
                                ],
                                [
                                    'name'  => 'expr_date',
                                    'type'  => \kartik\date\DatePicker::className(),
                                    'title' => 'Expired',
                                    'options' => [
                                        'readonly'=>true,
                                        'removeButton' => false,
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd',
                                            'autoclose' => true,
                                            'todayHighlight' => true
                                        ]
                                    ]
                                ],
                                
                            ],
                        ]);

    // $form->field($model, 'Products')->widget(MultipleInput::className(), [
    //     'max' => 10,
    //     'columns' => [
    //         [
    //             'name'  => 'item_id',
    //             'type'  => 'dropDownList',
    //             'title' => 'Products',
    //             'defaultValue' => 1,
    //             'items' => ArrayHelper::getColumn(\app\modules\master\models\Products::find()->all(), 'product_name'),
                
    //         ],
    //         [
    //             'name'  => 'qty',
    //             'title' => 'Qty',
    //             'enableError' => true,
    //             'options' => [
    //                 'class' => 'input-priority',
    //                 'style' => 'width: 100px',
    //             ]
    //         ],
    //         [
    //             'name'  => 'notes',
    //             'type' => 'textarea',
    //             'title' => 'Catatan',
    //             'enableError' => true,
    //             'options' => [
    //                 'class' => 'input-priority',
    //                 'rows' => "2",
    //             ]
    //         ],
    //         [
    //             'name'  => 'expr_date',
    //             'type'  => \kartik\date\DatePicker::className(),
    //             'title' => 'Expired',
    //             'options' => [
    //                 'readonly'=>true,
    //                 'removeButton' => false,
    //                 'pluginOptions' => [
    //                     'format' => 'yyyy-mm-dd',
    //                     'autoclose' => true,
    //                     'todayHighlight' => true
    //                 ]
    //             ]
    //         ],
    //     ]
    //  ])->label(false);
    
    ?>

    <?php // $form->field($model, 'qty')->textInput() ?>

    <?php // $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'expr_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
