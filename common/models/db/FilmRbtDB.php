<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "film_rbt".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $image_path
 * @property integer $is_hot
 * @property integer $is_active
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $slug
 *
 * @property VtSongDB[] $vtSongs
 */
class FilmRbtDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'film_rbt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'image_path', 'slug'], 'required'],
            [['description'], 'string'],
            [['is_hot', 'is_active', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image_path', 'slug'], 'string', 'max' => 255],
            [['name', 'slug'], 'unique', 'targetAttribute' => ['name', 'slug'], 'message' => 'The combination of Name and Slug has already been taken.']
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
            'description' => Yii::t('backend', 'Description'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'is_hot' => Yii::t('backend', 'Is Hot'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'slug' => Yii::t('backend', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSongs()
    {
        return $this->hasMany(VtSongDB::className(), ['film_id' => 'id']);
    }
}
