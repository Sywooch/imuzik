var crbtStatus = 0;
$(function() {
    $(':checkbox[name=rbt-check-all]').click(function() {
        $(':checkbox[name=rbt-list]').prop('checked', this.checked);
    });
    $(':checkbox[name=rbt-list]').click(function() {
        if (!this.checked) {
            $(':checkbox[name=rbt-check-all]').prop('checked', false);
        }
    });
    $(':checkbox[name=rbt-list]').click(function() {
        if ($(':checkbox[name=rbt-list]:checked').length == $(':checkbox[name=rbt-list]').length) {
            $(':checkbox[name=rbt-check-all]').prop('checked', true);
        }
    });

    $('.rbt-select').click(function() {
        var cbox = $(this).parent().parent().find(':checkbox[name=rbt-list]').first();
        if (cbox.length > 0) {
            if (cbox[0].checked) {
                cbox[0].checked = false;
                $(':checkbox[name=rbt-check-all]').prop('checked', false);
            } else {
                cbox[0].checked = true;
                if ($(':checkbox[name=rbt-list]:checked').length == $(':checkbox[name=rbt-list]').length) {
                    $(':checkbox[name=rbt-check-all]').prop('checked', true);
                }
            }
        }
    });
});

function confirmRemoveRbt(name, personid, tonecode) {
    $('#rbt-remove-name').html(name + ' - MS:' + tonecode);
    $('#rbt-remove-personid').val(personid);
    $('#rbt-remove-tonecode').val(tonecode);
    $('#rbt-remove-tonename').val(name);
    $('#rbt-down-reg-name').html(name + ' - MS:' + tonecode);
    $('#rbt-down-reg-tonecode').val(tonecode);
    $('#rbt-down-reg-tonename').val(name);
    $('#rbt-down-reg-toneid').val(toneid);
}

function deleteRbt() {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return;
    } else {
        var personID = $('#rbt-remove-personid').val();
        var toneCode = $('#rbt-remove-tonecode').val();
        var toneName = $('#rbt-remove-tonename').val();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        isPjaxLoading = true;
        $.pjax({
            type: "POST",
            url: "/profile",
            container: '#ajaxBodyContent',
            data: {
                _csrf: csrfToken,
                personID: personID,
                toneCode: toneCode,
                toneName: toneName,
                action: "remove"
            },
            "timeout": false,
            "scrollTo": 0
        });
    }
}

function presentOneRbt() {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return;
    } else {
        checkCrbtStatus(function(data) {
            crbtStatus = data;
        });
        if (parseInt(crbtStatus) == -1) {
            alert('Hệ thống đang bận, vui lòng thử lại sau!');
            return;
        }
        if (parseInt(crbtStatus) != 1) {
            $('#rbt_gift_item').modal('hide');
            $('#id03').modal('show');
            return;
        }
        var code = $('#rbt_item_code').val();
        var rbts = [];
        rbts.push(code);
        presentRbt(rbts);
    }
}

function presentRbtAll() {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return false;
    } else {
        checkCrbtStatus(function(data) {
            crbtStatus = data;
        });
        if (parseInt(crbtStatus) == -1) {
            alert('Hệ thống đang bận, vui lòng thử lại sau!');
            return;
        }
        if (parseInt(crbtStatus) != 1) {
            $('#id03').modal('show');
            return;
        }
        var rbts = [];
        $('input[name="rbt-list"]:checked').each(function() {
            rbts.push(this.value);
        });
        if (!rbts.length) {
            alert('Bạn chưa chọn bài hát nào!');
            return false;
        } else {
            presentRbt(rbts);
        }
    }
}

function presentRbt(toneCode) {
    var number = $.trim($('#present-number-input').val());
    if (number != '') {
        confirm('Bạn có chắc muốn tặng nhạc chờ cho thuê bao ' + htmlEncode(number) + '?', function() {
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                type: "POST",
                url: "/user/present-rbt",
                data: {
                    _csrf: csrfToken,
                    phonenumber: number,
                    toneCode: toneCode
                },
                success: function(data) {
                    if (data == 'Bạn phải nhập vào số điện thoại Viettel!') {
                        if (!detectSafari()) {
                            $('#present-number-input').focus();
                        }
                    }
                    $('#present-number-input').val('');
                    hideModal('rbt_gift_item');
                    alert(data);
                },
                error: function(request, status, err) {
                    alert('Tặng nhạc chờ không thành công');
                }
            });
        });
    } else {
        if (!detectSafari()) {
            $('#present-number-input').focus();
        }
        alert('Bạn phải nhập vào số điện thoại Viettel');
        return false;
    }
}

function crbtRegister(brand) {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return;
    } else {
        confirm('Bạn có chắc muốn đăng ký dịch vụ nhạc chờ?', function() {
            $.ajax({
                type: "POST",
                url: "/ajax/register",
                data: {
                    _csrf: $('meta[name="csrf-token"]').attr("content"),
                    brand_id: brand
                },
                success: function(message) {
                    if (message) {
                        alert(message);
                        hideModal('id03');
                    } else {
                        alert('Có lỗi xảy ra, Quý khách thử lại sau ít phút!');
                    }
                }
            });
        });
    }
}

function checkCrbtStatus(callback) {
    $.ajax({
        type: "GET",
        url: "/ajax/crbt",
        async: false,
        success: function(data) {
            callback(data);
        }
    });
}

function checkAction() {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return;
    } else {
        checkCrbtStatus(function(data) {
            crbtStatus = data;
        });
        if (parseInt(crbtStatus) != 1) {
            $('#id03').modal('show');
            return;
        }
    }
}

function downAllRbt() {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return false;
    } else {
        checkCrbtStatus(function(data) {
            crbtStatus = data;
        });
        if (parseInt(crbtStatus) == -1) {
            alert('Hệ thống đang bận, vui lòng thử lại sau!');
            return;
        }
        if (parseInt(crbtStatus) != 1) {
            $('#id03').modal('show');
            return;
        }
        var rbts = [];
        $('input[name="rbt-list"]:checked').each(function() {
            rbts.push(this.value);
        });
        if (!rbts.length) {
            alert('Bạn chưa chọn bài hát nào!');
        } else {
            confirm('Bạn có chắc muốn sao chép?', function() {
                downrbt(rbts);
            });
        }
    }
}

function downOneRbt(code) {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return false;
    } else {
        checkCrbtStatus(function(data) {
            crbtStatus = data;
        });
        if (parseInt(crbtStatus) == -1) {
            alert('Hệ thống đang bận, vui lòng thử lại sau!');
            return;
        }
        if (parseInt(crbtStatus) != 1) {
            $('#id03').modal('show');
            return;
        }
        var rbts = [];
        rbts.push(code);
        confirm('Bạn có chắc muốn tải bài nhạc chờ mã ' + code + '?', function() {
            downrbt(rbts);
        });
        return;
    }
}

function hideModal(id) {
    $('#' + id).modal('hide');
}

function downrbt(toneCode) {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "POST",
        url: "/user/downrbt",
        data: {
            _csrf: csrfToken,
            tonecode: toneCode
        },
        success: function(message) {
            alert(message);
        },
        error: function(request, status, err) {
            alert('Tải nhạc chờ không thành công.');
        }
    });
}

function confirmShareCRBT(link) {
    $('#link-share-rbt').val(link);
}

function deleteRBT(personID, toneCode) {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return;
    } else {
        confirm('Bạn có chắc muốn xóa bài nhạc chờ mã ' + toneCode, function() {
            $.ajax({
                type: "POST",
                url: "/user/del-my-rbt",
                data: {
                    _csrf: csrfToken,
                    personID: personID,
                    toneCode: toneCode
                },
                success: function(message) {
                    $('#' + toneCode).html('');
                    alert(message);
                },
                error: function(request, status, err) {
                    alert('Có lỗi xảy ra, Quý khách vui lòng thử lại sau ít phút!');
                }
            });
        });
        return;
    }
}
