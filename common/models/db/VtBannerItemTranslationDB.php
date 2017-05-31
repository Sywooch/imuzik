<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_banner_item_translation".
 *
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $alter_text
 * @property string $lang
 *
 * @property VtBannerItemDB $id0
 */
class VtBannerItemTranslationDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_banner_item_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name', 'link', 'alter_text'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 2]
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
            'link' => Yii::t('backend', 'Link'),
            'alter_text' => Yii::t('backend', 'Alter Text'),
            'lang' => Yii::t('backend', 'Lang'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(VtBannerItemDB::className(), ['id' => 'id']);
    }
}
