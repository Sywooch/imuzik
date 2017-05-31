<?php
$this->title = yii\helpers\Html::encode($newsDetail->title);
?>
<div class="col-lg-8 col-md-8  col-sm-12">

    <div class="mdl-1 mdl-news">
        <div class="title">
            <span href="#" class="txt"> TIN TỨC</span>
        </div>

        <div class="content-film-brt content-news">
            <h3><?php echo yii\helpers\Html::encode($newsDetail->title); ?></h3>
            <p class="time"><?php echo (\common\libs\TimeUtils::sw_get_current_weekday($newsDetail->vtArticle->published_time)); ?></p>
            <p><strong><?php echo common\helpers\Helpers::removeJstag($newsDetail->description); ?></strong></p>
            <p><?php echo common\helpers\Helpers::removeJstag($newsDetail->body); ?></p>
        </div>
        <?php if (sizeof($newsInvolve)) { ?>
            <div class="title">
                <span class="txt"> TIN TỨC KHÁC</span>
            </div>
            <div class="row">
                <?php foreach ($newsInvolve as $item) { ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <a href="/tin-tuc/<?php echo yii\helpers\Html::encode($item->vtArticleTranslations->slug); ?>"
                           class="item">
                            <img src="<?php echo $item->getImageLink(img_4_3); ?>"
                                 onerror="this.src='<?php echo img_4_3; ?>';" alt="" class="image-2"/>
                            <p class="text ellipsis-2" title="<?php echo yii\helpers\Html::encode($item->vtArticleTranslations->title); ?>"><?php echo yii\helpers\Html::encode($item->vtArticleTranslations->title); ?></p>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</div>
<?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
    <div class="col-lg-4 col-md-4  col-sm-12">
        <?php echo frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>