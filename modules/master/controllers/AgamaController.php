<?php

namespace app\modules\master\controllers;

use Yii;

use app\modules\master\models\Agama;
use app\modules\master\models\AgamaSearch;
use yii\web\controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgamaController inplements the CRUD actions for Bank model.
 */
class AgamaController extends Controller
{
	/**
     * @inheritdoc
     */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	public function actionIndex()
	{
		$searchModel = new AgamaSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,	
		]);
	}

	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	public function actionCreate()
	{
		Url::remember();
		$model = new Agama();

		if(Yii::$app->request->isAjax) {
		    $model->load(Yii::$app->request->post());
		    return Json::encode(\yii\widgets\ActiveForm::validate($model));
		}

		$connection = Yii::$app->db;
		$transaction = $connection->beginTransaction();
		if ($model->load(Yii::$app->request->post())) {
		    $valid = $model->validate();

		    if ($valid) {
		        try {
		            $model->save();
		            $transaction->commit();
		            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Agama is successfully added.'));
		            return $this->redirect('index');
		        } catch (Exception $e) {

		            $transaction->rollBack();
		            Yii::$app->getSession()->setFlash('error', Yii::t('app', $e->getMessage()));
		            return $this->render('create', [
		                'model' => $model,
		            ]);
		        }
		    } else {
		        Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Please change a few things up and try submitting again. '));
		    }
		}
		return $this->render('create', [
			'model' => $model,
		]);
	}

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id_agama]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}
	
	protected function findModel($id)
	{
		if (($model = Agama::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
			
		}
	}
}