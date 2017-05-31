<?php

namespace common\models;

use Yii;

class FilmRbtBase extends \common\models\db\FilmRbtDB {

    public function getImageLink() {
        if ($this->image_path) {
            return media_rbt_film_link . $this->image_path;
        }
        return '/images/landscape.png';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongs() {
        return $this->hasMany(VtSongBase::className(), ['film_id' => 'id'])->andWhere(['vt_song.status' => song_active])->orderBy('vt_song.updated_at desc');
    }

    /**
     * hàm lấy 12 film trong trang chu
     */
    public static function getListRBTFilm($limit = 12) {
        $cache = \Yii::$app->cache;
        $key = 'FilmRbtBase_getListRBTFilm_' . $limit;
        if ($_GET['page']) {
            $key .= '_' . $_GET['page'];
        }
        $data = $cache->get($key);
        if (!$data) {
            $query = FilmRbtBase::find()
                    ->where([
                        'is_active' => 1,
                    ])
                    ->orderBy('updated_at desc');
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

    /**
     *  ham lay danh sach nhac film host
     *  limit 4
     */
    public static function getListHostRBTFilm($id, $limit =4) {
        $cache = \Yii::$app->cache;
        $key = 'FilmRbtBase_getListHostRBTFilm_' . $id . '_' . $limit;
        if ($_GET['page']) {
            $key .= '_' . $_GET['page'];
        }
        $data = $cache->get($key);
        if (!$data) {
            $query = FilmRbtBase::find()
                    ->where([
                        'is_active' => 1,
                        'is_hot' => 1
                    ])
                    ->andWhere(['<>', 'slug', $id])
                    ->limit($limit)
                    ->orderBy('updated_at desc');
//            var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);die;
            $data = $query->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }

        return $data;
    }

}
