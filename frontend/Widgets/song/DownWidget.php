<?php

namespace frontend\Widgets\song;

use yii\base\Widget;

class DownWidget extends Widget {

    public $show_free = false;
    public $number_limit = 8;

    public function run() {
        $topFree = null;
        $topDownW = \frontend\models\VtRingBackTone::getTopDownWeek();
        $topDownM = \frontend\models\VtRingBackTone::getTopDownMonth();
        $topDownAll = \frontend\models\VtRingBackTone::getDownAll();
        if ($this->show_free) {
            $topFree = \frontend\models\VtRingBackTone::getTopFree();
        }
        return $this->render('/song/_download', [
                    'topDownW' => $topDownW['list'],
                    'topDownM' => $topDownM['list'],
                    'topDownAll' => $topDownAll['list'],
                    'topFree' => $topFree['list'],
                    'number_limit' => $this->number_limit,
        ]);
    }

}

?>