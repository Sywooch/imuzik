<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_log_rbt_service".
 *
 * @property string $id
 * @property string $member_id
 * @property string $username
 * @property string $phonenumber
 * @property string $action
 * @property string $return_code
 * @property string $created_at
 * @property string $source
 * @property integer $brand_id
 */
class LogRbtServiceDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_log_rbt_service';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dblog');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'action', 'brand_id'], 'integer'],
            [['username', 'phonenumber', 'return_code'], 'string'],
            [['created_at'], 'required'],
            [['created_at'], 'safe'],
            [['source'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'member_id' => Yii::t('backend', 'Member ID'),
            'username' => Yii::t('backend', 'Username'),
            'phonenumber' => Yii::t('backend', 'Phonenumber'),
            'action' => Yii::t('backend', 'Action'),
            'return_code' => Yii::t('backend', 'Return Code'),
            'created_at' => Yii::t('backend', 'Created At'),
            'source' => Yii::t('backend', 'Source'),
            'brand_id' => Yii::t('backend', 'Brand ID'),
        ];
    }
}
