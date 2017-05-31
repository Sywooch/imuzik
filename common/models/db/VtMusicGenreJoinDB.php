<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_music_genre_join".
 *
 * @property string $song_id
 * @property string $music_genre_id
 *
 * @property VtMusicGenreDB $musicGenre
 * @property VtSongDB $song
 */
class VtMusicGenreJoinDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_music_genre_join';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['song_id', 'music_genre_id'], 'required'],
            [['song_id', 'music_genre_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'song_id' => Yii::t('backend', 'Song ID'),
            'music_genre_id' => Yii::t('backend', 'Music Genre ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusicGenre()
    {
        return $this->hasOne(VtMusicGenreDB::className(), ['id' => 'music_genre_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong()
    {
        return $this->hasOne(VtSongDB::className(), ['id' => 'song_id']);
    }
}
