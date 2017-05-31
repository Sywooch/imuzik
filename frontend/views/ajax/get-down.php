<?php

$count = 1;
foreach ($data as $item) {
    if ($count <= number_limit) {
        if ($item->song) {
            echo $this->render('/rank/_item', ['item' => $item->song, 'index' => '0' . $count]);
            $count++;
        }
    }
}
?>