<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
?>
<?php
$form = ActiveForm::begin([
            'enableClientValidation' => false,
            'action' => '/site/login',
            'options' => [
                'class' => 'form-horizontal modal-content animate'
            ]
        ]);
?>
<!--<form class="form-horizontal modal-content animate" method="post">-->
<h2>Đăng nhập</h2>
<p>Quý khách vui lòng hoàn thành các thông tin sau để đăng nhập</p>
<div class="form-group">
    <label class="control-label col-sm-3" for="email">Số điện thoại (Viettel):</label>
    <div class="col-sm-9">
        <?= $form->field($model, 'username')->textInput(['type' => 'tel', 'autofocus' => 'autofocus', 'placeholder' => "Số điện thoại", 'class' => 'form-control'])->label(false) ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Mật khẩu:</label>
    <div class="col-sm-9">
        <?=
        $form->field($model, 'password')->passwordInput([
            'placeholder' => "Mật khẩu",
            'class' => 'form-control',
                //'onkeypress' => 'submitLogin(event);',
        ])->label(false)
        ?>
    </div>
</div>
<div class="form-group" <?php echo $countFail > 3 ? '' : 'style="display: none;"' ?> id="form-group-captcha">
    <label class="control-label col-sm-3" for="pwd">Mã xác thực:</label>
    <div class="col-sm-9">
        <?=
        $form->field($model, 'captcha')->widget(Captcha::className(), [
            'template' => '{input} {image}',
            'options' => [
                // 'onkeypress' => 'submitLogin(event);',
                "class" => 'form-control form-control-solid placeholder-no-fix',
                "autocomplete" => "off",
                "placeholder" => Html::encode(Yii::t('backend', "Captcha")),
                "style" => "float:left; width: 50%;"
            ],
        ])->label(false);
        ?>
    </div>
</div>
<p><em>Soạn tin MK gửi 1221 (miễn phí) để lấy mật khẩu.</em></p>
<div class="form-group">
    <div class="col-sm-12 text-right">
        <span class="btn" onclick="$('#id01').html('');
                hideModal('id01');">Hủy bỏ</span>
        <button type="submit" id="login-submit-form" class="btn btn-imuzik">Đăng nhập</button>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$js = <<<JS
       $('#loginform-username').focus();
JS;
$this->registerJs($js, $this::POS_READY);
?>
