<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php
echo $this->render('/account/_menu', []);

use yii\bootstrap\ActiveForm;
$this->title = 'Dịch vụ nhạc chờ';
?>
<div class="col-md-9 col-sm-9">
    <div class="mdl-1 mdl-form">
        <div class="title">
            <p class="txt"> Dịch vụ nhạc chờ</p>            
        </div>  
        <div class="item-function">            
            <h4><?php echo Yii::$app->params['crbt_brand_id'][$brandID]['name']; ?></h4>
            <p>Bạn đang <?php echo ($isRegister == 1) ? 'sử dụng' : 'tạm ngưng' ?> <?php echo strtolower(Yii::$app->params['crbt_brand_id'][$brandID]['name']); ?>, <?php echo Yii::$app->params['crbt_brand_id'][$brandID]['price']; ?></p>
        </div>
        <?php if ($isRegister == 1) { ?>
            <div class="item-function">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'frm_pause',
                            'options' => [
                                'class' => 'form-inline'
                            ]
                ]);
                ?>
                <input type="hidden" name="action" value="pause"/>
                <h4>Tạm dừng dịch vụ</h4>
                <p>Tạm ngừng sử dụng dịch vụ, bộ sưu tập nhạc chờ của bạn sẽ luôn được bảo lưu...</p>
                <p>
                    <input type="button" class="btn btn-imuzik" onclick="submitForm('frm_pause', 'Bạn có chắc muốn tạm dừng dịch vụ?');" value="TẠM DỪNG"/>
                </p>
                <?php ActiveForm::end(); ?> 
            </div>
        <?php } else if ($isRegister == 2) { ?>
            <div class="item-function">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'frm_active',
                            'options' => [
                                'class' => 'form-inline'
                            ]
                ]);
                ?>
                <input type="hidden" name="action" value="active"/>
                <h4>Kích hoạt dịch vụ</h4>
                <p>Thay đổi tiếng "tút tút" đơn điệu khi chờ máy bằng các giai điệu bạn và người thân yêu thích. </p>
                <p>
                    <input type="button" class="btn btn-imuzik" onclick="submitForm('frm_active', 'Bạn có chắc muốn kích hoạt dịch vụ?');" value="KÍCH HOẠT"/>
                </p>
                <?php ActiveForm::end(); ?> 
            </div>            
        <?php } ?>
        <?php if ($isRegister) { ?>
            <div class="item-function">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'frm_cancel',
                            'options' => [
                                'class' => 'form-inline'
                            ]
                ]);
                ?>
                <input type="hidden" name="action" value="unregister"/>
                <h4>Hủy dịch vụ</h4>
                <p>Sau khi huỷ dịch vụ 3 ngày, bộ sưu tập nhạc chờ của bạn sẽ bị xoá.</p>
                <p>
                    <input type="button" class="btn btn-imuzik button-error" onclick="submitForm('frm_cancel', 'Bạn có chắc muốn hủy dịch vụ?');" value="HỦY"/>
                </p>   
                <?php ActiveForm::end(); ?> 
            </div>
        <?php } ?>
    </div>
</div>