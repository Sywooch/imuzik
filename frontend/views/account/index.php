<?php use yii\widgets\LinkPager;
$this->title = yii\helpers\Html::encode("Danh sách yêu thích");

echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php echo $this->render('/account/_menu', []); ?>

<div class="col-md-9 col-sm-9">
    <div class="mdl-1 mdl-songs">
        <div class="title"> 	
            <span class="txt"> Danh sách yêu thích</span>
        </div>
        <?php
        if (sizeof($listSongYouLiked)) {
            foreach ($listSongYouLiked as $item) {
                echo $this->render('/song/_item_wide', ['item' => $item->song]);
            } ?>
            <?php if ($page < ceil($pages->totalCount/song_page_limit)){?>
                <div class="load-more">
                    <a class="jscroll-next-default" href="/danh-sach-yeu-thich<?php $page++;?>?page=<?php  echo $page ;?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
                </div>
            <?php } ?>
       <?php } else { ?>
            <h4 class="sub-title">Không có bài hát yêu thích nào</h4>
        <?php } ?>
        <div class="pagging hide-pagging">
            <?php
            // display pagination
            echo LinkPager::widget([

                'pagination' => $pages,
                'nextPageLabel' => 'Tiếp',
                'prevPageLabel' => 'Trước',
                'lastPageLabel' => 'Cuối',
                'firstPageLabel' => 'Đầu',
                'options' => ['class' => 'pager text-left'],
                'nextPageCssClass' => '',
                'maxButtonCount' => 5,
            ]);
            ?>
        </div>
    </div>

</div>

