<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_banner_item".
 *
 * @property integer $id
 * @property integer $banner_id
 * @property integer $is_active
 * @property integer $is_flash
 * @property string $published_time
 * @property string $end_time
 * @property string $file_path
 * @property string $created_at
 * @property string $updated_at
 * @property string $wap_link
 * @property integer $target_type
 * @property integer $target_id
 * @property integer $view
 * @property integer $click
 * @property integer $vtt_click
 * @property integer $vtt_view
 *
 * @property VtBannerDB $banner
 * @property VtBannerItemTranslationDB $vtBannerItemTranslation
 */
class VtBannerItemDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_banner_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner_id', 'is_active', 'is_flash', 'target_type', 'target_id', 'view', 'click', 'vtt_click', 'vtt_view'], 'integer'],
            [['published_time', 'end_time', 'created_at', 'updated_at'], 'safe'],
            [['file_path', 'wap_link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'banner_id' => Yii::t('backend', 'Banner ID'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'is_flash' => Yii::t('backend', 'Is Flash'),
            'published_time' => Yii::t('backend', 'Published Time'),
            'end_time' => Yii::t('backend', 'End Time'),
            'file_path' => Yii::t('backend', 'File Path'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'wap_link' => Yii::t('backend', 'Wap Link'),
            'target_type' => Yii::t('backend', 'Target Type'),
            'target_id' => Yii::t('backend', 'Target ID'),
            'view' => Yii::t('backend', 'View'),
            'click' => Yii::t('backend', 'Click'),
            'vtt_click' => Yii::t('backend', 'Vtt Click'),
            'vtt_view' => Yii::t('backend', 'Vtt View'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(VtBannerDB::className(), ['id' => 'banner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtBannerItemTranslation()
    {
        return $this->hasOne(VtBannerItemTranslationDB::className(), ['id' => 'id']);
    }
}
