<?php if (sizeof($rbts)) { ?>
    <div class="table-music">
        <div class="row-music row-header">
            <div class="column-1"><span class="txt-2">Tải</span> <span class="txt">Mã số</span></div>
            <div class="column-2"><span class="txt">Lượt nghe</span></div>
            <div class="column-3"><span class="txt">Lượt tải</span></div>
            <div class="column-4"><span class="txt">Thích</span></div>
        </div>
        <div class="scroll-pane">
            <div class="content-scroll">
                <?php foreach ($rbts as $item) { ?>
                    <div class="row-music" id="<?php echo $item->huawei_tone_code; ?>">
                        <div class="column-1">
                            <a href="javascript:void(0);" class="bg-color-02 btn-function" onclick="downOneRbt('<?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?>');">
                                <i class="fa icon-download"></i>
                            </a>
                            <a href="javascript:void(0);" class="huawei_tone_code" rbt_id="<?php echo $item->huawei_tone_code; ?>" source_url="<?php echo media_link . $item->vt_link; ?>">
                                <span class="txt"><?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?></span><span class="fa icon-playing"></span>
                            </a>
                        </div>
                        <div class="column-2"><span class="txt"><?php echo \common\helpers\Helpers::convertCountView($item->listen_number); ?></span></div>
                        <div class="column-3"><span class="txt"><?php echo \common\helpers\Helpers::convertCountView($item->huawei_order_times); ?></span></div>
                        <div class="column-4"><span class="txt"><?php echo \common\helpers\Helpers::convertCountView($item->like_number); ?></span></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>