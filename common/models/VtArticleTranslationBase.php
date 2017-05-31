<?php

namespace common\models;

use Yii;

class VtArticleTranslationBase extends \common\models\db\VtArticleTranslationDB {
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtArticle() {
        return $this->hasOne(VtArticleBase::className(), ['id' => 'id']);
    }

    public function getImageLink($defaultSizeImage = img_4_3) {
        if ($this->image_path) {
            return media_link . $this->image_path;
        }
        return $defaultSizeImage;
    }
    public static function getNewsDetail($slug) {

        $cache = \Yii::$app->cache;
        $key = 'VtArticleTranslationBase_getNewsDetail_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtArticleTranslationBase::find()
                ->where([
                    'slug' => $slug,
                    'lang'=>'en'
                ])
            ;
//            var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
            $data=$query ->one();

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }
}