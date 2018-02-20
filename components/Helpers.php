<?php 

namespace app\components;

use Yii;

use app\models\Notifikasi;
use app\models\Pesan;

class Helpers extends \yii\base\Component
{

	public function upload($file, $folderName, $uniqueName)
    {
        $folderName = Yii::$app->generate->slug($folderName);
        $uniqueName = Yii::$app->generate->slug($uniqueName);

        $folder = Yii::$app->generate->folder($folderName);
        $file->saveAs($folder.'/'.$uniqueName.'.'.$file->extension);
        $fileName = '/uploads/'.date('Y-m').'/'.$folderName.'/'.$uniqueName.'.'.$file->extension;
        return $fileName;
    }

    public static function deleteFile($namaFile)
    {
        if(!empty($namaFile)){
            if(file_exists(Yii::getAlias('@webroot').$namaFile)){ 
                unlink(Yii::getAlias('@webroot').$namaFile);
            }
        }
        return true;
    }

    public function sendNotif($to, $title, $message, $from = null, $url = null, $avatar = null, $nomorTransaksi = null)
    {
        $from = !empty($form) ? $from : Yii::$app->user->identity->id;
        $model = new Notifikasi;
        $model->from    = $from;
        $model->to      = $to;
        $model->title   = $title;
        $model->message = $message;
        $model->url     = !empty($url) ? $url : '#';
        $model->avatar  = !empty($avatar) ? $avatar : '/images/notif.png';
        $model->nomor_transaksi = $nomorTransaksi;
        if($model->validate() && $model->save())
            return true;
        else
            return false;
    }

    public function sendNotifByRoleName($roleName, $notif = [])
    {
        // $users      = Yii::$app->authManager->getUserIdsByRole($roleName);

        $title      = isset($notif['title']) ? $notif['title'] : "Notifikasi";
        $message    = isset($notif['message']) ? $notif['message'] : "Message";
        $url        = isset($notif['url']) ? $notif['url'] : '';
        $avatar     = isset($notif['avatar']) ? $notif['avatar'] : '';
        $transaksi  = isset($notif['nomor_transaksi']) ? $notif['nomor_transaksi'] : '';
        if(!empty($roleName)){
            $this->sendNotif($roleName, $title, $message, null, $url, $avatar, $transaksi);
        }

        return true;
    }

	public function getNotifikasiUser()
	{
		$roleUser = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id);
        $listRole = array_keys($roleUser);

        $notif = Notifikasi::find()->select(['title', 'avatar', 'url', 'message','created_at'])
                                    ->where(['in','to',$listRole])
                                    ->andWhere(['is_read'=>0])
                                    ->asArray()
                                    ->all();
        return $notif;
	}

	public function getPesanUser()
	{
		$pesan = Pesan::find()->select(['id','from','avatar', 'to', 'title', 'is_read', 'message', 'created_at'])
                                    ->where(['to'=>Yii::$app->user->identity->id])
                                    ->orderBy(['id'=>SORT_DESC])
                                    ->limit(10)
                                    ->asArray()
                                    ->all();

		return $pesan;
	}
}
?>