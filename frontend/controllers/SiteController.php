<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends AppController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'common\libs\WapCaptcha',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $banners = \frontend\models\VtBannerItem::getAll();
        $catHot = \frontend\models\VtMusicGenre::getHOT();
        $downNow = \frontend\models\VtRingBackTone::getDownNow();
        $news = \frontend\models\VtArticle::getNewsHot(4, 3);
        $songNewest = \frontend\models\VtSong::getNewest();
        return $this->render('index', [
                    'banners' => $banners,
                    'catHot' => $catHot['list'],
                    'downNow' => $downNow['list'],
                    'songNewest' => $songNewest['list'],
                    'news' => $news,
        ]);
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        $form = new \frontend\models\LoginForm();
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post())) {
            $phonenumber = \common\libs\RemoveSign::convertMsisdn($form->username);
            $lastTime = Yii::$app->params['lock_fail_time'];
            $countFail = \common\models\LoginFailTimesBase::getFailByTime($phonenumber, time() - $lastTime * 60);
            if ($countFail > 3) {
                $form->scenario = 'withCaptcha';
            }
            if ($form->login($countFail)) {
                \common\models\LoginFailTimesBase::delByPhonenumber($phonenumber);
            } else {
                if ($countFail > 4) {
                    $form->clearErrors();
                    $form->addError('password', \Yii::t('wap', "Nhập sai thông tin quá số lần cho phép. Tài khoản của quý khách bị khóa trong " . $lastTime . " phút!"));
                    $member = \frontend\models\Member::findByUsername(\common\libs\RemoveSign::convertMsisdn($phonenumber));
                    $member->locked = 1;
                    $member->save(false, ['locked']);
                } else {
                    if ($phonenumber && !$form->getErrors()['captcha']) {
                        $fail = new \common\models\LoginFailTimesBase();
                        $fail->phone_number = $phonenumber;
                        $fail->created_time = new \yii\db\Expression('now()');
                        $fail->save(false);
                    }
                }
            }
            $return = $form->getErrors();
            $return['countFail'] = $countFail;
            return json_encode($return);
        }
        return $this->renderAjax('login', [
                    'countFail' => $countFail,
                    'model' => $form,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionFaq() {
        return $this->render('faq');
    }

}
