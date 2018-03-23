<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\master\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('&nbsp;<strong>Tambah Categori</strong>', ['create'], ['class' => 'fa fa-plus btn btn-success btn-lg']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_category',
            'name',
            'description',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
            'header' => 'Aksi',
                'template' => '{view} {update} {delete}',
                'contentOptions' => ['style' => 'text-algin: center; width:120px;'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>',
                            Url::toRoute(['view', 'id' => $model->id_category]),
                            ['class' => 'btn btn-success btn-xs aksi']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-pencil"></i>',
                        Url::toRoute(['update', 'id' => $model->id_category]),
                        ['class'=>'btn btn-warning btn-xs aksi']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fa fa-trash-o"></i>',
                        Url::toRoute(['delete', 'id' => $model->id_category]),
                        ['class'=>'btn btn-danger btn-xs aksi','data-method'=>'post', 'data-confirm'=>'Anda Yakin?']);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
