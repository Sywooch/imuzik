<?php
/* @var $this View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta content="462996843754261" property="fb:app_id">
        <meta name = "format-detection" content = "telephone=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <?php echo $this->render('_header', array()); ?>
        <div class="wrap-content">
            <div class="container">  
                <div class="row">    
                    <?php if (Yii::$app->session->has('success')) { ?>
                        <div id="w0-success-0" class="alert-success alert fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo Yii::$app->session->getFlash('success'); ?>
                            <?php Yii::$app->session->removeAllFlashes(); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::$app->session->has('error')) { ?>
                        <div id="w0-danger-0" class="alert-danger alert fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo Yii::$app->session->getFlash('error'); ?>
                            <?php Yii::$app->session->removeAllFlashes(); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::$app->session->has('info')) { ?>
                        <div id="w0-info-0" class="alert-info alert fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo Yii::$app->session->getFlash('info'); ?>
                            <?php Yii::$app->session->removeAllFlashes(); ?>
                        </div>
                    <?php } ?>
                    <?= $content; ?>
                    <input type="hidden" id="user_logined" value="<?php echo Html::encode(Yii::$app->user->getId()); ?>"/>
                    <input type="hidden" id="crbt_status" value="0"/>
                </div>
            </div>
            <?php echo $this->render('_footer', array()); ?> 
        </div>
        <?php echo $this->render('_popup', array()); ?>
        <script>
            var LOGIN_TIMEOUT = <?php echo LOGIN_TIMEOUT; ?>;
            var IS_MOBILE = <?php echo \Yii::$app->devicedetect->isDescktop() ? 0 : 1; ?>;
            var viettel_phone_expression = '<?php echo \Yii::$app->params['viettel_phone_expression']; ?>';
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
