<?php if (sizeof($data)) { ?>
    <div class="mdl-1 mdl-news">
        <div class="title"> 	
            <span class="txt"> TIN TỨC</span>
        </div>  
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="/tin-tuc/<?php echo yii\helpers\Html::encode($data[0]->vtArticleTranslations->slug); ?>" class="item">
                    <img src="<?php echo $data[0]->getImageLink(); ?>" title="<?php echo yii\helpers\Html::encode($data[0]->vtArticleTranslations->title); ?>" onerror="this.src='/images/4x3.png';" alt="" class="image-2"/>
                    <p class="text-2" title="<?php echo yii\helpers\Html::encode($data[0]->vtArticleTranslations->title); ?>"> <?php echo yii\helpers\Html::encode($data[0]->vtArticleTranslations->title); ?></p>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php for ($i = 1; $i < sizeof($data); $i++) { ?>
                    <a href="/tin-tuc/<?php echo yii\helpers\Html::encode($data[$i]->vtArticleTranslations->slug); ?>" class="item">
                        <img src="<?php echo $data[$i]->getImageLink(); ?>" onerror="this.src='/images/4x3.png';" alt="" class="image"/>
                        <p class="text" title="<?php echo yii\helpers\Html::encode($data[$i]->vtArticleTranslations->title); ?>"><?php echo yii\helpers\Html::encode($data[$i]->vtArticleTranslations->title); ?></p>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>