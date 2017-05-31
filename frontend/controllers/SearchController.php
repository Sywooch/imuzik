<?php

/**
 * Copyright by KhanhNQ16@viettel.com.vn
 * All Rights Reserved.
 * Date: 25-Oct-15 3:59 PM
 */

namespace frontend\controllers;

use common\helpers\Helpers;
use common\libs\RemoveSign;
use frontend\models\VtSong;
use yii;
use common\libs\Search;
use yii\data\Pagination;

class SearchController extends AppController {

    public function actionIndex() {
        $keyword = urldecode(\Yii::$app->request->getQueryParam("k"));
        $querykeyword = \common\libs\Helpers::removeSignAndSpecialChars($keyword);
//        var_dump("phuonghv2--check==="+$querykeyword);
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);
        $offset = ($page - 1) * song_page_limit;
        $querySong = 'song_name:' . '"' . $querykeyword . '"';
        $songs = Search::searchAll($querySong, song_page_limit, $offset);
        if (Search::nameValidate($keyword, $songs['full_items'], $offset)) {
            $total = $songs["total"];
            $songid = array();
            foreach ($songs['full_items'] as $song) {
                $songid[] = $song->id;
            }
            if (count($songid) > 0) {
                $songs = VtSong::getListSongById($songid, song_page_limit, $querykeyword);
            } else {
                $songs = array();
            }

            $pages = new Pagination(['totalCount' => $total, 'defaultPageSize' => song_page_limit]);
            $title = "Có " . $total . " kết quả tìm kiếm với từ khóa " . $keyword;
            if ($typeM == 2) {
                $this->layout = false;
                return $this->render('/ajax/_item_search_ajax', [
                            'songs' => $songs['list'],
                            'k' => $keyword,
                            'pages' => $pages,
                            'title' => $title,
                            'page' => $page,
                ]);
            }
            return $this->render('/search/index', [
                        'songs' => $songs['list'],
                        'k' => $keyword,
                        'pages' => $pages,
                        'title' => $title,
                        'page' => $page,
            ]);
        } else {
            $queryRBT = 'huawei_tone_name:' . '"' . $querykeyword . '"';
            if ($offset >= 1500) {
                exit(0);
            }

            $songsRBT = Search::searchAll($queryRBT, song_page_limit, $offset);

            $total = $songsRBT["total"];
            if ($total <= 1500) {
                $total = $songsRBT["total"];
            } else {
                $total = 1500;
            }
            $pages = new Pagination(['totalCount' => $total, 'defaultPageSize' => song_page_limit]);
            $title = "Có " . $total . " kết quả tìm kiếm với từ khóa " . $keyword;
            if ($typeM == 2) {
                $this->layout = false;
                return $this->render('/ajax/_item_search_rbt_ajax', [
                            'songs' => $songsRBT['full_items'],
                            'k' => $keyword,
                            'pages' => $pages,
                            'title' => $title,
                            'page' => $page,
                ]);
            }
            return $this->render('/search/_rbt_index', [
                        'songs' => $songsRBT['full_items'],
                        'k' => $keyword,
                        'pages' => $pages,
                        'title' => $title,
                        'page' => $page,
            ]);
        }
    }


    /**
     * KhanhNQ16
     */
    public function actionSuggest($keyword) {
//        $songs = Search::searchDismaxSong($keyword,search_page_limit);
        $keyword = \common\libs\Helpers::removeSignAndSpecialChars($keyword);

        $query = 'song_name:' . '"' . $keyword . '"';

        $songs = Search::searchAll($query, search_page_limit);
//        $query = ':' . '"' . $keyword . '"';
//        $songs = Search::searchDismaxSongName($query, search_page_limit);
        echo \Yii::$app->view->render('/search/_contentSuggest.php', [
            'songs' => $songs['full_items'],
        ]);
        exit(0);
    }

    /**
     * phuonghv2
     */
    public static function textCompare($t1, $t2) {
        $t1 = strtoupper(RemoveSign::removeSign($t1));
        $t2 = strtoupper(RemoveSign::removeSign($t2));
        similar_text($t1, $t2, $per);
        return $per;
    }

    /**
     * phuonghv2
     * load more mobile
     */
    public function actionSearchMobile() {
        $k = \Yii::$app->request->get('k', "");
        $page = \Yii::$app->request->get('page', 1);

        $limit = \Yii::$app->request->getQueryParam('page') * search_page_limit;
        $songs = Search::searchDismaxSongName($k, $limit);
        $songid = array();
        foreach ($songs['full_items'] as $song) {
            $songid[] = $song->id;
        }

        if (count($songid) > 0) {
            $songs = VtSong::getListSongById($songid, search_page_limit);
        } else {
            $songs = array();
        }

        $pages = new Pagination(['totalCount' => $songs['total'], 'defaultPageSize' => search_page_limit]);
        $title = "Có " . $songs['total'] . " kết quả tìm kiếm với từ khóa: " . $k;
        return $this->render('/ajax/_item_search_ajax', [
                    'songs' => $songs['list'],
                    'k' => $k,
                    'pages' => $pages,
                    'page' => $page,
                    'title' => $title,
        ]);
    }

    /**
     * phuonghv2
     * load more mobile
     */
    public function actionSearchMobileRbt() {
        $k = \Yii::$app->request->get('k', "");
        $page = \Yii::$app->request->get('page', 1);

        $limit = \Yii::$app->request->getQueryParam('page') * search_page_limit;
        $songsRBT = Search::searchDismaxSongNameRBT($k, $limit);
        $total = $songsRBT["total"];
        $pages = new Pagination(['totalCount' => $total, 'defaultPageSize' => search_page_limit]);
        $title = "Có " . $total . " kết quả tìm kiếm với từ khóa " . $k;
        return $this->render('/ajax/_item_search_rbt_ajax', [
                    'songs' => $songsRBT['full_items'],
                    'k' => $k,
                    'pages' => $pages,
                    'title' => $title,
                    'page' => $page,
        ]);
    }

    /**
     *
     */
    public static function validateInput($keyWord) {
        $keyWord = str_replace(' ', '+', $keyWord);
        $keyWord = str_replace('|', '/', $keyWord);
//        $query = base64_decode($query);
        $query = trim($keyWord);
        $queryName = $query;
        if (strpos($query, " - ")) {
            $queryName = trim(substr($query, 0, strpos($query, "-")));
        }
        $queryName = \common\libs\Helpers::removeSignAndSpace($queryName);
        return $queryName;
    }

}
