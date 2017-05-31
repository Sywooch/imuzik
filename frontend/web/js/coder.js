var num_login_fail = 0;
$(document).ready(function() {
    window.addEventListener("touchmove", function(e) {
        if ($('.scroll-disable').has($(e.target)).length) {
            e.preventDefault();
        }
    });


    window.addEventListener("touchstart", function(e) {
        if ($('.scroll-disable').has($(e.target)).length) {
            e.preventDefault();
        }
    });

    var user_id = parseInt($('#user_logined').val());
    //upload avatar
    $('#user-avatar-upload').change(function() {
        var file_data = $('#user-avatar-upload').prop('files')[0];
        var form_data = new FormData();
        form_data.append('width', 450);
        form_data.append('height', 450);
        form_data.append('attr', 'avatar_image');
        form_data.append('title', 'Avatar');
        form_data.append('file', file_data);
        form_data.append('_csrf', $('meta[name="csrf-token"]').attr("content"));

        $.ajax({
            url: '/ajax/avatar',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data_json) {
                var data = JSON.parse(data_json);
                if (data.error == 0) {
                    location.href = '/account/info';
                } else {
                    alert(data.message);
                }
            }
        });
    });

    //upload avatar on mobile
    $('#user-avatar-upload-mobile').change(function() {
        var file_data = $('#user-avatar-upload-mobile').prop('files')[0];
        var form_data = new FormData();
        form_data.append('width', 450);
        form_data.append('height', 450);
        form_data.append('attr', 'avatar_image');
        form_data.append('title', 'Avatar');
        form_data.append('file', file_data);
        form_data.append('_csrf', $('meta[name="csrf-token"]').attr("content"));

        $.ajax({
            url: '/ajax/avatar',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function(xhr) {
                $('#user-avatar-image').html('<i class="fa fa-spinner fa-spin avatar-loading"></i>');
            },
            success: function(data_json) {
                var data = JSON.parse(data_json);
                if (data.error == 0) {
                    $('#user-avatar-image').html('<img src="' + data.message + '">');
                } else {
                    $('#user-avatar-image').html('<img src="' + $('#user_avatar').val() + '">');
                    alert(data.message);
                }
            }
        });
    });

    //upload image user
    $('#user-image-upload').change(function() {
        var file_data = $('#user-image-upload').prop('files')[0];
        var form_data = new FormData();
        form_data.append('attr', 'image_path');
        form_data.append('width', 1280);
        form_data.append('height', 600);
        form_data.append('title', 'ảnh nền');
        form_data.append('file', file_data);
        form_data.append('_csrf', $('meta[name="csrf-token"]').attr("content"));

        $.ajax({
            url: '/ajax/avatar',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data_json) {
                var data = JSON.parse(data_json);
                if (data.error == 0) {
                    location.href = '/account/info';
                } else {
                    alert(data.message);
                }
            }
        });
    });

    //fulltrack like
    $('#info-song-fulltrack').on('click', 'span.bg-color-03', function() {
        if (user_id) {
            var song_id = $('#song-fulltrack-id').val();
            $.get("/ajax/song-like?id=" + song_id, function(data) {
                if (parseInt(data) == 1) {
                    $('#info-song-fulltrack span.bg-color-03').html('<i class="fa fa-heart"></i> <span class="txt">Bỏ thích</span>');
                    $('#song-fulltrack-liked').val(1);
                }
                if (parseInt(data) == 2) {
                    $('#info-song-fulltrack span.bg-color-03').html('<i class="fa fa-heart-o"></i> <span class="txt">Thích</span>');
                    $('#song-fulltrack-liked').val(0);
                }
            });
        }
    });

    $('body').on('click', 'div.overlay a.bg-color-03', function() {
        if (user_id) {
            var song_id = $(this).attr('song_id');
            $.get("/ajax/song-like?id=" + song_id, function(data) {
                if (parseInt(data) == 1) {
                    $('div.overlay a#' + song_id).html('<i class="fa fa-heart" title="Bỏ thích"></i>');
                }
                if (parseInt(data) == 2) {
                    $('div.overlay a#' + song_id).html('<i class="fa fa-heart-o" title="Thích"></i>');
                }
            });
        }
    });
    //rbt list
    $('a.huawei_tone_code').on('click', function() {
        var rbt_id = $(this).attr('rbt_id');
        $.get("/song/rbt-detail?id=" + rbt_id, function(html) {
            $('#info-song-fulltrack').html(html);
            //jPlayer
            imuzikPlayer.jPlayer("setMedia", {mp3: $('a.huawei_tone_code').attr('source_url')}).jPlayer("play");
            $('div.row-music').removeClass('select-music');
            $('div#' + rbt_id).addClass('select-music');
        });
        if (IS_MOBILE == 1) {
            $('.jp-play').click();
        }
    });
    //submit form
    $("#id01").on("submit form", function(ev) {
        login();
        ev.preventDefault();
        return false;
    });
    //check login
    $('body').on('click', '.user, .user-login', function() {
        if (!user_id || user_id == undefined) {
            loadLogin();
        }
    });
    // lazy load
    lazyLoadScrollAjax();
});

function loadLogin() {
    $('#id01').html('').modal('show').load('/site/login');
    return false;
}

function registerLogin() {
    hideModal('id02');
    loadLogin();
}

function checkLogin() {
    if (Cookies.get('logined') == undefined) {
        return false;
    }
    return true;
}

function submitLogin(e) {
    if (e.which == 13) {
        login();
    }
}

function giftRbtSubmit(e) {
    if (e.which == 13) {
        presentOneRbt();
    }
}

function rbt_gift(rbtCode) {
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
        $('#rbt_gift_item').modal('show');
        $('#rbt_item_code').val(rbtCode);
        $('.close-overlay, .icon-delete').click();

        $('#rbt_gift_item').on('shown.bs.modal', function() {
            $('#present-number-input').focus();
        });
        return;
    }
}

function logout() {
    location.href = '/logout';
}

function login() {
    var form_data = new FormData();
    form_data.append('_csrf', $('[name="_csrf"]').val());
    form_data.append('LoginForm[username]', $('#loginform-username').val());
    form_data.append('LoginForm[password]', $('#loginform-password').val());
    form_data.append('LoginForm[captcha]', $('#loginform-captcha').val());
    $.ajax({
        url: '/site/login',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data_json) {
            var data = JSON.parse(data_json);

            var countFail = data.countFail;

            if (countFail > 2) {
                $('#form-group-captcha').css('display', 'block');
            } else {
                $('#form-group-captcha').css('display', 'none');
            }

            $('.field-loginform-captcha p').html('');
            $('.field-loginform-username p').html('');
            $('.field-loginform-password p').html('');

            if (data.captcha) {
                $('.field-loginform-captcha p').css({'color': 'red'}).html(data.captcha);
                $('#loginform-captcha-image').click();
            } else if (data.username) {
                $('.field-loginform-username p').css({'color': 'red'}).html(data.username);
                $('#loginform-captcha-image').click();
            } else if (data.password) {
                $('.field-loginform-password p').css({'color': 'red'}).html(data.password);
                $('#loginform-captcha-image').click();
            } else {
                location.reload();
            }
        }
    });
}

function rbtLike() {
    var logined = 0;
    checkLogintatus(function(status) {
        logined = status;
    });
    if (parseInt(logined) != 1) {
        loadLogin();
        return;
    } else {
        var song_id = $('#rbt-id').val();
        $.get("/ajax/rbt-like?id=" + song_id, function(data) {
            if (parseInt(data) == 1) {
                $('a#rbt-like').html('<i class="fa fa-heart"></i> <span class="txt">Bỏ thích</span>');
            }
            if (parseInt(data) == 2) {
                $('a#rbt-like').html('<i class="fa fa-heart-o"></i> <span class="txt">Thích</span>');
            }
        });
    }
}
function uploadAvatar() {
    //upload avatar
    $('#user-avatar-upload').click(function() {
        $.post('/ajax/avatar', {
            _csrf: $('meta[name="csrf-token"]').attr("content"),
            file: $(this).val()
        }, function(message) {
            alert(message);
        });
    });
}
function playFulltrack() {
    imuzikPlayer.jPlayer("setMedia", {mp3: $('#song-fulltrack-path').val()}).jPlayer("play");
    $('div.row-music').removeClass('select-music');
    if ($('#song-fulltrack-liked').val() == 1) {
        $('#info-song-fulltrack').html('<span class="bg-color-03 btn-function user"><i class="fa fa-heart"></i> <span class="txt">Bỏ thích</span></span>');
    } else {
        $('#info-song-fulltrack').html('<span class="bg-color-03 btn-function user"><i class="fa fa-heart-o"></i> <span class="txt">Thích</span></span>');
    }
}

function tonePlay(file, toneCode) {
    var className = $('#tone_code_' + toneCode).attr('class');
    if (className == 'fa icon-play2') {
        $('#tone-play-audio').css('height', 'auto');
        imuzikPlayer.jPlayer("setMedia", {mp3: file}).jPlayer("play");
        $('.bg-color-01 i').removeClass('icon-pause2');
        $('.bg-color-01 i').addClass('icon-play2');
        $('#tone_code_' + toneCode).removeClass('icon-play2');
        $('#tone_code_' + toneCode).addClass('icon-pause2');
    } else {
        imuzikPlayer.jPlayer("setMedia", {mp3: file}).jPlayer("stop");
        $('#tone-play-audio').css('height', '0');
        $('.bg-color-01 i').removeClass('icon-pause2');
        $('.bg-color-01 i').addClass('icon-play2');
    }
}

function lazyLoadScrollAjax() {

    if ($('a.jscroll-next-default') && $('a.jscroll-next-default').length > 0) {
        $('.mdl-1').jscroll({
            //loadingHtml: '<div class="loading" style="z-index:1100;"><img class="rotate" width="90" height="90" alt="" src="/images/loading.png"></div>',
            classShowLoading: '.spinner',
            autoTrigger: false,
            padding: 20,
            nextSelector: 'a.jscroll-next-default:last',
            callback: function() {
                showFunction();
                cutOffText();
                var screenWindow = window.innerWidth;
                changeMobileJS(screenWindow);
                resizeImage();
            }
        });
    }
}

function alert(message) {
    $.alert({
        title: 'Thông báo!',
        content: message
    });
    return false;
}

confirm = function(message, trueCallback, falseCallback) {
    $.confirm({
        title: '',
        content: message,
        buttons: {
            Ok: function() {
                trueCallback();
            },
            cancel: function() {
                falseCallback;
            }
        }
    });
}

function submitForm(id, message) {
    confirm(message, function() {
        $('#' + id).submit();
    });
    return;
}

function htmlEncode(value) {
    //create a in-memory div, set it's inner text(which jQuery automatically encodes)
    //then grab the encoded contents back out.  The div never exists on the page.
    return $('<div/>').text(value).html();
}

function htmlDecode(value) {
    return $('<div/>').html(value).text();
}

function cutTextHTml() {
    if ($('.ellipsis-hot').height > 32) {
        var text = $('.ellipsis-hot').text();
        text = text.substr(0, 72) + '...';
        $('.ellipsis-hot').text(text);
    }
}

function checkLogintatus(callback) {
    $.ajax({
        type: "GET",
        url: "/ajax/check-login",
        async: false,
        success: function(status) {
            callback(status);
        }
    });
}

function detectSafari() {
    if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i)) {
        return true;
    } else {
        return false;
    }
}