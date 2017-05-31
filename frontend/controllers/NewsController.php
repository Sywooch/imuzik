<?php

/**
 * Created by PhpStorm.
 * User: phuonghv2
 * Date: 4/12/2017
 * Time: 7:02 PM
 */

namespace frontend\controllers;

use yii\web\Controller;

/**
 * News controller
 */
class NewsController extends AppController {

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

    /**
     * Displays news.
     *
     * @return mixed
     */
    public function actionIndex() {
        $limithost=3;
        $typehost =1;
        $linitdefault=9;
        $typedefault=0;
        $newshostList = \frontend\models\VtArticle::getNewsHot($limithost,$typehost);
        $newsList = \frontend\models\VtArticle::getNewsHot($linitdefault, $typedefault);

        return $this->render('/tin-tuc/index', [
                    'newshostList' => $newshostList,
                    'newsList' => $newsList,
        ]);
    }

    /**
     * Displays news.
     *
     * @return mixed
     */
    public function actionDetail($id) {
        $newsDetail = \frontend\models\VtArticleTranslation::getNewsDetail($id);

        $arrID = $newsDetail->vtArticle->outer_related_article;
        if (sizeof($arrID)){
            $integerIDs = array_map('intval', explode(',', $arrID));
            $newsInvolve = \frontend\models\VtArticle::getNewsDetailInvolve($newsDetail->vtArticle->id,$integerIDs,$newsDetail->vtArticle->published_time);
        }
        
        return $this->render('/tin-tuc/detail', [
            'newsDetail' => $newsDetail,
            'newsInvolve' => $newsInvolve,
        ]);
    }

}
