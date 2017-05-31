<?php

namespace common\models;

use frontend\models\VtHelpCenterCategory;
use frontend\models\VtHelpCenterTranslation;
use Yii;

class VtHelpCenterTranslationBase extends \common\models\db\VtHelpCenterTranslationDB {
//phuonghv2 ham lay du lieu khi click vao menu
    public static function getDataItemHelper($idCategory) {
        $cache = \Yii::$app->cache;
        $key = 'VtHelpCenterTranslation_getDataItemHelper_'.$idCategory;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtHelpCenterTranslation::find()
                ->join('LEFT JOIN','vt_help_center v', 'vt_help_center_translation.id = v.id')
                ->join('INNER JOIN','vt_help_center_category v3', 'v.help_center_category_id = v3.id ')
                ->where([
                    'v.is_active' => is_active,
                    'v3.is_active'=>is_active,
                    'vt_help_center_translation.lang' => 'en',
                    'v.help_center_category_id' => $idCategory,

                ])->andWhere(['not', ['v.help_center_category_id' => null]]);
            $query  ->orderBy('v.order_number ASC');
            $query  ->addOrderBy('vt_help_center_translation.title ASC');
            $data= $query->all();

            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }
    public static function getDataItemHelperSlug($slug) {
        $cache = \Yii::$app->cache;
        $key = 'VtHelpCenterTranslation_getDataItemHelperSlug_'.$slug;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtHelpCenterCategory::find()
                ->join('LEFT JOIN','vt_help_center_category_translation v', 'vt_help_center_category.id = v.id')
                ->where([
                    'slug' => $slug,

                ]);
            $query  ->orderBy('order_number ASC');
            $query -> addOrderBy('v.name ASC');
            $data= $query->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }
}