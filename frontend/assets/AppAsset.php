<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/imuzik.css',
        'css/jquery.mmenu.css',
        'css/jquery.jscrollpane.css',
        'css/owl.carousel.min.css',
        'css/font-awesome.css',
        'css/jquery.datetimepicker.css',
        'css/jquery-confirm.min.css',
        'css/coder-update.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jscrollpane.min.js',
        'js/owl.carousel.min.js',
        'js/mousewheel.js',
        'js/jquery-confirm.min.js',
        'js/imuzik.js',
        'js/jplayer/jquery.jplayer.min.js',
        'js/jplayer/player.js',
        'js/jquery.jscroll.js',
        'js/jquery.datetimepicker.full.min.js',
        'js/rbt/ringbacktone.js',
        'js/user/user.js',
        'js/search/search.js',
        'js/coder.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
