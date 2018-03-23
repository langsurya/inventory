<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "master_bank".
 *
 * @property int $id_bank
 * @property string $nama_bank
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Bank extends \yii\db\ActiveRecord
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
        return 'master_bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_bank'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama_bank'], 'string', 'max' => 50],
            [['nama_bank'], 'checkName', 'message' => 'Bank name is already exists.', 'skipOnEmpty' => false],
        ];
    }

    public function checkName($attribute) {
        $model = Bank::find()->where('nama_bank = "' . $this->$attribute . '"')->all();
        if (count($model) > 0) {
            $this->addError($attribute, 'Bank name is already exists');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bank' => 'Id Bank',
            'nama_bank' => 'Nama Bank',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
