<div class="modal fade" role="dialog" id="modal-popup">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content mdl-1 mdl-form">
            <div class="modal-body">
                <h5 class="title-4 ellipsis">Linh hồn tượng đá saphia</h5>
                <div class="function-user">
                    <a href="#" class="bg-color-02"><i class="fa icon-download"></i> Tải</a>
                    <a href="#" class="bg-color-03"><i class="fa fa-heart-o"></i> Thích</a>
                    <a href="#" class="bg-color-05"><i class="fa icon-share"></i> Chia sẻ</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--BOXSEARH-->
<div class="popup-search">
    <div class="box-search">
        <a href=" javascript:void(0); " class="pull-right" id="closeBox"><i class="fa icon-delete"></i></a>
        <a href=" javascript:void(0); " class="pull-left" id="clearSuggess"><i class="fa icon-refresh"></i></a>
        <div class="box-search-content">
            <input type="search" id="keywordMobile" autocomplete="off" maxlength="50" name="k"
                   placeholder="Nội dung tìm kiếm ..." class="ipt-search">
        </div>
    </div>
    <div class="box-search-suggess">
        <div class="scroll-content-search">
            <ul id="contentSuggess">

            </ul>
        </div>
    </div>
</div>

<!--------Modal login------>
<div id="id01" class="modal-login"></div>
<!--------Modal register------>
<div id="id02" class="modal-login">
    <form class="form-horizontal modal-content animate">
        <h2>Đăng ký</h2>
        <p>Để đăng ký, Quý khách vui lòng soạn tin MK gửi 1221 để lấy mật khẩu và thực hiện đăng nhập</p>
        <div class="form-group">
            <div class="col-sm-12 text-right">
                <span class="btn" onclick="hideModal('id02');">Hủy bỏ</span>
                <button type="button" class="btn btn-imuzik" onclick="registerLogin();">Đăng nhập</button>
            </div>
        </div>
    </form>
</div>

<!--------Modal package------>
<div id="id03" class="modal-login">
    <form class="form-horizontal modal-content animate">
        <h2>Đăng ký dịch vụ nhạc chờ</h2>
        <p>Xin chào <?php echo (Yii::$app->user->identity) ? Yii::$app->user->identity->phonenumber : ''; ?>, Quý khách
            chưa đăng ký dịch vụ nhạc chờ Imuzik, thực hiện đăng ký để có thể tải/tặng nhạc chờ!</p>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="button" class="btn btn-imuzik user" onclick="crbtRegister(1);">Đăng ký</button>
                <span class="btn" style="color: #3ac663;" onclick="hideModal('id03')">Hủy bỏ</span>
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
                <span class="btn" onClick="hideModal('id04')">Hủy bỏ</span>
            </div>
        </div>
        <p><em>* Phí dịch vụ 9000đ/tháng. Gia hạn hàng tháng</em></p>
    </form>
</div>
