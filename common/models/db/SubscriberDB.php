<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "subscriber".
 *
 * @property string $id
 * @property string $member_id
 * @property string $sub_type_id
 * @property string $availabledate
 * @property string $created_at
 * @property string $updated_at
 * @property string $phonenumber
 * @property string $last_charge_time
 * @property string $expired_time
 * @property string $last_charge_result
 * @property string $process_id
 * @property string $process_time
 * @property integer $status
 * @property integer $charge_failure_times
 * @property string $description
 *
 * @property VtMemberDB $member
 * @property SubTypeDB $subType
 */
class SubscriberDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscriber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'sub_type_id', 'process_id', 'status', 'charge_failure_times'], 'integer'],
            [['availabledate', 'created_at', 'updated_at', 'last_charge_time', 'expired_time', 'process_time'], 'safe'],
            [['phonenumber'], 'string', 'max' => 20],
            [['last_charge_result'], 'string', 'max' => 10],
            [['description'], 'string', 'max' => 50]
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
            'sub_type_id' => Yii::t('backend', 'Sub Type ID'),
            'availabledate' => Yii::t('backend', 'Availabledate'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'phonenumber' => Yii::t('backend', 'Phonenumber'),
            'last_charge_time' => Yii::t('backend', 'Last Charge Time'),
            'expired_time' => Yii::t('backend', 'Expired Time'),
            'last_charge_result' => Yii::t('backend', 'Last Charge Result'),
            'process_id' => Yii::t('backend', 'Process ID'),
            'process_time' => Yii::t('backend', 'Process Time'),
            'status' => Yii::t('backend', 'Status'),
            'charge_failure_times' => Yii::t('backend', 'Charge Failure Times'),
            'description' => Yii::t('backend', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(VtMemberDB::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubType()
    {
        return $this->hasOne(SubTypeDB::className(), ['id' => 'sub_type_id']);
    }
}
