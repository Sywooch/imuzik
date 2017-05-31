<?php

/**
 * Created by PhpStorm.
 * User: Toanhv9
 * Date: 8/11/2015
 * Time: 4:29 PM
 */

namespace frontend\controllers;

use common\libs\MobileRecognized;
use common\libs\RemoveSign;
use frontend\models\Member;
use Yii;
use yii\base\Exception;
use yii\web\Controller;

class AppController extends Controller {

    public function beforeAction($action) {
        if (Yii::$app->session->has('lang')) {
            Yii::$app->language = Yii::$app->session->get('lang');
        } else {
            Yii::$app->language = 'vi';
        }
        $request = Yii::$app->request;
        if ($request->isPjax || $request->getQueryParam('_pjax') || $request->isAjax) {
            $this->layout = false;
        }

        if (!\Yii::$app->session->get('utm_source') && $request->getQueryParam('utm_source')) {
            \Yii::$app->session->set('utm_source', trim($request->getQueryParam('utm_source')));
        } else {
            \Yii::$app->session->set('utm_source', \Yii::$app->devicedetect->isDescktop() ? 'web' : 'wap');
        }

        if (Yii::$app->user->isGuest) {
            Yii::info("user login false");
            $msisdn = MobileRecognized::getMsisdn();
            Yii::info(" msisdn: " . $msisdn, "mobile");
            if ($msisdn && $msisdn != '') {
                $user = Member::findByUsername(RemoveSign::convertMsisdn($msisdn));
                if (!$user) {
                    $msisdn = RemoveSign::convertMsisdn($msisdn);
                    $user = new Member();
                    $user->username = $msisdn;
                    $user->password = sha1(uniqid());
                    $user->phonenumber = $msisdn;
                    $user->actived = 1;
                    $user->locked = 0;
                    $user->is_first_login = 1;
                    $user->actived = 1;
                    $user->save(false);
                }
                if ($user) {
                    Yii::$app->user->login($user, 0);
                }
            }
        }
        return parent::beforeAction($action);
    }

}
