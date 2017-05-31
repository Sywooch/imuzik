<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_favourite_rbt_join".
 *
 * @property string $id
 * @property string $rbt_id
 * @property string $member_id
 * @property string $created_at
 *
 * @property VtRingBackToneDB $rbt
 * @property VtMemberDB $member
 */
class VtFavouriteRbtJoinDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_favourite_rbt_join';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rbt_id', 'member_id'], 'required'],
            [['rbt_id', 'member_id'], 'integer'],
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
            'rbt_id' => Yii::t('backend', 'Rbt ID'),
            'member_id' => Yii::t('backend', 'Member ID'),
            'created_at' => Yii::t('backend', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbt()
    {
        return $this->hasOne(VtRingBackToneDB::className(), ['id' => 'rbt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(VtMemberDB::className(), ['id' => 'member_id']);
    }
}
