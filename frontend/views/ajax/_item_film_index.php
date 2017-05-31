<div class="list-film">
            <?php
                foreach ($rbtListFilm as $item) {
                ?>

                <?php echo $this->render('/film/_item', ['item' => $item]); ?>

            <?php } ?>
            <?php if ($page < ceil($pages->totalCount / topic_page_limit)) { ?>
                <div class="load-more">
                    <a class="jscroll-next-default" href="/nhac-phim<?php $page++; ?>?page=<?php echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
                </div>
            <?php } ?>
</div>




