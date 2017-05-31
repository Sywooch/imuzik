<div class="col-sm-3 col-md-3">

    <div class="mdl-links">
        <div class="title-2">Danh mục</div>
        <?php
        $action = Yii::$app->controller->action->id;
        if (sizeof($arrMenu)) {
            foreach ($arrMenu as $item) {

                ?>
                <?php if ($item->slug == "gop-y-bao-loi") { ?>
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <a href="/gop-y-bao-loi" <?php echo ($item->slug == $slug||$action=="feed-back-error") ? 'class="active"' : 'class="item"';?> ><?php echo yii\helpers\Html::encode($item->name); ?></a>
                    <?php } else { ?>
                        <a  href="javascript:void(0);" class = "user item">Góp ý/Báo lỗi</a>
                    <?php } ?>
                <?php } else { ?>
                    <a href="/huong-dan/<?php echo yii\helpers\Html::encode($item->slug); ?>" <?php echo ($item->slug == $slug || $item->id == $id) ? 'class="active"' : 'class="item"'; ?> ><?php echo yii\helpers\Html::encode($item->name); ?></a>
                <?php } ?>

            <?php }
        }
        ?>
    </div>
</div>
