<div class="mdl-1 mdl-form">
    <div class="title">
        <span class="txt"> Cài đặt thời gian</span>            
    </div>  
    <div class="time-line">
        <h4 class="sub-title">Nhóm <span class="hightlight"><?php echo yii\helpers\Html::encode($gName); ?></span></h4>
        <div class="time-row stage-3">
            <div>Số điện thoại</div>
            <div><span class="edge-1"></span> Cài đặt nhạc chờ <span class="edge-2"></span></div>
            <div>Cài đặt thời gian </div>
        </div>
    </div>

    <div class="form-group">
        <div class="radio radio-2">
            <label><input type="radio" id='1' onclick="showTime(1);" name="optradio" <?php echo ($st['timeType'] == 1) ? 'checked="checked"' : ''; ?>>Vĩnh viễn</label>
        </div>
    </div>

    <div class="form-group">
        <!--<div class="radio radio-2 has-input"> user with js-->
        <div class="radio radio-2">
            <label><input type="radio" id='6' onclick="showTime(6);" name="optradio" <?php echo ($st['timeType'] == 6) ? 'checked="checked"' : ''; ?>>Trong khoản thời gian xác định</label>
        </div>
        <div id='timeType_6' class="input-date" <?php echo $st['timeType'] != 6 ? 'style="display:none"' : ''; ?>>
            <input class="form-control" type="text" id="datepicker-from-6" readonly="readonly"
                   value="<?php echo ($st['timeType'] == 6) ? date('Y-m-d H:i', strtotime($st['startTime'])) : ''; ?>">	
            <span class="setting-mobile">đến</span>  
            <input class="form-control" type="text" id="datepicker-to-6" readonly="readonly"
                   value="<?php echo ($st['timeType'] == 6) ? date('Y-m-d H:i', strtotime($st['endTime'])) : ''; ?>">
        </div>				
    </div>

    <div class="form-group">
        <div class="radio radio-2">
            <label><input type="radio" id='2' onclick="showTime(2);" name="optradio" <?php echo ($st['timeType'] == 2) ? 'checked="checked"' : ''; ?>>Định kỳ hằng ngày</label>
        </div>
        <div id='timeType_2' class="input-date" <?php echo $st['timeType'] != 2 ? 'style="display:none"' : ''; ?>>
            <input class="form-control short" type="text" id="datepicker-from-2" readonly="readonly"
                   value="<?php echo ($st['timeType'] == 2) ? date('H:i', strtotime($st['startTime'])) : ''; ?>">	
            &nbsp;đến&nbsp;  
            <input class="form-control short" type="text" id="datepicker-to-2" readonly="readonly"
                   value="<?php echo ($st['timeType'] == 2) ? date('H:i', strtotime($st['endTime'])) : ''; ?>">
        </div>
    </div>

    <div class="form-group">	
        <div class="radio radio-2">
            <label><input type="radio" id='4' onclick="showTime(4);" name="optradio" <?php echo ($st['timeType'] == 4) ? 'checked="checked"' : ''; ?>>Định kỳ hằng tháng</label>
        </div>
        <div id='timeType_4' class="input-date" <?php echo $st['timeType'] != 4 ? 'style="display:none"' : ''; ?>>
            <select class="form-control short" id="datepicker-from-4">
                <?php for ($i = 1; $i < 32; $i ++) { ?>
                    <option value="<?php echo $i; ?>" <?php echo date('d', strtotime($st['startTime'])) == $i ? 'selected="selected"' : ''; ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
            &nbsp;đến ngày&nbsp;
            <select class="form-control short" id="datepicker-to-4">
                <?php for ($i = 1; $i < 32; $i ++) { ?>
                    <option value="<?php echo $i; ?>" <?php echo date('d', strtotime($st['endTime'])) == $i ? 'selected="selected"' : ''; ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>    

    <div class="form-group">	
        <div class="radio radio-2">
            <label><input type="radio" id='5' onclick="showTime(5);" name="optradio" <?php echo ($st['timeType'] == 5) ? 'checked="checked"' : ''; ?>>Định kỳ hằng năm</label>
        </div>
        <div id='timeType_5' class="input-date" <?php echo $st['timeType'] != 5 ? 'style="display:none"' : ''; ?>>
            <input class="form-control short" type="text" id="datepicker-from-5" readonly="readonly"
                   value="<?php echo ($st['timeType'] == 5) ? date('d-m', strtotime($st['startTime'])) : ''; ?>">	
            &nbsp;đến tháng&nbsp; 
            <input class="form-control short" type="text" id="datepicker-to-5" readonly="readonly"
                   value="<?php echo ($st['timeType'] == 5) ? date('d-m', strtotime($st['endTime'])) : ''; ?>">
        </div>
    </div>

    <div class="form-group">
        <a href="/them-moi-cai-dat-cuoc-goi-den/<?php echo $gid; ?>?name=<?php echo yii\helpers\Html::encode($gName); ?>" class="btn btn-cancel">QUAY LẠI</a>
        <span>&nbsp;&nbsp;</span>
        <a href="javascript:void(0);" class="btn btn-imuzik" onclick="updateSettingTime('<?php echo $gid; ?>')">HOÀN THÀNH</a>
    </div>

</div>