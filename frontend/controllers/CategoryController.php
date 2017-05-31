<?php

/**
 * Created by PhpStorm.
 * User: phuonghv2
 * Date: 4/12/2017
 * Time: 7:02 PM
 */

namespace frontend\controllers;

use yii\data\Pagination;
use yii\web\Controller;

/**
 * News controller
 */
class CategoryController extends AppController {

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
        //$regions =1 là viet nam, 2 là âu mỹ, 3 là châu á;
        $page = \Yii::$app->request->get('page', 1);
        $categoryAreaVN = \frontend\models\VtMusicGenre::getCategoryArea(1);
        $areaVN = array();
        foreach ($categoryAreaVN as $k => $v) {
            $areaVN[':' . $k] = $v->id;
        }
        $categoryAreaSongVN = \frontend\models\VtSong::getCategoryAreaSong(1, $areaVN, 5);

        $categoryAreaAM = \frontend\models\VtMusicGenre::getCategoryArea(2);
        $areaAM = array();
        foreach ($categoryAreaAM as $k => $v) {
            $areaAM[':' . $k] = $v->id;
        }
        $categoryAreaSongAM = \frontend\models\VtSong::getCategoryAreaSong(2, $areaAM, 5);

        $categoryAreaCA = \frontend\models\VtMusicGenre::getCategoryArea(3);
        $areaCA = array();
        foreach ($categoryAreaCA as $k => $v) {
            $areaCA[':' . $k] = $v->id;
        }
        $categoryAreaSongCA = \frontend\models\VtSong::getCategoryAreaSong(3, $areaCA, 5);

        return $this->render('/category/index', [
                    'categoryAreaVN' => $categoryAreaVN,
                    'categoryAreaAM' => $categoryAreaAM,
                    'categoryAreaCA' => $categoryAreaCA,
                    'categoryAreaSongVN' => $categoryAreaSongVN,
                    'categoryAreaSongAM' => $categoryAreaSongAM,
                    'categoryAreaSongCA' => $categoryAreaSongCA,
                    'page' => $page,
        ]);
    }

    public function actionSongOfCategory($id) {
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);
        $categoryAreaVN = \frontend\models\VtMusicGenre::getCategoryArea($id);
        $areaVN = array();
        foreach ($categoryAreaVN as $k => $v) {
            $areaVN[':' . $k] = $v->id;
        }
        $categoryAreaSongVN = \frontend\models\VtSong::getCategoryAreaSongPage($id, $areaVN, song_page_limit);
        $pages = new Pagination(['totalCount' => $categoryAreaSongVN['total'], 'defaultPageSize' => song_page_limit]);
        $type = 1;

        foreach ($categoryAreaVN as $item) {
            $regions = $item->regions;
        }
        if ($regions == 1)
            $title = 'Việt Nam';
        if ($regions == 2)
            $title = 'Âu Mỹ';
        if ($regions == 3)
            $title = 'Châu Á';
        if ($typeM==2){
            $this->layout = false;
            return $this->render('/ajax/song-of-category', [
                'categoryAreaVN' => $categoryAreaSongVN['list'],
                'pages' => $pages,
                'page' => $page,
                'type' => $type,
                'title' => $title,
                'slug' => $regions
            ]);
        }
        return $this->render('/song/song-of-category', [
                    'categoryAreaVN' => $categoryAreaSongVN['list'],
                    'pages' => $pages,
                    'page' => $page,
                    'type' => $type,
                    'title' => $title,
                    'slug' => $regions
        ]);
    }

    public function actionSongOfCategorySlug($slug) {
        $categoryAreaVN = \frontend\models\VtMusicGenre::getListIDFromSlug($slug);
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);
        $areaVN = array();
        foreach ($categoryAreaVN as $k => $v) {
            $areaVN[':' . $k] = $v->id;
        }
        $categoryAreaSongSlug = \frontend\models\VtSong::getCategoryAreaSongPage($slug, $areaVN, song_page_limit);
        $pages = new Pagination(['totalCount' => $categoryAreaSongSlug['total'], 'defaultPageSize' => song_page_limit]);
        $type = 2;
        foreach ($categoryAreaVN as $item) {
            $title = $item->name;
        }
        if ($typeM==2){
            $this->layout = false;
            return $this->render('/ajax/song-of-category', [
                'categoryAreaSongSlug' => $categoryAreaSongSlug['list'],
                'pages' => $pages,
                'page' => $page,
                'type' => $type,
                'title' => $title,
                'slug' => $slug
            ]);
        }
        return $this->render('/song/song-of-category', [
                    'categoryAreaSongSlug' => $categoryAreaSongSlug['list'],
                    'pages' => $pages,
                    'page' => $page,
                    'type' => $type,
                    'title' => $title,
                    'slug' => $slug
        ]);
    }

}
