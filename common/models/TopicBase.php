<?php

namespace common\models;

use Yii;

class TopicBase extends \common\models\db\TopicDB {
    public function getImageLink( ) {
        if ($this->image_path) {
            return media_rbt_film_link . $this->image_path;
        }
        return '/images/onbox_02.jpg';
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSongs()
    {
        return $this->hasMany(VtSongBase::className(), ['id' => 'song_id'])->viaTable('topic_song', ['topic_id' => 'id'])->andWhere(['vt_song.status'=>song_active]);
    }

    /**
     * hàm lấy 12 film trong trang chu
     */
    public static function getListTopic($limit=12) {
        $cache = \Yii::$app->cache;
        $key = 'TopicBase_getListTopic_' . $limit;
        if ($_GET['page']) {
            $key .= '_' . $_GET['page'];
        }
        $data = $cache->get($key);
        if (!$data) {
            $query = TopicBase::find()
                -> where([
                    'is_active'=>1,
                ])
                ->orderBy('priority ASC')
                ->addOrderBy('updated_at desc')
            ->limit($limit);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => ['priority' => SORT_ASC,'updated_at' => SORT_DESC]],
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