<?php 

namespace app\components;

//yii2
use Yii;
use yii\helpers\ArrayHelper;

use mdm\admin\models\User;
use app\modules\master\models\Bank;
use app\modules\master\models\Categories;
use app\modules\master\models\Suppliers;
use app\modules\master\models\Unit;
use app\modules\profile\models\Pegawai;

class HelperData extends \yii\base\Component
{

	/*AGAMA*/
	public function listAgama()
	{
		$data = [1=>'Islam', 'Kristen Protestan', 'Kristen Katolik', 'Budha', 'Dll'];

		return $data;	
	}

    public function agamaName($id)
    {
        $data = [1=>'Islam', 'Kristen Protestan', 'Kristen Katolik', 'Budha', 'Dll'];
        foreach ($data as $key => $value) {
            if ($key == $id) {
                $data = $value;
            }
        }
        return $data;
    }

    public function listCategory()
    {
        $data = Categories::find()->orderBy('name')->all();
        return ArrayHelper::map($data, 'id_category', 'name');
    }

    public function listSupplier()
    {
        $data = Suppliers::find()->orderBy('company_name')->all();
        return ArrayHelper::map($data, 'id_supplier', 'company_name');
    }

    public function listUnit()
    {
        $data = Unit::find()->orderBy('name')->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

	/* Nama bang */
    public function listBank()
    {
        $data = Bank::find()->all();
        return ArrayHelper::map($data, 'id_bank', 'nama_bank');
    }

    public function pegawaiName($id)
    {
        $pegawai = Pegawai::find()->select(['nama_pegawai'])->where(['user_id'=>$id])->one();
        if(!empty($pegawai)){
            return $pegawai->nama_pegawai;
        } else {
            return \Yii::$app->user->identity->username;
        }

        return 'No Name';
    }

}