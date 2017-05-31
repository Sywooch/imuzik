<?php
$this->title = 'Bảng xếp hạng';
?>
<div class="col-lg-4 col-md-4  col-sm-12">
    <?php echo frontend\Widgets\rank\RankWidget::widget(['scroll' => '']); ?>
</div>

<div class="col-lg-4 col-md-4  col-sm-12">
    <?php echo frontend\Widgets\song\DownWidget::widget(['number_limit' => 20]); ?>
</div>

<div class="col-lg-4 col-md-4  col-sm-12">
    <?php echo frontend\Widgets\song\TopFreeWidget::widget(); ?>
</div>