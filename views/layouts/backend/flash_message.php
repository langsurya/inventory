<?php
use yii\helpers\Html;
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable timer">
        <button aria-hidden="true" data-dismiss="alert" class="close pull-right" type="button"><i class="fa fa-close"></i></button>
    <?= Yii::$app->session->getFlash('success') ?><p class="pull-right countDown">07</p>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable timer">
        <button aria-hidden="true" data-dismiss="alert" class="close pull-right" type="button"><i class="fa fa-close"></i></button>
    <?= Yii::$app->session->getFlash('error') ?><p class="pull-right countDown">07</p>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('warning')): ?>
    <div class="alert alert-warning alert-dismissable timer">
    <?= Yii::$app->session->getFlash('warning') ?><p class="pull-right countDown">07</p>
    </div>
<?php endif; ?>

<?php
$js = <<< NOTIFS
    $('.timer').delay(7000).fadeOut(1000);
    var fiveMinutes = 6,
        display = document.querySelector('.countDown');
    startTimer(fiveMinutes, display);
NOTIFS;
$this->registerJs($js, $this::POS_END);
?>