<?php

namespace app\modules\master\models;

use Yii;

class Rak extends \yii\db\ActiveRecord
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
        return 'master_rak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gudang_id', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'required'],
            ['name', 'unique'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 100],
            [['gudang_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterGudang::className(), 'targetAttribute' => ['gudang_id' => 'id_gudang']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rak' => 'Id Rak',
            'gudang_id' => 'Gudang ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGudang()
    {
        return $this->hasOne(MasterGudang::className(), ['id_gudang' => 'gudang_id']);
    }
}
