<?php

namespace frontend\Widgets\song;

use yii\base\Widget;

class DailyListenWidget extends Widget {

    public $limit = 3;

    public function run() {
        $dailyListen = \frontend\models\DailyListen::getAll($this->limit);
        if (sizeof($dailyListen['list'])) {
            return $this->render('/song/_dailyListen', [
                        'data' => $dailyListen['list'],
            ]);
        }
    }

}

?>