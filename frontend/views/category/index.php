<?php
$this->title = 'Thể loại âm nhạc';
?>
<div class="col-sm-3 col-md-3">
    <div class="btn-scroll-genre" data-toggle="modal" data-target=".scroll-mobile">
        Thể loại nhạc <i class="fa fa-angle-down"></i>
    </div>
    <div class="scroll-mobile bs-example-modal-sm">
        <div class="scroll-mobile-sub-1">
            <div class="scroll-mobile-sub-2">
                <span class="close" data-dismiss="modal"><i class="fa fa-close"></i></span>	
                <div class="mdl-links">
                    <div class="scroll-pane horizontal-only">
                        <div class="content-scroll-2">
                            <?php if (count($categoryAreaVN) > 0) { ?>
                                <div class="title">Việt nam</div>
                                <?php foreach ($categoryAreaVN as $item) { ?>
                                    <?php echo $this->render('/category/_item_area', ['item' => $item]); ?>

                                <?php } ?>
                            <?php } ?>
                            <?php if (count($categoryAreaAM) > 0) { ?>
                                <div class="title">Âu Mỹ</div>
                                <?php foreach ($categoryAreaAM as $item) { ?>

                                    <?php echo $this->render('/category/_item_area', ['item' => $item]); ?>

                                <?php } ?>
                            <?php } ?>
                            <?php if (count($categoryAreaCA) > 0) { ?>
                                <div class="title">Châu Á</div>

                                <?php foreach ($categoryAreaCA as $item) { ?>

                                    <?php echo $this->render('/category/_item_area', ['item' => $item]); ?>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-9 col-md-9">
    <div class="mdl-1 mdl-songs">
        <?php if (count($categoryAreaSongVN) > 0) { ?>
            <div class="title">
                <a href="/bai-hat-thuoc-the-loai/<?php echo yii\helpers\Html::encode(category_vn) ?>" class="txt"> Việt Nam</a>
                <a class="pull-right view-all" href="/bai-hat-thuoc-the-loai/<?php echo yii\helpers\Html::encode(category_vn) ?>"><span class="txt-3">XEM THÊM </span><i class="fa fa-angle-double-right"></i> </a>
            </div>
        <?php } ?>
        <?php foreach ($categoryAreaSongVN as $item) { ?>
            <?php echo $this->render('/song/_item_wide', ['item' => $item]); ?>
        <?php } ?>
    </div>
    <div class="mdl-1 mdl-songs">
        <?php if (count($categoryAreaSongAM) > 0) { ?>
            <div class="title">
                <a href="/bai-hat-thuoc-the-loai/<?php echo yii\helpers\Html::encode(category_am) ?>" class="txt"> Âu Mỹ</a>
                <a class="pull-right view-all" href="/bai-hat-thuoc-the-loai/<?php echo yii\helpers\Html::encode(category_am) ?>"><span class="txt-3">XEM THÊM </span> <i class="fa fa-angle-double-right"></i> </a>
            </div>
        <?php } ?>
        <?php foreach ($categoryAreaSongAM as $item) { ?>
            <?php echo $this->render('/song/_item_wide', ['item' => $item]); ?>
        <?php } ?>
    </div>
    <div class="mdl-1 mdl-songs">
        <?php if (count($categoryAreaSongCA) > 0) { ?>
            <div class="title">
                <a href="/bai-hat-thuoc-the-loai/<?php echo yii\helpers\Html::encode(category_ca) ?>" class="txt">Châu Á</a>
                <a class="pull-right view-all" href="/bai-hat-thuoc-the-loai/<?php echo yii\helpers\Html::encode(category_ca) ?>"><span class="txt-3">XEM THÊM </span> <i class="fa fa-angle-double-right"></i> </a>
            </div>
        <?php } ?>
        <?php foreach ($categoryAreaSongCA as $item) { ?>
            <?php echo $this->render('/song/_item_wide', ['item' => $item]); ?>
        <?php } ?>
    </div>
</div>