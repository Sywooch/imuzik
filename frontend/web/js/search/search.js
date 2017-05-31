/**
 * Created by khanhnq16 on 27-Oct-15.
 */

var lastQuery = "";
var searchValue ="";
var timer = null;

$(function ($, win) {
        initSearch();

});

function initSearch(){
    $('#keyword').keyup(function (event) {
        searchValue = $(this).val();
        searchValue = $.trim(searchValue);
        var timerCallback = function () {
            suggestionFunc();
        };
        clearTimeout(timer);
        timer = setTimeout(timerCallback, 200);
    });

    $('#search-nav-form, #search-mobile-form').submit(function(event){
        if (!searchValue){
            alert("Bạn chưa nhập từ khóa tìm kiếm");
            return false;
        }

    });

    $('#keywordMobile').keyup(function (event) {
        searchValue = $(this).val();
        searchValue = $.trim(searchValue);
        if (event.which == 13) {
            if (!searchValue) {
                alert("Bạn chưa nhập từ khóa tìm kiếm");
                return false;
            } else {
                //$('#closeBox').click();
                window.location.href = '/search/index?k=' + this.value;
                return false;
            }
        } else {
            var timerCallback = function () {
                suggestionFunc();
            };
            clearTimeout(timer);
            timer = setTimeout(timerCallback, 200);
            $(".box-search-suggess").show();
            return false;
        }
    });

    //************ BOXSEARH *************
    $(".btn-search").click(function (e) {
        // $(".popup-search").toggle(20);
        $('#keywordMobile').val('').focus();
        $(".box-search-suggess").hide();
        e.preventDefault();
    });

    $("#closeBox").click(function () {
        //$("#keyword").val('');
        $(".popup-search").hide(20);
        //$(".box-search-suggess").hide();
    });

    $("#clearSuggess").click(function () {
        $("#keywordMobile").val('').focus();
        $(".box-search-suggess").hide();
    });
}


function suggestionFunc() {
    if (searchValue.length < 2) {
        $('#box-search-suggest').fadeOut(100);
    } else {
        if (lastQuery == "") {
            lastQuery = searchValue;
        } else if (lastQuery == searchValue) {
            $('#box-search-suggest').fadeIn(100);
            return;
        } else {
            lastQuery = $('#keyword').val();
            // lastQuery = $('#keywordMobile').val();
        }
        //lấy dữ liệu từ ajax
        //currentRequest = generateGuid();
        //isFinishRequest = false;
        var link = "/tim-kiem-suggest/"+searchValue;
        // var link = "/search/suggest?keyword="+searchValue;
//    var link = "/ajax/suggestionQuery?q=" + Base64.encode(searchValue);
        $.ajax({
            type:"GET",
            url:link,
            cache:false,
            //container: '#ajaxBodyContent',
            success:function (data) {
                // for data
                // sinh <li></li>
                console.log(data);
                $('#contentSuggess').html(data);
                // $("#box-search-suggess").show(20);
            },
            error:function (request, status, err) {
                console.log(err);
            },
            complete:function () {
            }
        });
    }
}