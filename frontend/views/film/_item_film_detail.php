<img src="<?php echo ($item->getImageLink());  ?>" onerror="this.src='<?php echo img_film; ?>';" width="200" alt=""/>
<h3><?php echo yii\helpers\Html::encode($item->name); ?></h3>
<p><?php echo yii\helpers\Html::encode($item->description); ?></p>