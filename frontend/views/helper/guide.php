<?php
$this->title = yii\helpers\Html::encode($title);
?>
<?php echo $this->render('/helper/_menu', ['arrMenu'=>$arrMenu,'slug'=>$slug]); ?>
<div class="col-md-9 col-sm-9">

    <div class="mdl-1 mdl-video-nominations left-line">
        <?php
        if (sizeof($data)){
            foreach ($data as $item){?>
                <div class="title"><?php echo yii\helpers\Html::encode($item->title);?> </div>
        <div class="content">
            <?php echo common\helpers\Helpers::removeJstag($item->body);?>
        </div>
            <?php } ?>
        <?php }else {?>
            <p class="title">Dữ liệu đang cập nhật</p>
       <?php } ?>

    </div>
</div>