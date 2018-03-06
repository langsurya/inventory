<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

\app\assets\BootstrapFileInputAsset::register($this);
\app\assets\Select2Asset::register($this);
\app\assets\DatePickerAsset::register($this);

$this->title = 'Permohonan Data Diri';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Data Diri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-form">
	
	<?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
            ],
        ]); 
    ?>

    <div class="panel panel-info">
    	<div class="panel-heading">Identitas Pegawai</div>
    	<div class="panel-body">
    		<?php echo $form->errorSummary($model); ?>
    		<div class="row">
    			<div class="col-lg-4">
    				<?= $form->field($model, 'foto')->fileInput() ?>
    			</div>
    			<div class="col-lg-4">
    				<?= $form->field($model, 'nama_pegawai')->textInput() ?>
    				<?= $form->field($model, 'nip_pegawai')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'readonly'=>true]) ?>
                    <?= $form->field($model, 'agama_id')->dropDownList(Yii::$app->helperData->listAgama(),['prompt'=>'- Pilih Agama -']) ?>
    				<?= $form->field($model, 'status')->hiddenInput(['value' => 0])->label(false) ?>
    			</div>
    			<div class="col-lg-4">
    				<?= $form->field($model, 'status_pernikahan')->dropDownList([ 'Menikah' => 'Menikah', 'Belum' => 'Belum', ], ['prompt' => '']) ?>
    				<?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>
    				<?= $form->field($model, 'tanggal_lahir')->textInput(['readonly'=>true]) ?>
    				<?= $form->field($model, 'jenis_kelamin')->dropDownList([ 'L' => 'Laki-Laki', 'P' => 'Perempuan', ], ['prompt' => '']) ?>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="panel panel-info">
    	<div class="panel-heading">Identitas Pegawai</div>
    	<div class="panel-body">
    		<div class="row">
    			<div class="col-lg-4">
    				<?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
    				<?= $form->field($model, 'nomor_telp')->widget(MaskedInput::classname(), [
                            'mask' => '9',
                            'clientOptions' => [
                                'repeat' => 16, 'greedy' => false,
                                'removeMaskOnSubmit' => true,
                            ],
                        ]); 
                    ?>
    			</div>
    			<div class="col-lg-4">
    				<?= $form->field($model, 'nomor_hp')->widget(MaskedInput::classname(), [
                            'mask' => '9',
                            'clientOptions' => [
                                'repeat' => 16, 'greedy' => false,
                                'removeMaskOnSubmit' => true,
                            ],
                        ]); 
                    ?>
    				<?= $form->field($model, 'golongan_darah')->dropDownList([ 'A' => 'A', 'B' => 'B', 'O' => 'O', 'AB' => 'AB', ], ['prompt' => '']) ?>
    			</div>
    			<div class="col-lg-4">
                    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'bank_id')->dropDownList(Yii::$app->helperData->listBank(),['prompt'=>'- Pilih -']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'nomor_rekening')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                	<?= $form->field($model, 'alamat_pegawai')->textArea(['maxlength' => true,'rows'=>3, 'placeholder'=>'isi dengan alamat jalan dan nomor rumah']) ?>
                </div>
    		</div>
    	</div>
    </div>
    <hr>

    <div class="form-group">
        <?= Html::submitButton('Ajukan Permohonan', ['class' =>'btn btn-success', 'data-confirm'=>'Anda Yakin?']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php

$this->registerCss("
    .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }
    .kv-avatar .file-input {
        display: table-cell;
        max-width: 220px;
    }
    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }
    .file-prev {
        max-width: 220px;
     }
");


$js = <<< DATADIRI

//JS FOR AVATAR
$("#pegawai-foto").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<i class="glyphicon glyphicon-folder-open"> Pilih</i>',
    removeIcon: '<i class="glyphicon glyphicon-remove"> Hapus</i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '.kv-fileinput-error',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar" style="width:100%">',
    layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "pdf"],
    msgSizeTooLarge : 'Maksimal file 5 Mb',
    msgInvalidFileExtension : 'File upload yang di izinkan hanya, PNG, JPG, dan PDF.'
});


//JS FOR WILAYAH
$("#transaksidatadiri-provinsi_id").on("change", function(){
    ajaxWilayah($(this).val(), 'transaksidatadiri-kabupaten_id');
    $('#transaksidatadiri-kecamatan_id').html('');
});

$("#transaksidatadiri-kabupaten_id").on("change", function(){
    ajaxWilayah($(this).val(), 'transaksidatadiri-kecamatan_id');
});

//JS FOR DATE INPUT
$('#pegawai-tanggal_lahir').datepicker({
    autoclose: true,
    endDate: '-17y',
    todayHighlight: true,
    format: 'yyyy-mm-dd',
});
$('#transaksidatadiri-tanggal_wafat').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
});
$('#transaksidatadiri-tanggal_pensiun').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
    startDate: '+1d',
});
$('#transaksidatadiri-tanggal_cpns').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
});
$('#transaksidatadiri-tmt_pangkat').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
});
$('#transaksidatadiri-tmt_jabatan').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
});

$("#transaksidatadiri-satker_id").select2({
    minimumInputLength: 2,
    ajax : {
        url : '/ajax/auto-complete-satker',
        dataType : 'JSON',
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true,
    },
});

DATADIRI;
$this->registerJs($js, $this::POS_END);
?>