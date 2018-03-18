<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "master_gudang".
 *
 * @property int $id_gudang
 * @property string $nama_gudang
 * @property string $alamat
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class MasterGudang extends \yii\db\ActiveRecord
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
        return 'master_gudang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_gudang'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama_gudang'], 'string', 'max' => 11],
            [['alamat'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gudang' => 'Id Gudang',
            'nama_gudang' => 'Nama Gudang',
            'alamat' => 'Alamat',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
