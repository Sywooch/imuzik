<?php

namespace common\models;

use frontend\models\Topic;
use Yii;

class VtMusicGenreBase extends \common\models\db\VtMusicGenreDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSongs() {
        return $this->hasMany(VtSongBase::className(), ['id' => 'song_id'])->viaTable('vt_song_genre_join', ['music_genre_id' => 'id'])->andWhere(['vt_song.status' => song_active]);
    }

    public function getImageLink() {
        if ($this->image_path) {
            return media_link . $this->image_path;
        }
        return '/images/topic_default.jpg';
    }

    public static function getHOT($limit = 3) {
        $cache = \Yii::$app->cache;
        $key = 'VtMusicGenre_getHOT_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = Topic::find()->where(['is_active' => 1, 'is_hot' => 1]);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    //phuonghv2 ham lay danh sach the laoi theo vung
    public static function getCategoryArea($regions) {
        $cache = \Yii::$app->cache;
        $key = 'VtMusicGenre_getCategoryArea_' . $regions;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtMusicGenreBase::find()
                    ->where([
                        'is_active' => '1',
                        'regions' => $regions,
                    ])
                    ->orderBy('name')
                    ;
            $data= $query->all();
//            var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }
    // phuonghv2 ham lay danh sach id tu slug truyen vao
    public static  function getListIDFromSlug($slug){
        $cache = \Yii::$app->cache;
        $key = 'VtMusicGenre_getListIDFromSlug_'.$slug;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtMusicGenreBase::find()
                ->where([
                    'is_active' => '1',
                    'slug' => $slug,
                ])
                ->all();

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }
}
