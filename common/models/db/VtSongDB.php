<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_song".
 *
 * @property string $id
 * @property string $name
 * @property string $ims_id
 * @property string $ims_name
 * @property string $file_path
 * @property integer $status
 * @property integer $type
 * @property integer $attr
 * @property string $view_number
 * @property string $download_number
 * @property string $caption
 * @property string $lyric
 * @property string $lyric_id
 * @property string $lyric_username
 * @property integer $is_lyric_full
 * @property string $rbt_tone_ids
 * @property string $ringtone_ids
 * @property string $mp_ids
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $slug
 * @property integer $is_keeng
 * @property string $keeng_file_path
 * @property string $singer_list
 * @property string $film_id
 * @property string $image_path
 *
 * @property DailyListenDB[] $dailyListens
 * @property MaybeYouLikeDB[] $maybeYouLikes
 * @property TopicSongDB[] $topicSongs
 * @property TopicDB[] $topics
 * @property VtFavouriteSongJoinDB[] $vtFavouriteSongJoins
 * @property VtMusicGenreJoinDB[] $vtMusicGenreJoins
 * @property VtMusicGenreDB[] $musicGenres
 * @property VtMusicSubjectJoinDB[] $vtMusicSubjectJoins
 * @property VtMusicSubjectDB[] $musicSubjects
 * @property VtRingBackToneDB[] $vtRingBackTones
 * @property VtRingtoneDB[] $vtRingtones
 * @property SfGuardUserDB $createdBy
 * @property FilmRbtDB $film
 * @property SfGuardUserDB $updatedBy
 * @property VtSongAlbumJoinDB[] $vtSongAlbumJoins
 * @property VtAlbumDB[] $albums
 * @property VtSongComposerJoinDB[] $vtSongComposerJoins
 * @property VtComposerDB[] $composers
 * @property VtSongGenreJoinDB[] $vtSongGenreJoins
 * @property VtSongRankTableDB[] $vtSongRankTables
 * @property VtSongSingerJoinDB[] $vtSongSingerJoins
 * @property VtSingerDB[] $singers
 * @property VtVideoDB[] $vtVideos
 */
class VtSongDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_song';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'file_path', 'created_at', 'updated_at'], 'required'],
            [['ims_id', 'status', 'type', 'attr', 'view_number', 'download_number', 'lyric_id', 'is_lyric_full', 'created_by', 'updated_by', 'is_keeng', 'film_id'], 'integer'],
            [['lyric', 'rbt_tone_ids', 'ringtone_ids', 'mp_ids', 'singer_list'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'ims_name', 'file_path', 'caption', 'lyric_username', 'slug', 'keeng_file_path', 'image_path'], 'string', 'max' => 255],
            [['slug', 'name'], 'unique', 'targetAttribute' => ['slug', 'name'], 'message' => 'The combination of Name and Slug has already been taken.']
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
            'ims_id' => Yii::t('backend', 'Ims ID'),
            'ims_name' => Yii::t('backend', 'Ims Name'),
            'file_path' => Yii::t('backend', 'File Path'),
            'status' => Yii::t('backend', 'Status'),
            'type' => Yii::t('backend', 'Type'),
            'attr' => Yii::t('backend', 'Attr'),
            'view_number' => Yii::t('backend', 'View Number'),
            'download_number' => Yii::t('backend', 'Download Number'),
            'caption' => Yii::t('backend', 'Caption'),
            'lyric' => Yii::t('backend', 'Lyric'),
            'lyric_id' => Yii::t('backend', 'Lyric ID'),
            'lyric_username' => Yii::t('backend', 'Lyric Username'),
            'is_lyric_full' => Yii::t('backend', 'Is Lyric Full'),
            'rbt_tone_ids' => Yii::t('backend', 'Rbt Tone Ids'),
            'ringtone_ids' => Yii::t('backend', 'Ringtone Ids'),
            'mp_ids' => Yii::t('backend', 'Mp Ids'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'slug' => Yii::t('backend', 'Slug'),
            'is_keeng' => Yii::t('backend', 'Is Keeng'),
            'keeng_file_path' => Yii::t('backend', 'Keeng File Path'),
            'singer_list' => Yii::t('backend', 'Singer List'),
            'film_id' => Yii::t('backend', 'Film ID'),
            'image_path' => Yii::t('backend', 'Image Path'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDailyListens()
    {
        return $this->hasMany(DailyListenDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaybeYouLikes()
    {
        return $this->hasMany(MaybeYouLikeDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopicSongs()
    {
        return $this->hasMany(TopicSongDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(TopicDB::className(), ['id' => 'topic_id'])->viaTable('topic_song', ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteSongJoins()
    {
        return $this->hasMany(VtFavouriteSongJoinDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtMusicGenreJoins()
    {
        return $this->hasMany(VtMusicGenreJoinDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusicGenres()
    {
        return $this->hasMany(VtMusicGenreDB::className(), ['id' => 'music_genre_id'])->viaTable('vt_song_genre_join', ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtMusicSubjectJoins()
    {
        return $this->hasMany(VtMusicSubjectJoinDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusicSubjects()
    {
        return $this->hasMany(VtMusicSubjectDB::className(), ['id' => 'music_subject_id'])->viaTable('vt_music_subject_join', ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtRingBackTones()
    {
        return $this->hasMany(VtRingBackToneDB::className(), ['vt_song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtRingtones()
    {
        return $this->hasMany(VtRingtoneDB::className(), ['song_id' => 'id']);
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
    public function getFilm()
    {
        return $this->hasOne(FilmRbtDB::className(), ['id' => 'film_id']);
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
    public function getVtSongAlbumJoins()
    {
        return $this->hasMany(VtSongAlbumJoinDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(VtAlbumDB::className(), ['id' => 'album_id'])->viaTable('vt_song_album_join', ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongComposerJoins()
    {
        return $this->hasMany(VtSongComposerJoinDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComposers()
    {
        return $this->hasMany(VtComposerDB::className(), ['id' => 'composer_id'])->viaTable('vt_song_composer_join', ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongGenreJoins()
    {
        return $this->hasMany(VtSongGenreJoinDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongRankTables()
    {
        return $this->hasMany(VtSongRankTableDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongSingerJoins()
    {
        return $this->hasMany(VtSongSingerJoinDB::className(), ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingers()
    {
        return $this->hasMany(VtSingerDB::className(), ['id' => 'singer_id'])->viaTable('vt_song_singer_join', ['song_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtVideos()
    {
        return $this->hasMany(VtVideoDB::className(), ['song_id' => 'id']);
    }
}
