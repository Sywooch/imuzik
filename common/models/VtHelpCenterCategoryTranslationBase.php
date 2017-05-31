<?php

namespace common\models;

use frontend\models\VtHelpCenterCategoryTranslation;
use Yii;

class VtHelpCenterCategoryTranslationBase extends \common\models\db\VtHelpCenterCategoryTranslationDB {
//phuonghv2 ham lay danh sach menu
    public static function getCategoryMenuHelper() {
        $cache = \Yii::$app->cache;
        $key = 'VtHelpCenterCategoryTranslation_getCategoryMenuHelper';
        $data = $cache->get($key);
        if (!$data) {
            $query = VtHelpCenterCategoryTranslation::find()
                ->join('INNER JOIN','vt_help_center_category', 'vt_help_center_category.id = vt_help_center_category_translation.id')
                ->where([
                    'vt_help_center_category.is_active' => is_active,
                    'vt_help_center_category_translation.lang'=> "en"
                ]);
            $query->orderBy('vt_help_center_category_translation.name')
            ->addOrderBy('vt_help_center_category.order_number');
            $data= $query->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}