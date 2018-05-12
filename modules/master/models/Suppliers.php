<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "master_suppliers".
 *
 * @property int $id_supplier
 * @property string $company_name
 * @property string $supplier_name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Suppliers extends \yii\db\ActiveRecord
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
        return 'master_suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'supplier_name', 'phone', 'email', 'address'], 'required'],
            [['address'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['company_name', 'supplier_name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_supplier' => 'Id Supplier',
            'company_name' => 'Company Name',
            'supplier_name' => 'Supplier Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
