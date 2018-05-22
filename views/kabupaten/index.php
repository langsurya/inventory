<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\Provinsi;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KabupatenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kabupatens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kabupaten-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kabupaten', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nama',
            [
            'attribute' => 'id_provinsi',
            'value' => function($data) {
                return $data->provinsi->nama;
            },
            'filter' => \kartik\select2\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'id_provinsi',
                'data' => ArrayHelper::map(Provinsi::find()->all(), 'id', 'nama')
            ]),
        ],
            // 'id_provinsi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
