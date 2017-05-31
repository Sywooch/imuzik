<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_help_center_translation".
 *
 * @property string $id
 * @property string $title
 * @property string $body
 * @property string $lang
 *
 * @property VtHelpCenterDB $id0
 */
class VtHelpCenterTranslationDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_help_center_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'body', 'lang'], 'required'],
            [['id'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'title' => Yii::t('backend', 'Title'),
            'body' => Yii::t('backend', 'Body'),
            'lang' => Yii::t('backend', 'Lang'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(VtHelpCenterDB::className(), ['id' => 'id']);
    }
}
