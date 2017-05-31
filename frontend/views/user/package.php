<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php echo $this->render('/account/_menu', []); ?>
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\ActiveForm;
$this->title = 'Dịch vụ nhạc chờ';
?>
<div class="col-md-9 col-sm-9">
    <div class="mdl-1 mdl-form">
        <div class="title">
            <p class="txt"> Danh sách gói cước</p>            
        </div> 
        <p><br></p>
        <h4 class="sub-title">I. Gói tháng</h4>
        <p></p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="last-col">
                        <?php $form = ActiveForm::begin(['id' => 'frm_monthly', 'action' => '/user/package']); ?> 
                        <input type="hidden" name="brand_id" value="1"/>
                        <span class="text">1. Thuê bao thông thường <strong>9.000 đ/tháng</strong></span>                        
                        <?php if ($isRegister && $brandID == 1) { ?>   
                            <input type="button" class="btn btn-imuzik control-right button-error" onclick="submitForm('frm_monthly', 'Bạn có chắc muốn hủy gói cước tháng?');" value="Hủy"/>
                            <input type="hidden" name="action" value="unregister"/>
                        <?php } else if ($isRegister && $brandID != 1) { ?>
                            <p class="btn btn-imuzik control-right" onclick="alert('Để đăng ký, bạn phải hủy gói cước hiện tại!');
                                    return;">Đăng ký</p>
                           <?php } else if (!$isRegister) { ?>     
                            <input type="button" class="btn btn-imuzik control-right" onclick="submitForm('frm_monthly', 'Bạn có chắc muốn đăng ký cước tháng?');" value="Đăng ký"/>
                            <input type="hidden" name="action" value="register"/>
                        <?php } ?>
                        <?php ActiveForm::end(); ?>      
                    </td>
                </tr>
                <tr>
                    <td class="last-col">
                        <?php $form = ActiveForm::begin(['id' => 'frm_highschool', 'action' => '/user/package']); ?>
                        <input type="hidden" name="brand_id" value="77"/>
                        <span class="text">2. Thuê bao highschool <strong>4.500 đ/tháng</strong></span>
                        <?php if ($isRegister && $brandID == 77) { ?>    
                            <input type="button" class="btn btn-imuzik control-right button-error" onclick="submitForm('frm_highschool', 'Bạn có chắc muốn hủy gói cước highschool?');" value="Hủy"/>
                            <input type="hidden" name="action" value="unregister"/>
                        <?php } else if ($isRegister && $brandID != 77) { ?>
                            <p class="btn btn-imuzik control-right" onclick="alert('Để đăng ký, bạn phải hủy gói cước hiện tại!');
                                    return;">Đăng ký</p>
                           <?php } else if (!$isRegister) { ?>   
                            <input type="button" class="btn btn-imuzik control-right" onclick="submitForm('frm_highschool', 'Bạn có chắc muốn đăng ký cước highschool?');" value="Đăng ký"/>
                            <input type="hidden" name="action" value="register"/>
                        <?php } ?>
                        <?php ActiveForm::end(); ?>      
                    </td>
                </tr>
                <tr>
                    <td class="last-col">
                        <span class="text">3. Thuê bao homephone <strong>6.000 đ/tháng</strong></span>    
                    </td>
                </tr>
                <tr>
                    <td class="last-col">
                        <em>* Gia hạn theo tháng</em>
                    </td>
                </tr>
            </tbody>
        </table>

        <h4 class="sub-title">II. Gói tuần</h4>
        <p></p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="last-col">
                        <?php $form = ActiveForm::begin(['id' => 'frm_weekly', 'action' => '/user/package']); ?>
                        <input type="hidden" name="brand_id" value="86"/>
                        <span class="text">1. Thuê bao thông thường <strong>5.000 đ/tuần</strong></span>
                        <?php if ($isRegister && $brandID == 86) { ?>  
                            <input type="button" class="btn btn-imuzik control-right button-error" onclick="submitForm('frm_weekly', 'Bạn có chắc muốn hủy gói cước tuần?');" value="Hủy"/>
                            <input type="hidden" name="action" value="unregister"/>
                        <?php } else if ($isRegister && $brandID != 86) { ?>
                            <p class="btn btn-imuzik control-right" onclick="alert('Để đăng ký, bạn phải hủy gói cước hiện tại!');
                                    return;">Đăng ký</p>
                           <?php } else if (!$isRegister) { ?>  
                            <input type="button" class="btn btn-imuzik control-right" onclick="submitForm('frm_weekly', 'Bạn có chắc muốn đăng ký gói cước tuần?');" value="Đăng ký"/>
                            <input type="hidden" name="action" value="register"/>
                        <?php } ?>
                        <?php ActiveForm::end(); ?>
                    </td>
                </tr>
                <tr>
                    <td class="last-col">
                        <em>* Gia hạn theo tuần</em>
                    </td>
                </tr>
            </tbody>
        </table> 

        <h4 class="sub-title">III. Gói ngày</h4>
        <p></p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="last-col">
                        <?php $form = ActiveForm::begin(['id' => 'frm_daily', 'action' => '/user/package']); ?>
                        <input type="hidden" name="brand_id" value="75"/>
                        <span class="text">1. Thuê bao thông thường <strong>1.000 đ/ngày</strong></span>
                        <?php if ($isRegister && $brandID == 75) { ?>    
                            <input type="button" class="btn btn-imuzik control-right button-error" onclick="submitForm('frm_daily', 'Bạn có chắc muốn hủy gói cước ngày?');" value="Hủy"/>
                            <input type="hidden" name="action" value="unregister"/>
                        <?php } else if ($isRegister && $brandID != 75) { ?>
                            <p class="btn btn-imuzik control-right" onclick="alert('Để đăng ký, bạn phải hủy gói cước hiện tại!');
                                    return;">Đăng ký</p>
                           <?php } else if (!$isRegister) { ?>       
                            <input type="button" class="btn btn-imuzik control-right" onclick="submitForm('frm_daily', 'Bạn có chắc muốn đăng ký gói cước ngày?');" value="Đăng ký"/>
                            <input type="hidden" name="action" value="register"/>
                        <?php } ?>
                        <?php ActiveForm::end(); ?>
                    </td>
                </tr>
                <tr>
                    <td class="last-col">
                        <em>* Gia hạn theo ngày</em>
                    </td>
                </tr>
            </tbody>
        </table>                             
    </div>
</div>