<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {

    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;
    private $_user;
    public $loginFailCount = 0;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['username'], 'required', 'message' => 'Số điện thoại không được để trống'],
            [['password'], 'required', 'message' => 'Mật khẩu không được để trống'],
            //[['captcha'], 'required', 'message' => 'Mã xác thực không được để trống'],
            [['username', 'captcha'], 'trim'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['captcha', 'captcha', 'message' => 'Mã xác thực không đúng', 'on' => 'withCaptcha'],
            [['username'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'username' => Yii::t('wap', 'Số điện thoại'),
            'password' => Yii::t('wap', 'Mật khẩu'),
            'rememberMe' => Yii::t('wap', 'Nhớ mật khẩu'),
            'captcha' => Yii::t('wap', 'Mã xác thực'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Số điện thoại hoặc mật khẩu chưa đúng');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login($countFail = 0) {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user->actived == 0) {
                $this->addError('password', Yii::t('frontend', 'Tài khoản của bạn chưa được kích hoạt'));
            } elseif ($user->locked == 1 && $countFail > 4) {
                $this->addError('password', Yii::t('frontend', 'Tài khoản của bạn đang bị khóa, vui lòng thử lại sau ít phút!'));
            } elseif ($user->actived == 1) {
                $user->locked = 0;
                $user->save(false, ['locked']);
                return Yii::$app->user->login($user, LOGIN_TIMEOUT);
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = Member::findByUsername(\common\libs\RemoveSign::convertMsisdn($this->username));
        }

        return $this->_user;
    }

}
