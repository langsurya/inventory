<?php 

namespace app\components;

//yii2
use Yii;
use yii\helpers\ArrayHelper;

use mdm\admin\models\User;
use app\modules\master\models\Bank;

class HelperData extends \yii\base\Component
{

	/*AGAMA*/
	public function listAgama()
	{
		$data = [1=>'Islam', 'Kristen Protestan', 'Kristen Katolik', 'Budha', 'Dll'];

		return $data;	
	}

	/* Nama bang */
    public function listBank()
    {
        $data = Bank::find()->all();
        return ArrayHelper::map($data, 'id_bank', 'nama_bank');
    }

}