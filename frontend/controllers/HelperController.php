<?php

/**
 * Created by PhpStorm.
 * User: phuonghv2
 * Date: 5/5/2017
 * Time: 10:14 AM
 */

namespace frontend\controllers;

use common\models\VtHelpCenterCategoryTranslationBase;
use common\models\VtHelpCenterTranslationBase;
use frontend\models\VtMessages;
use Yii;
use yii\web\Controller;

class HelperController extends AppController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        //ham lay du lieu menu
        $title = \Yii::$app->request->get('name', "Hướng dẫn");
        $arrMenu = VtHelpCenterCategoryTranslationBase::getCategoryMenuHelper();
        $data = VtHelpCenterTranslationBase::getDataItemHelper($arrMenu[0]->id);
        return $this->render('/helper/guide', [
                    'arrMenu' => $arrMenu,
                    'data' => $data,
                    'slug'=>$arrMenu[0]->slug,
                    'title'=>$title
        ]);
    }

    public function actionInstruction($id) {
        //ham lay du lieu menu
        $title = \Yii::$app->request->get('name', "Hướng dẫn");
        $arrMenu = VtHelpCenterCategoryTranslationBase::getCategoryMenuHelper();
        $data = VtHelpCenterTranslationBase::getDataItemHelper($id);
        return $this->render('/helper/guide', [
                    'arrMenu' => $arrMenu,
                    'data' => $data,
                    'title'=>$title
        ]);
    }

    public function actionHelpsCategory($slug) {
        //ham lay du lieu menu

        $arrMenu = VtHelpCenterCategoryTranslationBase::getCategoryMenuHelper();
        $dataSlug = VtHelpCenterTranslationBase::getDataItemHelperSlug($slug);
        $title = \Yii::$app->request->get('name', "Hướng dẫn");
        if ($dataSlug->id != null) {
            $data = VtHelpCenterTranslationBase::getDataItemHelper($dataSlug->id);
        }
        return $this->render('/helper/guide', [
                    'arrMenu' => $arrMenu,
                    'data' => $data,
                    'slug'=>$slug,
                    'title'=>$title
        ]);
    }

    public function actionFeedBackError() {
        $member = \Yii::$app->user->identity;
        $message = new VtMessages();
        if ($message->load(Yii::$app->request->post()) && $message->validate()) {
            $message->phone_number = $member->username;
            $message->save(false);
            \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Gửi góp ý thành công!'));
            return $this->goHome();
        }
        //ham lay du lieu menu
        $arrMenu = VtHelpCenterCategoryTranslationBase::getCategoryMenuHelper();
        return $this->render('/helper/feedback_error', [
                    'arrMenu' => $arrMenu,
                    'model' => $message,
            
        ]);
    }

}
