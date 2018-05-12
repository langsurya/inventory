<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Agama */

$this->title = $model->agama;
$this->params['breadcrumbs'][] = ['label' => 'Agama', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-body">
    	
		<div class="agama-view">

			<p>
				<?= Html::a('Update', ['update', 'id' => $model->id_agama], ['class' => 'btn btn-primary']) ?>
				<?= Html::a('Delete', ['delete', 'id' => $model->id_agama], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
			</p>

			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
					'id_agama',
					'agama',
					'created_by',
					'updated_by',
					'created_at',
					'updated_at'
				],
			]) ?>
			
		</div>
        
    </div>
</div>

