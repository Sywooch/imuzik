<?php




?>
<?php if (sizeof($item)) { ?>
    <?php
    $name = '';
    $singers = json_decode($item->singer_alias_song);
    var_dump($singers);die();
    $size = sizeof($singers);
    if ($size){
        if ($size > 2 & $getOne) {
            $singerName = 'Nhiều ca sĩ   ';
        } else {
            foreach ($singers as $item) {
                $singerName .= $item;
            }
        }
    }else $singerName = ($name) ? substr($name, 0, -3) : 'Đang cập nhật';
    $slug = yii\helpers\Html::encode($item->slug);
    if (strpos($item->image_path, 'vip.img.cdn.keeng.vn') !== false) {
        return $item->image_path;
    }
    $image_url = media_image_link . $item->image_path;
    ?>
    <div class="media">
        <div class="media-left">
            <a href="/bai-hat/<?php echo $slug; ?>">
                <img class="media-object" src="<?php echo $image_url; ?>" width="48" alt="..." onerror="this.onerror=null;this.src='<?php echo img_4_4; ?>';">
            </a>
        </div>
        <div class="media-body special-text">
            <div class="wrap-song">
                <a href="/bai-hat/<?php echo $slug; ?>" class="song-name ellipsis" title="<?php echo yii\helpers\Html::encode($item->song_name); ?>"><?php echo yii\helpers\Html::encode($item->song_name); ?></a>
                <span class="singer-name ellipsis" title="<?php echo yii\helpers\Html::encode($singerName); ?>"><?php echo yii\helpers\Html::encode($singerName); ?></span>
            </div>
        </div>
        <div class="media-right">
            <div class="right-info">
                <span class="viewer"><i class="fa icon-headphone"></i><?php echo yii\helpers\Html::encode(\frontend\controllers\SongController::convertCountView($item->view_number)); ?></span>
            </div>
        </div>
        <div class="link-more-mobile">
            <i class="fa icon-more"></i>
            <i class="fa fa-close"></i>
        </div>
        <div class="overlay">
            <a href="/bai-hat/<?php echo $slug; ?>" class="bg-color-01" title="Play"><i class="fa icon-play2"></i></a>
            <a href="javascript:void(0);" class="bg-color-03 user" id="<?php echo $item->id; ?>" song_id="<?php echo $item->id; ?>">
<!--                --><?php //if ($item->getLiked()) { ?>
<!--                    <i class="fa fa-heart" title="Bỏ thích"></i>-->
<!--                --><?php //} else { ?>
<!--                    <i class="fa fa-heart-o" title="Thích"></i>-->
<!--                --><?php //} ?><!-- -->
            </a>
            <a title="Chia sẻ" name="fb_share" class="bg-color-05" href="https://facebook.com/sharer.php?u=<?php echo $_SERVER['HTTP_HOST']; ?>/bai-hat/<?php echo yii\helpers\Html::encode($item->slug); ?>"><i class="fa icon-share"></i></a>
        </div>

    </div>
<?php } ?> 