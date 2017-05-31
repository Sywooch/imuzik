<?php

namespace frontend\Widgets\rank;

use yii\base\Widget;

class RankWidget extends Widget {

    public $scroll = 'scroll-pane';

    public function run() {
        $rankVN = \frontend\models\VtSongRankTable::getAll(1);
        $rankUK = \frontend\models\VtSongRankTable::getAll(2);
        $rankCHAUA = \frontend\models\VtSongRankTable::getAll(3);
        return $this->render('/rank/_home', [
                    'rankVN' => $rankVN['list'],
                    'rankUK' => $rankUK['list'],
                    'rankCHAUA' => $rankCHAUA['list'],
                    'scroll' => $this->scroll
        ]);
    }

}

?>