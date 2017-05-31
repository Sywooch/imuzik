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
						<a href="#" onClick="document.getElementById('id01').style.display='block'" class="user">
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

<div class="banner-02" style="background-image:url(images/img_03.jpg)">	
  <div class="container">
    <div class="">
        <img src="images/4x4.png" width="200" class="img-circle"/>
        <div class="big-name"><h1>Sơn Tùng MTP</h1></div>
        <div><a href="#" class="link">Đổi Avatar</a> <a href="#" class="link">Đổi ảnh nền</a></div>
    </div>
  </div>
</div>

 <div class="container">
  <div class="row">
  	<div class="col-sm-3 col-md-3">
    	 <div class="btn-scroll-genre" data-toggle="modal" data-target=".scroll-mobile">
         	Danh sách chức năng
         </div>	
         
         <div class="scroll-mobile bs-example-modal-sm">
          <div class="scroll-mobile-sub-1">
            <div class="scroll-mobile-sub-2">
               <div class="mdl-links">
                    <div class="scroll-pane horizontal-only">
                        <div class="title selected">CÁ NHÂN</div>
                        <a href="#" class="item" data-dismiss="modal">Thông tin cá nhân</a>
                        <a href="#" class="item" data-dismiss="modal">Danh sách yêu thích</a>
                        <a href="#" class="item" data-dismiss="modal">Playlist cá nhân</a>
                        <p><br></p>
                        <div class="title">DỊCH VỤ NHẠC CHỜ</div>
                        <a href="#" class="item" data-dismiss="modal">Kích hoạt/Huỷ/Dừng DV</a>
                        <a href="#" class="item" data-dismiss="modal">Nhạc chờ cá nhân</a>
                        <a href="#" class="item" data-dismiss="modal">Cài đặt nhạc chờ cho 
SĐT/Nhóm gọi đến</a>
						<a href="#" class="item" data-dismiss="modal">Sao chép nhạc chờ</a>
                        <p><br></p>
                        <div class="title">DỊCH VỤ KHÁC</div>
                        <a href="#" class="item" data-dismiss="modal">Quà tặng âm nhạc</a>
                        <a href="#" class="item" data-dismiss="modal">Imuzik</a>
                        <a href="#" class="item" data-dismiss="modal">Karaoke</a>
                    </div>
         </div>
            </div>
          </div>
        </div>
    </div>
  
  	<div class="col-md-9 col-sm-9">
        <div class="mdl-1 mdl-songs">
            <div class="title"> 	
              <a href="#" class="txt"> Danh sách yêu thích</a>
            </div>                    
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="images/4x4.png" width="36" alt="...">
                </a>
              </div>
              <div class="media-body special-text">
                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                <a href="#" class="singer-name ellipsis">Bảo Thy</a>
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
                <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                <a href="#" class="bg-color-06"><i class="fa fa-trash-o"></i></a>
              </div>
              
            </div>
            <div class="media active-item">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="images/4x4.png" width="36" alt="...">
                </a>
              </div>
              <div class="media-body special-text">
                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                <a href="#" class="singer-name ellipsis">Bảo Thy</a>
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
                <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                <a href="#" class="bg-color-06"><i class="fa fa-trash-o"></i></a>
              </div>
            </div>
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="images/4x4.png" width="36" alt="...">
                </a>
              </div>
              <div class="media-body special-text">
                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                <a href="#" class="singer-name ellipsis">Bảo Thy</a>
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
                <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                <a href="#" class="bg-color-06"><i class="fa fa-trash-o"></i></a>
              </div>
            </div>
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="images/4x4.png" width="36" alt="...">
                </a>
              </div>
              <div class="media-body special-text">
                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                <a href="#" class="singer-name ellipsis">Bảo Thy</a>
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
                <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                <a href="#" class="bg-color-06"><i class="fa fa-trash-o"></i></a>
              </div>
            </div>
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="images/4x4.png" width="36" alt="...">
                </a>
              </div>
              <div class="media-body special-text">
                <a href="#" class="song-name ellipsis">Con Tim Anh Nằm Đâu</a>
                <a href="#" class="singer-name ellipsis">Bảo Thy</a>
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
                <a href="#" class="bg-color-04"><i class="fa icon-gift"></i></a>
                <a href="#" class="bg-color-05"><i class="fa icon-share"></i></a>
                <a href="#" class="bg-color-06"><i class="fa fa-trash-o"></i></a>
              </div>
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
        	
        </ul>
    </div>
</div>

<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jscrollpane.min.js"></script>
<script src="js/owl.carousel.min.js"></script> 
<script src="js/imuzik.js"></script>



</body>
</html>
