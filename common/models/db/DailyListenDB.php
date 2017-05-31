<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "daily_listen".
 *
 * @property string $id
 * @property string $song_id
 * @property string $created_at
 * @property string $created_by
 * @property string $priority
 *
 * @property VtSongDB $song
 */
class DailyListenDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daily_listen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['song_id', 'created_by', 'priority'], 'integer'],
            [['created_at'], 'safe']
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
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'priority' => Yii::t('backend', 'Priority'),
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
