 <?php
    if (sizeof($listSongTopic)) {
        foreach ($listSongTopic as $item) {
            echo $this->render('/song/_item_wide', ['item' => $item]);
         }
        if ($page< ceil($pages->totalCount/song_page_limit) ){?>
            <div class="load-more">
                <a class="jscroll-next-default" href="/chu-de/<?php echo yii\helpers\Html::encode($slug) ?>?page=<?php $page++; echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
            </div>
        <?php } ?>
    <?php } ?>

