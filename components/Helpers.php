<?php 

namespace app\components;

use Yii;

use app\models\Notifikasi;
use app\models\Pesan;
use app\modules\profile\models\Pegawai;

use mdm\admin\models\User;

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

    public function checkExistingPegawai($user_id)
    {
        if (!empty($user_id)) {
            $data = Pegawai::find()->where(['user_id'=>$user_id])->one();
            if (!empty($data))
                return true;
            else
                return false;
        }
    }

    public function updateNotification($nomorTransaksi)
    {
        Notifikasi::updateAll(['is_read' => 1], 'nomor_transaksi = '.$nomorTransaksi.'');
        return true;
    }

    public function sendMessage($from, $to, $title, $message, $avatar = null)
    {
        $pesan = new Pesan;
        $pesan->from    = $from;
        $pesan->to      = $to;
        $pesan->title   = $title;
        $pesan->message = $message;
        $pesan->avatar  = !empty($avatar) ? $avatar : '/images/notif.png';
        if ($pesan->save())
            return true;
        else
            return false;

    }

    public function getPegawiIdByUserId($id = null)
    {
        $userId = !empty($id)? $id : Yii::$app->user->identity->id;
        $model = Pegawai::find()->select(['id_pegawai'])->where(['user_id'=>$userId])->one();
        if (!empty($model))
            return $model->id_pegawai;
        else
            return 0;
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

    public static function pdf($content, $file_name, $options = [])
    {
        $file_name = preg_replace('/\.pdf$/', '', $file_name);

        $orientation = self::def($options, 'orientation', 'P');
        $margin = self::def($options, 'margin', 10);
        $border = self::def($options, 'border', true);
        $title  = self::def($options, 'title', '');
        $header = self::def($options, 'header', 0);
        $footer = self::def($options, 'footer', 0);
        $mode = self::def($options, 'mode', 'I');
        $font = self::def($options, 'font', 'Arial');
        $author  = self::def($options, 'author', 'Docotel');
        $creator = self::def($options, 'creator', 'Dev');
        $subject = self::def($options, 'subject', '');
        $paper_size = self::def($options, 'paper_size', [215, 297]);
        $watermark  = self::def($options, 'watermark', false);

        $left = $right = $top = $bottom = $margin;
        if (is_array($margin) && count(margin) == 4) {
            $top = self::def($margin, 'top', 20);
            $left = self::def($margin, 'left', 10);
            $right = self::def($margin, 'right', 10);
            $bottom = self::def($margin, 'bottom', 20);
        }

        $mpdf = new Mpdf($paper_size, 0, '', $left, $right, $top, $bottom, $header, $footer, $orientation);
        $mpdf->SetDefaultFont($font);
        $mpdf->SetProtection(['print', 'print-highres'], '', md5(time()), 128);
        $mpdf->SetTitle($title);
        $mpdf->SetAuthor($author);
        $mpdf->SetCreator($creator);
        $mpdf->SetSubject($subject);
        $mpdf->h2toc = ['H4' => 0, 'H5' => 1];
        $mpdf->simpleTable = true;

        $mpdf->WriteHTML($content);
        $mpdf->Output($file_name . '.pdf', $mode);
        if ($mode === 'D' or $mode === 'I')
            exit;
    }

    /**
     * Safe way to access array or public property from an object.
     *
     * @param mixed  $stack
     * @param string $offset
     * @param mixed  $default
     *
     * @return mixed
     *
     */
    public static function def($stack, $offset, $default = null)
    {
        if (is_array($stack)) {
            if (array_key_exists($offset, $stack)) {
                return $stack[$offset];
            }
        } elseif (is_object($stack)) {
            if (property_exists($stack, $offset)) {
                return $stack->{$offset};
            } elseif ($stack instanceof ArrayAccess) {
                return $stack[$offset];
            } elseif (method_exists($stack, '__isset')) {
                if ($stack->__isset($offset)) {
                    if (method_exists($stack, '__get')) {
                        return $stack->__get($offset, $default);
                    }

                    return $stack->$offset;
                }
            } else {
                return self::def((array) $stack, $offset, self::value($default));
            }
        }

        return self::value($default);
    }

    public static function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }

    public static function alphabet()
    {
        $alphabet = ['A', 'B', 'C', 'D', 'E',
                       'F', 'G', 'H', 'I', 'J',
                       'K', 'L', 'M', 'N', 'O',
                       'P', 'Q', 'R', 'S', 'T',
                       'U', 'V', 'W', 'X', 'Y',
                       'Z'
                    ];
        return $alphabet;
    }

    public function numToAlphabet($num)
    {
        $alpha = self::alphabet();
        return $alpha[$num];
    }
}
?>