<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_member".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $fullname
 * @property string $email
 * @property string $phonenumber
 * @property string $birthday
 * @property integer $sex
 * @property integer $actived
 * @property integer $locked
 * @property string $province_id
 * @property string $credit
 * @property string $image_path
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_first_login
 * @property string $avatar_image
 * @property string $address
 *
 * @property VtFavouriteRbtJoinDB[] $vtFavouriteRbtJoins
 * @property VtFavouriteSongJoinDB[] $vtFavouriteSongJoins
 * @property VtFavouriteVideoJoinDB[] $vtFavouriteVideoJoins
 * @property VtSingerFanDB[] $vtSingerFans
 * @property VtSingerDB[] $singers
 */
class VtMemberDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'created_at', 'updated_at'], 'required'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['sex', 'actived', 'locked', 'province_id', 'credit', 'is_first_login'], 'integer'],
            [['username', 'password', 'fullname', 'email', 'image_path', 'avatar_image', 'address'], 'string', 'max' => 255],
            [['phonenumber'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['phonenumber'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'username' => Yii::t('backend', 'Username'),
            'password' => Yii::t('backend', 'Password'),
            'fullname' => Yii::t('backend', 'Fullname'),
            'email' => Yii::t('backend', 'Email'),
            'phonenumber' => Yii::t('backend', 'Phonenumber'),
            'birthday' => Yii::t('backend', 'Birthday'),
            'sex' => Yii::t('backend', 'Sex'),
            'actived' => Yii::t('backend', 'Actived'),
            'locked' => Yii::t('backend', 'Locked'),
            'province_id' => Yii::t('backend', 'Province ID'),
            'credit' => Yii::t('backend', 'Credit'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'is_first_login' => Yii::t('backend', 'Is First Login'),
            'avatar_image' => Yii::t('backend', 'Avatar Image'),
            'address' => Yii::t('backend', 'Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteRbtJoins()
    {
        return $this->hasMany(VtFavouriteRbtJoinDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteSongJoins()
    {
        return $this->hasMany(VtFavouriteSongJoinDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteVideoJoins()
    {
        return $this->hasMany(VtFavouriteVideoJoinDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSingerFans()
    {
        return $this->hasMany(VtSingerFanDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingers()
    {
        return $this->hasMany(VtSingerDB::className(), ['id' => 'singer_id'])->viaTable('vt_singer_fan', ['member_id' => 'id']);
    }
}
