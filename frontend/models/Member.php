<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;
use yii\base\NotSupportedException;
use yii\db\Expression;
use yii\web\IdentityInterface;

class Member extends \common\models\VtMemberBase implements IdentityInterface {

    public $oldpass;
    public $newpass;
    public $repeatnewpass;

    public function rules() {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            ['actived', 'default', 'value' => 1],
            ['actived', 'in', 'range' => [1, 0]],
            [['email'], 'email'],
            ['birthday', 'validateDates', 'message' => Yii::t('frontend', 'Ngày sinh không được lớn hơn hoặc bằng ngày hiện tại')],
            [['username', 'email'], 'unique'],
            [['image_path', 'avatar_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg, jpg', 'maxSize' => 16 * 1024 * 1024,
                'tooBig' => Yii::t('frontend', 'File "{file}" quá lớn. Kích cỡ tối đa phải < {formattedLimit}.'),
                'wrongExtension' => Yii::t('frontend', 'File không đúng định dạng ({extensions}).'),
            ],
            [['address'], 'string', 'max' => 255, 'tooLong' => Yii::t('frontend', 'Bạn chỉ có thể nhập tối đa 255 ký tự')],
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

    public function validateDates($attribute) {
        if (strtotime($this->birthday) >= strtotime(date("Y-m-d ", time()))) {
            $this->addError($attribute, 'Ngày sinh không được lớn hơn hoặc bằng ngày hiện tại');
        }
    }

    public function getName() {
        return ($this->fullname) ? \yii\helpers\Html::encode($this->fullname) : \yii\helpers\Html::encode($this->username);
    }

    public function getImage() {
        return ($this->image_path) ? media_member_link . $this->image_path : '/images/img_03.jpg';
    }

    public function getAvatar() {
        return ($this->avatar_image) ? media_member_link . $this->avatar_image : '/images/4x4.png';
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
        $uploadPath = \Yii::$app->params['upload_path'];
        if ($this->validate()) {
            $dir = $uploadPath . \Yii::$app->params['upload_prefix'] . media_root_image_member;
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $imageName = \Yii::$app->params['upload_prefix'] . media_root_image_member . uniqid() . '.' . $this->$attr->extension;
            $this->$attr->saveAs($uploadPath . $imageName);

            self::autoRotateImage($uploadPath . $imageName);

            \yii\imagine\Image::thumbnail($uploadPath . $imageName, $with, $height)->save(Yii::getAlias($uploadPath . $imageName), ['quality' => 100]);

            return $imageName;
        }
        return false;
    }

    public static function autoRotateImage($filePath) {
        $image = new \Imagick($filePath);
        $orientation = $image->getImageOrientation();

        switch ($orientation) {
            case \Imagick::ORIENTATION_BOTTOMRIGHT:
                $image->rotateimage("#000", 180); // rotate 180 degrees 
                // Now that it's auto-rotated, make sure the EXIF data is correct in case the EXIF gets saved with the image! 
                $image->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
                $image->writeImage($filePath);
                break;

            case \Imagick::ORIENTATION_RIGHTTOP:
                $image->rotateimage("#000", 90); // rotate 90 degrees CW 
                // Now that it's auto-rotated, make sure the EXIF data is correct in case the EXIF gets saved with the image! 
                $image->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
                $image->writeImage($filePath);
                break;

            case \Imagick::ORIENTATION_LEFTBOTTOM:
                $image->rotateimage("#000", -90); // rotate 90 degrees CCW 
                // Now that it's auto-rotated, make sure the EXIF data is correct in case the EXIF gets saved with the image! 
                $image->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
                $image->writeImage($filePath);
                break;
        }
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'username' => Yii::t('backend', 'Username'),
            'password' => Yii::t('backend', 'Password'),
            'fullname' => Yii::t('backend', 'Fullname'),
            'email' => Yii::t('backend', 'Email'),
            'phonenumber' => Yii::t('backend', 'Phonenumber'),
            'birthday' => Yii::t('backend', 'Ngày sinh'),
            'sex' => Yii::t('backend', 'Sex'),
            'actived' => Yii::t('backend', 'Actived'),
            'locked' => Yii::t('backend', 'Locked'),
            'province_id' => Yii::t('backend', 'Province ID'),
            'credit' => Yii::t('backend', 'Credit'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'is_first_login' => Yii::t('backend', 'Is First Login'),
            'avatar_image' => Yii::t('backend', 'Avatar Image'),
            'address' => Yii::t('backend', 'Địa chỉ'),
        ];
    }

}
