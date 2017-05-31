<div class="media">
    <div class="media-left">
        <a href="/song/fulltrack">
            <img class="media-object" src="<?php echo $item->getImageUrl(); ?>" width="48" alt="...">
        </a>
    </div>
    <div class="media-body">
        <a href="/song/fulltrack" class="song-name ellipsis"><?php echo yii\helpers\Html::encode($item->name) ?></a>
        <p class="singer-name ellipsis"><a href="javascript:void(0);"><?php echo yii\helpers\Html::encode($item->getSingerName()); ?></a></p>
    </div>
    <div class="media-right text-danger"><?php echo $number; ?></div>
</div>