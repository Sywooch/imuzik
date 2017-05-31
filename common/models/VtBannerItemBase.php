<?php

namespace common\models;

use Yii;

class VtBannerItemBase extends \common\models\db\VtBannerItemDB {

    public $link;

    public static function getAll($limit = 4) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongBase_getNewest_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtBannerItemBase::find()->alias('c')->select('c.file_path as image, vt_banner_item_translation.link as link')
                    ->innerJoin('vt_banner', 'vt_banner.id = c.banner_id')
                    ->innerJoin('vt_banner_item_translation', 'vt_banner_item_translation.id = c.id')
                    ->where('c.is_active=1 AND vt_banner.is_active=1 AND c.banner_id=60 AND c.published_time <= DATE(NOW()) AND c.end_time > DATE(NOW())')
                    ->orderBy(['c.vtt_view' => SORT_ASC, 'c.updated_at' => SORT_DESC])
                    ->limit($limit)
                    ->all();

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public function getImageUrl() {
        if ($this->file_path) {
            return media_link . $this->file_path;
        }
        return '/images/banner-default.jpg';
    }

}
