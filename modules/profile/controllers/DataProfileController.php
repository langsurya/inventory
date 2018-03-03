<?php

namespace app\modules\profile\controllers;

use Yii;

use yii\web\Controller;
use yii\data\ActiveDataProvider;

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

    public function actionIndex()
    {
    	
    }
}