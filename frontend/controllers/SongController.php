<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Song controller
 */
class SongController extends AppController {

    public function actionFulltrack($slug) {
        $mayBeYouLike = \frontend\models\MaybeYouLike::getAll();
        $song = $this->findModelBySlug($slug);

        $song->view_number = $song->view_number + 1;
        $song->updated_at = new \yii\db\Expression('now()');
        $song->save(false, ['view_number']);

        return $this->render('fulltrack', [
                    'song' => $song,
                    'mayBeYouLike' => $mayBeYouLike['list'],
                    'rbts' => $song->vtRingBackTones,
        ]);
    }

    public function actionRbtDetail($id) {
        $this->layout = false;
        $rbt = \frontend\models\VtRingBackTone::getOneByCode($id);
        if (!$rbt) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $rbt->listen_number = $rbt->listen_number + 1;
        $rbt->updated_at = new \yii\db\Expression('now()');
        $rbt->save(false, ['listen_number']);
        return $this->render('_rbt_item', [
                    'rbt' => $rbt,
        ]);
    }

    public function actionRbt($id) {
        $rbt = \frontend\models\VtRingBackTone::getOneByCode($id);
        if (!$rbt) {
            throw new NotFoundHttpException('Bài nhạc chờ không tồn tại!');
        }

        $rbt->listen_number = $rbt->listen_number + 1;
        $rbt->updated_at = new \yii\db\Expression('now()');
        $rbt->save(false, ['listen_number']);
        return $this->render('rbt', [
                    'rbt' => $rbt,
        ]);
    }

    protected function findModelBySlug($slug) {
        if (($model = \frontend\models\VtSong::getOneBySlug($slug)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Bài hát không tồn tại!');
        }
    }

    protected function findModelById($id) {
        if (($model = \frontend\models\VtSong::getOneById($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Bài hát không tồn tại!');
        }
    }

    /** action bài hát cùng ca sĩ
     * @param $id
     * @return string
     */
    public function actionSongOfSinger($id, $typeM) {
        $page = \Yii::$app->request->get('page', 1);
        $song = $this->findModelBySlug($id);
        $singerIds = [];
        $title = '';
        if ($song->singer_list) {
            $singers = json_decode($song->singer_list);
            if ($singers) {
                foreach ($singers as $item) {
                    if ($item->id) {
                        $singerIds[] = $item->id;
                        $title .= \yii\helpers\Html::encode($item->alias) . ' - ';
                    }
                }
            }
        } else {
            foreach ($song->singers as $item) {
                $singerIds[] = intval($item->id);
                $title .= \yii\helpers\Html::encode($item->alias) . ' - ';
            }
        }
        $data = \frontend\models\VtSong::getListBySinger($singerIds, $id, song_page_limit);

        $pages = new \yii\data\Pagination(['totalCount' => $data['total'], 'defaultPageSize' => song_page_limit]);
        $type = 2;
        $typeName = "song_of_singer";
        if ($typeM == 2) {
            $this->layout = false;
            return $this->render('/ajax/song-of-category', [
                        'categoryAreaSongSlug' => $data['list'],
                        'pages' => $pages,
                        'page' => $page,
                        'type' => $type,
                        'typeName' => $typeName,
                        'slug' => $id,
                        'title' => substr($title, 0, - 3)
            ]);
        }
        return $this->render('/song/song-of-category', [
                    'categoryAreaSongSlug' => $data['list'],
                    'pages' => $pages,
                    'type' => $type,
                    'typeName' => $typeName,
                    'slug' => $id,
                    'page' => $page,
                    'title' => substr($title, 0, - 3)
        ]);
    }

    public function actionSongOfCategory($id) {
        $song = $this->findModelById($id);
        $singerIds = [];
        foreach ($song->musicGenres as $item) {
            $singerIds[] = intval($item->id);
        }

        $data = \frontend\models\VtSong::getListByCat($singerIds, $id, song_page_limit);
        $pages = new \yii\data\Pagination(['totalCount' => $data['total'], 'defaultPageSize' => song_page_limit]);
        $type = 2;
        foreach ($song->musicGenres as $item) {
            $title = \yii\helpers\Html::encode($item->name) . ' - ';
        }
        return $this->render('/song/song-of-category', [
                    'categoryAreaSongSlug' => $data['list'],
                    'pages' => $pages,
                    'type' => $type,
                    'title' => substr($title, 0, - 3)
        ]);
    }

    public function actionSongOfYouLike() {
        $page = \Yii::$app->request->get('page', 1);
        $typeM = \Yii::$app->request->get('typeM', 1);
        $data = \frontend\models\MaybeYouLike::getAll(song_page_limit);
        $pages = new \yii\data\Pagination(['totalCount' => $data['total'], 'defaultPageSize' => song_page_limit]);
        $type = 3;
        if ($typeM == 2) {
            $this->layout = false;
            return $this->render('/ajax/song-of-category', [
                        'categoryAreaSongSlug' => $data['list'],
                        'pages' => $pages,
                        'page' => $page,
                        'type' => $type,
                        'title' => 'Có thể bạn thích',
            ]);
        }
        return $this->render('/song/song-of-category', [
                    'categoryAreaSongSlug' => $data['list'],
                    'pages' => $pages,
                    'page' => $page,
                    'type' => $type,
                    'title' => 'Có thể bạn thích'
        ]);
    }

    public static function convertCountView($count) {
        return \common\helpers\Helpers::convertCountView($count);
    }

}
