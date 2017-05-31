<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_help_center_category_translation".
 *
 * @property string $id
 * @property string $name
 * @property string $lang
 * @property string $slug
 *
 * @property VtHelpCenterCategoryDB $id0
 */
class VtHelpCenterCategoryTranslationDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_help_center_category_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'lang'], 'required'],
            [['id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 2],
            [['slug', 'name', 'lang'], 'unique', 'targetAttribute' => ['slug', 'name', 'lang'], 'message' => 'The combination of Name, Lang and Slug has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'lang' => Yii::t('backend', 'Lang'),
            'slug' => Yii::t('backend', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(VtHelpCenterCategoryDB::className(), ['id' => 'id']);
    }
}
