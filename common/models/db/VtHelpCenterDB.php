<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_help_center".
 *
 * @property string $id
 * @property integer $is_active
 * @property string $help_center_category_id
 * @property string $order_number
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property VtHelpCenterCategoryDB $helpCenterCategory
 * @property SfGuardUserDB $createdBy
 * @property SfGuardUserDB $updatedBy
 * @property VtHelpCenterTranslationDB[] $vtHelpCenterTranslations
 */
class VtHelpCenterDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_help_center';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'help_center_category_id', 'order_number', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
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
            'help_center_category_id' => Yii::t('backend', 'Help Center Category ID'),
            'order_number' => Yii::t('backend', 'Order Number'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHelpCenterCategory()
    {
        return $this->hasOne(VtHelpCenterCategoryDB::className(), ['id' => 'help_center_category_id']);
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
    public function getVtHelpCenterTranslations()
    {
        return $this->hasMany(VtHelpCenterTranslationDB::className(), ['id' => 'id']);
    }
}
