<?php

namespace frontend\Widgets\user;

use yii\base\Widget;

class AvatarWidget extends Widget {

    public function run() {
        if (\Yii::$app->devicedetect->isDescktop()) {
            return $this->render('/account/_account_header', [
                        'model' => \Yii::$app->user->identity,
            ]);
        }
    }

}

?>