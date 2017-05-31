<?php

namespace common\models;

use Yii;

class VtFavouriteSongJoinBase extends \common\models\db\VtFavouriteSongJoinDB {
    
    public function getSong()
    {
        return $this->hasOne(VtSongBase::className(), ['id' => 'song_id'])->andWhere(['vt_song.status' => song_active]);
    }

    public static function getListSongID($memberId,$limit=15) {

        $query = VtFavouriteSongJoinBase::find()->innerJoin('vt_member', 'vt_favourite_song_join.member_id=vt_member.id');
        $query->andWhere(['vt_favourite_song_join.member_id' => $memberId]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [ 'updated_at' => SORT_ASC]],
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);
        $data = ['list' => $dataProvider->getModels(), 'total' => $dataProvider->getTotalCount()];
        return $data;
    }

}
