<div class="list-topic">
    <?php
    if (sizeof($rbtListFilm)) {
        foreach ($rbtListFilm as $item) {
            echo $this->render('/topic/_item', ['item' => $item]);
         }
        if ( $page < ceil($pages->totalCount/topic_page_limit) ){ ?>
            <div class="load-more">
                <a class="jscroll-next-default" href="/chu-de<?php $page++; ?>?page=<?php echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
            </div>
        <?php } ?>
    <?php } ?>
</div>
