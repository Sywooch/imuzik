<input type="hidden" id="rbt-id" value="<?php echo $rbt->id; ?>"/>
<input type="hidden" id="rbt_file_path" value="<?php echo media_link . $rbt->vt_link; ?>"/>
<span class="bg-color-01 btn-function" onclick="playFulltrack();" id="song-play-fulltrack"><i class="fa icon-play2"></i> <span class="txt">Fulltrack</span></span>
<a onclick="rbtLike();" id="rbt-like" href="javascript:void(0);" class="bg-color-03 btn-function user">
    <?php if ($rbt->getLiked()) { ?>
        <i class="fa fa-heart"></i> <span class="txt">Bỏ thích</span>
    <?php } else { ?>
        <i class="fa fa-heart-o"></i> <span class="txt">Thích</span>
    <?php } ?>
</a>
<a href="javascript:void(0);" class="bg-color-04 btn-function" onclick="rbt_gift('<?php echo $rbt->huawei_tone_code; ?>');">
    <i class="fa icon-gift"></i> <span class="txt">Tặng</span>
</a>
<!--Tặng nhạc chờ-->
<?php echo $this->render('/song/_popup_rbt_gift', []); ?>