<?php 

namespace app\components;

use Yii;
use yii\web\UploadedFile;
use \Mpdf\Mpdf;

use app\models\Notifikasi;
use app\models\Pesan;
use app\modules\transaksi\models\NomorUrut;
use app\modules\profile\models\Pegawai;
use app\modules\profile\models\RiwayatPendidikan;
use app\modules\master\models\Content;
use mdm\admin\models\User;

class Helpers extends \yii\base\Component
{
    public function upload($file, $folderName, $uniqueName)
    {

    }

    public static function sendEmail($untuk, $judul, $pesanHtml)
    {
        // \Yii::$app->mail->compose('your_view', ['params' => $params])
        \Yii::$app->mail->compose()
            ->setFrom([\Yii::$app->params['adminEmail'] => 'Sistem Informasi Kepegawaian'])
            ->setTo($untuk)
            ->setSubject($judul)
            ->setHtmlBody($pesanHtml)
            ->send();

        return true;
    }

    public function sendContent($key, $content = [], $identity = [], $tipe, $email = null)
    {
        $model = Content::find()->where(['key'=>$key])->one();

        // set identity untuk pengiriman notif or inbox
        $to      = isset($identity['TO']) ? $identity['TO'] : 1;
        $from    = isset($identity['FROM']) ? $identity['FROM'] : '';
        $avatar  = isset($identity['AVATAR']) ? $identity['AVATAR'] : '';

        // ambil kontent dan replace value
        $message = '';
        if(!empty($model)){
            $message = preg_replace_callback('/{{(\w+)}}/', function($matches) use (&$content) {
                            return $content[$matches[1]];
                        }, $model->text);

            if(!empty($message)){
                switch ($tipe) {
                    case 'inbox':
                        return Yii::$app->helpers->sendMessage($from, $to, $model->title, $message, $avatar);
                        break;

                    case 'email':
                        return Yii::$app->helpers->sendEmail($email, $model->title, $message);
                        break;

                    default:
                        return false;
                        break;
                }
            }
        }

        return false;
    }
}