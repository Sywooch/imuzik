<?php

namespace frontend\Widgets\song;

use yii\base\Widget;

class WithTheCatWidget extends Widget {

    public $cats;
    public $song_id;
    public $classs = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';

    public function run() {
        foreach ($this->cats as $item) {
            $ids[] = intval($item->id);
        }
        $data = \frontend\models\VtSong::getListByCat($ids, $this->song_id);
        return $this->render('/song/_cung_the_loai', [
                    'data' => $data['list'],
                    'song_id' => $this->song_id,
                    'class' => $this->classs
        ]);
    }

}

?>