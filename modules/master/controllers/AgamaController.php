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

	/**
     * Lists all Agama models.
     * @return mixed
     */
	public function actionIndex()
	{
		$searchModel = new AgamaSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,	
		]);
	}

	/**
	 * Display a single Agama model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Agama model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
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

	/**
	 * Updates an existing Agama model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
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

	/**
	 * Deletes an existing Agama model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Agama model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be throw.
	 * @param integer $id
	 * @return Agama the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Agama::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
			
		}
	}
}