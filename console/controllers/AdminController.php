<?php

namespace console\controllers;

use common\models\VtSongBase;
use yii\console\Controller;

class AdminController extends Controller {

    public function actionSong() {
        $offset = 0;
        $limit = 1000;
        $songModel = new VtSongBase();
        $allRecord = $songModel->find()->count();
        while ($offset < $allRecord) {
            $songs = VtSongBase::find()
                    ->where(['status' => song_active])
                    ->offset($offset)
                    ->limit($limit)
                    ->all();
            foreach ($songs as $item) {
                $singers = $item->singers;
                $singerList = [];
                $imagePath = '';
                if ($singers) {
                    foreach ($singers as $singer) {
                        $temp['id'] = $singer->id;
                        $temp['name'] = $singer->name;
                        $temp['alias'] = $singer->alias;
                        $temp['slug'] = $singer->slug;
                        $temp['image_path'] = $singer->image_path;
                        if (self::checkImageUrl($singer->image_path)) {
                            $imagePath = $singer->image_path;
                        } else {
                            $imagePath = self::getImageUrl($singers);
                        }
                        $singerList[] = $temp;
                    }
                }
                $item->singer_list = json_encode($singerList);
                $item->image_path = $imagePath;
                $item->save(false);

                echo $imagePath . "\n";
            }
            $offset+= $limit;
            echo "\n offset: $offset Syn Song singer_list done: " . date('Y-m-d H:i:s');
        }
    }

    public static function getImageUrl($singers) {
        foreach ($singers as $singer) {
            if (self::checkImageUrl($singer->image_path)) {
                return $singer->image_path;
            }
        }
        return '';
    }

    public static function checkImageUrl($url) {
        if (strpos($url, '.jpg')) {
            return true;
        }
        return false;
    }

}
