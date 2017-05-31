<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php echo $this->render('/account/_menu', []); ?>

  	<div class="col-md-9 col-sm-9">

        <div class="mdl-1 mdl-form">
            <div class="title">
              <span class="txt"> Dịch vụ nhạc chờ</span>
            </div>
            <?php
            $form = ActiveForm::begin([
                'action' => '/kich-hoat-huy-dung-dich-vu',
                'options' => [
                    'class' => 'form-inline'
                ]
            ]);
            ?>
<!--            --><?php //if (!$isRegister){?>
            <div class="item-function">
                <h4>Đăng ký dịch vụ</h4>
                    <p> Thay đổi tiếng ‘tút tút’ đơn điệu khi chờ máy bằng các giai điệu bạn và người thân yêu thích. Cước thuê bao: 9000đ /tháng cho di động và 6000đ/tháng cho Homephone. </p>
                <?= Html::submitButton('ĐĂNG KÝ', ['class' => 'btn btn-imuzik','value'=>'register', 'name'=>'submit']) ?>
            </div>
<!--      --><?php //} else { ?>
            <div class="item-function">
            	<h4>Tạm dừng dịch vụ</h4>
                <p>Tạm ngừng sử dụng dịch vụ, bộ sưu tập nhạc chờ của bạn sẽ luôn được bảo lưu...</p>
                <?= Html::submitButton('TẠM DỪNG', ['class' => 'btn btn-imuzik','value'=>'pending', 'name'=>'submit']) ?>
            </div>
            <div class="item-function">
            	<h4>Tạm dừng dịch vụ</h4>
                <p>Tạm ngừng sử dụng dịch vụ, bộ sưu tập nhạc chờ của bạn sẽ luôn được bảo lưu...</p>
                <?= Html::submitButton('HỦY', ['class' => 'btn btn-imuzik','value'=>'unregister', 'name'=>'submit']) ?>
            </div>
        </div>
<!--        --><?php //} ?>
        <?php ActiveForm::end(); ?>
    </div>






