<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_music_genre".
 *
 * @property string $id
 * @property string $name
 * @property integer $is_active
 * @property string $parent_id
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $slug
 * @property string $regions
 * @property string $image_path
 * @property integer $is_hot
 *
 * @property VtAlbumGenreJoinDB[] $vtAlbumGenreJoins
 * @property VtAlbumDB[] $albums
 * @property SfGuardUserDB $createdBy
 * @property SfGuardUserDB $updatedBy
 * @property VtMusicGenreJoinDB[] $vtMusicGenreJoins
 * @property VtSongDB[] $songs
 * @property VtSingerGenreJoinDB[] $vtSingerGenreJoins
 * @property VtSingerDB[] $singers
 * @property VtSongGenreJoinDB[] $vtSongGenreJoins
 * @property VtVideoGenreJoinDB[] $vtVideoGenreJoins
 * @property VtVideoDB[] $videos
 */
class VtMusicGenreDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_music_genre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['is_active', 'parent_id', 'created_by', 'updated_by', 'is_hot'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'regions', 'image_path'], 'string', 'max' => 255],
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
            'is_active' => Yii::t('backend', 'Is Active'),
            'parent_id' => Yii::t('backend', 'Parent ID'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'slug' => Yii::t('backend', 'Slug'),
            'regions' => Yii::t('backend', 'Regions'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'is_hot' => Yii::t('backend', 'Is Hot'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtAlbumGenreJoins()
    {
        return $this->hasMany(VtAlbumGenreJoinDB::className(), ['music_genre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(VtAlbumDB::className(), ['id' => 'album_id'])->viaTable('vt_album_genre_join', ['music_genre_id' => 'id']);
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
    public function getVtMusicGenreJoins()
    {
        return $this->hasMany(VtMusicGenreJoinDB::className(), ['music_genre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSongs()
    {
        return $this->hasMany(VtSongDB::className(), ['id' => 'song_id'])->viaTable('vt_song_genre_join', ['music_genre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSingerGenreJoins()
    {
        return $this->hasMany(VtSingerGenreJoinDB::className(), ['music_genre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingers()
    {
        return $this->hasMany(VtSingerDB::className(), ['id' => 'singer_id'])->viaTable('vt_singer_genre_join', ['music_genre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongGenreJoins()
    {
        return $this->hasMany(VtSongGenreJoinDB::className(), ['music_genre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtVideoGenreJoins()
    {
        return $this->hasMany(VtVideoGenreJoinDB::className(), ['genre_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(VtVideoDB::className(), ['id' => 'video_id'])->viaTable('vt_video_genre_join', ['genre_id' => 'id']);
    }
}
