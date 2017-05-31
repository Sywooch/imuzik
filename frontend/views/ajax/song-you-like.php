<?php
if (sizeof($listSongYouLiked)) {
//    var_dump(round($pages->totalCount/song_page_limit));die();
    foreach ($listSongYouLiked as $item) {
        echo $this->render('/song/_item_wide', ['item' => $item]);
    }
   if ($page < ceil($pages->totalCount/song_page_limit) ){?>
    <div class="load-more">
        <a class="jscroll-next-default" href="/bai-hat-ban-thich<?php $page++;?>?page=<?php  echo $page ;?>"><i class="fa fa-angle-down"></i></a>
    </div>
    <?php } ?>
    <?php } ?>

