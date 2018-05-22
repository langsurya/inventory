<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\transaksi\models\InboundSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inbounds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inbound-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Inbound', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_inbound',
            'ref_code',
            'rak.gudang.nama_gudang',
            'rak.name',
            'item.product_name',
            'qty',
            [
                'header' => 'Jumlah',
                'value' => function($model){
                    return Yii::$app->formatter->format('2018-04-01', 'date');;
                }
            ],
            //'notes:ntext',
            //'expr_date',
            //'status',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
