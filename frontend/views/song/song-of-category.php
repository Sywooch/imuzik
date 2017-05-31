<?php

use \yii\widgets\LinkPager;
$this->title = $title;

?>
<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="scroll mdl-1 mdl-songs ">
        <?php //if (sizeof($categoryAreaVN) || sizeof($categoryAreaSongSlug)) { ?>
            <div class="title">
                <samp href="javascript:void(0);" class="txt"> <?php echo \yii\helpers\Html::encode($title); ?></samp>
            </div>
        <?php //} ?>
        <?php
        if ($type == 1) {
            foreach ($categoryAreaVN as $item) {
                echo $this->render('/song/_item_wide', ['item' => $item]);
            }
            ?>
        <?php if ($page < ceil($pages->totalCount/song_page_limit)) { ?>
            <div class="load-more">
                <a class="jscroll-next-default" href="/bai-hat-thuoc-the-loai/<?php
                $page++;
                echo yii\helpers\Html::encode($slug);
                ?>?page=<?php echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
            </div>
            <?php } ?>
            <?php
        } elseif ($type == 2) {
            foreach ($categoryAreaSongSlug as $item) {
                echo $this->render('/song/_item_wide', ['item' => $item]);
            }
            ?>
            <?php if ($page < ceil($pages->totalCount/song_page_limit)) { ?>
            <div class="load-more">
                <?php if ($typeName!= null) { ?>
                <a class="jscroll-next-default" href="/bai-hat-cung-ca-si/<?php
                $page++;
                echo yii\helpers\Html::encode($slug);
                ?>/<?php echo  2;?>?page=<?php echo $page; ?>"><i class="fa fa-angle-down"></i></a>
                <?php } else {?>

                <a class="jscroll-next-default" href="/the-loai/<?php
                $page++;
                echo yii\helpers\Html::encode($slug);
                ?>?page=<?php echo $page; ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php
        } elseif ($type == 3) {
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
    </div>

    <div class="pagging hide-pagging">
        <?php
        // display pagination
        echo LinkPager::widget([
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
        <?php echo \frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>
