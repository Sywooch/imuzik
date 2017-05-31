<?php
        if ($type == 1) {
            foreach ($categoryAreaVN as $item) {
                echo $this->render('/song/_item_wide', ['item' => $item]);
            }
       if ($page< ceil($pages->totalCount/song_page_limit) ){?>
           <div class="load-more">
               <a class="jscroll-next-default" href="/bai-hat-thuoc-the-loai/<?php
               $page++;
               echo yii\helpers\Html::encode($slug);
               ?>?page=<?php echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
           </div>
    <?php } ?>
       <?php echo '</div>'; } elseif ($type == 2) {
            foreach ($categoryAreaSongSlug as $item) {
                echo $this->render('/song/_item_wide', ['item' => $item]);
            }
        if ($page< ceil($pages->totalCount/song_page_limit) ){?>
    <div class="load-more">
            <?php if ($typeName!= null) {?>
                <a class="jscroll-next-default" href="/bai-hat-cung-ca-si/<?php
                $page++;
                echo yii\helpers\Html::encode($slug);
                ?>/<?php echo  2;?>?page=<?php echo $page; ?>"><i class="fa fa-angle-down"></i></a>
            <?php } else {?>
            <a class="jscroll-next-default" href="/the-loai-mobile/<?php ++$page; echo yii\helpers\Html::encode($slug); ?>?page=<?php  echo $page ;?>"><i class="fa fa-angle-down"></i></a>
                <?php } ?>
    </div>
        <?php } ?>
        <?php } elseif ($type == 3) {
            foreach ($categoryAreaSongSlug as $item) {
                echo $this->render('/song/_item', ['item' => $item->song]);
            }
if ($page < ceil($pages->totalCount/song_page_limit)) { ?>
    <div class="load-more">
        <a class="jscroll-next-default" href="/bai-hat-co-the-ban-thich<?php
        $page++;
        echo yii\helpers\Html::encode($slug);
        ?>?page=<?php echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
    </div>
    <?php } ?>
        <?php } ?>

