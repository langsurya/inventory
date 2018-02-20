<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifikasi".
 *
 * @property integer $id
 * @property integer $reply_id
 * @property integer $from
 * @property integer $to
 * @property string $tilte
 * @property string $message
 * @property integer $is_read
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Notifikasi extends \yii\db\ActiveRecord
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
        return 'notifikasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply_id', 'from', 'is_read', 'created_by', 'updated_by'], 'integer'],
            [['to', 'title', 'message'], 'required'],
            [['to','message'], 'string'],
            [['nomor_transaksi'], 'string','max'=>20],
            [['created_at', 'updated_at'], 'safe'],
            [['title','url','avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reply_id' => 'Reply ID',
            'from' => 'From',
            'to' => 'To',
            'title' => 'title',
            'url' => 'Url',
            'message' => 'Message',
            'nomor_transaksi'=>'Nomor Transaksi',
            'is_read' => 'Is Read',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
