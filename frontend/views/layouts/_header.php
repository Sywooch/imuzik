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
                    <a class="navbar-brand" href="/"><img alt="Brand" src="/images/chplay.png" height="43"></a>
                    <span class="search-mobile btn-search">
                        <i class="fa icon-search2"></i>
                    </span>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li>
                            <p class="txt-hide"><br></p>
                            <a href="javascript:void(0);" class="btn-imuzik link-01" onclick="$('#id02').modal('show');">Đăng ký</a>
                            <p class="txt-hide">hoặc</p>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="link-01 user-login">Đăng nhập</a>
                        </li>
                    <?php } else { ?>
                        <li class="hide-object">
                            <p class="txt-hide"><br></p>
                            <a class="btn-imuzik link-01" href="/account/info">
                                <?php echo yii\helpers\Html::encode(Yii::$app->user->identity->username); ?>
                            </a>
                            <p class="txt-hide">hoặc</p>
                        </li>
                        <li class="hide-object"><a href="javascript:void(0);" class="link-01" onclick="logout();">Thoát</a></li>
                    <?php } ?>
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <li class="hide-object-2">
                            <span class="btn-change">
                                <i class="fa fa-angle-down"></i>
                            </span>
                            <input type="hidden" id="user_avatar" value="<?php echo Yii::$app->user->identity->getAvatar(); ?>"/>
                            <a href="javascript:void(0);" class="user">
                                <span id="user-avatar-image">                                    
                                    <img src="<?php echo Yii::$app->user->identity->getAvatar(); ?>">
                                </span>
                                <span class="icon-change" onclick="$('#user-avatar-upload-mobile').click();"> <i class="fa fa-camera"></i> </span>
                            </a>
                        </li>
                    <?php } ?>   
                    <li >
                        <span class="text">
                            <?php
                            if (Yii::$app->user->identity) {
                                if (Yii::$app->user->identity->fullname) {
                                    echo yii\helpers\Html::encode(Yii::$app->user->identity->fullname);
                                } else {
                                    echo yii\helpers\Html::encode(Yii::$app->user->identity->username);
                                }
                            }
                            ?>
                        </span>
                    </li>
                    <div style="display: none;">
                        <input type="file" id="user-avatar-upload-mobile"/>
                    </div>
                </ul>	

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <div class="scroll-menu">
                        <ul class="nav navbar-nav anchor-change-1">
                            <?php $controller = Yii::$app->controller->id; ?>
                            <?php $action = Yii::$app->controller->action->id; ?>
                            <li class="<?php echo $controller == 'rank' ? 'active' : ''; ?>"><a href="/bang-xep-hang"><i class="fa icon-broad"></i> BXH</a></li>
                            <li class="<?php echo $controller == 'category' ? 'active' : ''; ?>"><a href="/the-loai"><i class="fa icon-music"></i> Thể loại</a></li>
                            <li class="<?php echo $controller == 'topic' ? 'active' : ''; ?>"><a href="/chu-de"><i class="fa icon-music"></i> Chủ đề</a></li>
                            <li class="<?php echo $controller == 'rbt-film' ? 'active' : ''; ?>"><a href="/nhac-phim"><i class="fa icon-play"></i> Nhạc phim</a></li>
                            <li class="<?php echo $controller == 'news' ? 'active' : ''; ?>"><a href="/tin-tuc"><i class="fa icon-global"></i> Tin tức</a></li>
                            <li class="<?php echo $controller == 'helper' ? 'active' : ''; ?>"><a href="/huong-dan-su-dung"><i class="fa icon-faq"></i> Hướng dẫn</a></li>
                        </ul>
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <ul class="nav navbar-nav anchor-change-3">
                                <li class="separate"></li>
                                <li><a href="/huong-dan/dieu-khoan-su-dung">Điều khoản sử dụng</a></li>
                                <li>
                                    <?php if (!Yii::$app->user->isGuest) { ?>
                                        <a  href="/gop-y-bao-loi">Góp ý/Báo lỗi</a>
                                    <?php } else { ?>
                                        <a  href="javascript:void(0);" class="user">Góp ý/Báo lỗi</a>
                                    <?php } ?>
                                </li>
                                <li><a href="/huong-dan/cau-hoi-thuong-gap">Câu hỏi thường gặp</a></li>
                                <li><a href="javascript:void(0);" onclick="logout();">Đăng xuất</a></li>
                            </ul>

                            <ul class="nav navbar-nav anchor-change-2">
                                <li><p class="title">Cá nhân</p></li>
                                <li><a href="/thong-tin-ca-nhan">Thông tin cá nhân</a></li>
                                <li><a href="/danh-sach-yeu-thich">Danh sách yêu thích</a></li>                                
                                <li class="separate"></li>
                                <li><p class="title">Dịch vụ nhạc chờ</p></li>
                                <li><a href="/kich-hoat-huy-dung-dich-vu">Kích hoạt/Huỷ/Dừng DV</a></li>
                                <li><a href="/nhac-cho-ca-nhan">Nhạc chờ cá nhân</a></li>
                                <li><a href="/tao-moi-nhom-nhac-cho">Cài đặt nhạc chờ cho SĐT/Nhóm gọi đến</a></li>
                                <li><a href="/sao-chep-nhac-cho">Sao chép nhạc chờ</a></li>
                            </ul>
                        <?php } ?>
                    </div>
                    <div class="navbar-right-tablet">
                        <div class="wrap-content">
                            <form id="search-nav-form" autocomplete="off" class="navbar-form pull-left" action="/search/index" method="get">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <button type="submit" class="btn btn-default"><i class="fa icon-search2"></i></button>
                                    </span>
                                    <input id="keyword" name="k" type="search" autocomplete="off" class="form-control" value="" maxlength="50" placeholder="Tìm kiếm...">
                                </div>
                            </form>
                            <span class="fa icon-on-off-search"></span>
                        </div>
                    </div>

                </div><!-- /.navbar-collapse -->

                <div class="close-menu"></div>

            </nav>
        </div>
    </div>
</div>