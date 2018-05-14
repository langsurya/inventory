<?php 
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BackendAsset;

BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head><meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel='shortcut icon' type='image/png' href='/images/inventory.png' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bg">
<?php $this->beginBody() ?>
	<div class="sign-in-wrapper">
		<div class="sign-container">
			<?php //echo $this->render('flash_message') ?>
			<div class="text-center">
				<h2 class="logo"><img src="/" width="130px" alt=""></h2>
				<center>
					<p style="font-weight: bold; color: black; font-size: 26px;margin: -1px 0px;">Inventory</p>
					<p style="font-size: 12px">(Aplikasi Inventory)</p>
				</center>
			</div>

			<?php echo $content; ?>

			<div class="text-center copyright-txt">
				<small>Copyright &copy; <?php echo date('Y'); ?></small>
			</div>
		</div>
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>