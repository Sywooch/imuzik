<?php

namespace common\models;

use Yii;

class VtSongBase extends \common\models\db\VtSongDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteSongJoins() {
        return $this->hasMany(VtFavouriteSongJoinBase::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiked() {
        return VtFavouriteSongJoinBase::find()->where(['song_id' => $this->id, 'member_id' => \Yii::$app->user->getId()])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtRingBackTones() {
        return $this->hasMany(VtRingBackToneBase::className(), ['vt_song_id' => 'id'])
                        ->andWhere(['vt_ring_back_tone.vt_status' => song_active])
                        ->andWhere(['vt_ring_back_tone.huawei_status' => huawei_status])
                        ->andWhere(['<>', 'vt_ring_back_tone.vt_link', ''])
                        ->orderBy(['vt_ring_back_tone.updated_at' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusicGenres() {
        return $this->hasMany(VtMusicGenreBase::className(), ['id' => 'music_genre_id'])
                        ->viaTable('vt_song_genre_join', ['song_id' => 'id'])
                        ->andWhere(['vt_music_genre.is_active' => is_active]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingers() {
        return $this->hasMany(VtSingerBase::className(), ['id' => 'singer_id'])->viaTable('vt_song_singer_join', ['song_id' => 'id'])->andWhere(['vt_singer.is_active' => is_active]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaybeYouLikes($limit = 6) {
        return $this->hasMany(MaybeYouLikeBase::className(), ['song_id' => 'id'], function($query) {
                    $query->andWhere(['vt_song.status' => song_active])
                            ->orderBy(['maybe_you_like.priority' => SORT_ASC])
                            ->limit($limit);
                });
    }

    public function getSingerImage() {
        $singers = json_decode($this->singer_list);
        if ($singers) {
            foreach ($singers as $item) {
                if ($item->image_path) {
                    return media_link . $item->image_path;
                }
            }
        } else {
            $singers = $this->singers;
            foreach ($singers as $item) {
                if ($item->image_path) {
                    return media_link . $item->image_path;
                }
            }
        }
        return '/images/4x4.png';
    }

    public function getImageUrl() {
        if (strpos($this->image_path, 'vip.img.cdn.keeng.vn') !== false) {
            return $this->image_path;
        }
        return media_image_link . $this->image_path;
    }

    public function getSingerName($getOne = true) {
        $singers = json_decode($this->singer_list);
        if (!$singers) {
            $singers = $this->singers;
        }
        $name = '';
        $size = sizeof($singers);
        if ($size) {
            if ($size > 2 & $getOne) {
                $name = 'Nhiều ca sĩ   ';
            } else {
                foreach ($singers as $item) {
                    if ($item->alias) {
                        $name .= \yii\helpers\Html::encode($item->alias) . ' - ';
                        if ($getOne && $name && $count == 2) {
                            break;
                        }
                    }
                }
            }
        }
        return ($name) ? substr($name, 0, -3) : 'Đang cập nhật';
    }

    public static function getNewest($limit = 6) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongBase_getNewest_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtSongBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->andWhere(['status' => song_active]);

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtMusicGenreJoins() {
        return $this->hasMany(VtMusicGenreJoinBase::className(), ['song_id' => 'id']);
    }

    /**
     * hàm lấy 5 bài hát trong khu vực hiển thị trong category
     */
    public static function getCategoryAreaSong($regions, $aread, $limit = 5) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongBase_getCategoryAreaSong_' . $aread . '_' . $limit . '_' . $regions;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSongBase::find()
                    ->join('INNER JOIN', 'vt_music_genre_join as vj', 'vt_song.id= vj.song_id ')
                    ->where([
                        'status' => song_active,
                        'vj.music_genre_id' => $aread
                    ])
                    ->groupBy('id')
                    ->orderBy('id desc')
                    ->limit($limit)
                    ->all();

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    /**
     * hàm lấy 15 bài hát trong khu vực hiển thị trong category
     */
    public static function getCategoryAreaSongPage($type, $aread, $limit = 15) {

        $cache = \Yii::$app->cache;
        $page = 1;
        if ($_GET['page']) {
            $page = $_GET['page'];
        }
        $key = 'VtSongBase_getCategoryAreaSongPage_' . $type . '_' . $aread . '_' . $limit . '_' . $page;

        $data = $cache->get($key);
        if (!$data) {
            $query = VtSongBase::find()
                    ->join('INNER JOIN', 'vt_music_genre_join as vj', 'vt_song.id= vj.song_id ')
                    ->where([
                        'status' => song_active,
                        'vj.music_genre_id' => $aread
                    ])
                    ->groupBy('id')
                    ->orderBy('id desc');

            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
                'pagination' => [
                    'defaultPageSize' => $limit,
                ],
            ]);
            $query->andWhere(['status' => song_active]);
            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getOneById($id) {
        return VtSongBase::find()->where(['status' => song_active, 'id' => intval($id)])->one();
    }

    public static function getOneBySlug($slug) {
        return VtSongBase::find()->where(['status' => song_active, 'slug' => $slug])->one();
    }

    public static function getListBySinger($singerId, $songId = 0, $limit = 5) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongBase_getListBySinger_' . $singerId . '_' . $songId . '_' . $limit;
        if ($_GET['page']) {
            $key .= '_' . $_GET['page'];
        }
        $data = $cache->get($key);
        if (!$data) {
            $query = VtSongBase::find()->innerJoin('vt_song_singer_join', 'vt_song_singer_join.song_id=vt_song.id');
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->andWhere(['vt_song.status' => song_active]);
            $query->andWhere(['vt_song_singer_join.singer_id' => $singerId]);

            if ($songId) {
                $query->andWhere(['<>', 'vt_song.id', intval($songId)]);
            }

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getListByCat($catId, $songId = 0, $limit = 5) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongBase_getListByCat_' . $catId . '_' . $songId . '_' . $limit;
        if ($_GET['page']) {
            $key .= '_' . $_GET['page'];
        }
        $data = $cache->get($key);
        if (!$data) {
            $query = VtSongBase::find()->innerJoin('vt_song_genre_join', 'vt_song_genre_join.song_id=vt_song.id');
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->andWhere(['vt_song.status' => song_active]);
            $query->andWhere(['vt_song_genre_join.music_genre_id' => $catId]);

            if ($songId) {
                $query->andWhere(['<>', 'vt_song.id', intval($songId)]);
            }

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getListSongTopic($slug, $songsId, $limit = 15) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongBase_getListSongTopic_' . $slug . '_' . $songsId . '_' . $limit;
        if ($_GET['page']) {
            $key .= '_' . $_GET['page'];
        }
        $data = $cache->get($key);
        if (!$data) {
            $query = VtSongBase::find()->innerJoin('topic_song', 'topic_song.song_id=vt_song.id');
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
//                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->andWhere(['vt_song.status' => song_active]);
            $query->andWhere(['topic_song.song_id' => $songsId]);
            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getListSongYouLiked($songsId, $limit = 15) {
        $cache = \Yii::$app->cache;
//        $key = 'VtSongBase_getListSongYouLiked_' . $songsId . '_' . $limit;
        if ($_GET['page']) {
            $key .= '_' . $_GET['page'];
        }
        $data = $cache->get($key);
        if (!$data) {
            $query = VtSongBase::find();

            $query->andWhere(['status' => song_active]);
            $query->orderBy('updated_at DESC');
            $query->andWhere(['id' => $songsId]);
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

}
