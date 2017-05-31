<?php echo frontend\Widgets\user\AvatarWidget::widget(); ?>
<?php
echo $this->render('/account/_menu', []);

use yii\helpers\Html;
$this->title = 'Cài đặt nhạc chờ';
?>
<div class="col-md-9 col-sm-9">
    <div class="mdl-1 mdl-form">
        <div class="title">
            <span class="txt"> Cài đặt bài nhạc chờ</span>            
        </div>  
        <div class="time-line">
            <h4 class="sub-title">Nhóm <span class="hightlight"><?php echo Html::encode($_GET['name']); ?></span></h4>
            <div class="time-row stage-2">
                <div>Số điện thoại</div>
                <div><span class="edge-1"></span> Cài đặt nhạc chờ <span class="edge-2"></span></div>
                <div>Cài đặt thời gian </div>
            </div>
        </div>

        <span class="form-inline">
            <table class="table table-hover table-edit">
                <tbody>
                    <tr>
                        <th width="27%" class="first-col">
                            <strong class="song-name">Bài nhạc chờ</strong> 
                        </th>
                        <th width="40%">
                            <strong class="song-name">Ca sĩ</strong> 
                        </th>
                        <th width="10%">
                            <strong class="song-name">Hết hạn</strong> 
                        </th>
                        <th class="last-col"><div class="control-2 pull-right"><input type="checkbox" name="rbt-check-all"></div></th>
                </tr>
                <?php foreach ($lt as $t) { ?>
                    <?php
                    $check = '';
                    if (in_array($t['toneCode'], $ltcode)) {
                        $check = 'checked="checked"';
                    }
                    ?>
                    <tr>
                        <td class="first-col">
                            <?php echo Html::encode($t['toneName']); ?>
                        </td>
                        <td>
                            <?php echo Html::encode($t['singerName']); ?>
                        </td>
                        <td>
                            <span class="horizontal-line"><?php echo date('d-m-Y H:i:s', strtotime($t['availableDateTime'])); ?></span>
                        </td>
                        <td class="last-col">
                            <div class="control-2 pull-right">                            
                                <input type="checkbox" <?php echo $check; ?> name="rbt-list" value="<?php echo $t['toneID']; ?>">
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>  
        </span>
        <div class="form-group ">
            <?php
            $urlBack = '/cai-dat-nhom-nhac-cho/' . $gid . '?name=' . Html::encode($_GET['name']);
            if ($gid == 'default') {
                $urlBack = '/tao-moi-nhom-nhac-cho';
            }
            ?>
            <a href="<?php echo $urlBack; ?>" class="btn btn-cancel">QUAY LẠI</a>
            <span>&nbsp;&nbsp;</span>
            <a href="#" class="btn btn-imuzik" onclick="updateSettingRbt('<?php echo $gid; ?>', '<?php echo Html::encode($_GET['name']); ?>');">TIẾP THEO</a>
        </div>

    </div>
</div>