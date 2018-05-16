<?php

namespace app\modules\master\models;

use Yii;

class Customer extends \yii\db\ActiveRecord
{
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
        return 'master_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_name', 'email', 'phone', 'address', 'city'], 'required'],
            [['address'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_name'], 'string', 'max' => 255],
            [['email', 'city'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => 'Id Customer',
            'customer_name' => 'Customer Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
