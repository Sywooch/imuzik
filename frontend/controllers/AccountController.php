<?php

/**
 * Created by PhpStorm.
 * User: phuonghv2
 * Date: 4/22/2017
 * Time: 9:38 AM
 */

namespace frontend\controllers;

use common\libs\CrbtService;
use common\models\VtFavouriteSongJoinBase;
use common\models\VtSongBase;
use frontend\models\ChangePasssForm;
use frontend\models\Member;
use Prophecy\Exception\Exception;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class AccountController extends AppController {

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
        $model = new Member();
        //default lấy danh sách nhạc yêu thích;
        //$id_member = Yii::$app->user->getId();
        $member = Yii::$app->user->identity;
        $id_member = $member->id;
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);
        if (!$member)
            return $this->goHome();
        // lay song_id

        $listSongYouLiked = VtFavouriteSongJoinBase::getListSongID($id_member);
        $pages = new Pagination(['totalCount' => $listSongYouLiked['total'], 'defaultPageSize' => song_page_limit]);
        if ($member->load(Yii::$app->request->post())) {
            $avatar = $_FILES["Member"]["name"]["image_path"];
            $member->image_path = \yii\web\UploadedFile::getInstance($member, 'image_path');
            $model->upload($avatar);
        }
        if ($typeM==2){
            return $this->render('/ajax/_item_song_you_like_ajax', [
                'listSongYouLiked' => $listSongYouLiked['list'],
                'member' => $member,
                'pages' => $pages,
                'page' => $page,
            ]);
        }else{
            return $this->render('/account/index', [
                'listSongYouLiked' => $listSongYouLiked['list'],
                'member' => $member,
                'pages' => $pages,
                'page' => $page,
            ]);
        }

    }

    public function actionInfo() {

        if (!\Yii::$app->user->identity) {
            return $this->goHome();
        }
        $model = \Yii::$app->user->identity;
        $modelPass = new ChangePasssForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->fullname = trim($_POST["Member"]["fullname"]);
            $model->sex = $_POST["Member"]["sex"];
            $model->birthday = $_POST["Member"]["birthday"];
            $model->address = trim($_POST["Member"]["address"]);
            $model->save();
            \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Cập nhật thông tin thành công!'));
        }

        return $this->render('/account/info', [
                    'model' => $model,
                    'modelPass' => $modelPass,

        ]);
    }

    public function actionChangePass() {
        $model = \Yii::$app->user->identity;
        if (!$model) {
            return $this->goHome();
        }
        $modelPass = new ChangePasssForm();
        if ($modelPass->load(Yii::$app->request->post()) && $modelPass->validate()) {
            $model->password = $model->generatePasswordHash($modelPass->newpass);
            $model->save(false, ['password']);
            \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Thay đổi mật khẩu thành công!'));
            $modelPass->repeatnewpass="";
            $modelPass->oldpass="";
            $modelPass->newpass="";
        }
        return $this->render('/account/info', [
                    'model' => $model,
                    'modelPass' => $modelPass,

        ]);
    }

}
