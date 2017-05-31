<?php

namespace common\models;

use Yii;

class VtSongRankTableBase extends \common\models\db\VtSongRankTableDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong() {
        return $this->hasOne(VtSongBase::className(), ['id' => 'song_id']); //->andWhere(['vt_song.status' => song_active]);
    }

    public static function getAll($type, $limit = 20) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongRankTableBase_getAll_' . $type . '_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtSongRankTableBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['fake_vote_times' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);

            $query->andWhere(['ranktable_id' => intval($type)]);

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}
