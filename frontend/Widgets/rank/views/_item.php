<div class="media">
    <div class="media-left">
        <a href="/bai-hat/<?php echo yii\helpers\Html::encode($item->slug); ?>">
            <img class="media-object" src="<?php echo $item->getSingerImage(); ?>" width="48" alt="...">
        </a>
    </div>
    <div class="media-body">
        <a href="/bai-hat/<?php echo yii\helpers\Html::encode($item->slug); ?>" class="song-name ellipsis"><?php echo yii\helpers\Html::encode($item->name) ?></a>
        <p class="singer-name ellipsis"><a href="javascript:void(0);"><?php echo yii\helpers\Html::encode($item->getSingerName()); ?></a></p>
    </div>
    <div class="media-right text-danger"><?php echo $index; ?></div>
</div>