<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login Inventory';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
    ],
]); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'username'])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder'=>'password'])->label(false) ?>

<?= $form->field($model, 'rememberMe')->checkbox([
    'template' => "<div class=\"col-lg-12\">{input} {label}</div>\n<div class=\"col-lg-12\">{error}</div>",
]) ?>

<div class="form-group">
    <div class="col-lg-offset-4 col-lg-7">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<center>Lupa Password? <a href="/site/request-password-reset">Klik Disini.</a></center>