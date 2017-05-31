<a href="/chu-de/<?php echo yii\helpers\Html::encode($item->slug) ?>" class="item">
    <img src="<?php echo $item->getImageLink(); ?>" onerror="this.src='<?php echo img_topic; ?>';"/>
    <p class="text " title="<?php echo yii\helpers\Html::encode($item->name); ?>"><?php echo yii\helpers\Html::encode($item->name);?></p>
</a>