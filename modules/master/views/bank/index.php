<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\master\models\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-index">
    
    <p>
        <?= Html::a('&nbsp;<strong>Tambah Bank</strong>', ['create'], ['class' => 'fa fa-plus btn btn-success btn-lg',]) ?>
    </p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_bank',

            ['class' => 'yii\grid\ActionColumn',
            'header' => 'Aksi',
                'template' => '{view} {update} {delete}',
                'contentOptions' => ['style' => 'text-algin: center; width:120px;'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>',
                                Url::toRoute(['view', 'id' => $model->id_bank]),
                                ['class'=>'btn btn-success btn-xs aksi']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-pencil"></i>',
                                Url::toRoute(['update', 'id' => $model->id_bank]),
                                ['class'=>'btn btn-warning btn-xs aksi']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fa fa-trash-o"></i>',
                                Url::toRoute(['delete', 'id' => $model->id_bank]),
                                ['class'=>'btn btn-danger btn-xs aksi','data-method'=>'post', 'data-confirm'=>'Anda Yakin?']);
                    },
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
