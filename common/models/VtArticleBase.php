<?php

namespace common\models;

use Yii;

class VtArticleBase extends \common\models\db\VtArticleDB {

    public function getImageLink($defaultSizeImage = img_4_3) {
        if ($this->image_path) {
            return media_rbt_film_link . $this->image_path;
        }
        return $defaultSizeImage;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtArticleTranslations() {
        return $this->hasOne(VtArticleTranslationBase::className(), ['id' => 'id'])->andWhere(['vt_article_translation.lang' => 'en']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    

    public static function getNewsHot($limit, $type) {
        $cache = \Yii::$app->cache;
        $key = 'VtArticleBase_getNewsHot_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtArticleBase::find()
                    ->where([
                        'status' => news_active,
                        'type' => $type,
                    ])
                    ->andWhere(['<=', 'published_time', new \yii\db\Expression('now()')])
                    ->orderBy('published_time DESC')
                    ->limit($limit);
                    $data=$query->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }
    
    public static function getNewsDetailInvolve($id,$outer_related_article,$published_timeID){
        $cache = \Yii::$app->cache;
        $key = 'VtArticleBase_getNewsDetailInvolve_' . $outer_related_article.'_'.$id.'_'.$published_timeID;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtArticleBase::find()
                ->where([
                    'id' => $outer_related_article,
                    'status'=> song_active
                ])
                ->andWhere(['<=', 'published_time', $published_timeID]);
            if ($id) {
                $query->andWhere(['<>', 'id', intval($id)]);
            }
            $query->orderBy('published_time DESC')->limit(4);
            $data= $query->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }


}
