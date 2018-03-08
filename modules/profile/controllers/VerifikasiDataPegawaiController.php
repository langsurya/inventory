<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

use app\modules\profile\models\Pegawai;
use app\modules\profile\models\PegawaiSearch;

use app\models\Notifikasi;
use app\models\Pesan;

/**
 * VerifikasiDataPegawaiController implements the CRUD actions for TransaksiDataDiri model.
 */

class VerifikasiDataPegawaiController extends Controller
{
	private $userId;

    public function init()
    {
        if(Yii::$app->user->isGuest == false){
            $this->userId = \Yii::$app->user->identity->id;
        }
    }

 	public function actionListDataDiri()   
 	{
 		$searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

 		return $this->render('listDataDiri', [
 			'searchModel' => $searchModel,
 			'dataProvider' => $dataProvider,
 		]);
 	}

 	public function actionViewDataDiri($id)
 	{
 		$model = $this->findDataDiri($id);
 		$post = Yii::$app->request->post();
        // $transaction = Yii::$app->db->beginTransaction();

        if ($post) {
        	try {
		        $model->updated_by = $this->userId;
		        $model->updated_at = date('Y-m-d H:i:s');

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Transaksi berhasil diproses');
                    return $this->redirect(['list-data-diri']);
                }
                $model->status = null; // ini di set null biar buttonnya tampil dan gak langsung ngeSet ketika ada error
        	} catch (Exception $e) {
        		$transaction->rollback();
        	}
        }

        return $this->render('viewDataDiri',['model'=>$model]);
 	}


 	protected function findDataDiri($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Permintaan halaman anda tidak ditemukan');
        }
    }
}