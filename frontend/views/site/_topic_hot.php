<?php
$class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
if ((sizeof($data) && !sizeof($downNow)) || (!sizeof($data) && sizeof($downNow))) {
    $class = 'col-lg-12 col-md-6 col-sm-6 col-xs-12';
}
?>
<div class="mdl-1 mdl-songs"> 
    <div class="row">
        <?php if (sizeof($data)) { ?>
            <div class="<?php echo $class; ?>">
                <div class="title"> 	
                    <span href="javascript:void(0);" class="txt"> CHỦ ĐỀ HOT</span>
                </div> 
                <?php foreach ($data as $item) { ?>
                    <p>
                        <a href="/chu-de/<?php echo yii\helpers\Html::encode($item->slug); ?>">
                            <img src="<?php echo $item->getImageLink(); ?>" class="image-topic" alt=""onerror="this.src='<?php echo img_topic; ?>';" title="<?php echo yii\helpers\Html::encode($item->name); ?>"/>
                        </a>
                    </p>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if (sizeof($downNow)) { ?>
            <div class="<?php echo $class; ?>">
                <div class="title"> 	
                    <span href="javascript:void(0);" class="txt"> TẢI GẦN ĐÂY</span>
                </div> 
                <?php
                $count = 0;
                foreach ($downNow as $item) {
                    if ($count < 5) {
                        if ($item->song) {
                            echo $this->render('/song/_item', ['item' => $item->song]);
                            $count++;
                        }
                    }
                }
                ?>
            </div>
        <?php } ?>
    </div> 
</div>