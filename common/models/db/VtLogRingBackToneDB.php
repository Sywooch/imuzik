<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_log_ring_back_tone".
 *
 * @property string $id
 * @property string $tone_id
 * @property string $tone_name
 * @property string $tone_code
 * @property string $tone_price
 * @property string $tone_availabledate
 * @property integer $action
 * @property string $member_id
 * @property string $username
 * @property string $from_phonenumber
 * @property string $to_phonenumber
 * @property string $return_code
 * @property string $created_at
 * @property integer $reported
 * @property string $source
 */
class VtLogRingBackToneDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_log_ring_back_tone';
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
            [['tone_id', 'tone_price', 'action', 'member_id', 'reported'], 'integer'],
            [['tone_name', 'tone_code', 'username', 'from_phonenumber', 'to_phonenumber'], 'string'],
            [['tone_availabledate', 'created_at'], 'safe'],
            [['member_id', 'from_phonenumber', 'created_at'], 'required'],
            [['return_code', 'source'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'tone_id' => Yii::t('backend', 'Tone ID'),
            'tone_name' => Yii::t('backend', 'Tone Name'),
            'tone_code' => Yii::t('backend', 'Tone Code'),
            'tone_price' => Yii::t('backend', 'Tone Price'),
            'tone_availabledate' => Yii::t('backend', 'Tone Availabledate'),
            'action' => Yii::t('backend', 'Action'),
            'member_id' => Yii::t('backend', 'Member ID'),
            'username' => Yii::t('backend', 'Username'),
            'from_phonenumber' => Yii::t('backend', 'From Phonenumber'),
            'to_phonenumber' => Yii::t('backend', 'To Phonenumber'),
            'return_code' => Yii::t('backend', 'Return Code'),
            'created_at' => Yii::t('backend', 'Created At'),
            'reported' => Yii::t('backend', 'Reported'),
            'source' => Yii::t('backend', 'Source'),
        ];
    }
}
