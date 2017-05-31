<?php
$this->title = $song->name;
?>
<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="mdl-detail-song">
        <div class="title">
            <span href="javascript:void(0);" class="txt"> <?php echo yii\helpers\Html::encode($song->name); ?></span>
        </div>
        <div class="txt-singer">
            <?php echo yii\helpers\Html::encode($song->getSingerName(false)); ?>
        </div>

        <?php echo frontend\Widgets\song\AudioWidget::widget(['file' => $song->file_path]); ?>

        <div id="info-song-full">
            <input type="hidden" id="song-fulltrack-id" value="<?php echo $song->id; ?>"/>
            <input type="hidden" id="song-fulltrack-path" value="<?php echo media_link . $song->file_path; ?>"/>
            <input type="hidden" id="song-fulltrack-liked" value="<?php echo $song->getLiked() ? 1 : 0; ?>"/>
            <div class="info-song">
                <span id="info-song-fulltrack">
                    <?php if ($song->getLiked()) { ?>
                        <span class="bg-color-03 btn-function user"><i class="fa fa-heart"></i> <span class="txt">Bỏ thích</span></span>
                    <?php } else { ?>
                        <span class="bg-color-03 btn-function user"><i class="fa fa-heart-o"></i> <span class="txt">Thích</span></span>
                    <?php } ?>
                </span>
                <div class="fb-like" data-href="https://facebook.com/sharer.php?u=<?php echo $_SERVER['HTTP_HOST']; ?>/bai-hat/<?php echo yii\helpers\Html::encode($song->slug); ?>" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
            </div>
            <?php echo $this->render('_rbt_code', ['rbts' => $rbts, 'song_id' => $song->id]); ?>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="mdl-1 mdl-songs">
        <div class="row">
            <?php
            $classs = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
            if ((sizeof($song->singers) && !sizeof($song->musicGenres)) || (!sizeof($song->singers) && sizeof($song->musicGenres))) {
                $classs = 'col-lg-12 col-md-12 col-sm-6 col-xs-12';
            }
            ?>
            <?php echo frontend\Widgets\song\WithTheSingerWidget::widget(['song' => $song, 'classs' => $classs]); ?>
            <?php echo (sizeof($song->musicGenres)) ? frontend\Widgets\song\WithTheCatWidget::widget(['cats' => $song->musicGenres, 'song_id' => $song->id, 'classs' => $classs]) : ''; ?>
        </div>
    </div>
    <?php echo frontend\Widgets\song\MayBeYouLikeWidget::widget(['more' => true]); ?>
</div>
<?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <?php echo frontend\Widgets\rank\RankWidget::widget(); ?>
        <?php echo frontend\Widgets\song\DownWidget::widget(); ?>
    </div>
<?php } ?>
