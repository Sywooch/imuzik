<?php if (sizeof($item)) { ?>
    <?php
    $name = yii\helpers\Html::encode($item->name);
    $singerName = yii\helpers\Html::encode($item->getSingerName());
    $slug = yii\helpers\Html::encode($item->slug);
    ?>
    <div class="media">
        <div class="media-left">
            <a href="/bai-hat/<?php echo $slug; ?>">
                <img class="media-object" src="<?php echo $item->getImageUrl(); ?>" onerror="this.src='/images/4x4.png';" width="48" alt="...">
            </a>
        </div>
        <div class="media-body">
            <a href="/bai-hat/<?php echo $slug; ?>" class="song-name ellipsis" title="<?php echo $name; ?>">
                <?php echo $name; ?>
            </a>
            <p class="singer-name ellipsis" title="<?php echo $singerName; ?>"><?php echo $singerName; ?></p>
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
                <?php if ($item->getLiked()) { ?>
                    <i class="fa fa-heart" title="Bỏ thích"></i>
                <?php } else { ?>
                    <i class="fa fa-heart-o" title="Thích"></i>
                <?php } ?>    
            </a>
            <a name="fb_share" title="Chia sẻ" class="bg-color-05" href="https://facebook.com/sharer.php?u=<?php echo $_SERVER['HTTP_HOST']; ?>/bai-hat/<?php echo yii\helpers\Html::encode($item->slug); ?>"><i class="fa icon-share"></i></a>
        </div>              
    </div>
<?php } ?>