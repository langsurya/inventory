<?php

use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\widget\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
\app\assets\FancyboxAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\Pegawai */

$this->title = $model->nama_pegawai;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Data Diri', 'url' => ['list-data-diri']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel">
    <div class="panel-body">

        <style type="text/css">
            .isi {
                margin-left: 25px;
            }
        </style>
        <header class="panel-heading clearfix">
            <h3 class="profile-title pull-left"><?php echo $model->nama_pegawai ?></h3>
        </header>

        <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->errorSummary($model) ?>

        <div class="panel-body row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="profile-thumb">
                        <img src="<?php echo $model->foto ?>" style="width:100%">
                    </div>
                    <hr>
                    <div class="profile-info well">
                    <h5>General</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa fa-user-circle"></i>
                            <div class="p-i-list">
                                <span class="text-muted">Status Pegawai</span>
                                <?php echo "Karyawan" ?>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-user-circle-o"></i>
                            <div class="p-i-list">
                                <span class="text-muted">Tipe Pegawai</span>
                                <?php echo $model->nama_pegawai ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="profile-info well">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa fa-headphones"></i>
                            <div class="p-i-list">
                                <span class="text-muted">Nomor Telp</span>
                                <?php echo $model->nomor_telp ?>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-phone-square"></i>
                            <div class="p-i-list">
                                <span class="text-muted">Nomor HP</span>
                                <?php echo $model->nomor_hp ?>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            <div class="p-i-list">
                                <span class="text-muted">E-mail</span>
                                <?php echo $model->email ?>
                            </div>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="col-md-8">
                <?php 
                    echo DetailView::widget([
                        'model' => $model,
                        'template' => "<tr><th width='30%'>{label}</th><td>{value}</td></tr>",
                        'attributes' => [
                            'nama_pegawai',
                            'tempat_lahir',
                            [
                                'attribute'=>'tanggal_lahir',
                                'value'=>function($model){
                                    return $model->tanggal_lahir;
                                }
                            ],
                            [
                                'attribute'=>'jenis_kelamin',
                                'value'=>function($model){
                                    return ($model->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan';
                                }
                            ],
                            [
                                'attribute'=>'agama_id',
                                'value'=>function($model){
                                    return Yii::$app->helperData->agamaName($model->agama_id);
                                }
                            ],
                            'status_pernikahan',
                            'golongan_darah',
                            'npwp',
                            'nik',
                            'bank.nama_bank',
                            'nomor_rekening',
                            
                        ],
                    ])
                ?>
            </div>
        </div>

        <div class="row" style="color: purple">
            <?php if($model->status == 0): ?>
                <?= Html::button('Verifikasi', ['class' => 'btn btn-success','id'=>'modalButton']) ?>
            <?php else: ?>
                Status <?php echo ($model->status == 1) ? "Terverifikasi" : "Ditolak" ?> 
                Oleh <?php echo Yii::$app->helperData->pegawaiName($model->updated_by) ?>
                Pada <?php echo $model->updated_at ?>
            <?php endif; ?>
        </div>


        <!-- Modal -->
        <div id="modal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Verifikasi</h4>
              </div>
              <div class="modal-body">

                    <?= 
                        $form->field($model, 'status')
                                    ->radioList([1=>'Terverifikasi','Tolak'],
                                    [
                                        'item' => function($index, $label, $name, $checked, $value) {

                                            $return = '<label class="radio-inline i-checks">';
                                            $return .= '<input type="radio" name="' . $name . '" value="' . $value . '">';
                                            $return .= '<i></i>';
                                            $return .= ucwords($label);
                                            $return .= '</label>';

                                            return $return;
                                        }
                                    ]
                                    )

                    ?>

                    <?= $form->field($model,'keterangan')->textArea(['maxlength' => true,'rows'=>6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>        
        
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$js = <<< JSPANEL
    $(document).ready(function() {
        $(".fancybox-effects-a").fancybox();
        
        $(".panel").addClass("profile-wrap");
        $('.field-pegawai-keterangan').hide();
        $("#modalButton").click(function(){
            $("#modal").modal('show');
        });

        $('#pegawai-status input').on('change', function() {
            var value = $("input[name='Pegawai[status]']:checked", '#pegawai-status').val();
            if(value == 2){
                $('.field-pegawai-keterangan').show();
            } else {
                $('.field-pegawai-keterangan').hide();
            }

        });
    });
JSPANEL;
$this->registerJs($js, $this::POS_END);
?>