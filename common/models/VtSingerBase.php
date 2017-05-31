<?php

namespace common\models;

use Yii;

class VtSingerBase extends \common\models\db\VtSingerDB {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSongs() {
        return $this->hasMany(VtSongDB::className(), ['id' => 'song_id'])->viaTable('vt_song_singer_join', ['singer_id' => 'id']);
    }

    public static function getOneById($id) {
        $cache = \Yii::$app->cache;
        $key = 'VtSingerBase_getOneById_' . $id;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSingerBase::find()->where(['is_active' => singer_active, 'id' => intval($id)])->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getOneBySlug($slug) {
        $cache = \Yii::$app->cache;
        $key = 'VtSingerBase_getOneBySlug_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSingerBase::find()->where(['is_active' => singer_active, 'slug' => $slug])->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}
