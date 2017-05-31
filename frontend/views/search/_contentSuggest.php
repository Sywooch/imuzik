 <?php
 if (sizeof($songs)) {
        foreach ($songs as $item){ ?>
            <?php
            $count = sizeof($item->singer_alias_song);
            $name="";
            if (sizeof($item->singer_alias_song)==0){$name= yii\helpers\Html::encode("Đang cập nhật");}
            else {
                if (count($item->singer_alias_song)> 2){
                    $name=yii\helpers\Html::encode("Nhiều ca sĩ");

                }else{

                    foreach (($item->singer_alias_song) as $item_singer){

                        if ($count ==2) {
                            $name .= \yii\helpers\Html::encode($item_singer). ' - ' ;
                        }else{
                            $name .= \yii\helpers\Html::encode($item_singer);
                        }
                    }

               }} ?>


            <li>
                <i class="fa icon-headphone"></i>
                <div class="right-result">
                <a href="/bai-hat/<?php echo yii\helpers\Html::encode($item->slug); ?>" title="<?php echo yii\helpers\Html::encode($item->song_name); ?>" class="txt-song"><?php echo yii\helpers\Html::encode($item->song_name);?></a>
                <a href="#" class="txt-singer ellipsis" title="<?php echo $name; ?>"><?php echo $name; ?></a>
                </div>
            </li>
        <?php }} ?>
