<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = yii\helpers\Html::encode("Góp ý báo lỗi");
echo $this->render('/helper/_menu', ['arrMenu' => $arrMenu, 'slug' => $slug]);
?>
<div class="col-md-9 col-sm-9" xmlns="http://www.w3.org/1999/html">

    <div class="mdl-1 mdl-video-nominations left-line">
        <div class="title">Góp ý/báo lỗi </div>

        <div class="mdl-form">
            <?php
            $form = ActiveForm::begin([
                        'action' => '/gop-y-bao-loi',
                        'id' => 'btn_guithongtin',
                        'fieldConfig' => [
                            'template' => "<div class=\"col-md-6 col-xs-8\">
                        {input}</div>\n
                        <div class=\"clearfix\"></div>\n
                        <div class=\"col-md-12\">
                        {error}</div>",
                        ]
            ]);
            ?>
            <div class="form-group">
                <div class="col-md-2 col-xs-4">
                    <span class="text-style-1"> Tiêu đề : </span>
                </div>

                <?= $form->field($model, 'title')->textInput(['maxlength' => 255, 'class' => 'form-control ipt-imuzik'])->label(false) ?>

            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-2 col-xs-4">
                    <span class="text-style-1"> Email : </span>
                </div>

                <?= $form->field($model, 'email')->textInput(['type' => 'email', 'maxlength' => 255, 'class' => 'form-control ipt-imuzik'])->label(false) ?>

            </div>


            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-2 col-xs-4">
                    <span class="text-style-3"> Nội dung : </span>
                </div>
                <?= $form->field($model, 'body')->textarea(['options' => ['rows' => 2, 'cols' => 3], 'class' => 'form-control ipt-imuzik'])->label(false) ?>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="control-label col-md-2  col-xs-4" for="pwd"><span class="text-style-1"> Mã xác thực: </span></div>

                <?=
                $form->field($model, 'captcha')->widget(Captcha::className(), [
                    'template' => '{input} {image}',
                    'options' => [
                        "class" => 'form-control ipt-imuzik vtmessages-captcha',
                        "autocomplete" => "off",
                        "placeholder" => Html::encode(Yii::t('backend', "Captcha")),
                        "style" => "float:left; width: 50%;"
                    ],
                ])->label(false);
                ?>

            </div>
            <div class="clearfix"></div>
            <div class="form-group"><br>
                    <div class="col-md-2">
                        &nbsp;
                    </div>
                    <div class="col-md-6">
                        <?=
                        (Yii::$app->user->identity) ?
                                Html::submitButton(Yii::t('frontend', 'GỬI THÔNG TIN'), ['class' => 'btn btn-imuzik', 'value' => 'btn_guithongtin', 'name' => 'send']) :
                                Html::button(Yii::t('frontend', 'GỬI THÔNG TIN'), ['class' => 'user btn btn-imuzik', 'value' => 'btn_guithongtin', 'name' => 'send'])
                        ?>
                        <p></p>
                    </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>