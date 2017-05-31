<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property integer $is_active
 * @property string $image_path
 * @property string $priority
 * @property string $listen_number
 * @property string $like_number
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_hot
 *
 * @property TopicSongDB[] $topicSongs
 * @property VtSongDB[] $songs
 */
class TopicDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_active', 'priority', 'listen_number', 'like_number', 'is_hot'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'image_path'], 'string', 'max' => 255]
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
            'slug' => Yii::t('backend', 'Slug'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'priority' => Yii::t('backend', 'Priority'),
            'listen_number' => Yii::t('backend', 'Listen Number'),
            'like_number' => Yii::t('backend', 'Like Number'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'is_hot' => Yii::t('backend', 'Is Hot'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopicSongs()
    {
        return $this->hasMany(TopicSongDB::className(), ['topic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSongs()
    {
        return $this->hasMany(VtSongDB::className(), ['id' => 'song_id'])->viaTable('topic_song', ['topic_id' => 'id']);
    }
}
