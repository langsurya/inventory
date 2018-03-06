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
 * @property int $nik
 * @property int $bank_id
 * @property int $nomor_rekening
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

            [['user_id', 'nip_pegawai', 'nama_pegawai', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama_id', 'status_pernikahan', 'golongan_darah', 'email', 'alamat_pegawai', 'npwp', 'nik', 'bank_id', 'nomor_rekening', 'nomor_telp', 'nomor_hp', 'status'], 'required'],

            [['foto'], 'file', 'extensions' => 'png, jpg, pdf'],
            [['foto'], 'file', 'maxSize'=>5120000, 'tooBig' => 'Ukuran tidak boleh lebih dari 5 MB'],

            [['user_id', 'agama_id', 'nik', 'bank_id', 'nomor_rekening', 'status', 'created_by', 'updated_by'], 'integer'],
            [['keterangan', 'status_pernikahan'], 'string', 'max' => 255],
            [['tanggal_lahir', 'created_at', 'updated_at'], 'safe'],
            [['jenis_kelamin', 'alamat_pegawai'], 'string'],
            [['nip_pegawai'], 'string', 'max' => 16],
            [['nama_pegawai', 'tempat_lahir', 'email'], 'string', 'max' => 50],
            [['golongan_darah'], 'string', 'max' => 10],
            [['npwp'], 'string', 'max' => 20],

            // [['foto'], 'required'],
            [['foto'], 'required', 'on'=>['permohonan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'user_id' => 'Username',
            'nip_pegawai' => 'Nip Pegawai',
            'nama_pegawai' => 'Nama Pegawai',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama_id' => 'Agama',
            'status_pernikahan' => 'Status Pernikahan',
            'golongan_darah' => 'Golongan Darah',
            'email' => 'Email',
            'alamat_pegawai' => 'Alamat Pegawai',
            'npwp' => 'Npwp',
            'nik' => 'Nik',
            'bank_id' => 'Bank',
            'nomor_rekening' => 'Nomor Rekening',
            'nomor_telp' => 'Nomor Telp',
            'nomor_hp' => 'Nomor HP',
            'foto' => 'Foto',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function saveFormTransaksi($model, $status)
    {
        if ($status == 1) {
            $pegawai = new Pegawai;
            $pegawai->attributes = $model->attributes;
            if ($pegawai->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }

        return false;
    }
}
