<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_song_rank_table".
 *
 * @property string $id
 * @property string $song_id
 * @property integer $ranktable_id
 * @property string $vote_times
 * @property string $fake_vote_times
 * @property integer $last_rank
 * @property string $image_path
 * @property string $tone_code
 *
 * @property VtSongDB $song
 */
class VtSongRankTableDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_song_rank_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['song_id', 'ranktable_id', 'vote_times', 'fake_vote_times', 'last_rank'], 'integer'],
            [['ranktable_id'], 'required'],
            [['image_path', 'tone_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'song_id' => Yii::t('backend', 'Song ID'),
            'ranktable_id' => Yii::t('backend', 'Ranktable ID'),
            'vote_times' => Yii::t('backend', 'Vote Times'),
            'fake_vote_times' => Yii::t('backend', 'Fake Vote Times'),
            'last_rank' => Yii::t('backend', 'Last Rank'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'tone_code' => Yii::t('backend', 'Tone Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong()
    {
        return $this->hasOne(VtSongDB::className(), ['id' => 'song_id']);
    }
}
