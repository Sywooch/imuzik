<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_article".
 *
 * @property string $id
 * @property string $image_path
 * @property integer $status
 * @property integer $attr
 * @property integer $type
 * @property string $published_time
 * @property string $view_number
 * @property string $inner_related_article
 * @property string $outer_related_article
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SfGuardUserDB $createdBy
 * @property SfGuardUserDB $updatedBy
 * @property VtArticleTranslationDB[] $vtArticleTranslations
 */
class VtArticleDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'attr', 'type', 'view_number', 'created_by', 'updated_by'], 'integer'],
            [['published_time', 'created_at', 'updated_at'], 'safe'],
            [['created_at', 'updated_at'], 'required'],
            [['image_path', 'inner_related_article', 'outer_related_article'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'status' => Yii::t('backend', 'Status'),
            'attr' => Yii::t('backend', 'Attr'),
            'type' => Yii::t('backend', 'Type'),
            'published_time' => Yii::t('backend', 'Published Time'),
            'view_number' => Yii::t('backend', 'View Number'),
            'inner_related_article' => Yii::t('backend', 'Inner Related Article'),
            'outer_related_article' => Yii::t('backend', 'Outer Related Article'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
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
    public function getVtArticleTranslations()
    {
        return $this->hasMany(VtArticleTranslationDB::className(), ['id' => 'id']);
    }
}
