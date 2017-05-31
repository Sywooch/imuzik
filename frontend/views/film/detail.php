<?php
$this->title = $title;
?>
<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="mdl-1 mdl-songs">
        <div class="title">
            <samp href="#" class="txt"> Nhạc chờ theo phim</samp>
            <a class="pull-right view-all text-more " href="/nhac-phim"><span class="txt-2">XEM THÊM </span><i class="fa fa-angle-double-right"></i></a>

        </div>

        <!-- Nav tabs -->
        <ul class="nav nav-pills" role="tablist">
            <li class="active"><a href="#tab-film-1" role="tab" data-toggle="tab"><?php echo(yii\helpers\Html::encode($filmDetail->name)); ?></a></li>
            <?php
            foreach ($rbtListFilmHost as $item) {
                echo $this->render('/film/_item_tab_hot', ['item' => $item]);
            }
            ?>

        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab-film-1">
                <div class="content-film-brt">
                    <?php echo $this->render('/film/_item_film_detail', ['item' => $filmDetail]); ?>

                </div>
                <?php if (sizeof($filmDetail->vtSongs)) { ?>
                <?php foreach ($filmDetail->vtSongs as $item) { ?>
                    <?php echo $this->render('/song/_item_wide', ['item' => $item]); ?>
                <?php } ?>
                <?php } else { ?>
                    <h4 class="sub-title">Đang cập nhật dữ liệu bài hát</h4>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
    <div class="col-lg-4 col-md-4  col-sm-12">
        <?php echo frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>