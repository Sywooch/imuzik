<?php
$this->title = 'Tin tức';
?>
<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="mdl-1 mdl-news">
        <div class="title">
            <span class="txt"> TIN TỨC</span>
        </div>
        <div class="row">
            <?php if (sizeof($newshostList)) { ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php foreach ($newshostList as $item) { ?>

                    <?php echo $this->render('/tin-tuc/_item_hot', ['item' => $item]); ?>

                <?php } ?>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php foreach ($newsList as $item) { ?>
                    <?php echo $this->render('/tin-tuc/_item', ['item' => $item]); ?>

                <?php } ?>

            </div>
            <?php } else { ?>
                <h4 class="sub-title">Dữ liệu đang được cập nhật</h4>
            <?php } ?>
        </div>
    </div>

</div>
<?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
    <div class="col-lg-4 col-md-4  col-sm-12">
        <?php echo frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>