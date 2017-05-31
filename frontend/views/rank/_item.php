<?php
if (sizeof($item)) {
    switch ($index) {
        case '01':
            $class = 'media-right text-danger';
            break;
        case '02':
            $class = 'media-right text-success';
            break;
        case '03':
            $class = 'media-right text-primary';
            break;
        default :
            $class = 'media-right';
            break;
    }
    $name = yii\helpers\Html::encode($item->name);
    $singerName = yii\helpers\Html::encode($item->getSingerName());
    $slug = yii\helpers\Html::encode($item->slug);
    ?>
    <div class="media">
        <div class="media-left">
            <a href="/bai-hat/<?php echo $slug; ?>">
                <img class="media-object" src="<?php echo $item->getImageUrl(); ?>" width="48" alt="..." onerror="this.onerror=null;this.src='<?php echo img_4_4; ?>';">
            </a>
        </div>
        <div class="media-body">
            <a href="/bai-hat/<?php echo $slug; ?>" class="song-name ellipsis" title="<?php echo $name; ?>"><?php echo $name; ?></a>
            <p class="singer-name ellipsis" title="<?php echo $singerName; ?>"><?php echo $singerName; ?></p>
        </div>
        <div class="<?php echo $class; ?>"><?php echo $index; ?></div>
    </div>
<?php } ?>