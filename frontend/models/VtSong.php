<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

class VtSong extends \common\models\VtSongBase {

    public static function getDownMost($limit = number_limit) {
        $cache = \Yii::$app->cache;
        $key = 'VtSong_getDownMost_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSong::find()
                    ->select('vt_song.*, rank_song.position, rank_song.image_path   ')
                    ->leftJoin('rank_song', 'vt_song.id = rank_song.song_id')
                    ->where([
                        'rank_song.rank_id' => $id,
                        'vt_song.is_active' => Constant::ACTIVE
                    ])->with(['singers' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                    ->orderBy('rank_song.position asc')
                    ->limit($limit)
                    ->asArray()
                    ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_song.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    public static function getListSongById($arrSong, $limit = 15, $keyword) {
        $cache = \Yii::$app->cache;
        $page = 1;
        if ($_GET['page']) {
            $page = $_GET['page'];
        }
        $key = 'VtSong_getListSongById_' . json_encode($arrSong) . '_' . $limit . '_' . $page . '_' . $keyword;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtSong::find()->where(['id' => $arrSong]);
            $query->orderBy([new \yii\db\Expression('FIELD (id, ' . implode(',', $arrSong) . ')')]);

            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'defaultPageSize' => $limit,
                ],
            ]);
            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}
