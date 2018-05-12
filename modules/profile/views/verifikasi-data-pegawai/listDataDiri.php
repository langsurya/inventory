<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\profile\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pegawai';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-body">
        
        <div class="pegawai-index">
            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    
                    'nip_pegawai',
                    'nama_pegawai',
                    [
                        'attribute'=>'status',
                        'filter'=>[0=>'Belum Diverifikasi','Terverifikasi','Ditolak'],
                        'value'=>function($data){
                            if($data->status == 0)
                                return "Belum Diverifikasi";
                            else if($data->status == 1)
                                return "Terverifikasi";
                            else
                                return "Ditolak";
                        }
                    ],
                    // 'tempat_lahir',
                    //'tanggal_lahir',
                    //'jenis_kelamin',
                    //'agama_id',
                    //'status_pernikahan',
                    //'golongan_darah',
                    //'email:email',
                    //'alamat_pegawai:ntext',
                    //'keterangan',
                    //'status',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Aksi',
                        'template' => '{view}',
                        'contentOptions' => ['style' => 'text-align: center; width:120px;'],
                        'buttons' => [
                            'view' => function ($url, $model) {
                                if($model->status == 0)
                                    return  Html::a('Verifikasi',
                                            Url::toRoute(['view-data-diri', 'id' => $model->id_pegawai]),
                                            ['class'=>'btn btn-success btn-xs aksi']);
                                if($model->status == 1)
                                    return  $model->updated_at;
                            },
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        
    </div>
</div>
