<div class="mdl-banner">
    <div id="carousel-banner" class="owl-carousel">	
        <!-- Wrapper for slides -->
        <?php $index = 1; ?>
        <?php foreach ($data as $item) { ?>
            <div class="item <?php echo $index == 1 ? 'active' : '' ?>">
                <a href="<?php echo yii\helpers\Html::encode($item->link); ?>">
                    <img src="<?php echo $item->getImageUrl(); ?>" alt="" class="center-block">
                </a>
            </div>
            <?php $index ++; ?>
        <?php } ?>
    </div>
</div>