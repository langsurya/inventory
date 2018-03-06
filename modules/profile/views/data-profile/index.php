<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\transaksi\models\TransaksiDataDiriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile';
?>

<div class="">
	<?php if ($statusTransaksi === 0): ?>
		<div class="alert alert-warning alert-dismissable">
            <center>Data diri anda sedang dalam proses verifikasi. mohon untuk sabar menunggu.</center>
        </div>
    <?php elseif ($statusTransaksi === 2) : ?>
    	<center>
        <div class="alert alert-danger alert-dismissable">
        Permohonan Data Diri anda ditolak, silahkan lakukan Permohonan Data Diri kembali.
        </div>
            <?= Html::a('Permohonan Data Diri', ['/profile/permohonan-data-pegawai/data-diri'], ['class'=>'btn btn-sm btn-warning']) ?>
        </center>
    <?php elseif ($statusTransaksi === false) : ?>
    	<center>
        <div class="alert alert-danger alert-dismissable">
        Anda belum memiliki data diri pegawai, silahkan lakukan Permohonan Data Diri terlebih dahulu.
        </div>
                <?= Html::a('Permohonan Data Diri', ['/profile/permohonan-data-pegawai/data-diri'], ['class'=>'btn btn-sm btn-warning']) ?>
        </center>
    <?php elseif($statusTransaksi === true): ?>
        <?php echo $this->render('profilePegawai', ['model'=>$model]) ?>
	<?php endif ?>
</div>