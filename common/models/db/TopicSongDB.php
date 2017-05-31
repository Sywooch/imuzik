<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "topic_song".
 *
 * @property string $topic_id
 * @property string $song_id
 * @property string $priority
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TopicDB $topic
 * @property VtSongDB $song
 */
class TopicSongDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic_song';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id', 'song_id'], 'required'],
            [['topic_id', 'song_id', 'priority'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic_id' => Yii::t('backend', 'Topic ID'),
            'song_id' => Yii::t('backend', 'Song ID'),
            'priority' => Yii::t('backend', 'Priority'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(TopicDB::className(), ['id' => 'topic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong()
    {
        return $this->hasOne(VtSongDB::className(), ['id' => 'song_id']);
    }
}
