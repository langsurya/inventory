<?php

namespace app\modules\transaksi\models;
use app\modules\master\models\Rak;
use app\modules\master\models\Products;
use Yii;

/**
 * This is the model class for table "inbound".
 *
 * @property int $id_inbound
 * @property string $ref_code
 * @property int $rak_id
 * @property int $item_id
 * @property int $qty
 * @property string $notes
 * @property string $expr_date
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MasterRak $rak
 * @property MasterProducts $item
 */
class Inbound extends \yii\db\ActiveRecord
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
        return 'inbound';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_code', 'qty', 'notes', 'expr_date', 'status'], 'required'],
            [['rak_id', 'item_id', 'qty', 'status', 'created_by', 'updated_by'], 'integer'],
            [['notes'], 'string'],
            [['expr_date', 'created_at', 'updated_at'], 'safe'],
            [['ref_code'], 'string', 'max' => 255],
            [['rak_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rak::className(), 'targetAttribute' => ['rak_id' => 'id_rak']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['item_id' => 'id_product']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_inbound' => 'Id Inbound',
            'ref_code' => 'Ref Code',
            'rak_id' => 'Rak ID',
            'item_id' => 'Item ID',
            'qty' => 'Qty',
            'notes' => 'Notes',
            'expr_date' => 'Expr Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRak()
    {
        return $this->hasOne(Rak::className(), ['id_rak' => 'rak_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Products::className(), ['id_product' => 'item_id']);
    }
}
