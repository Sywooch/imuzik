<?php

namespace frontend\Widgets\song;

use yii\base\Widget;

class WithTheSingerWidget extends Widget {

    public $song;
    public $classs = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';

    public function run() {
        $ids = [];
        $singers = ($this->song->singer_list) ? json_decode($this->song->singer_list) : $this->song->singers;
        foreach ($singers as $item) {
            $ids[] = intval($item->id);
        }
        $data = \frontend\models\VtSong::getListBySinger($ids, $this->song->id);
        return $this->render('/song/_with_singer', [
                    'data' => $data['list'],
                    'song_id' => $this->song->id,
                    'song_slug' => $this->song->slug,
                    'class' => $this->classs
        ]);
    }

}

?>