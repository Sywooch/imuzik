/**
 * Created by HoangL on 11/10/2015.
 */
var rbtCategoryNameMarquee;
var titleNameScroll;
$(function () {
    $('body').on('show.bs.modal', '.popCategorySelect', function (e) {
        enableOverScroll('.popCategorySelect');
        disableOverScroll('#body_content');
        // $('.popCategorySelect').addClass('disable-scroll');
        // $('.popCategorySelect ul:eq(0)').addClass('enable-scroll');
        // $('#body_content').removeClass('enable-scroll').addClass('disable-scroll');
    }).on('hidden.bs.modal', '.popCategorySelect', function (e) {
        disableOverScroll('.popCategorySelect');
        enableOverScroll('#body_content');
        // $('.popCategorySelect').removeClass('disable-scroll');
        // $('.popCategorySelect ul:eq(0)').removeClass('enable-scroll');
        // $('#body_content').removeClass('disable-scroll').addClass('enable-scroll');
    });
    $('body').on('show.bs.modal', '.popCategoryMarginSelect', function (e) {
        enableOverScroll('.popCategoryMarginSelect');
        disableOverScroll('#body_content');
    }).on('hidden.bs.modal', '.popCategoryMarginSelect', function (e) {
        disableOverScroll('.popCategoryMarginSelect');
        enableOverScroll('#body_content');
    });
    $('body').on('click', '.popCategorySelect ul', function (e) {
        $('.popCategorySelect').modal('hide');
    });
    marqueeCategoryName();
    marqueeTitle();
});

function marqueeCategoryName() {
    // 20: padding left right, 105: dropdownlist, 10: padding dropdownlist
    var rbtCategoryName = $('.categoryNameScroll')
            .css('width', winWidth - 20 - 105 - 10)
            .css('overflow', 'hidden')
            .css('white-space', 'nowrap');
    if (rbtCategoryName.length > 0) {
        if (rbtCategoryNameMarquee) {
            rbtCategoryNameMarquee.marquee('destroy');
            rbtCategoryNameMarquee = null;
        }
        if (rbtCategoryName[0].scrollWidth > rbtCategoryName.innerWidth()) {
            rbtCategoryNameMarquee = rbtCategoryName.marquee({duplicated: true});
        }
    }
}

function marqueeTitle() {
    // 20: padding left right, 105: dropdownlist, 10: padding dropdownlist    
    var rbtCategoryName = $('.titleNameScroll')
            .css('width', winWidth - 20 - 20 - 10)
            .css('overflow', 'hidden')
            .css('white-space', 'nowrap');
    if (rbtCategoryName.length > 0) {
        if (titleNameScroll) {
            titleNameScroll.marquee('destroy');
            titleNameScroll = null;
        }
        if ($('.titleNameScroll .js-marquee-wrapper .js-marquee').length > 0) {
            $('.titleNameScroll').html($('.titleNameScroll .js-marquee-wrapper .js-marquee').html());
        }
        if (rbtCategoryName[0].scrollWidth > rbtCategoryName.innerWidth()) {
            titleNameScroll = rbtCategoryName.marquee({duplicated: true});
        }
    }
}