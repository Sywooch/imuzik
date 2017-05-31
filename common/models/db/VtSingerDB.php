<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_singer".
 *
 * @property string $id
 * @property string $alias
 * @property string $name
 * @property string $image_path
 * @property integer $is_active
 * @property string $birthday
 * @property integer $attr
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $slug
 * @property integer $is_keeng
 * @property string $keeng_image_path
 * @property string $big_image_path
 * @property integer $fan_number
 * @property integer $service_status
 * @property integer $is_show_big_image
 *
 * @property VtAlbumSingerJoinDB[] $vtAlbumSingerJoins
 * @property VtAlbumDB[] $albums
 * @property VtComposerDB[] $vtComposers
 * @property SfGuardUserDB $createdBy
 * @property SfGuardUserDB $updatedBy
 * @property VtSingerAttrDB[] $vtSingerAttrs
 * @property VtSingerFanDB[] $vtSingerFans
 * @property VtMemberDB[] $members
 * @property VtSingerGenreJoinDB[] $vtSingerGenreJoins
 * @property VtMusicGenreDB[] $musicGenres
 * @property VtSingerTranslationDB[] $vtSingerTranslations
 * @property VtSongSingerJoinDB[] $vtSongSingerJoins
 * @property VtSongDB[] $songs
 * @property VtVideoSingerJoinDB[] $vtVideoSingerJoins
 * @property VtVideoDB[] $videos
 */
class VtSingerDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_singer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'created_at', 'updated_at', 'service_status'], 'required'],
            [['is_active', 'attr', 'created_by', 'updated_by', 'is_keeng', 'fan_number', 'service_status', 'is_show_big_image'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['alias', 'name', 'image_path', 'birthday', 'slug', 'keeng_image_path', 'big_image_path'], 'string', 'max' => 255],
            [['slug', 'alias'], 'unique', 'targetAttribute' => ['slug', 'alias'], 'message' => 'The combination of Alias and Slug has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'alias' => Yii::t('backend', 'Alias'),
            'name' => Yii::t('backend', 'Name'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'birthday' => Yii::t('backend', 'Birthday'),
            'attr' => Yii::t('backend', 'Attr'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'slug' => Yii::t('backend', 'Slug'),
            'is_keeng' => Yii::t('backend', 'Is Keeng'),
            'keeng_image_path' => Yii::t('backend', 'Keeng Image Path'),
            'big_image_path' => Yii::t('backend', 'Big Image Path'),
            'fan_number' => Yii::t('backend', 'Fan Number'),
            'service_status' => Yii::t('backend', 'Service Status'),
            'is_show_big_image' => Yii::t('backend', 'Is Show Big Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtAlbumSingerJoins()
    {
        return $this->hasMany(VtAlbumSingerJoinDB::className(), ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(VtAlbumDB::className(), ['id' => 'album_id'])->viaTable('vt_album_singer_join', ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtComposers()
    {
        return $this->hasMany(VtComposerDB::className(), ['singer_id' => 'id']);
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
    public function getVtSingerAttrs()
    {
        return $this->hasMany(VtSingerAttrDB::className(), ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSingerFans()
    {
        return $this->hasMany(VtSingerFanDB::className(), ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(VtMemberDB::className(), ['id' => 'member_id'])->viaTable('vt_singer_fan', ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSingerGenreJoins()
    {
        return $this->hasMany(VtSingerGenreJoinDB::className(), ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusicGenres()
    {
        return $this->hasMany(VtMusicGenreDB::className(), ['id' => 'music_genre_id'])->viaTable('vt_singer_genre_join', ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSingerTranslations()
    {
        return $this->hasMany(VtSingerTranslationDB::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongSingerJoins()
    {
        return $this->hasMany(VtSongSingerJoinDB::className(), ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSongs()
    {
        return $this->hasMany(VtSongDB::className(), ['id' => 'song_id'])->viaTable('vt_song_singer_join', ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtVideoSingerJoins()
    {
        return $this->hasMany(VtVideoSingerJoinDB::className(), ['singer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(VtVideoDB::className(), ['id' => 'video_id'])->viaTable('vt_video_singer_join', ['singer_id' => 'id']);
    }
}
