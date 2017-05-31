<a href="/nhac-phim/<?php echo yii\helpers\Html::encode($item->slug) ?>" class="item">
    <img src="<?php echo $item->getImageLink(); ?>" onerror="this.src='<?php echo img_film; ?>';" title="<?php echo yii\helpers\Html::encode($item->name); ?>"/>
</a>