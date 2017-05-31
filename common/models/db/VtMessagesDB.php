<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_messages".
 *
 * @property string $id
 * @property string $title
 * @property string $body
 * @property integer $status
 * @property string $phone_number
 * @property string $created_at
 * @property string $updated_at
 * @property string $email
 */
class VtMessagesDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'created_at', 'updated_at'], 'required'],
            [['body'], 'string'],
            [['status', 'phone_number'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'body' => Yii::t('backend', 'Body'),
            'status' => Yii::t('backend', 'Status'),
            'phone_number' => Yii::t('backend', 'Phone Number'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'email' => Yii::t('backend', 'Email'),
        ];
    }
}
