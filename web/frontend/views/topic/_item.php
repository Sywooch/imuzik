<a href="/chu-de/<?php echo yii\helpers\Html::encode($item->slug) ?>" class="item">
    <img src="<?php echo $item->getImageLink(); ?>" onerror="this.src='<?php echo img_topic; ?>';"/>
    <p><?php echo yii\helpers\Html::encode($item->name);?></p>
</a>