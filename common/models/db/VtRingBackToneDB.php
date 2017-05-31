<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_ring_back_tone".
 *
 * @property string $id
 * @property string $huawei_tone_name
 * @property string $huawei_cp_id
 * @property string $huawei_price
 * @property string $huawei_tone_id
 * @property string $huawei_tone_code
 * @property string $huawei_tone_address
 * @property string $huawei_available_datetime
 * @property string $huawei_order_times
 * @property string $huawei_singer_name
 * @property integer $huawei_status
 * @property integer $vt_status
 * @property string $vt_order_time
 * @property string $vt_present_time
 * @property integer $vt_is_downloaded
 * @property integer $vt_is_converted
 * @property string $vt_link
 * @property string $vt_song_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $huawei_lastsync
 * @property integer $vt_attr
 * @property string $listen_number
 * @property string $like_number
 *
 * @property VtFavouriteRbtJoinDB[] $vtFavouriteRbtJoins
 * @property VtSongDB $vtSong
 * @property VtVideoRbtJoinDB[] $vtVideoRbtJoins
 * @property VtVideoDB[] $videos
 */
class VtRingBackToneDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_ring_back_tone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['huawei_tone_name', 'huawei_cp_id', 'huawei_price', 'huawei_tone_id', 'huawei_tone_code', 'huawei_order_times', 'huawei_singer_name', 'huawei_status', 'created_at', 'updated_at'], 'required'],
            [['huawei_cp_id', 'huawei_price', 'huawei_tone_id', 'huawei_order_times', 'huawei_status', 'vt_status', 'vt_order_time', 'vt_present_time', 'vt_is_downloaded', 'vt_is_converted', 'vt_song_id', 'vt_attr', 'listen_number', 'like_number'], 'integer'],
            [['huawei_available_datetime', 'created_at', 'updated_at', 'huawei_lastsync'], 'safe'],
            [['huawei_tone_name', 'huawei_tone_code', 'huawei_tone_address', 'huawei_singer_name', 'vt_link'], 'string', 'max' => 255],
            [['huawei_tone_id'], 'unique'],
            [['huawei_tone_code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'huawei_tone_name' => Yii::t('backend', 'Huawei Tone Name'),
            'huawei_cp_id' => Yii::t('backend', 'Huawei Cp ID'),
            'huawei_price' => Yii::t('backend', 'Huawei Price'),
            'huawei_tone_id' => Yii::t('backend', 'Huawei Tone ID'),
            'huawei_tone_code' => Yii::t('backend', 'Huawei Tone Code'),
            'huawei_tone_address' => Yii::t('backend', 'Huawei Tone Address'),
            'huawei_available_datetime' => Yii::t('backend', 'Huawei Available Datetime'),
            'huawei_order_times' => Yii::t('backend', 'Huawei Order Times'),
            'huawei_singer_name' => Yii::t('backend', 'Huawei Singer Name'),
            'huawei_status' => Yii::t('backend', 'Huawei Status'),
            'vt_status' => Yii::t('backend', 'Vt Status'),
            'vt_order_time' => Yii::t('backend', 'Vt Order Time'),
            'vt_present_time' => Yii::t('backend', 'Vt Present Time'),
            'vt_is_downloaded' => Yii::t('backend', 'Vt Is Downloaded'),
            'vt_is_converted' => Yii::t('backend', 'Vt Is Converted'),
            'vt_link' => Yii::t('backend', 'Vt Link'),
            'vt_song_id' => Yii::t('backend', 'Vt Song ID'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'huawei_lastsync' => Yii::t('backend', 'Huawei Lastsync'),
            'vt_attr' => Yii::t('backend', 'Vt Attr'),
            'listen_number' => Yii::t('backend', 'Listen Number'),
            'like_number' => Yii::t('backend', 'Like Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteRbtJoins()
    {
        return $this->hasMany(VtFavouriteRbtJoinDB::className(), ['rbt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtVideoRbtJoins()
    {
        return $this->hasMany(VtVideoRbtJoinDB::className(), ['rbt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(VtVideoDB::className(), ['id' => 'video_id'])->viaTable('vt_video_rbt_join', ['rbt_id' => 'id']);
    }
}
