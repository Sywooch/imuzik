<?php
$this->title = 'Một thế giới âm nhạc';
?>
<div class="col-lg-8 col-md-8  col-sm-12">
    <?php echo $this->render('_banner', ['data' => $banners]); ?>
    <?php echo frontend\Widgets\song\MayBeYouLikeWidget::widget(); ?>
    <?php echo $this->render('_topic_hot', ['data' => $catHot, 'downNow' => $downNow]); ?>
    <?php echo $this->render('_news', ['data' => $news]); ?>
    <?php echo $this->render('_newest', ['data' => $songNewest]); ?>
</div>
<div class="col-lg-4 col-md-4  col-sm-12">
    <?php echo frontend\Widgets\rank\RankWidget::widget(); ?>
    <?php echo frontend\Widgets\song\DailyListenWidget::widget(); ?>
    <?php echo frontend\Widgets\song\DownWidget::widget(['show_free' => true]); ?>
</div>