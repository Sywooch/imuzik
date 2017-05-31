<?php

namespace common\models;

use Yii;

/**
 * @property VtSongBase $song
 */
class VtRingBackToneBase extends \common\models\db\VtRingBackToneDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong() {
        return $this->hasOne(VtSongBase::className(), ['id' => 'vt_song_id'])->andWhere(['vt_song.status' => song_active]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiked() {
        return VtFavouriteRbtJoinBase::find()->where(['rbt_id' => $this->id, 'member_id' => Yii::$app->user->getId()])->one();
    }

    public static function getOneByCode($code) {
        return VtRingBackToneBase::find()->where(['huawei_tone_code' => $code, 'vt_status' => song_active])->one();
    }

    public static function getAllBySong($songId) {
        $cache = \Yii::$app->cache;
        $key = 'VtRingBackToneBase_getAllBySong_' . $songId;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtRingBackToneBase::find()->where(['vt_song_id' => $songId, 'vt_status' => song_active])
                    ->orderBy(['updated_at' => SORT_DESC])
                    ->all();
            $cache->set($key, $data, CACHE_LONG_TIMEOUT);
        }
        return $data;
    }

    public static function getDownNow($limit = 15) {
        $cache = \Yii::$app->cache;
        $key = 'VtRingBackToneBase_getDownNow_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtRingBackToneBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['huawei_lastsync' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->where(['vt_status' => song_active, 'huawei_status' => huawei_status]);
            $query->andFilterCompare('huawei_order_times', 0, '>');
            $query->andFilterCompare('vt_link', "''", '<>');

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_LONG_TIMEOUT);
        }
        return $data;
    }

    public static function getDownAll($limit = 20) {
        $cache = \Yii::$app->cache;
        $key = 'VtRingBackToneBase_getDownNow_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtRingBackToneBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['huawei_order_times' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->where(['vt_status' => song_active, 'huawei_status' => huawei_status]);
            $query->andFilterCompare('vt_link', "''", '<>');

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_LONG_TIMEOUT);
        }
        return $data;
    }

    public static function getTopDownWeek($limit = 20) {
        $cache = \Yii::$app->cache;
        $key = 'VtRingBackToneBase_getTopDownWeek_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtRingBackToneBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['huawei_order_times' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->where(['vt_status' => song_active, 'huawei_status' => huawei_status]);
            $query->andFilterCompare('huawei_lastsync', new \yii\db\Expression('DATE_ADD(NOW(), INTERVAL(1-DAYOFWEEK(NOW())) DAY)'), '>');
            $query->andFilterCompare('vt_link', "''", '<>');

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_LONG_TIMEOUT);
        }
        return $data;
    }

    public static function getTopDownMonth($limit = 20) {
        $cache = \Yii::$app->cache;
        $key = 'VtRingBackToneBase_getTopDownMonth_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtRingBackToneBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['huawei_order_times' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->where(['vt_status' => song_active, 'huawei_status' => huawei_status]);
            $query->andFilterCompare('huawei_lastsync', new \yii\db\Expression('DATE_FORMAT(NOW() ,\'%Y-%m-01\')'), '>');
            $query->andFilterCompare('vt_link', "''", '<>');

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_LONG_TIMEOUT);
        }
        return $data;
    }

    public static function getTopFree($limit = 20) {
        $cache = \Yii::$app->cache;
        $key = 'VtRingBackToneBase_getTopFree_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtRingBackToneBase::find();
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
            $query->where(['vt_status' => song_active, 'huawei_price' => 0, 'huawei_status' => huawei_status]);
            $query->andFilterCompare('vt_link', "''", '<>');

            $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];

            $cache->set($key, $data, CACHE_LONG_TIMEOUT);
        }
        return $data;
    }

}
