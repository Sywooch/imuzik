<?php

namespace frontend\Widgets\song;

use yii\base\Widget;

class AudioWidget extends Widget {

    public $file;

    public function run() {
        return $this->render('/song/_audio', [
                    'file' => media_link . $this->file,
        ]);
    }

}

?>