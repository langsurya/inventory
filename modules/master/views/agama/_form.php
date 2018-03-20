<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Agama */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agama-form">
	
	<?php $form = ActiveForm::begin([
		'id' => 'form-terms','enableAjaxValidation' => false,
		'enableClientValidation' => true,
		'skipOnEmpty' => false, 
		'skipOnError' => false
		]); 
	?>

	<?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
