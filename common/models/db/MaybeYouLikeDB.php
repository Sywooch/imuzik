<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "maybe_you_like".
 *
 * @property string $id
 * @property string $song_id
 * @property string $priority
 * @property string $created_at
 * @property string $created_by
 *
 * @property VtSongDB $song
 */
class MaybeYouLikeDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maybe_you_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['song_id', 'priority', 'created_by'], 'integer'],
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
            'priority' => Yii::t('backend', 'Priority'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
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
