<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php echo $this->render('/account/_menu', []); ?>
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Nhạc chờ cho sđt/nhóm';
?>
<div class="col-md-9 col-sm-9">
    <div class="mdl-1 mdl-form">
        <div class="title">
            <p class="txt"> Nhạc chờ cho SĐT/Nhóm</p>            
        </div>  
        <h4 class="sub-title">Tạo nhóm mới</h4><p></p>
        <div class="form-group">
            <?php
            $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'form-inline'
                        ]
            ]);
            ?>
            <input type="text" name="gname" class="form-control ipt-imuzik" value="">
            <input type="hidden" name="action" value="add"/>
            <button type="submit" class="btn btn-imuzik">TẠO</button>
            <?php ActiveForm::end(); ?>    
        </div>
        <p><br></p>
        <h4 class="sub-title">Danh sách nhóm</h4>
        <p></p>
        <table class="table table-hover table-vertical">
            <tbody>                
                <?php foreach ($st as $s) { ?>
                    <?php if ($s['setType'] == 2 || $s['setType'] == 4) { ?>  
                        <tr>
                            <td width="5%" class="first-col">
                                <a href="/them-moi-cai-dat-cuoc-goi-den/default?name=Nhóm mặc định" class="image-group g-01">
                                    M
                                </a>
                            </td>
                            <td class="last-col">
                                <div class="control pull-right">
                                    <a href="/them-moi-cai-dat-cuoc-goi-den/default?name=Nhóm mặc định">Cài đặt</a>
                                </div>
                                <a class="song-name ellipsis" href="/them-moi-cai-dat-cuoc-goi-den/default?name=Nhóm mặc định">
                                    Nhóm mặc định
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <?php foreach ($gr as $g) { ?>
                    <?php $urlEdit = '/them-moi-cai-dat-cuoc-goi-den/' . $g['groupCode'] . '?name=' . Html::encode($g['groupName']); ?>
                    <tr>
                        <td width="5%" class="first-col">
                            <a href="<?php echo $urlEdit; ?>" class="image-group g-0<?php echo rand(2, 7); ?>">
                                <?php echo strtoupper(substr($g['groupName'], 0, 1)); ?>
                            </a>
                        </td>
                        <td class="last-col">
                            <div class="control pull-right">
                                <a href="<?php echo $urlEdit; ?>">Cài đặt</a>
                                <a href="/cai-dat-nhom-nhac-cho/<?php echo $g['groupCode']; ?>">Sửa</a>
                                <?php
                                $form = ActiveForm::begin([
                                            'id' => 'frm-group-delete-' . $g['groupCode'],
                                            'options' => [
                                                'class' => 'group-form-delete'
                                            ]
                                ]);
                                ?> 
                                <input type="hidden" name="action" value="remove"/>
                                <input type="hidden" name="gid" value="<?php echo Html::encode($g['groupCode']) ?>"/>
                                <a href="javascript:void(0);" onclick="submitForm('frm-group-delete-<?php echo $g['groupCode']; ?>', 'Bạn có chắc muốn xóa nhóm <?php echo Html::encode($g['groupName']); ?> ?');">Xóa</a>
                                <?php ActiveForm::end(); ?>  
                            </div>
                            <a class="song-name ellipsis" href="<?php echo $urlEdit; ?>">
                                <?php echo Html::encode($g['groupName']); ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>  
    </div>
</div>