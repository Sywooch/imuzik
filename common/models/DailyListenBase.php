<?php

namespace common\models;

use Yii;

class DailyListenBase extends \common\models\db\DailyListenDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong() {
        return $this->hasOne(VtSongBase::className(), ['id' => 'song_id']);
    }

    public static function getAll($limit = 3) {
        $cache = \Yii::$app->cache;
        $key = 'DailyListenBase_getAll_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = DailyListenBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['priority' => SORT_ASC, 'created_at' => SORT_ASC]],
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
