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
<head>
	<meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel='shortcut icon' type='image/png' href='/favicon.ico' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<div id="ui" class="ui">
		<?php echo $this->render('header') ?>

		<?php echo $this->render('sidebar') ?>

		<div id="content" class="ui-content ui-content-compact">
			<div class="page-head-wrap">
				<h4 class="margin0">
					<?php echo $this->title ?>
				</h4>
				<div class="breadcrumb-right">
					<?php echo Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
				</div>
			</div>
			<div class="ui-content-body">
				<div class="panel">
					<div class="panel-body">
						<?php echo $content ?>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>