<?php

namespace app\modules\profile\controllers;

use Yii;

use yii\web\Controller;
use yii\data\ActiveDataProvider;

use app\modules\profile\models\Pegawai;

/**
 * Default controller for the `profile` module
 */
class DataProfileController extends Controller
{
	private $userId;
    private $pegawaiId;

    public function init()
    {
        if(Yii::$app->user->isGuest == false){
            $this->userId       = \Yii::$app->user->identity->id;
            $this->pegawaiId    = \Yii::$app->helpers->getPegawaiIdByUserId($this->userId);
        }
    }

    public function checkStatusTransaksi($userId)
    {
        $transaksi = Pegawai::find()->where(['user_id'=>$this->userId])
        ->orderBy(['id_pegawai' => SORT_DESC])
        ->one();

        if (!empty($transaksi)) {
            if ($transaksi->status == 0) {
                return 0; // transaksi belum di verivikasi
            }
            if ($transaksi->status == 2) {
                return 2; // transaksi di tolak;
            }
        }

        return false;
    }

    public function actionIndex()
    {
    	$model = $this->findPegawai($this->userId);
        $statusTransaksi = false;
        if (!empty($model)) {
            if ($model->status != 0) {
                $statusTransaksi = true;
            } else {
                $statusTransaksi = $this->checkStatusTransaksi($this->userId);
            }
        } else {
            $statusTransaksi = $this->checkStatusTransaksi($this->userId);
        }

        return $this->render('index', get_defined_vars());
    }

    protected function findPegawai($id)
    {
        if (($model = Pegawai::find()->where(['user_id'=>$id])->one()) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}