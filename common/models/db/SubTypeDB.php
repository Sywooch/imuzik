<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sub_type".
 *
 * @property string $id
 * @property string $name
 * @property string $price
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $active
 * @property integer $duration
 * @property integer $type
 * @property string $cmd
 * @property string $content
 *
 * @property SubscriberDB[] $subscribers
 */
class SubTypeDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['active', 'duration', 'type'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 10],
            [['cmd'], 'string', 'max' => 50],
            [['content'], 'string', 'max' => 200]
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
            'price' => Yii::t('backend', 'Price'),
            'description' => Yii::t('backend', 'Description'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'active' => Yii::t('backend', 'Active'),
            'duration' => Yii::t('backend', 'Duration'),
            'type' => Yii::t('backend', 'Type'),
            'cmd' => Yii::t('backend', 'Cmd'),
            'content' => Yii::t('backend', 'Content'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscribers()
    {
        return $this->hasMany(SubscriberDB::className(), ['sub_type_id' => 'id']);
    }
}
