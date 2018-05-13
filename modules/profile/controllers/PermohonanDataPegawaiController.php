<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

use app\modules\profile\models\Pegawai;

/**
 * DataDiriPegawaiController implements the CRUD actions for TransaksiDataDiri model.
 */
class PermohonanDataPegawaiController extends Controller
{
    /**
     * @inheritdoc
     */
    private $userId;
    private $pegawaiId;

    public function init()
    {
        if(Yii::$app->user->isGuest == false){
            $this->userId       = \Yii::$app->user->identity->id;
            $this->pegawaiId    = \Yii::$app->helpers->getPegawaiIdByUserId($this->userId);
        }
    }

    public function beforeAction($action)
    {
        if($this->pegawaiId !== 0 && $this->getRoute() === 'profile/permohonan-data-pegawai/data-diri'){
            Yii::$app->getSession()->setFlash('error', 'Maaf.. Anda sudah memiliki data diri pegawai.');
            $this->redirect(['/profile/data-profile/index']);
        }

        if ($this->pegawaiId === 0 && $this->getRoute() !== 'profile/permohonan-data-pegawai/data-diri') {
            Yii::$app->getSession()->setFlash('error', 'Maaf.. Anda belum memiliki data diri pegawai.');
            $this->redirect(['/profile/data-profile/index']);
        }

        return true;
    }

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
     * Permohonan data diri pegawai untuk pertama kalinya.
     */
   public function actionDataDiri($id = null)
   {
        if (!array_key_exists('karyawan-role', Yii::$app->authManager->getRolesByUser($this->userId))) {
            Yii::$app->getSession()->setFlash('error', 'Maaf, anda tidak memiliki role Pegawai');
            return $this->goHome();
        }
        
        $model = !empty($id) ? $this->findTransaksiDataDiri($id) : new Pegawai();
        // $model->scenario = 'permohonan';
        $model->email = Yii::$app->user->identity->email;
        $model->user_id = $this->userId;
        $post = Yii::$app->request->post("Pegawai");
        // $transaction = Yii::$app->db->beginTransaction();

        if ($post) {
            $model->attributes = $post;
            $foto   = UploadedFile::getInstance($model, 'foto');
            $model->foto = Yii::$app->helpers->upload($foto, $model->nama_pegawai, 'foto-'.$model->nama_pegawai);
            $model->agama_id = (int)$model->agama_id;
            $model->bank_id = (int)$model->bank_id;
            $model->nomor_rekening = (int)$model->nomor_rekening;

            try {
                if ($model->validate()) {
                    if ($model->save()) { // true
                        Yii::$app->getSession()->setFlash('success', 'Berhasil menambahkan data diri');
                        return $this->redirect('/profile/data-profile/');
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
            }
        }

        return $this->render('formDataDiri', [
            'model' => $model,
        ]);
   }

   public function findTransaksiDataDiri($id)
   {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Permintaan halaman anda tidak ditemukan');
        }
   }
}