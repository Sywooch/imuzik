<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class AccoutInfoForm extends Member {

    /**
     * @inheritdoc
     */


    public function rules() {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            ['actived', 'default', 'value' => 1],
            ['actived', 'in', 'range' => [1, 0]],
            [['email'], 'email'],
            [['username', 'email'], 'unique'],
            [['image_path', 'avatar_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'maxSize' => 16 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa phải < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
           
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

    public function getName() {
        return ($this->fullname) ? \yii\helpers\Html::encode($this->fullname) : \yii\helpers\Html::encode($this->username);
    }

    public function getImage() {
        return ($this->image_path) ? $this->image_path : '/images/img_03.jpg';
    }

    public function getAvatar() {
        return ($this->avatar_image) ? $this->avatar_image : '/images/4x4.png';
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
        return sha1($this->username . $password);
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

    public function upload($attr, $with = 450, $height = 450) {
        if ($this->validate()) {
            $dir = media_root . media_root_image_member;
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $imageName = media_root_image_member . $this->$attr->baseName . '.' . $this->$attr->extension;
            $this->$attr->saveAs(media_root . $imageName);

            \yii\imagine\Image::thumbnail(media_root . $imageName, $with, $height)->save(Yii::getAlias(media_root . $imageName), ['quality' => 100]);

            return $imageName;
        }
        return false;
    }

}
