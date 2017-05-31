<?php
use yii\widgets\LinkPager;
$this->title = yii\helpers\Html::encode("NHẠC PHIM");
?>
<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="mdl-1 mdl-songs">
        <div class="title">
            <span href="javascript:void(0);" class="txt"> Nhạc chờ theo phim</span>
        </div>
        <div class="list-film">
            <?php if (sizeof($rbtListFilm)) { ?>
            <?php



                foreach ($rbtListFilm as $item) {
                ?>

                <?php echo $this->render('/film/_item', ['item' => $item]); ?>

            <?php } ?>
            <?php  if ($page < ceil($pages->totalCount / topic_page_limit)) { ?>
                <div class="load-more">
                    <a class="jscroll-next-default" href="/nhac-phim<?php $page++; ?>?page=<?php echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
                </div>
            <?php } ?>
            <?php } else { ?>
                <h4 class="sub-title">Dữ liệu đang được cập nhật</h4>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
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
<?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
    <div class="col-lg-4 col-md-4  col-sm-12">
        <?php echo frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>
