 <?php
 if (sizeof($listSongYouLiked)) {
     foreach ($listSongYouLiked as $item) {
         echo $this->render('/song/_item_wide', ['item' => $item]);
     } ?>
     <?php  if ($page < ceil($pages->totalCount/song_page_limit) ){?>
         <div class="load-more">
             <a class="jscroll-next-default" href="/danh-sach-yeu-thich<?php $page++;?>?page=<?php  echo $page ;?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
         </div>
     <?php } ?>
 <?php } ?>

