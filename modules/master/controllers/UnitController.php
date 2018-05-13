<?php

namespace app\modules\master\controllers;

use Yii;
use app\modules\master\models\Unit;
use app\modules\master\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UnitController implements the CRUD actions for Unit model.
 */
class UnitController extends Controller
{

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
        $model = new Unit();
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
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
        $model = new Unit();

        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        if ($model->load(Yii::$app->request->post())) {
            $valid = $model->validate();
            if ($valid) {
                try {
                    $model->save();                    
                    $transaction->commit();

                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Unit is successfully added.'));
                    return $this->redirect('index');
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::$app->getSession()->setFlash('error', Yii::t('app', $e->getMessage()));
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Please change a few things up and try submitting again. '));
                return $this->redirect('index');
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
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Unit is successfully updated.'));
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->getSession()->setFlash('warning', Yii::t('app', 'Delete Supplier is successfully.'));
            return $this->redirect(['index']);
        } else {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Delete Supplier is failed.'));
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Unit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
