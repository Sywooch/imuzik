<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_banner".
 *
 * @property integer $id
 * @property integer $width
 * @property integer $height
 * @property integer $is_slide
 * @property integer $is_active
 * @property integer $max_items
 * @property string $style
 * @property string $created_at
 * @property string $updated_at
 * @property string $image_path
 *
 * @property VtBannerItemDB[] $vtBannerItems
 * @property VtBannerTranslationDB $vtBannerTranslation
 */
class VtBannerDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['width', 'height', 'is_slide', 'is_active', 'max_items'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['style', 'image_path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'width' => Yii::t('backend', 'Width'),
            'height' => Yii::t('backend', 'Height'),
            'is_slide' => Yii::t('backend', 'Is Slide'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'max_items' => Yii::t('backend', 'Max Items'),
            'style' => Yii::t('backend', 'Style'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'image_path' => Yii::t('backend', 'Image Path'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtBannerItems()
    {
        return $this->hasMany(VtBannerItemDB::className(), ['banner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtBannerTranslation()
    {
        return $this->hasOne(VtBannerTranslationDB::className(), ['id' => 'id']);
    }
}
