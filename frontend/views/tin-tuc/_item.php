<a href="/tin-tuc/<?php echo yii\helpers\Html::encode($item->vtArticleTranslations->slug)?>" class="item">
    <img src="<?php echo $item->getImageLink(img_4_3); ?>" onerror="this.src='/images/4x3.png';"  alt="" class="image"/>
    <p  class="text" title="<?php echo yii\helpers\Html::encode($item->vtArticleTranslations->title); ?>"><?php echo yii\helpers\Html::encode($item->vtArticleTranslations->title);?></p>
</a>