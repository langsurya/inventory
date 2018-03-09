<?php

namespace app\modules\profile\models;

use Yii;

/**
 * This is the model class for table "profile_pegawai".
 *
 * @property int $id_pegawai
 * @property int $user_id
 * @property string $nip_pegawai
 * @property string $nama_pegawai
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $jenis_kelamin
 * @property int $agama_id
 * @property string $status_pernikahan
 * @property string $golongan_darah
 * @property string $email
 * @property string $alamat_pegawai
 * @property string $npwp
 * @property string $nik
 * @property int $bank_id
 * @property int $nomor_rekening
 * @property string $nomor_telp
 * @property string $nomor_hp
 * @property string $foto
 * @property string $keterangan
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'value' => date('Y-m-d H:i:s'),
            ],
            \yii\behaviors\BlameableBehavior::className(),
        ];
    }

    public static function tableName()
    {
        return 'profile_pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'nip_pegawai', 'nama_pegawai', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama_id', 'status_pernikahan', 'golongan_darah', 'email', 'alamat_pegawai', 'npwp', 'nik', 'bank_id', 'nomor_rekening', 'nomor_telp', 'nomor_hp', 'foto', 'status'], 'required'],
            [['user_id', 'agama_id', 'bank_id', 'nomor_rekening', 'status', 'created_by', 'updated_by'], 'integer'],
            [['tanggal_lahir', 'keterangan', 'status', 'created_at', 'updated_at'], 'safe'],
            [['alamat_pegawai'], 'string'],
            [['nip_pegawai', 'nomor_telp', 'nomor_hp'], 'string', 'max' => 16],
            [['nama_pegawai', 'tempat_lahir', 'jenis_kelamin', 'status_pernikahan', 'email'], 'string', 'max' => 50],
            [['golongan_darah'], 'string', 'max' => 10],
            [['npwp', 'nik'], 'string', 'max' => 20],
            [['status','keterangan'], 'required', 'on'=>'verifikasi'],
            [['foto', 'keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'user_id' => 'User ID',
            'nip_pegawai' => 'Nip Pegawai',
            'nama_pegawai' => 'Nama Pegawai',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama_id' => 'Agama ID',
            'status_pernikahan' => 'Status Pernikahan',
            'golongan_darah' => 'Golongan Darah',
            'email' => 'Email',
            'alamat_pegawai' => 'Alamat Pegawai',
            'npwp' => 'Npwp',
            'nik' => 'Nik',
            'bank_id' => 'Bank ID',
            'nomor_rekening' => 'Nomor Rekening',
            'nomor_telp' => 'Nomor Telp',
            'nomor_hp' => 'Nomor Hp',
            'foto' => 'Foto',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getBank()
    {
        return $this->hasOne(\app\modules\master\models\Bank::className(), ['id_bank' => 'bank_id']);
    }

    public static function saveOnTransaksi($status)
    {
        $model = new Pegawai;
        $model->status = $status;
        $model->save(false);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->scenario == 'verifikasi' && $this->status == 1){
            \app\modules\profile\models\Pegawai::saveOnTransaksi(
                    $this->status
            );
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    
}
