<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">	
                <div class="control-social">
                    <a href="https://www.facebook.com/nhaccho.imuzik/?fref=ts"><img src="/images/facebook.png"/></a>
                    <a href="#"><img src="/images/youtube.png"/></a>
                </div>
                <p class="link">
                    <a href="/">Trang chủ</a>      
                    <a href="/huong-dan/gioi-thieu">Giới thiệu</a>
                    <a href="/huong-dan/dieu-khoan-su-dung">Điều khoản sử dụng</a>
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <a  href="/gop-y-bao-loi">Góp ý/Báo lỗi</a>
                    <?php } else { ?>
                        <a  href="javascript:void(0);" class = "user">Góp ý/Báo lỗi</a>
                    <?php } ?>
                    <a href="/huong-dan/cau-hoi-thuong-gap">Câu hỏi thường gặp</a>
                </p>
                <p class="text-copyright">
                    <span class="text-copyright">Copyright © Imuzik.</span> Đơn vị chủ quản: Tập Đoàn Viễn Thông Quân Đội Viettel.<br> 
                    Giấy phép MXH số 67/GP-BTTTT cấp ngày 05/02/2016.
                </p>
            </div>
        </div>
    </div>
</div>