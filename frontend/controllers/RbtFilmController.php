<?php

/**
 * Created by PhpStorm.
 * User: phuonghv2
 * Date: 4/15/2017
 * Time: 3:47 PM
 */

namespace frontend\controllers;

use frontend\models\FilmRbt;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class RbtFilmController extends AppController {

    public function actionIndex() {
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);

        $rbtListFilm = FilmRbt::getListRBTFilm(film_rbt_list_limit);
        $pages = new Pagination(['totalCount' => $rbtListFilm['total'],'defaultPageSize' => topic_page_limit]);
        if ($typeM==2){
            $this->layout = false;
            return $this->render('/ajax/_item_film_index', [
                'rbtListFilm' => $rbtListFilm['list'],
                'pages' => $pages,
                'page' => $page,
            ]);
        }
        return $this->render('/film/index', [
                    'rbtListFilm' => $rbtListFilm['list'],
                    'pages' => $pages,
                    'page' => $page,
        ]);
    }

    public function actionDetail($slug) {
        $query =  FilmRbt::find()->where(['slug'=>$slug]);
        $filmDetail = $query->one();
        $title = $filmDetail->name;
        $rbtListFilm = FilmRbt::getListRBTFilm(film_rbt_list_limit);
        $pages = new Pagination(['totalCount' => $rbtListFilm['total'],'defaultPageSize' => topic_page_limit]);

        //ham lay ra danh sach nhac film host
        $rbtListFilmHost = FilmRbt::getListHostRBTFilm($slug, song_active);

        return $this->render('/film/detail', [
                    'rbtListFilm' => $rbtListFilm['list'],
                    'rbtListFilmHost' => $rbtListFilmHost,
                    'filmDetail' => $filmDetail,
                    'id_hot' => $slug,
                    'pages' => $pages,
                    'title'=> $title
        ]);
    }

}
