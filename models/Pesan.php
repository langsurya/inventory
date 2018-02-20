<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pesan".
 *
 * @property integer $id
 * @property integer $reply_id
 * @property integer $from
 * @property integer $to
 * @property string $message
 * @property integer $is_read
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Pesan extends \yii\db\ActiveRecord
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
        return 'pesan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','message','to'], 'required'],
            [['reply_id', 'from', 'to', 'is_read', 'created_by', 'updated_by'], 'integer'],
            [['message'], 'string'],
            [['title','avatar'], 'string', 'max'=>255],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reply_id' => 'Reply',
            'title'=>'Judul',
            'from' => 'Dari',
            'to' => 'Untuk',
            'message' => 'Pesan',
            'is_read' => 'Is Read',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
    
}
