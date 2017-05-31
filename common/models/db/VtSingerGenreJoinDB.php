<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_singer_genre_join".
 *
 * @property string $music_genre_id
 * @property string $singer_id
 *
 * @property VtMusicGenreDB $musicGenre
 * @property VtSingerDB $singer
 */
class VtSingerGenreJoinDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_singer_genre_join';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['music_genre_id', 'singer_id'], 'required'],
            [['music_genre_id', 'singer_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'music_genre_id' => Yii::t('backend', 'Music Genre ID'),
            'singer_id' => Yii::t('backend', 'Singer ID'),
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
    public function getSinger()
    {
        return $this->hasOne(VtSingerDB::className(), ['id' => 'singer_id']);
    }
}
