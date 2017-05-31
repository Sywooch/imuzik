<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php echo $this->render('/account/_menu', []); ?>
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sao chép nhạc chờ';
?>

<div class="col-md-9 col-sm-9">
    <div class="mdl-1 mdl-form">
        <div class="title">
            <a href="#" class="txt"> Sao chép nhạc chờ</a>            
        </div>  
        <h4 class="sub-title">Số điện thoại muốn sao chép (Viettel)</h4><p></p>
        <?php
        $form = ActiveForm::begin([
                    'enableClientValidation' => false,
                    'action' => '/user/rbt-copy',
                    'options' => [
                        'class' => 'form-inline'
                    ]
        ]);
        ?>
        <div class="form-group">
            <input type="tel" autofocus="autofocus" placeholder="Nhập số điện thoại" class="form-control ipt-imuzik" style="width:330px;" id="msisdn_copy_input" name="msisdn" value="<?php echo Html::encode($msisdn); ?>"/>
            <button type="submit" class="btn btn-imuzik">TÌM</button>
        </div>
        <p><br></p>
        <?php if ($msisdn) { ?>
            <?php if (sizeof($lt)) { ?>
                <h4 class="sub-title">Danh sách nhạc chờ</h4>
                <div class="mdl-detail-song" id="tone-play-audio" style="height: 0px; overflow: hidden;">
                    <?php echo frontend\Widgets\song\AudioWidget::widget(['file' => '']); ?>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="55%" class="first-col">Bài hát</th>                    
                            <th width="35%"  class="last-col">
                    <div class="col-content">
                        <span class="col-form-01">Mã số </span> 
                        <span class="col-form-02">Giá</span>     		
                    </div>
                    <div class="checkbox control-checkbox"> <input type="checkbox" name="rbt-check-all"/></div>
                    </th> 
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lt as $rbt) { ?>
                            <?php $item = \frontend\models\VtRingBackTone::find()->where(['huawei_tone_id' => $rbt['toneID']])->one(); ?>
                            <?php if ($item) { ?>
                                <tr class="special-text">
                                    <td>
                                        <a href="javascript:void(0);" class="bg-color-01" onclick="tonePlay('<?php echo media_link . $item->vt_link; ?>', '<?php echo $item->huawei_tone_code; ?>');"><i id="tone_code_<?php echo $item->huawei_tone_code; ?>" class="fa icon-play2"></i></a>
                                        <div class="wrap-content-table rbt-select">
                                            <span class="song-name"><?php echo yii\helpers\Html::encode($rbt['toneName']); ?></span>
                                            <span class="singer-name"><?php echo yii\helpers\Html::encode($rbt['singerName']); ?></span> 
                                        </div>
                                    </td>
                                    <td class="last-col function-more">
                                        <div class="col-content rbt-select">
                                            <span class="col-form-01"><?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?></span> 
                                            <span class="col-form-01"><?php echo number_format($rbt['price']); ?></span> 
                                        </div>
                                        <div class="checkbox control-checkbox"> 
                                            <input type="checkbox" name="rbt-list" value="<?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?>">
                                        </div>                                        
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="form-group">
                    <button type="button" class="btn btn-imuzik" onclick="downAllRbt();">SAO CHÉP</button>
                    <span class="space">hoặc tặng</span>
                    <input type="tel" class="form-control ipt-imuzik" id="present-number-input" placeholder="Nhập sđt tặng" value="">
                    <button type="button" class="btn btn-imuzik" onclick="presentRbtAll()">TẶNG</button>
                </div>  
            <?php } else { ?>
                <h4 class="sub-title">Không tìm thấy bài nhạc chờ nào</h4>
            <?php } ?>
        <?php } ?>
        <?php ActiveForm::end(); ?>      
    </div>
</div>
<?php
$js = <<<JS
       $('#msisdn_copy_input').click();
JS;
$this->registerJs($js, $this::POS_READY);
?>
