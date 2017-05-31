<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_favourite_song_join".
 *
 * @property string $id
 * @property string $member_id
 * @property string $song_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property VtMemberDB $member
 * @property VtSongDB $song
 */
class VtFavouriteSongJoinDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_favourite_song_join';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'song_id'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'member_id' => Yii::t('backend', 'Member ID'),
            'song_id' => Yii::t('backend', 'Song ID'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(VtMemberDB::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong()
    {
        return $this->hasOne(VtSongDB::className(), ['id' => 'song_id']);
    }
}
