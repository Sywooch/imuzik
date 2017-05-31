<?php

namespace common\models;

use Yii;

class TopicSongBase extends \common\models\db\TopicSongDB {
    public static function getSongIDTopic($topicId) {
        $cache = \Yii::$app->cache;
        $key = 'TopicSongBase_getSongIDTopic_' . $topicId ;
        $data = $cache->get($key);
        if (!$data) {
            $query = TopicSongBase::find()
                ->where([
                    'topic_id' => $topicId,
                ]) ->orderBy('priority ASC')
                ->addOrderBy('updated_at desc');
            $data = $query->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }
}