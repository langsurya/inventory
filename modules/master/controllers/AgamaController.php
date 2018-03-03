<?php

namespace app\modules\master\controllers;

use Yii;

use yii\web\controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BankController inplements the CRUD actions for Bank model.
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
     * Lists all Bank models.
     * @return mixed
     */
	public function actionIndex()
	{
		// $searchModel = new BankSearch();
		// dd('test');
		return $this->render('index', [
			
		]);

	}
}