<?php

namespace frontend\models;

use Yii;
use yii\web\IdentityInterface;

class VtMessages extends \common\models\VtMessagesBase {

    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'body', 'email'], 'required'],
            [['body'], 'string'],
            [['status', 'phone_number'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email'], 'string', 'max' => 255],
            ['email', 'email'],
            [['title', 'body'], 'trim'],
            ['captcha', 'captcha', 'message' => 'Mã xác thực không đúng'],
            [['captcha'], 'required', 'message' => 'Mã xác thực không được để trống'],
            [['title'], 'string', 'max' => 26, 'tooLong' => Yii::t('frontend', 'Bạn chỉ có thể nhập tối đa 26 ký tự')],
            [['body'], 'string', 'max' => 1000, 'tooLong' => Yii::t('frontend', 'Bạn chỉ có thể nhập tối đa 1000 ký tự')],
        ];
    }

    public function beforeSave($b = true) {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->created_at = $this->updated_at = date("Y-m-d H:i:s", time());
            } else
                $this->updated_at = date("Y-m-d H:i:s", time());
            return true;
        } else
            return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Tiêu đề'),
            'body' => Yii::t('backend', 'Nội dung'),
            'status' => Yii::t('backend', 'Status'),
            'phone_number' => Yii::t('backend', 'Phone Number'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'email' => Yii::t('backend', 'Email'),
        ];
    }

}
