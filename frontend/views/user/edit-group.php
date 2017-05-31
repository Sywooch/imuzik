<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php
echo $this->render('/account/_menu', []);

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Html::encode($g['groupName']);
?>
<div class="col-md-9 col-sm-9">
    <div class="mdl-1 mdl-form">
        <div class="title">
            <span class="txt"> Cài đặt số điện thoại</span>            
        </div>  
        <div class="time-line">
            <h4 class="sub-title">Nhóm <span class="hightlight"><?php echo Html::encode($g['groupName']); ?></span></h4>
            <div class="time-row stage-1">
                <div>Số điện thoại</div>
                <div><span class="edge-1"></span> Cài đặt nhạc chờ <span class="edge-2"></span></div>
                <div>Cài đặt thời gian </div>
            </div>
        </div>
        <table class="table table-hover table-edit">
            <tbody>
                <tr>
                    <th width="27%" class="first-col">
                        <strong class="song-name">Số điện thoại</strong> 
                    </th>
                    <th width="40%">
                        <strong class="song-name">Tên thuê bao</strong> 
                    </th>
                    <th class="last-col">
                    </th>
                </tr>
                <?php if ($ginfo && sizeof($ginfo)) { ?>
                    <?php foreach ($ginfo as $mem) { ?>
                        <tr id="<?php echo yii\helpers\Html::encode($mem['memberNumber']); ?>">
                            <td class="first-col">
                                <?php echo yii\helpers\Html::encode($mem['memberNumber']); ?>
                            </td>
                            <td>
                                <?php echo ($mem['memberName'] != 'no name') ? yii\helpers\Html::encode($mem['memberName']) : ''; ?>
                            </td>
                            <td class="last-col">
                                <div class="control-2 pull-right">
                                    <a href="javascript:void(0);" onclick="removeMember('<?php echo $g['groupCode']; ?>', '<?php echo yii\helpers\Html::encode($mem['memberNumber']); ?>');">Xóa</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3">Không có thành viên nào trong nhóm</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>  

        <div class="form-group">
            <?php
            $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'form-inline'
                        ]
            ]);
            ?>
            <input type="tel" class="form-control ipt-imuzik" placeholder="Số điện thoại" style="width: 280px !important;" name="mnumber">
            <input type="text" class="form-control ipt-imuzik" placeholder="Tên" style="width: 280px !important;" name="mname">
            <input type="hidden" value="add" name="action"/>
            <button type="submit" class="btn btn-imuzik">THÊM</button>
            <?php ActiveForm::end(); ?>  
        </div>

        <div class="form-group ">
            <a href="/tao-moi-nhom-nhac-cho" class="btn btn-cancel">QUAY LẠI</a>
            <span>&nbsp;&nbsp;</span>
            <a href="/them-moi-cai-dat-cuoc-goi-den/<?php echo $g['groupCode']; ?>?name=<?php echo Html::encode($g['groupName']); ?>" class="btn btn-imuzik">TIẾP THEO</a>
        </div>
    </div>
</div>