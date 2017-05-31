<input type="hidden" id="rbt-id" value="<?php echo $rbt->id; ?>"/>
<input type="hidden" id="rbt_file_path" value="<?php echo media_link . $rbt->vt_link; ?>"/>
<?php if ($rbt->getLiked()) { ?>
    <a id="rbt-like" href="javascript:void(0);" class="bg-color-03 btn-function"><i class="fa fa-heart"></i> Bỏ thích</a>
<?php } else { ?>
    <a id="rbt-like" href="javascript:void(0);" class="bg-color-03 btn-function"><i class="fa fa-heart-o"></i> Thích</a>
<?php } ?>

<a href="javascript:void(0);" class="bg-color-04 btn-function"><i class="fa icon-gift"></i> Tặng</a>
<img src="/images/img_14.jpg" width="143" height="30" alt=""/>
