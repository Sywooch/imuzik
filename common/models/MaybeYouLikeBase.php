<?php

namespace common\models;

use Yii;

class MaybeYouLikeBase extends \common\models\db\MaybeYouLikeDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong() {
        //return $this->hasOne(VtSongBase::className(), ['id' => 'song_id'])->andWhere(['vt_song.status' => song_active]);
        return $this->hasOne(VtSongBase::className(), ['id' => 'song_id']);
    }

    public static function getAll($limit = 6) {
        $cache = \Yii::$app->cache;
        $page = 1;
        if ($_GET['page']) {
            $page = $_GET['page'];
        }
        $key = 'MaybeYouLike_getAll_' . $limit . '_' . $page;
        $data = $cache->get($key);
        if (!$data) {
            $query = MaybeYouLikeBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['priority' => SORT_ASC]],
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
