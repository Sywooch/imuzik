<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php echo $this->render('/account/_menu', []); ?>
<?php $this->title = 'Bộ sưu tập cá nhân'; ?>

<div class="col-md-9 col-sm-9">        
    <div class="mdl-1 mdl-form">
        <?php if (sizeof($lt)) { ?>
            <div class="title">
                <p class="txt"> Bộ sưu tập cá nhân</p>            
            </div>  
            <div class="mdl-detail-song" id="tone-play-audio" style="height: 0px; overflow: hidden;">
                <?php echo frontend\Widgets\song\AudioWidget::widget(['file' => '']); ?>
            </div>
            <div class="form-inline">
                <table class="table table-hover table-vertical">
                    <thead>
                        <tr>
                            <th width="55%" class="first-col">Bài hát</th>                    
                            <th width="35%">
                    <div class="col-content">
                        <span class="col-form-01">Mã số </span> 
                        <span class="col-form-01">Giá </span> 
                        <span class="col-form-02">Hết hạn</span>
                    </div>
                    </th>
                    <th width="5%" class="col-sub">
                        Tặng
                    </th> 
                    <th width="5%" class="last-col col-sub">
                        Xóa
                    </th> 
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lt as $rbt) { ?>
                            <?php $item = \frontend\models\VtRingBackTone::find()->where(['huawei_tone_id' => $rbt['toneID']])->one(); ?>
                            <?php if ($item) { ?>
                                <tr class="special-text" id="<?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?>">
                                    <td>
                                        <a href="javascript:void(0);" class="bg-color-01" onclick="tonePlay('<?php echo media_link . $item->vt_link; ?>', '<?php echo $item->huawei_tone_code; ?>');"><i id="tone_code_<?php echo $item->huawei_tone_code; ?>" class="fa icon-play2"></i></a>
                                        <div class="wrap-content-table">
                                            <span class="song-name"><?php echo yii\helpers\Html::encode($rbt['toneName']); ?></span>
                                            <span class="singer-name"><?php echo yii\helpers\Html::encode($rbt['singerName']); ?></span>
                                        </div>
                                    </td>
                                    <td class="function-more">
                                        <div class="col-content">
                                            <span class="col-form-01"><?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?></span> 
                                            <span class="col-form-01"><?php echo number_format($rbt['price']); ?></span> 
                                            <span class="col-form-02"><?php echo date('d-m-Y', strtotime($rbt['availableDateTime'])); ?></span>
                                        </div>
                                        <span class="btn-more-table"><i class="fa icon-more"></i></span>
                                        <div class="overlay">
                                            <a href="javascript:void(0);" class="bg-color-04" onclick="rbt_gift('<?php echo $item->huawei_tone_code; ?>')"><i class="fa icon-gift"></i></a>
                                            <a href="javascript:void(0);" class="bg-color-06" onclick="deleteRBT('<?php echo $rbt['personID']; ?>', '<?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?>');"><i class="fa fa-trash-o"></i></a>                                        
                                            <span class="close-overlay"><i class="fa icon-delete"></i></span>
                                        </div>
                                    </td>
                                    <td align="center" class="col-sub">
                                        <a href="javascript:void(0);" onclick="rbt_gift('<?php echo $item->huawei_tone_code; ?>')"><i class="fa icon-gift"></i></a>
                                    </td>
                                    <td align="center" class="col-sub">
                                        <a href="javascript:void(0);" onclick="deleteRBT('<?php echo $rbt['personID']; ?>', '<?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?>');"><i class="fa fa-trash-o"></i></a>                                        
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <h4 class="sub-title">Không tìm thấy bài nhạc chờ nào</h4>
        <?php } ?>  
    </div>
</div>
<?php echo $this->render('/song/_popup_rbt_gift', []); ?>
