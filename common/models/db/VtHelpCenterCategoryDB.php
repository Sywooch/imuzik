<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_help_center_category".
 *
 * @property string $id
 * @property integer $is_active
 * @property string $parent_id
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $order_number
 *
 * @property VtHelpCenterDB[] $vtHelpCenters
 * @property SfGuardUserDB $createdBy
 * @property SfGuardUserDB $updatedBy
 * @property VtHelpCenterCategoryTranslationDB[] $vtHelpCenterCategoryTranslations
 */
class VtHelpCenterCategoryDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_help_center_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'parent_id', 'created_by', 'updated_by', 'order_number'], 'integer'],
            [['parent_id', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'parent_id' => Yii::t('backend', 'Parent ID'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'order_number' => Yii::t('backend', 'Order Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtHelpCenters()
    {
        return $this->hasMany(VtHelpCenterDB::className(), ['help_center_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(SfGuardUserDB::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(SfGuardUserDB::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtHelpCenterCategoryTranslations()
    {
        return $this->hasMany(VtHelpCenterCategoryTranslationDB::className(), ['id' => 'id']);
    }
}
