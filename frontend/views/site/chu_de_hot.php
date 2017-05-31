<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Imuzik - Một thế giới âm nhạc cực đỉnh</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/imuzik.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/jquery.mmenu.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css">
        <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">

        <link href="css/coder-update.css" rel="stylesheet">

<!--<script type="text/javascript">--><!--var myScroll1;--><!--var myScroll2;--><!--var myScroll3;--><!--var myScroll4;--><!--var myScroll5;--><!--function loaded () {--><!--myScroll1 = new IScroll('#box-scroller-1', { eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false });--><!--myScroll2 = new IScroll('#box-scroller-2', { eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false });--><!--myScroll3 = new IScroll('#box-scroller-3', { eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false });--><!--myScroll4 = new IScroll('#box-scroller-4', { eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false });	--><!--myScroll5 = new IScroll('#box-scroller-5', { eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false });	--><!--}--><!--</script>--><!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --><!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]-->

    </head>
    <body>

        <div class="header navbar-fixed-top-mobile">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default navbar-imuzik">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"><img alt="Brand" src="images/chplay.png" height="43"></a>
                            <span class="search-mobile btn-search">
                                <i class="fa icon-search2"></i>
                            </span>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" onClick="document.getElementById('id01').style.display = 'block'" class="user">
                                    <span class="fa icon-user"></span>
                                    <!--<img src="images/4x4.png"> -->
                                </a>
                            </li>
                            <li>
                                    <!--<span class="text">0988005744</span>-->
                            </li>
                            <!--<li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                    User_007<span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                              </ul>
                            </li>-->
                        </ul>	

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse">

                            <ul class="nav navbar-nav">
                                <li class="active"><a href="home.html"><i class="fa icon-home"></i> Trang chủ</a></li>
                                <li><a href="billboard.html"><i class="fa icon-broad"></i> BXH</a></li>
                                <li><a href="songs.html"><i class="fa icon-music"></i> Thể loại</a></li>
                                <li><a href="film_brt.html"><i class="fa icon-play"></i> Nhạc chờ theo phim</a></li>
                                <li><a href="news.html"><i class="fa icon-global"></i> Tin tức</a></li>
                                <li><a href="faq.html"><i class="fa icon-faq"></i> Hướng dẫn</a></li>
                            </ul>

                            <div class="navbar-right-tablet">

                                <form class="navbar-form navbar-right">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <button type="submit" class="btn btn-default"><i class="fa icon-search2"></i></button></span>
                                        <input type="text" class="form-control" value="Tìm kiếm...">
                                    </div>
                                </form>
                                <span class="fa icon-on-off-search"></span>		
                            </div>

                        </div><!-- /.navbar-collapse -->

                        <div class="close-menu"></div>

                    </nav>
                </div>
            </div>
        </div>

        <div class="wrap-content">
            <div class="container">  
                <div class="row">    
                    <div class="col-lg-8 col-md-8  col-sm-12">
                        <div class="mdl-banner">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">

                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                    <li data-target="#myCarousel" data-slide-to="3"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="images/onbox_01.jpg" alt="Chania">
                                    </div>

                                    <div class="item">
                                        <img src="images/onbox_01.jpg" alt="Chania">
                                    </div>

                                    <div class="item">
                                        <img src="images/onbox_01.jpg" alt="Flower">
                                    </div>

                                    <div class="item">
                                        <img src="images/onbox_01.jpg" alt="Flower">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mdl-1 mdl-songs">
                            <div class="title"> 	
                                <a href="#" class="txt"> CÓ THỂ BẠN THÍCH</a>
                            </div>  
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="media active">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>   
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>   
                                </div>
                            </div>  

                        </div>

                        <div class="mdl-1 mdl-songs"> 
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="title"> 	
                                        <a href="#" class="txt"> CHỦ ĐỀ HOT</a>
                                    </div> 

                                    <p><a href="#"><img src="images/img_02.jpg" width="300" height="110" alt=""/></a></p>
                                    <p><a href="#"><img src="images/onbox_02.jpg" width="300" height="110" alt=""/></a></p>
                                    <p><a href="#"><img src="images/onbox_03.jpg" width="300" height="110" alt=""/></a></p>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="title"> 	
                                        <a href="#" class="txt"> TẢI GẦN ĐÂY</a>
                                    </div> 
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                </div>
                            </div>  

                        </div>

                        <div class="mdl-1 mdl-news">
                            <div class="title"> 	
                                <a href="#" class="txt"> TIN TỨC</a>
                            </div>  
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a href="#" class="item">
                                        <img src="images/4x3.png" alt="" class="image-2"/>
                                        <p class="text">Cháu gái danh ca Thái Châu xin lỗi cậu ruột trên sân khấu</p>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a href="#" class="item">
                                        <img src="images/4x3.png" alt="" class="image"/>
                                        <p class="text">Cháu gái danh ca Thái Châu xin lỗi cậu ruột trên sân khấu</p>
                                    </a>
                                    <a href="#" class="item">
                                        <img src="images/4x3.png" alt="" class="image"/>
                                        <p class="text">Cháu gái danh ca Thái Châu xin lỗi cậu ruột trên sân khấu</p>
                                    </a>
                                    <a href="#" class="item">
                                        <img src="images/4x3.png" alt="" class="image"/>
                                        <p class="text">Cháu gái danh ca Thái Châu xin lỗi cậu ruột trên sân khấu</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mdl-1 mdl-songs">
                            <div class="title"> 	
                                <a href="#" class="txt"> MỚI CẬP NHẬT</a>
                            </div>  
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>   
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                            <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                        </div>
                                        <div class="media-right">
                                            <div class="right-info">
                                                <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                                <span class="download"><i class="fa icon-download"></i>1523</span>
                                            </div>
                                        </div>
                                        <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                            <i class="fa icon-more"></i>
                                        </div>
                                        <div class="overlay">
                                            <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                        </div>              
                                    </div>   
                                </div>
                            </div>  

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4  col-sm-12">
                        <div class="mdl-1 mdl-billboard">
                            <div class="title ellipsis"> 
                                <a href="#" class="txt"> BẢNG XẾP HẠNG</a> 
                            </div>    
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist">
                                <li class="active"><a href="#home" role="tab" data-toggle="tab">Việt Nam</a></li>
                                <li><a href="#profile" role="tab" data-toggle="tab">US/UK</a></li>
                                <li><a href="#messages" role="tab" data-toggle="tab">Châu Á</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="scroll-pane">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right text-danger">01</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right text-success">02</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right text-primary">03</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">04</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">05</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">06</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">07</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">08</div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">... 2</div>
                                <div role="tabpanel" class="tab-pane" id="messages">... 3</div>
                            </div>            
                        </div>

                        <div class="mdl-1 mdl-songs">
                            <div class="title"> 	
                                <a href="#" class="txt"> HÔM NAY NGHE GÌ?</a>
                            </div>    
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                    <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                </div>
                                <div class="media-right">
                                    <div class="right-info">
                                        <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                        <span class="download"><i class="fa icon-download"></i>1523</span>
                                    </div>
                                </div>
                                <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                    <i class="fa icon-more"></i>
                                </div>
                                <div class="overlay">
                                    <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                    <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                    <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                    <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                    <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                </div>              
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                    <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                </div>
                                <div class="media-right">
                                    <div class="right-info">
                                        <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                        <span class="download"><i class="fa icon-download"></i>1523</span>
                                    </div>
                                </div>
                                <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                    <i class="fa icon-more"></i>
                                </div>
                                <div class="overlay">
                                    <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                    <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                    <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                    <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                    <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                </div>              
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                    <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                </div>
                                <div class="media-right">
                                    <div class="right-info">
                                        <span class="viewer"><i class="fa icon-headphone"></i>8752</span>
                                        <span class="download"><i class="fa icon-download"></i>1523</span>
                                    </div>
                                </div>
                                <div data-target="#modal-popup" data-toggle="modal" class="link-more-mobile">
                                    <i class="fa icon-more"></i>
                                </div>
                                <div class="overlay">
                                    <a href="#" class="bg-color-01"><i class="fa icon-play2"></i></a>
                                    <a href="#" class="bg-color-02"><i class="fa icon-download"></i></a>
                                    <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i></a>
                                    <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                                    <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                                </div>              
                            </div>            
                        </div>

                        <div class="mdl-1 mdl-billboard">
                            <div class="title ellipsis"> 
                                <a href="#" class="txt"> TẢI NHIỀU NHẤT</a> 
                            </div>    
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist">
                                <li class="active"><a href="#week" role="tab" data-toggle="tab">Tuần</a></li>
                                <li><a href="#month" role="tab" data-toggle="tab">Tháng</a></li>
                                <li><a href="#all" role="tab" data-toggle="tab">Tất cả</a></li>
                                <li><a href="#free" role="tab" data-toggle="tab">Miễn phí</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="week">
                                    <div class="scroll-pane">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right text-danger">01</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right text-success">02</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right text-primary">03</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">04</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">05</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">06</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">07</div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/4x4.png" width="48" alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                                                <p class="singer-name ellipsis"><a href="#">Bảo Thy</a></p>
                                            </div>
                                            <div class="media-right">08</div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="month">... 2</div>
                                <div role="tabpanel" class="tab-pane" id="all">... 3</div>
                                <div role="tabpanel" class="tab-pane" id="free">... 4</div>
                            </div>            
                        </div>
                    </div>
                </div>

            </div>  

            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">	
                            <div class="control-social">
                                <a href="#"><img src="images/facebook.png"/></a>
                                <a href="#"><img src="images/youtube.png"/></a>
                                <a href="#"><img src="images/instagram.png"/></a>
                            </div>
                            <p class="link"> <a href="#">Trang chủ</a>      <a href="#">Giới thiệu</a>      <a href="#">Điều khoản sử dụng</a>      <a href="#">Góp ý/Báo lỗi</a>      <a href="#">Câu hỏi thường gặp</a>
                            </p>
                            <p class="text-copyright"><span class="text-copyright">Copyright © Imuzik.</span> Đơn vị chủ quản: Tập Đoàn Viễn Thông Quân Đội Viettel.<br> 
                                Giấy phép MXH số 67/GP-BTTTT cấp ngày 05/02/2016.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="modal-popup">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content mdl-1 mdl-form">
                    <div class="modal-body">
                        <h5 class="title-4 ellipsis">Linh hồn tượng đá saphia</h5>
                        <div class="function-user">
                            <a href="#" class="bg-color-04"><i class="fa icon-gift"></i> Tặng</a>
                            <a href="#" class="bg-color-02"><i class="fa icon-download"></i> Tải</a>
                            <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i> Thích</a>
                            <a href="#" class="bg-color-05"><i class="fa icon-share"></i> Chia sẻ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content mdl-1 mdl-form">
              <div class="modal-body">
                <h4 class="title-3">Đăng ký tài khoản</h4>
                <p>Để đăng ký, Quý khách vui lòng soạn tin MK gửi 9219 để lấy 
        mật khẩu và thực hiện đăng nhập</p>
                        <p></p>
                    <p align="right">
                        <a href="#" data-dismiss="modal" class="view-full-article">Hủy bỏ</a>               
                        <span class="space"></span>
                                <button type="button" class="btn btn-imuzik">ĐĂNG KÝ</button>
                        </p>
              </div>
            </div>
          </div>
        </div>-->

        <!--BOXSEARH-->
        <div class="popup-search">
            <div class="box-search"> 
                <a href="#" class="pull-right" id="closeBox"><i class="fa icon-delete"></i></a>
                <a href="#" class="pull-left" id="clearSuggess"><i class="fa icon-refresh"></i></a>

                <div class="box-search-content">
                    <input type="text" placeholder="Nội dung tìm kiếm ..." class="ipt-search">
                </div>

            </div>
            <div class="box-search-suggess">
                <ul id="contentSuggess">
                    <li>
                        <i class="icon-music-note"></i>
                        <a href="#" class="txt-song">Nếu em được lựa chọn</a>
                        <span>-</span>
                        <a href="#" class="txt-singer">Lệ quyên</a>        
                    </li>            
                    <li>
                        <i class="fa fa-film"></i>
                        <a href="#" class="txt-song">Nếu em được lựa chọn</a>
                        <span>-</span>
                        <a href="#" class="txt-singer">Lệ quyên</a>        
                    </li>            
                    <li>
                        <i class="fa fa-play-circle"></i>
                        <a href="#" class="txt-song">Nếu em được lựa chọn</a>
                        <span>-</span>                
                        <a href="#" class="txt-singer">Lệ quyên</a>        
                    </li>            
                    <li>
                        <i class="fa icon-headphone"></i>
                        <a href="#" class="txt-song">Nếu em được lựa chọn</a>
                        <span>-</span>                
                        <a href="#" class="txt-singer">Lệ quyên</a>        
                    </li>            
                    <li>
                        <i class="glyphicon glyphicon-cd"></i>
                        <a href="#" class="txt-song">Nếu em được lựa chọn</a>
                        <span>-</span>                
                        <a href="#" class="txt-singer">Lệ quyên</a>        
                    </li>
                </ul>
            </div>
        </div>




        <!--------Modal login------>
        <div id="id01" class="modal-login">
            <form class="form-horizontal modal-content animate">
                <h2>Đăng nhập</h2>
                <p>Quý khách vui lòng hoàn thành các thông tin sau để đăng nhập</p>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="email">Số điện thoại(Viettel):</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="pwd">Mật khẩu:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                    </div>
                </div>
                <p><em>Soạn tin MK gửi 9219 (miễn phí) để lấy mật khẩu.</em></p>
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <span class="btn" onClick="document.getElementById('id01').style.display = 'none'">Hủy bỏ</span>
                        <button type="submit" class="btn btn-imuzik">Đăng nhập</button>
                    </div>
                </div>
            </form>
        </div>

        <!--------Modal register------>
        <div id="id02" class="modal-login">
            <form class="form-horizontal modal-content animate">
                <h2>Đăng ký</h2>
                <p>Để đăng ký, Quý khách vui lòng soạn tin MK gửi 9291 để lấy mật khẩu và thực hiện đăng nhập</p>
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <span class="btn" onClick="document.getElementById('id01').style.display = 'none'">Hủy bỏ</span>
                        <button type="submit" class="btn btn-imuzik">Đăng nhập</button>
                    </div>
                </div>
            </form>
        </div>

        <!--------Modal package------>
        <div id="id03" class="modal-login">
            <form class="form-horizontal modal-content animate">
                <h2>Gói cước</h2>
                <p>Xin chào 0988005774, mới Quý khách đăng ký gói tháng dịch vụ nhạc chờ iMuzik để được tải nhạc chờ miễn phí.</p>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-imuzik">Đăng ký</button>
                        <span class="btn" onClick="document.getElementById('id01').style.display = 'none'">Hủy bỏ</span>
                    </div>
                </div>
                <p><em>* Phí dịch vụ 9000đ/tháng. Gia hạn hàng tháng</em></p>
            </form>
        </div>

        <!--------Modal package------>
        <div id="id04" class="modal-login">
            <form class="form-horizontal modal-content animate">
                <h2>Thông báo</h2>
                <p>Thuê bao 0988005774, xác nhận tạm dừng dịch vụ nhạc chờ ngày/tuần/tháng</p>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-imuzik">ĐỒNG Ý</button>
                        <span class="btn" onClick="document.getElementById('id01').style.display = 'none'">Hủy bỏ</span>
                    </div>
                </div>
                <p><em>* Phí dịch vụ 9000đ/tháng. Gia hạn hàng tháng</em></p>
            </form>
        </div>


        <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script> 
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/jscrollpane.min.js"></script>
        <script src="js/owl.carousel.min.js"></script> 
        <script src="js/imuzik.js"></script>



    </body>
</html>
