/* Day 2605*/
var screenWindow = window.innerWidth;
var screenWindowH = window.innerHeight;


$(function() {

    setWidthBoxPlaying();
    cutOffText();
    openMenu();
    menuInTablet();

    $('#carousel-banner').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        paginationSpeed: 1,
        lazyFollow: false,
        responsiveRefreshRate: 1,
        autoHeight: false,
        dots: true,
        autoplayTimeout: 10000
    });


    /*off zoom in safari*/
    document.addEventListener('gesturestart', function(e) {
        e.preventDefault();
    });



    checkRadio();
    showFunction();
    changeContent();

    changeMobileJS(screenWindow);

    viewLesFull();
    searchImuzik();
    resizeImage();
    //closeLanding();



});

//-------------------View full, view less		
function viewLesFull() {
    $(".view-full-article").click(function(e) {
        $(".less-article").toggleClass("full-article");
        $(".full-link").toggleClass("off");
        $(".less-link").toggleClass("on");
    });
}

//-------------------Only for ellipsis class of module .media
function cutOffText() {
    var objectWidth = $(".media").outerWidth() - ($(" .media-left").outerWidth() + $(".media-right").outerWidth() + 5);
    var objectWidth2 = $(".mdl-billboard .media").outerWidth() - ($(".media-left").outerWidth() +
            $(".mdl-billboard .media-right").outerWidth() + 10);
    var objectWidth3 = $(".media").outerWidth() - ($(".media-left").outerWidth() +
            $(".mdl-billboard .media-right").outerWidth() + 40);
    var one_col = ".col-lg-6 ";
    var objectWidth4 = $(one_col + ".media").outerWidth() - ($(one_col + ".media-left").outerWidth() + $(one_col + ".media-right").outerWidth() + 5);


    //alert(objectWidth4);

    $(".mdl-songs .ellipsis").css("max-width", objectWidth);
    $(".mdl-billboard .media-body .ellipsis").css("max-width", objectWidth2);
    $(".col-md-4 .mdl-songs .ellipsis").css("max-width", objectWidth3);
    $(one_col + ".ellipsis").css("max-width", objectWidth4);
}

//----------------------Slide item	
function buildSilder(clazz, numItem) {
    $(clazz).owlCarousel({
        stagePadding: 15,
        loop: true,
        dots: false,
        margin: -5,
        nav: false,
        dotData: false,
        lazyLoad: true,
        smartSpeed: 500,
        responsive: {
            0: {
                items: numItem
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
}

//----------------------Search
function searchImuzik() {
    $(".btn-search").click(function() {
        var heightBody = $(window).height();
        $(".popup-search").toggle(0, function() {
            $(".container").css({"height": heightBody, "overflow": "hidden"});
        });

        //On body
        $("body").addClass("show-search");
    });

    $("#closeBox").click(function() {
        $(".popup-search").hide(20);
        $(".container").css({"height": "inherit", "overflow": "inherit"});

        //Off body
        $("body").removeClass("show-search");
    });

    $(".ipt-search").focus(function() {
        //alert("Hello!");
        $(".box-search-suggess").toggle(50);
    });

    $("#clearSuggess").click(function() {
        $(".box-search-suggess").hide();
    });

    $(".navbar-right-tablet .form-control").keypress(function() {
        $(".popup-search").show(50);
        $(".box-search-suggess").show(50);

        $(window).click(function() {
            //Hide the menus if visible
            $(".box-search-suggess").hide(50);
        });

        $('.box-search-suggess').click(function(event) {
            event.stopPropagation();
        });
    });



}

//-------------------Set width for box-playing in player-bar	
function setWidthBoxPlaying() {
    /*
     var widthParent = $(".player-bar .box-playing").width();
     
     $(".player-bar .box-playing .list-group-item .wrap-text").css("width",widthParent - 103);
     
     $(".player-bar .link-more-mobile").click(function() {
     $( ".player-bar .box-playing" ).toggleClass("show-box");
     });*/
    var widthUse, widthPlayer, width1, width2, width3, width4;
    width1 = $('.player-bar .control-left').outerWidth(true);
    width2 = $('.player-bar .text-elapsed').outerWidth(true);
    width3 = $('.player-bar .text-duration').outerWidth(true);
    width4 = $('.player-bar .volume').outerWidth(true);
    widthPlayer = $('.player-bar').width();

    widthUse = widthPlayer - (width1 + width2 + width3 + width4 + 10);

    //alert(" a--" + width1 + " b-- " + width2 + " c--" + width3 + " d--" + width4 + " f--" + widthPlayer);

    $('.player-bar .slider-horizontal').css("width", widthUse);
}

//-------------------Set open menu
function openMenu() {
    var layerWrap = "body > .wrap-content";
    var layerContaner = ".wrap-content .container";
    var layerFooter = ".wrap-content .footer";
    var widthLayerOver = screenWindow - 256;//256 is width of container menu

    //Toogle menu
    $(".collapsed").click(function() {
        if (!$("body").hasClass("menu-left")) {
            $("body").toggleClass("menu-left");
            if (screenWindow < 769) {
                //For case in iOS

                //1.Set width for layer wrap
                $(layerWrap).css("width", widthLayerOver);

                //2.Set width for content(.container, headed)
                $(layerContaner).css("width", screenWindow);
                $(layerFooter).css("width", screenWindow);
            }
            resizeMenu();
        } else {
            $(".wrap-content").click();
        }
    });

    //Close menu
    $(".wrap-content").bind("click", "touchstart", function() {
        $("body").removeClass("menu-left");
        if (screenWindow < 769) {
            //For case in iOS
            //1.Reset width for layer wrap
            $(layerWrap).css("width", "inherit");

            //2.Reset width for content(.container, headed)
            $(layerContaner).css("width", screenWindow);
            $(layerFooter).css("width", screenWindow);
        }
    });

    //Close menu
    $(".close-menu").bind("click", "touchstart", function() {
        $("body").removeClass("menu-left");

        $(".wrap-content").removeClass('scroll-disable');
        if (screenWindow < 769) {
            //For case in iOS		
            //1.Reset width for layer wrap
            $(layerWrap).css("width", "100%");

            //2.Reset width for content(.container, headed)
            $(layerContaner).css("width", screenWindow);
            $(layerFooter).css("width", screenWindow);
        }
    });

    resizeMenu();

    window.addEventListener("orientationchange", function() {
        rtimeResizeend = new Date();
        if (timeoutResizeend === false) {
            timeoutResizeend = true;
            setTimeout(resizeend, deltaResizeend);
        }
    }, false);

    window.addEventListener("resize", function() {
        rtimeResizeend = new Date();
        if (timeoutResizeend === false) {
            timeoutResizeend = true;
            setTimeout(resizeend, deltaResizeend);
        }
    }, false);
}

var rtimeResizeend;
var timeoutResizeend = false;
var deltaResizeend = 200;

function resizeMenu() {
    //Open menu
    var menuHeight = $("ul.navbar-right").height();
    var itemHeight = $(window).height() - menuHeight;
    console.log(menuHeight);
    console.log(itemHeight);
    if (screenWindow < 769) {
        $(".scroll-menu").css("height", itemHeight);
        //alert("Height menu:" + itemHeight + "; Height top content " + menuHeight);
        //$(".scroll-menu").css("height", 500);
        //alert(itemHeight);
    }
    if (screenWindow > 640) {
        $('.scroll-pane').jScrollPane();
    } else {
        //$('.scroll-pane').destroy();
    }
    cutOffText();
    setWidthBoxPlaying();
}

function resizeend() {
    if (new Date() - rtimeResizeend < deltaResizeend) {
        setTimeout(resizeend, deltaResizeend);
    } else {
        timeoutResizeend = false;
        resizeMenu();
    }
}

//-------------------Close open menu in tablet
function menuInTablet() {
    $('.icon-on-off-search').click(function() {
        $('.navbar-right-tablet').toggleClass('open-search');
        $('#keyword').val('').focus();
    });
}

//-------------------Check radio
function checkRadio() {
    $('.has-input input').click(function() {
        $('.input-date').toggle();
    });
}

//-------------------Check radio
function showFunction() {

//    $('.link-more-mobile').click(function() {
//        if ($(".media").hasClass("active-item")) {
//
//            if ($(this).parent().hasClass("active-item")) {
//                $(".media").removeClass("active-item");
//            } else {
//                $(".media").removeClass("active-item");
//                $(this).parent().addClass("active-item");
//            }
//
//        } else {
//            $(this).parent().toggleClass("active-item");
//        }
//    });

// click vao icon more
    $('.link-more-mobile').on("click", function() {
        var parent = $(this).parent();
        if (!parent.hasClass("active-item")) {
            $('.media').removeClass('active-item');
            parent.addClass('active-item');
        } else {
            parent.removeClass('active-item');
        }
    });
//    $('.link-more-mobile .icon-more').on("click", function() {
//        var parent = $(this).parent().parent();
//        $('.media').removeClass('active-item');
//        // Set thang cha
//        parent.addClass('active-item');
//    });
    // click vao icon close
//    $('.link-more-mobile .fa-close').on("click", function() {
//        var parent = $(this).parent().parent();
//        parent.removeClass('active-item');
//    });

    $('.btn-more-table').click(function() {
        if ($(".function-more").hasClass("active-item")) {

            if ($(this).parent().hasClass("active-item")) {
                $(".function-more").removeClass("active-item");
            } else {
                $(".function-more").removeClass("active-item");
                $(this).parent().addClass("active-item");
            }

        } else {
            $(this).parent().toggleClass("active-item");
        }
    });

    $('.function-more .icon-delete').click(function() {
        if ($(".function-more").hasClass("active-item")) {
            $(".function-more").removeClass("active-item");
        }
    });


}


//-------------------Change content
function changeContent() {
    $('.btn-change').click(function() {
        //alert("Hello!");
        $(".anchor-change-1").toggle();
        $(".anchor-change-2").toggle();
        $(".anchor-change-3").toggle();
    });

}

//
function changeMobileJS(screenWindow) {

    //-------------jscroll panel-----------------
    if (screenWindow > 640) {//This condition only for web
        $('.scroll-pane').jScrollPane({
            verticalDragMinHeight: 90,
            verticalDragMaxHeight: 90
        });
        $('.owl-carousel').css("display", "block");

        $(".open-popup").click(function() {
            //alert("Ok");
            $(".player-bar .box-playing").toggleClass("show-box");
        });
    } else {
        buildSilder('.owl-carousel', 2);
        $(".scroll-mobile").addClass("modal fade");
        $(".scroll-mobile-sub-1").addClass("modal-dialog modal-sm");
        $(".scroll-mobile-sub-2").addClass("modal-content");
        $(".scroll-mobile .mdl-links").css("height", screenWindowH - 100);
        $(".mdl-songs .media-body").css("width", screenWindow - (97 + 101));//97 = width of images + icon more + four gap + right content

        if ($('.scroll-pane')) {
            //$('.scroll-pane').destroy();
        }
    }
}

//*****************Resize image**********************
function resizeImage() {
    //resize for images film
    var imageWidth = $(".list-film .item img").width();
    var imageHeight = (imageWidth * 3) / 2;/*respect 3x2*/
    $(".list-film .item img").css("height", imageHeight);

    //alert("xxx" + itemHeight);

}