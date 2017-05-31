<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;
use yii\base\NotSupportedException;

class ChangePasssForm extends Member {

    /**
     * @inheritdoc
     */
    public $oldpass;
    public $newpass;
    public $repeatnewpass;

    public function rules() {
        return [
            [['oldpass', 'newpass', 'repeatnewpass'], 'required'],

            [['newpass'], 'string', 'min' => 6, 'max' => 20, 'tooShort' => Yii::t('frontend', 'Mật khẩu phải lớn hơn 6 ký tự')],
            ['oldpass', 'findPasswords', 'message' => Yii::t('frontend', 'Mật khẩu cũ không đúng')],
            ['repeatnewpass', 'compare', 'compareAttribute' => 'newpass', 'message' => Yii::t('frontend', 'Xác nhận mật khẩu không khớp với mật khẩu mới')],
            ['newpass', 'comparePasswords', 'message' => Yii::t('frontend', 'Mật khẩu mới không được giống mật khẩu cũ')],
//            [['newpass', 'repeatnewpass'], 'match', 'pattern' => '/^[a-zA-Z0-9_-@#$]{6,20}$/','message'=>Yii::t('frontend','Mật khẩu phải từ 6-20 ký tự,có thể chứa ký tự đặc biệt _ - @ # $, không chứa dấu cách')]
            [['newpass', 'repeatnewpass'], 'match', 'pattern' => '((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})',
        'message' => Yii::t('frontend', 'Mật khẩu phải từ 6-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt')],
        ];
    }

    public function findPasswords($attribute) {

        $user = Member::find()->where([
            'username'=>Yii::$app->user->identity->username])->one();
        $password = $user->password;
        if ($password != $this->generatePasswordHash($this->oldpass)) {
            $this->addError($attribute, 'Mật khẩu cũ không chính xác');
        }
    }
    public function comparePasswords($attribute) {
        if ($this->newpass === $this->oldpass) {
            $this->addError($attribute, 'Mật khẩu mới không được giống mật khẩu cũ');
        }
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
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password == $this->generatePasswordHash($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $this->generatePasswordHash($password);
    }

    public function generatePasswordHash($password) {
        return sha1(Yii::$app->user->identity->username . $password);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'actived' => Constant::ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'actived' => Constant::ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
    public function attributeLabels() {
        return [
            'oldpass' => 'Mật khẩu cũ :',
            'newpass' => 'Mật khẩu mới :',
            'repeatnewpass' => 'Xác nhận mật khẩu :',
        ];
    }

}
