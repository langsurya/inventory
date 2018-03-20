<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "master_agama".
 *
 * @property int $id_agama
 * @property string $nama_agama
 * @property int $created_by
 * @property int $update_by
 * @property string $created_at
 * @property string $updated_at
 */
class Agama extends \yii\db\ActiveRecord
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
		return 'master_agama';
	}

	/**
	 *@inheritdoc
	 */
	public function rules()
	{
		return [
			[['agama'], 'required'],
			[['created_by', 'updated_by'], 'integer'],
			[['created_at', 'updated_at'], 'safe'],
			[['agama'], 'string', 'max' => 50],
			[['agama'], 'checkName', 'message' => 'Agama name is already exists.' ,'skipOnEmpty' => false],
		];
	}

	public function checkName($attribute) {
		$model = Agama::find()->where( 'agama = "' . $this->$attribute .'"')->all();
		if (count($model) > 0) {
			$this->addError($attribute, 'Agama is already exists.');
		}
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_agama' => 'Id Agama',
			'agama' => 'Agama',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}
}
