<?php

namespace frontend\Widgets\song;

use yii\base\Widget;

class MayBeYouLikeWidget extends Widget {

    public $more = false;

    public function run() {
        $mayBeYouLike = \frontend\models\MaybeYouLike::getAll();
        if (sizeof($mayBeYouLike['list'])) {
            return $this->render('/song/may-be-you-like', [
                        'data' => $mayBeYouLike['list'],
                        'more' => $this->more
            ]);
        }
    }

}

?>