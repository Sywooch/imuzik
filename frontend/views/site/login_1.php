<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form-horizontal modal-content animate']); ?>

<h2>Đăng nhập</h2>
<p>Quý khách vui lòng hoàn thành các thông tin sau để đăng nhập</p>

<div class="form-group">
    <label class="control-label col-sm-3" for="username">Số điện thoại(Viettel):</label>
    <div class="col-sm-9">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => "Số điện thoại", 'class' => 'form-control'])->label(false) ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3" for="password">Mật khẩu:</label>
    <div class="col-sm-9">
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Mật khẩu", 'class' => 'form-control'])->label(false) ?>
    </div>
</div>

<div class="form-group">
    <?=
    $form->field($model, 'captcha')->widget(Captcha::className(), [
        'template' => '{input} {image}',
        'options' => [
            "class" => 'form-control form-control-solid placeholder-no-fix',
            "autocomplete" => "off",
            "placeholder" => Html::encode(Yii::t('backend', "Captcha")),
            "style" => "float:left; width: 50%;"
        ],
    ])->label(false);
    ?>
</div>

<p><em>Soạn tin MK gửi 9219 (miễn phí) để lấy mật khẩu.</em></p>
<div class="form-group">
    <div class="col-sm-12 text-right">
        <span class="btn" onClick="document.getElementById('id01').style.display = 'none';">Hủy bỏ</span>
        <button type="submit" class="btn btn-imuzik">Đăng nhập</button>
    </div>
</div>
<?php ActiveForm::end(); ?>
