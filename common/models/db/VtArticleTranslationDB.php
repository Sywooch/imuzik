<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_article_translation".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $body
 * @property string $lang
 * @property string $slug
 *
 * @property VtArticleDB $id0
 */
class VtArticleTranslationDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_article_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'lang'], 'required'],
            [['id'], 'integer'],
            [['description', 'body'], 'string'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 2],
            [['slug', 'title', 'lang'], 'unique', 'targetAttribute' => ['slug', 'title', 'lang'], 'message' => 'The combination of Title, Lang and Slug has already been taken.']
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
            'description' => Yii::t('backend', 'Description'),
            'body' => Yii::t('backend', 'Body'),
            'lang' => Yii::t('backend', 'Lang'),
            'slug' => Yii::t('backend', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(VtArticleDB::className(), ['id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtArticle()
    {
        return $this->hasOne(VtArticleDB::className(), ['id' => 'id']);
    }
}
