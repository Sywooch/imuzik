<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php use yii\bootstrap\Html;
use yii\jui\DatePicker;
$this->title = yii\helpers\Html::encode("Thông tin cá nhân");
echo $this->render('/account/_menu', []); ?>

<div class="col-md-9 col-sm-9">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' =>['/account/info'],
        'id'=>'btn_info',
        'fieldConfig'=>[
            'template'=>"<div class=\"col-md-6 col-xs-8\">
                        {input}</div>\n
                        <div class=\"clearfix\"></div>\n
                        <div class=\"col-md-12 \">
                        {error}</div>",
        ]
    ]); ?>
    <div class="mdl-1 mdl-form">
        <div class="title">
            <span href="#" class="txt"> Thông tin cá nhân</span>
        </div>
        <form>
            <div class="form-group">
                <div class="col-md-2 col-xs-4">
                   <span class="text-style-1"> Tên hiển thị : </span>
                </div>
                    <?= $form->field($model, 'fullname')->textInput(['maxlength' => 255,'class'=>'form-control ipt-imuzik'])->label(false) ?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-2 col-xs-4">
                    <span class="text-style-1"> Ngày sinh : </span>
                </div>
                    <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
                        'language' => 'vi',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => [
                            'readonly' => 'readonly',
                            'class' => 'form-control ipt-imuzik',
                        ]
                    ])->label(false) ?>

            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-2 col-xs-4">
                    <span class="text-style-2">Giới tính :</span>
                </div>
                <div class="col-md-6 col-xs-8">
                    <div class="radio">
                        <?= $form->field($model, 'sex')->radioList([1 => 'Nam', 2 => 'Nữ'])->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-2 col-xs-4">
                   <span class="text-style-1"> Đến từ : </span>
                </div>
                    <?= $form->field($model, 'address')->textInput(['class'=>'form-control ipt-imuzik'])->label(false) ?>

            </div>
            <div class="clearfix"></div>
            <div class="form-group"><br>
                <?=  Html::submitButton( Yii::t('frontend', 'LƯU THÔNG TIN'), ['class' => 'btn btn-imuzik','value'=>'btn_thongtin','name'=>'update']) ?>
            </div>
        </form>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
    <p><br></p>
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' =>['/account/change-pass'],
        'id'=>'btn_change_pass',
        'fieldConfig'=>[
            'template'=>"<div class=\"col-md-6 col-xs-8\">
                        {input}</div>\n
                        <div class=\"clearfix\"></div>\n
                        <div class=\"col-md-12 \">
                        {error}</div>",
        ],
    ]); ?>
    <div class="mdl-1 mdl-form">
        <div class="title">
            <span href="#" class="txt"> Đổi mật khẩu</span>
        </div>
        <form>
            <div class="form-group">
                <div class="col-md-3 col-xs-4">
                    <span class="text-style-1">Mật khẩu cũ:</span>
                </div>
                <?= $form->field($modelPass, 'oldpass')->passwordInput(['class'=>'form-control ipt-imuzik'])->label(false)?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-3 col-xs-4">
                    <span class="text-style-1">Mật khẩu mới:</span>
                </div>
                <?= $form->field($modelPass, 'newpass')->passwordInput(['class'=>'form-control ipt-imuzik'])->label(false) ?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-3 col-xs-4">
                    <span class="text-style-2">Xác nhận mật khẩu :</span>
                </div>
                <?= $form->field($modelPass, 'repeatnewpass')->passwordInput(['maxlength' => 255,'class'=>'form-control ipt-imuzik'])->label(false) ?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group"><br>
                <?=  Html::submitButton( Yii::t('frontend', 'ĐỔI MẬT KHẨU'), ['class' => 'btn btn-imuzik','value'=>'btn_doimatkhau','name'=>'update']) ?>
            </div>
        </form>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>
