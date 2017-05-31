<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_song_singer_join".
 *
 * @property string $song_id
 * @property string $singer_id
 *
 * @property VtSingerDB $singer
 * @property VtSongDB $song
 */
class VtSongSingerJoinDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_song_singer_join';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['song_id', 'singer_id'], 'required'],
            [['song_id', 'singer_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'song_id' => Yii::t('backend', 'Song ID'),
            'singer_id' => Yii::t('backend', 'Singer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSinger()
    {
        return $this->hasOne(VtSingerDB::className(), ['id' => 'singer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSong()
    {
        return $this->hasOne(VtSongDB::className(), ['id' => 'song_id']);
    }
}
