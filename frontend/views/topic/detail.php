<?php
$this->title = yii\helpers\Html::encode($topicDetail->name);
?>
<div class="col-lg-12 col-md-12 col-sm-12">
    <img src="<?php echo $topicDetail->getImageLink(); ?>" onerror="this.src='<?php echo img_topic; ?>';" width="100%" alt=""/>
</div>
<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="content-film-brt"><br>
        <p><?php echo yii\helpers\Html::encode($topicDetail->name); ?></p>
    </div>

    <div class="mdl-1 mdl-songs">
        <div class="title">
            <?php if (sizeof($listSongTopic)) { ?>
                <span href="#" class="txt"> Bài hát</span>
            <?php } ?>
        </div>

        <?php
        foreach ($listSongTopic as $item) {
            echo $this->render('/song/_item_wide', ['item' => $item]);
        }
        ?>
        <?php if ($page < ceil($pages->totalCount / song_page_limit)) { ?>
            <div class="load-more">
                <a class="jscroll-next-default" href="/chu-de/<?php echo yii\helpers\Html::encode($slug) ?>?page=<?php $page++;echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
            </div>
        <?php } ?>
    </div>
    <div class="pagging hide-pagging">
        <?php
        echo yii\widgets\LinkPager::widget([
            'pagination' => $pages,
            'nextPageLabel' => 'Tiếp',
            'prevPageLabel' => 'Trước',
            'firstPageLabel' => 'Đầu',
            'lastPageLabel' => 'Cuối',
            'options' => ['class' => 'pager text-left'],
            'nextPageCssClass' => '',
            'maxButtonCount' => 5,
        ]);
        ?>
    </div>
</div>
<?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
    <div class="col-lg-4 col-md-4  col-sm-12">
        <?php echo frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>
