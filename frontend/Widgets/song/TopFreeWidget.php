<?php

namespace frontend\Widgets\song;

use yii\base\Widget;

class TopFreeWidget extends Widget {

    public function run() {
        $topFree = \frontend\models\VtRingBackTone::getTopFree();
        return $this->render('/song/_top_free', [
                    'data' => $topFree['list'],
        ]);
    }

}

?>