<?php
$this->title = yii\helpers\Html::encode($rbt->huawei_tone_name);
?>
<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="mdl-detail-song">
        <div class="title">
            <span href="javascript:void(0);" class="txt"> <?php echo $this->title; ?></span>
        </div>
        <div class="txt-singer">
            <?php echo yii\helpers\Html::encode($rbt->huawei_singer_name); ?>
        </div>

        <?php echo frontend\Widgets\song\AudioWidget::widget(['file' => $rbt->vt_link]); ?>

        <div id="info-song-full">
            <div class="info-song">
                <span id="info-song-fulltrack">
                    <input type="hidden" id="rbt-id" value="<?php echo $rbt->id; ?>"/>
                    <a onclick="rbtLike();" id="rbt-like" href="javascript:void(0);" class="bg-color-03 btn-function">
                        <?php if ($rbt->getLiked()) { ?>
                            <i class="fa fa-heart"></i> <span class="txt">Bỏ thích</span>
                        <?php } else { ?>
                            <i class="fa fa-heart-o"></i> <span class="txt">Thích</span>
                        <?php } ?>
                    </a>
                    <a title="Tải" href="javascript:void(0);" class="bg-color-02 btn-function" onclick="downOneRbt('<?php echo yii\helpers\Html::encode($rbt->huawei_tone_code); ?>');">
                        <i class="fa icon-download"></i> <span class="txt">Tải</span>
                    </a>
                    <a title="Tặng" href="javascript:void(0);" class="bg-color-04 btn-function" onclick="rbt_gift('<?php echo $rbt->huawei_tone_code; ?>');">
                        <i class="fa icon-gift"></i> <span class="txt">Tặng</span>
                    </a>
                </span>
                <div title="Chia s" class="fb-like" data-href="https://facebook.com/sharer.php?u=<?php echo $_SERVER['HTTP_HOST']; ?>/bai-nhac-cho/<?php echo yii\helpers\Html::encode($rbt->huawei_tone_code); ?>"
                     data-action="like" data-size="small" data-show-faces="false" data-share="true">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php echo frontend\Widgets\song\MayBeYouLikeWidget::widget(['more' => true]); ?>
</div>
<?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <?php echo frontend\Widgets\rank\RankWidget::widget(); ?>
        <?php echo frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>
<!--Tặng nhạc chờ-->
<?php echo $this->render('/song/_popup_rbt_gift', []); ?>
