function showTime(id) {
    $('div.input-date').hide();
    $('div#timeType_' + id).show();
}

function setTime(id, format) {
    $('#' + id).datetimepicker({
        format: format
    });
}

function changeProfile() {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var link = $('#changeImageProfile').attr('action');
    var data = new FormData();
    data.append('ProfileForm[image_path]', $('#avatarImage')[0].files[0]);
    data.append('ProfileForm[theme_path]', $('#themeImage')[0].files[0]);
    data.append('_csrf', csrfToken);
    $('.spinner-bar').show();
    isPjaxLoading = true;
    $.ajax({
        type: "POST",
        data: data,
        url: link,
        container: '#ajaxBodyContent',
        contentType: false,
        processData: false,
        cache: false,
        "timeout": false,
        "scrollTo": 0
    });
}

/**
 * KhanhNQ16
 */
function loadProfile() {
    reloadLeftMenu = true;
    isPjaxLoading = true;
    $.pjax({
        type: "GET",
        url: "/profile",
        container: '#ajaxBodyContent',
        "timeout": false,
        "scrollTo": 0
    });
}

/**
 * KhanhNQ16
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
/**
 * KhanhNQ16
 */
function addGroup() {
    var gname = $('#group-name').val();
    if (gname == undefined || gname == "") {
        $('#message-content').html('Tên nhóm không được để trống!');
        $('#message-box').modal('show');
        return false;
    }
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('.spinner-bar').show();
    isPjaxLoading = true;
    $.pjax({
        type: "POST",
        url: "/group",
        data: {
            gname: gname,
            _csrf: csrfToken,
            action: "add"
        },
        container: '#ajaxBodyContent',
        "timeout": false,
        "scrollTo": 0
    });

}

function confirmRemoveGroup(gid, gname) {
    $('#remove-group-name').html(gname);
    $('#remove-group-id').val(gid);
}

/**
 * KhanhNQ16
 */
function removeGroup() {
    var gid = $('#remove-group-id').val();
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('.spinner-bar').show();
    isPjaxLoading = true;
    $.pjax({
        type: "POST",
        url: "/group",
        data: {
            gid: gid,
            _csrf: csrfToken,
            action: "remove"
        },
        container: '#ajaxBodyContent',
        "timeout": false,
        "scrollTo": 0
    });

}


/**
 * KhanhNQ16
 */
function addMember() {
    var gid = $('#group-id').val();
    var mnumber = $('#member-number').val();
    var mname = $('#member-name').val();
    if (mnumber == undefined || mnumber == "") {
        $('#message-content').html('Số điện thoại không được để trống!');
        $('#message-box').modal('show');
        return false;
    }
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('.spinner-bar').show();
    isPjaxLoading = true;
    $.pjax({
        type: "POST",
        url: "/edit-group/" + gid,
        data: {
            gid: gid,
            mnumber: mnumber,
            mname: mname,
            action: "add",
            _csrf: csrfToken
        },
        container: '#ajaxBodyContent',
        "timeout": false,
        "scrollTo": 0
    });

}

function removeMember(gid, mnumber) {
    confirm('Bạn có chắc muốn xóa số điện thoại "' + mnumber + '"?', function() {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: "POST",
            url: "/cai-dat-nhom-nhac-cho/" + gid,
            data: {
                gid: gid,
                mnumber: mnumber,
                action: "remove",
                _csrf: csrfToken
            },
            success: function(data) {
                $('tr#' + mnumber).hide();
            },
            "timeout": false
        });
    });
}

/**
 * KhanhNQ16
 */
function copyrbt() {
    var msisdn = $('#msisdn').val();
    if (msisdn == undefined || msisdn == "") {
        $('#message-content').html("Bạn phải nhập số điện thoại!");
        $('#message-box').modal('show');
        return false;
    }

    if (!isNumber(msisdn)) {
        $('#message-content').html("Số điện thoại không đúng!");
        $('#message-box').modal('show');
        return false;
    }
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('.spinner-bar').show();
    isPjaxLoading = true;
    $.pjax({
        type: "POST",
        url: "/copyrbt",
        data: {
            msisdn: msisdn,
            _csrf: csrfToken
        },
        container: '#ajaxBodyContent',
        "timeout": false,
        "scrollTo": 0
    });
}

/**
 * KhanhNQ16
 */
function updateSettingRbt(gid, name) {
    var rbts = [];
    $('input[name="rbt-list"]:checked').each(function() {
        rbts.push(this.value);
    });
    if (rbts.length < 1) {
        alert("Bạn chưa chọn bài nhạc chờ nào!");
        return false;
    }
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "POST",
        url: "/cai-dat-cuoc-goi-den/" + gid,
        data: {
            _csrf: csrfToken,
            rbts: rbts,
            name: name
        },
        "timeout": false,
        beforeSend: function(xhr) {
            $('.col-md-9').html('<div class="loading" style="z-index:1100;text-align: center;"><img class="rotate" width="90" height="90" alt="" src="/images/loader.gif"></div>');
        },
        success: function(data) {
            $('.col-md-9').html(data);
            var step = 1;
            $('#datepicker-from-6').datetimepicker({
                format: 'Y-m-d H:i',
                step: step
            });
            $('#datepicker-to-6').datetimepicker({
                format: 'Y-m-d H:i',
                step: step
            });
            $('#datepicker-from-2').datetimepicker({
                datepicker: false,
                step: step,
                format: 'H:i'
            });
            $('#datepicker-to-2').datetimepicker({
                datepicker: false,
                step: step,
                format: 'H:i'
            });
            $('#datepicker-from-5').datetimepicker({
                timepicker: false,
                step: step,
                format: 'd-m'
            });
            $('#datepicker-to-5').datetimepicker({
                timepicker: false,
                step: step,
                format: 'd-m'
            });
        }
    });
}

function updateSettingTime(gid) {
    var timeType = 1;
    var startTime = "";
    var endTime = "";
    $('input[name="optradio"]:checked').each(function() {
        timeType = this.id;
    });
    if (timeType != 1) {
        startTime = $('#datepicker-from-' + timeType).val().trim();
        endTime = $('#datepicker-to-' + timeType).val().trim();
        if (startTime == undefined || startTime == "") {
            alert("Bạn phải chọn thời điểm bắt đầu!");
            $('#datepicker-from-' + timeType).focus();
            return false;
        }
        if (endTime == undefined || endTime == "") {
            alert("Bạn phải chọn thời điểm kết thúc!");
            $('#datepicker-to-' + timeType).focus();
            return false;
        }
    }
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "POST",
        url: "/finish-setting/" + gid,
        data: {
            _csrf: csrfToken,
            gid: gid,
            timeType: timeType,
            startTime: startTime,
            endTime: endTime
        },
        success: function(data_json) {
            var data = JSON.parse(data_json);
            if (data.errorCode == 0) {
                location.href = '/tao-moi-nhom-nhac-cho';
            } else {
                alert(data.message);
            }
        }
    });
}

/**
 * KhanhNQ16
 * @param event
 */
function registerCrbt(userId) {
    if (userId == 'rbt_member_id') {    // huync2: lay id tu popup confirm
        userId = $('#rbt_member_id').val();
    }
    if (parseInt(userId) > 0) {
        var link = $('#rbt-service-form').attr('action')
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var data = new FormData();
        data.append('action', $('#action').val());
        data.append('_csrf', csrfToken);

        $('.spinner-bar').show();
        isPjaxLoading = true;
        $.pjax({
            type: "POST",
            data: data,
            url: link,
            container: '#ajaxBodyContent',
            contentType: false,
            processData: false,
            cache: false,
            timeout: false,
            scrollTo: 0
        });
    } else {
        $('#a-login').click();
    }
    return false;
}

/**
 * huync2: confirm register rbt
 * @param name
 * @param userId
 */
function confirmRegisterCrbt(name, userId) {
    $('#rbt-register-name').html(name);
    $('#rbt_member_id').val(userId);
}


function confirmUnregisVip(itemid) {
    $('#confirm-un-vip-name').html($('#' + itemid + '-sub-name').html());
    $('#span-un-vip-name').html($('#' + itemid + '-sub-name').html());
    $('#sub-vip-id').val(itemid);
    $('#confirm-un-register-vip').modal('show');
}