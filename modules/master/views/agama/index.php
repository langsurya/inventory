<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\master\models\AgamaSearch */
/* @var $dataProvider yii\data\ActiveDataProvier */

$this->title = 'Agama';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agama-index">

	<p>
		<?= Html::a('Create Agama', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'agama',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); 
?>
<?php Pjax::end(); ?></div>
