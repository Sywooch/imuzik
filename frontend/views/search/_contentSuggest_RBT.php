 <?php
 if (sizeof($songs)) {
        foreach ($songs as $item){?>
            <li>
                <i class="fa icon-headphone"></i>
                <a href="/bai-hat/<?php echo yii\helpers\Html::encode($item->slug); ?>" class="txt-song"><?php echo yii\helpers\Html::encode($item->huawei_tone_name);?></a>
                <a href="#" class="txt-singer"><?php
                        echo yii\helpers\Html::encode($item->huawei_singer_name);
                    ?></a>
            </li>
        <?php }} ?>
