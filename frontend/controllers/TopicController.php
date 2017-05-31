<?php

namespace frontend\controllers;

use common\models\TopicBase;
use common\models\TopicSongBase;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Topic controller
 */
class TopicController extends AppController {

    public function actionIndex() {
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);

        $listTopic = TopicBase::getListTopic(film_rbt_list_limit);
        $pages = new Pagination(['totalCount' => $listTopic['total'],'defaultPageSize' => topic_page_limit]);
        if ($typeM==2){
            $this->layout = false;
            return $this->render('/ajax/_item_topic_ajax', [
                'rbtListFilm' => $listTopic['list'],
                'pages' => $pages,
                'page'=>$page,
            ]);
        }
        return $this->render('/topic/index', [
            'rbtListFilm' => $listTopic['list'],
            'pages' => $pages,
            'page'=>$page,
        ]);
    }

    public function actionDetail($slug) {
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);
        $query =  TopicBase::find()->where(['slug'=>$slug]);
        $topicDetail = $query->one();
        $queryTopicSong = TopicSongBase::getSongIDTopic($topicDetail->id);
        foreach ($queryTopicSong as $item){
            $songId[] = $item->song_id;
        }
        //ham lay ra danh sach nhac thuoc chu de
        if (sizeof($songId)){
            $listSongTopic =  \frontend\models\VtSong::getListSongTopic($slug,$songId,song_page_limit);
        }
        $pages = new Pagination(['totalCount' => $listSongTopic['total'],'defaultPageSize' => song_page_limit]);
        if ($typeM==2){
            return $this->render('/ajax/_item_topic_detail_ajax', [
                'topicDetail' => $topicDetail,
                'listSongTopic' => $listSongTopic['list'],
                'pages' => $pages,
                'page' => $page,
                'slug' => $slug
            ]);
        }
        return $this->render('/topic/detail', [
            'topicDetail' => $topicDetail,
            'listSongTopic'=>$listSongTopic['list'],
            'pages' => $pages,
            'page'=>$page,
            'slug'=>$slug
        ]);
    }

}
