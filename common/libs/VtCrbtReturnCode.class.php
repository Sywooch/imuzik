<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VtCrbtReturnCode
 *
 * @author Ico
 */
class VtCrbtReturnCode {

    private $code;

    public function __construct($code) {
        $this->code = $code;
    }

    public function setCode($code){
        return $this->code = $code;
    }
    public function getCode() {
        return $this->code;
    }

    public function getDescription() {
        return $this->getErrVN();
    }

    public function isSuccess() {
        if (self::strBeginWith('0', $this->code))
            return true;
        return false;
    }
    
    private static function strBeginWith($needle, $haystack) {
        return (substr($haystack, 0, strlen($needle)) == $needle);
    }

    private function getErrVN() {
        switch ($this->code) {
            case "000000":
                return "Thực hiện thành công";
            case "000001":
                return "Yêu cầu đã được chấp nhận và đang trong quá trình xử lý.";
            case "000002":
                return "Không có thông tin về gói đang thêm mới hoặc sửa thành công.";
            case "000003":
                return "Yêu cầu tải RBT được chấp nhận và RBTs sẽ được tải về sau khi thuê bao đăng kí dịch vụ RBT.";
            case "100001":
                return "Lỗi không xác đinh.";
            case "100002":
                return "Hệ thống đang bận xử lý.";
            case "100003":
                return "Thời gian chờ đợi xử lý đã hết.";
            case "100004":
                return "Lỗi đường truyền.";
            case "100005":
                return "Lỗi xử lý database.";
            case "100006":
                return "Lỗi xử lý database.";
            case "100007":
                return "Dịch vụ tạm dừng hoạt động.";
            case "100008":
                return "Lỗi thực thi cơ sở dữ liệu.";
            case "200001":
                return "Không vào giá trị các tham số bắt buộc.";
            case "200002":
                return "Dữ liệu nhập vào không hợp lệ.";
            case "200003":
                return "Độ dài tham số vượt quá độ dài cho phép.";
            case "200004":
                return "Tất cả các tham số vào đều rỗng(null).";
            case "200005":
                return "Sai định dạng thời gian của RBT hoặc thời gian bắt đầu phải bé hơn thời gian kết thúc.";
            case "200006":
                return "Vào giá trị của những tham số không yêu cầu.";
            case "201001":
                return "Sai định dạng số điện thoại.";
            case "201002":
                return "Sai mật khẩu.";
            case "201003":
                return "Không vào mật khẩu.";
            case "202001":
                return "Sai định dạng của hộp âm nhạc.";
            case "202002":
                return "Sai định dạng của mã RBT.";
            case "300001":
                return "Vượt quá số lượng thành viên cho phép.";
            case "300002":
                return "Không lấy được thông tin.";
            case "301001":
                return "Thuê bao không tồn tại.";
            case "301002":
                return "Thuê bao đã đăng ký dịch vụ trước đó.";
            case "301003":
                return "Sai mật khẩu.";
            case "301004":
                return "Không gửi được tin nhắn đến thuê bao.";
            case "301005":
                return "Vào sai mã kiểm tra.";
            case "301006":
                return "Thuê bao đang chờ đăng ký hoặc chờ được kích hoạt.";
            case "301008":
                return "Không lấy được mã kiểm tra do thuê bao có lỗi.";
            case "301009":
                return "Không được phép định nghĩa thuê bao do thuê bao đang có lỗi.";
            case "301010":
                return "Không xóa được thuê bao do thuê bao đang có lỗi.";
            case "301011":
                return "Thuê bao nợ tiền.";
            case "301012":
                return "Mã kiểm tra không tồn tại.";
            case "301013":
                return "Không thể tải về trang thái dịch vụ thuê bao.";
            case "301014":
                return "Không thể thiết lập trạng thái dịch vụ thuê bao";
            case "301015":
                return "Dịch vụ không đáp ứng cho thuê bao do lỗi trạng thái dịch vụ của thuê bao.";
            case "301016":
                return "Thuê bao không cho phép các thuê bao khác sao chép RBTs.";
            case "301017":
                return "Không thể sao chép cấu hình hệ thống.";
            case "301018":
                return "Số điện thoại của thuê bao bị sao chép không tồn tại.";
            case "301019":
                return "Danh sách các RBT có chứa RBT không hợp lệ (trạng thái không xác định).";
            case "301020":
                return "RBT không thuộc một công ty nào.";
            case "301021":
                return "Đối tượng bị hạn chế lần tiêu thụ.";
            case "301022":
                return "Mã giới hạn tiêu dùng không tồn tại.";
            case "301023":
                return "Vượt quá giới hạn sử dụng.";
            case "301024":
                return "Loại RBT không tồn tại.";
            case "301025":
                return "Hệ thống tính tiền mới không thay đổi so với hệ thống cũ nên không cần thay đổi gì.";
            case "309123":
                return "Số lần thuê bao đăng ký dịch vụ trong ngày đã vượt quá giới hạn.";
            case "301026":
                return "Một nhánh dịch vụ mới không thay đổi gì so với dịch vụ cũ.";
            case "301027":
                return "Mã ngôn ngữ không được Hệ thống hỗ trợ.";
            case "301029":
                return "Số thuê bao không thuộc phạm vi vùng.";
            case "302001":
                return "RBT đã tồn tại.";
            case "302002":
                return "Lỗi truyền file RBT.";
            case "302003":
                return "Nhạc chờ không tồn tại.";
            case "302004":
                return "RBT đã bị yêu cầu xóa.";
            case "302005":
                return "RBT của CP yêu cầu xử lý không thuộc về CP đó.";
            case "302006":
                return "RBT đã được yêu cầu sửa chữa.";
            case "302007":
                return "Số lượng kết quả truy vấn bằng 0.";
            case "302008":
                return "RBT đang trong trạng thái được thay đổi.";
            case "302009":
                return "RBT trong thư để tải lên có lỗi.";
            case "302010":
                return "Lỗi tính cước thuê bao.";
            case "302011":
                return "Nhạc chờ đã có trong bộ sưu tập";
            case "302015":
                return "RBT đã ở trạng thái ẩn (chưa kích hoạt).";
            case "302016":
                return "RBT đã ở trạng thái được phép hiển thị.";
            case "302017":
                return "Hộp âm nhạc không tồn tại.";
            case "302018":
                return "RBT chưa được tải về.";
            case "302019":
                return "RBT hết hạn sử dụng.";
            case "302020":
                return "Số lượng RBT trong hộp âm nhạc vượt quá giới hạn.";
            case "302021":
                return "Kiểu thư mục không tồn tại.";
            case "302022":
                return "Mã xác định trong của thư mục không tồn tại.";
            case "302023":
                return "Không tạo được thư mục.";
            case "302026":
                return "Không ẩn được trạng thái của RBT.";
            case "302027":
                return "Không hiện được trạng thái của RBT.";
            case "302028":
                return "RBT đang đợi được chấp nhận.";
            case "302029":
                return "Lỗi sai thời hạn sử dụng RBT: Thời gian sử dụng lại đặt trước thời gian hiện thời hoặc Thời hạn sử dụng sai (bắt đầu và kết thúc)";
            case "302030":
                return "Thời gian chơi RBT bị đè lên nhau.";
            case "302031":
                return "Mã kiểu thư mục không tồn tại hoặc sai định dạng.";
            case "302032":
                return "Cấu trúc thư mục sai và không chứa được RBT.";
            case "302033":
                return "Thư mục gốc không được chứa RBT (hệ thống chỉ cho phép thư mục con chứa RBT)";
            case "302034":
                return "Không được xóa thư mục chứa RBT.";
            case "302035":
                return "Không xóa được thư mục chứa thư mục con.";
            case "302037":
                return "Không sao chép được tất cả RBTs trong thư mục.";
            case "302038":
                return "Không sao chép được một vài RBTs trong thư mục.";
            case "302039":
                return "Các trường đợi được chấp nhận không thể sửa chữa. Các trường đang ở trong trạng thái bị xóa.";
            case "302040":
                return "Ngôn ngữ không tồn tại.";
            case "302041":
                return "Công ty không tồn tại.";
            case "302042":
                return "Mã vùng không tồn tại.";
            case "302043":
                return "Sai định dạng file.";
            case "302044":
                return "Không ẩn được bài hát trong hộp âm nhạc.";
            case "302045":
                return "Không thể thay đổi thuộc tính tài nguyên của thư mục.";
            case "302046":
                return "Thư mục mẹ không tồn tại.";
            case "302047":
                return "Thư mục RBT không tồn tại.";
            case "302048":
                return "Hộp âm nhạc đã tồn tại.";
            case "302052":
                return "Hộp âm nhạc quá hạn.";
            case "302053":
                return "Hộp âm nhạc đang trọng trạng thái chờ được chấp nhận.";
            case "302054":
                return "Không ẩn được trạng thái hiện thời của hộp âm nhạc.";
            case "302055":
                return "Không hiển thị được trạng thái hiện thời của hộp âm nhạc.";
            case "302056":
                return "Thư mục chứ RBT không tồn tại.";
            case "302057":
                return "Thư mục chứa RBT đang đợi được chấp nhận.";
            case "302058":
                return "Không ẩn được trạng thái hiện thời của thư mục chứa RBT.";
            case "302059":
                return "Không hiển thị được trạng thái hiện thời của thư mục RBT.";
            case "302060":
                return "Không thực hiện thay đổi một chuỗi RBT.";
            case "302061":
                return "Không thực hiện được thay đổi chuỗi";
            case "302065":
                return "Ngày hết hạn sử dụng của hôm âm nhạc sớm hơn ngày hiện thời.";
            case "302066":
                return "Hộp âm nhạc đang đợi được chấp nhận đã bị xóa nên không thể thay đổi được.";
            case "302067":
                return "Hộp âm nhạc không thể thay đổi.";
            case "302068":
                return "RBT không thuộc một danh sách RBTs nào cả.";
            case "302069":
                return "Tất cả RBTs đã bao gồm trong danh sách RBT.";
            case "302070":
                return "Không lấy được thư mục hoạt động của file announcement trong hộp âm nhạc.";
            case "302071":
                return "Đã tồn tại cả hai trường ghi người gọi và nhận.";
            case "302072":
                return "Không tồn tại cả hai trường ghi người gọi và nhận.";
            case "302073":
                return "Thuê bao hoặc tài nguyên RBT không tồn tại.";
            case "302074":
                return "RBT không thể được sửa chữa.";
            case "302075":
                return "Số nhạc nền không tồn tại trong mục ghi cấu hình.";
            case "302076":
                return "Âm nhạc nền không tồn tại.";
            case "302078":
                return "Không soạn được RBT.";
            case "302079":
                return "Số người gọi đã đặt trước đó.";
            case "302080":
                return "Thời gian hiệu lực bị sai.";
            case "302082":
                return "Vượt quá hạn sử dụng của hộp âm nhạc.";
            case "302088":
                return "Thuê bao chưa tải RBT.";
            case "302091":
                return "RBT và hộp âm nhạc  hết hạn sử dụng và không gia hạn được.";
            case "302093":
                return "Hạn sử dụng của một gói sớm hơn thời gian hiện thời.";
            case "302100":
                return "RBT đã tồn tại trước đó.";
            case "302101":
                return "Announcement file không tồn tại.";
            case "302102":
                return "Không sao chép được file announcement.";
            case "302103":
                return "Mã trường ghi RBTs ngầm định không tồn tại.";
            case "302104":
                return "Trạng thái hiện thời của gói RBT không ẩn được.";
            case "302105":
                return "Trạng thái hiện thời của gói RBT không hiển thị được.";
            case "302110":
                return "Ngày bắt đầu sớm hơn ngày kết thúc thời hạn sử dụng.";
            case "302112":
                return "Sai lệch hạn sử dụng.";
            case "302119":
                return "Trạng thái RBT bị lỗi.";
            case "302123":
                return "RBT tồn tại trong thư viện cá nhân.";
            case "302124":
                return "Kiểu RBT khác nhau.";
            case "302125":
                return "Kiểu RBT đặt không trùng với kiểu trong danh sách. Ví dụ kiểu RBT được đặt là PLUS RBT nhưng trong danh sách RBT lại là RBT thường.";
            case "302133":
                return "Số lượng RBTs tải vượt quá tối đa cho phép";
            case "303001":
                return "Thuê bao đã định nghĩa nhóm gọi đến (gồm cả tên và số thuê bao).";
            case "303002":
                return "Khi sửa chữa hoặc xóa một nhóm người gọi, trường ghi nhận báo nhóm đó không tồn tại.";
            case "303003":
                return "Nhóm người gọi không thể bổ xung bởi số người trong nhóm vượt quá giới hạn cho phép.";
            case "303004":
                return "Nhóm người gọi bao gồm những thành viên không thể xóa được.";
            case "303011":
                return "Thuê bao đã tồn tại trong nhóm.";
            case "303012":
                return "Thuê bao không tồn tại trong nhóm.";
            case "303013":
                return "Số thuê bao trong nhóm vượt quá giới hạn.";
            case "303014":
                return "Không thể sửa được số của thuê bao bởi thuê bao này nằm trong nhóm khác.";
            case "303015":
                return "Số lượng thuê bao gọi tới vượt quá giới hạn cho phép.";
            case "303021":
                return "RBT đã tồn tại trong hộp âm nhạc.";
            case "303023":
                return "Số lượng RBT được tải về vượt quá giới hạn cho phép.";
            case "303024":
                return "Số lượng RBT vượt quá giới hạn cho phép.";
            case "303025":
                return "Gói tải về không tồn tại.";
            case "303028":
                return "Gói chuẩn bị tải về đã được tải trước đó.";
            case "303029":
                return "Thuê bao không tải gói về.";
            case "303030":
                return "Thuê bao không được phép tải nhiều gói của một CP.";
            case "303031":
                return "Hộp âm nhạc đã tồn tại.";
            case "303032":
                return "Hộp âm nhạc không tồn tại.";
            case "303033":
                return "Chủ sở hữu của hộp âm nhạc không tồn tại.";
            case "303041":
                return "RBT đã tồn tại trong hộp âm nhạc.";
            case "303042":
                return "RBT không tồn tại trong hộp âm nhạc.";
            case "303043":
                return "Nội dung của nhóm RBT không sửa chữa được.";
            case "303051":
                return "Cài đặt RBT đã tồn tại.";
            case "303052":
                return "Cài đặt cho RBT không tồn tại.";
            case "303053":
                return "Nhóm hoặc bộ phận không tồn tại.";
            case "303054":
                return "Tình trạng dịch vụ của nhóm hoặc bộ phận không bình thường";
            case "303056":
                return "Nguồn RBT không nằm trong thư viện nhạc cá nhân của người sử dụng, mà sẽ được copied.";
            case "303057":
                return "Thông tin cấu hình hệ thống thiết yếu không tồn tại";
            case "304001":
                return "Không tìm thấy giá trị thống kê.";
            case "306001":
                return "RBT ngầm định không tồn tại.";
            case "306002":
                return "Hệ thống báo lỗi khi hiển thị mã RBT.";
            case "306003":
                return "Hệ thống báo lỗi khi mã nhận dạng trong của RBT chuyển thành mã RBT.";
            case "306004":
                return "Tham số vào sai.";
            case "306012":
                return "Mã vùng không tồn tại.";
            case "307016":
                return "Nhóm đã cài đặt rồi.";
            case "307017":
                return "Dải số không tồn tại";
            case "308001":
                return "Người nhận quà tặng RBT không đăng ký dịch vụ RBT";
            case "308002":
                return "Số lượng RBT của người nhận quà tặng RBT đã vượt quá giới hạn cho phép.";
            case "308003":
                return "Người nhận quà tặng không phải thuộc vùng thuê bao cho phép.";
            case "308004":
                return "Người nhận quà tặng đã có quà tặng này trong nhóm rồi.";
            case "308005":
                return "Số tháng tặng quà vượt quá giá trị cho phép.";
            case "308006":
                return "Người nhận quà tặng dịch vụ RBT cũng đã đăng kí dịch vụ RBT.";
            case "308007":
                return "Người được tặng không được là người tặng RBT";
            case "308008":
                return "Dịch vụ hết hạn sử dụng.";
            case "308009":
                return "Một phần của gói đang download bị lỗi!";
            case "308010":
                return "Thuê bao đã có RBTs ngầm định, cài đặt không thực hiện được.";
            case "308011":
                return "Một RBT không thể đặt được vào hộp âm nhạc.";
            case "308012":
                return "RBT tồn tại trong danh sách RBT rồi.";
            case "308013":
                return "Tải không thành công. Bạn đã có bài hát này hoặc bộ sưu tập của bạn đã đầy.";
            case "308014":
                return "Lệnh gửi tặng bị lỗi.";
            case "308015":
                return "Lệnh gửi tặng bị lỗi.";
            case "308016":
                return "Thực hiện lệnh gửi tặng bị lỗi.";
            case "308017":
                return "Thực hiện lệnh gửi tặng bị lỗi.";
            case "308023":
                return "Bài hát (RBT) đã tồn tại hoặc đang được gửi tặng.";
            case "309001":
                return "Vượt quá khả năng cung cấp của hệ thống.";
            case "309002":
                return "Yêu cầu mã kiểm tra";
            case "309003":
                return "Chính sách đăng ký không tìm thấy.";
            case "309004":
                return "Không xóa và tạo được thuê bao tại website.";
            case "309005":
                return "Chưa đặt kiểu truy cập";
            case "309006":
                return "Số lượng thue bao định nghĩa trong ngày vượt quá giới hạn.";
            case "309007":
                return "Không xóa hoặc tạo được thuê bao.";
            case "309008":
                return "Thuê bao đang được tạo hoặc xóa.";
            case "309113":
                return "Người dùng không dùng được dịch vụ RBT .";
            case "309114":
                return "Thuê bao không thể xóa được.";
            case "309115":
                return "Chưa đặt kiểu thuê bao.";
            case "309116":
                return "Sai kiểu thuê bao hoặc kiểu truy cập.";
            case "309117":
                return "Số lượng thuê bao hằng ngày dùng dịch vụ vượt quá giới hạn cho phép.";
            case "309118":
                return "Thuê bao không được phép sử dụng dịch vụ dịch vụ RBT.";
            case "309119":
                return "Vùng của thuê bao không được phép dùng dịch vụ.";
            case "309120":
                return "Thời gian để tạo hoặc xóa một thuê bao nằm trong khoảng thời gian không cho phép.";
            case "309121":
                return "Thuê bao thuộc nhóm khác.";
            case "309122":
                return "Tạo được dịch vụ cho thuê bao nhưng không gửi được tin nhắn SMS. Nhắc thuê bao để lấy mật khẩu qua Webiste.";
            case "310001":
                return "Thuê bao không đủ tiền trong tài khoản.";
            case "310010":
                return "Thuê bao không đủ tiền trong tài khoản.";
            case "312003":
                return "Mã vùng không tồn tại.";
            case "312004":
                return "Tài khoản của thuê bao không được phép thực hiện yêu cầu.";
            case "312005":
                return "Mã không tồn tại.";
            case "312008":
                return "Administrator không tồn tại.";
            case "312009":
                return "Mã đăng nhập của tài khoản hệ thống đã tồn tại.";
            case "312010":
                return "Mã đăng nhập của tài khoản hệ thống không tồn tại.";
            case "312011":
                return "Mật khẩu cũ vào không đúng.";
            case "312017":
                return "Quản trị không có quyền hoạt động trên thuê bao.";
            case "313001":
                return "Mã trả về không tồn tại.";
            case "313002":
                return "Dừng lại một vài tác vụ có lỗi.";
            case "313003":
                return "Nhận lại một vài tác vụ có lỗi.";
            case "313004":
                return "Sửa chưa các tác vụ tại thời điểm hoạt động bị lỗi.";
            case "314001":
                return "Tên tham số không tồn tại.";
            case "314002":
                return "Tên mới của biến không tuân theo yêu cầu đăng nhập.";
            case "314003":
                return "Tham số cập nhật không tồn tại.";
            case "314004":
                return "Kiểu tham số hàm gọi không tồn tại.";
            case "314005":
                return "Lỗi xử lý database";
            case "314006":
                return "Mục cấu hình đã tồn tại";
            case "314007":
                return "Tham số vào không đúng hoặc không đúng với qui tắc cấu hình.";
            case "314008":
                return "Hệ thống lỗi để cập nhật cấu hình";
            case "315001":
                return "Danh sách xếp hạng không tồn tại";
            case "315002":
                return "Vào vị trí của bảng xếp hạng sai.";
            case "315003":
                return "Nội dung của một bảng xếp hạng bị sai.";
            case "315004":
                return "Bảng xếp hạng bị trùng đè.";
            case "315005":
                return "Bảng xếp hàng không thể bị xóa";
            case "315006":
                return "Một vài RBTs có chung một vị trí trong bảng xếp hạng.";
            case "315007":
                return "Một bảng xếp hạng có hiệu lực sớm hơn thời gian hiện tại.";
            case "316001":
                return "Một phiên yêu cầu tồn tại.";
            case "316002":
                return "Không có RBT tương ứng trong bảng xếp hạng.";
            case "316003":
                return "Mã RBT không tồn tại.";
            case "316004":
                return "RBT được kích hoạt không tồn tại hoặc ở trạng thái lỗi.";
            case "317001":
                return "Thuê bao không yêu cầu dịch vụ.";
            case "317002":
                return "Thuê bao bị lỗi không thể khởi tạo dịch vụ.";
            case "317003":
                return "Thuê bao chưa kích hoạt dịch vụ thêm.";
            case "317004":
                return "Thuê bao đang ở trạng thái lỗi và không thể hủy dịch vụ.";
            case "317006":
                return "RBT không phải là RBT plus.";
            case "317007":
                return "Bộ sưu tập cá nhân đã vượt quá mức cho phép";
            case "317008":
                return "Thuê bao không được phép tải RBT – plus lên hệ thống.";
            case "317010":
                return "Sau khi RBT plus được chấp thuận, RBT tải về lỗi.";
            case "318004":
                return "Bạn không thể xóa hoặc sửa các trường đang đợi chấp thuận.";
            case "319003":
                return "Luật không thể áp dùng cho dịch vụ thông tin.";
            case "319004":
                return "Luật này không thể áp dụng cho hàm dịch vụ này.";
            case "319005":
                return "Dịch vụ được yêu cầu nên không xóa được.";
            case "319006":
                return "Dịch vụ chưa hoàn tất nên không thể tải về được.";
            case "319008":
                return "Luật phí dịch vụ đã tồn tại.";
            case "319009":
                return "Dịch vụ đã tồn tại";
            case "319010":
                return "Luật cho dịch vụ đã tồn tại.";
            case "319011":
                return "Dịch vụ không tồn tại hoặc đang bị ẩn.";
            case "319012":
                return "Luật cho dịch vụ không tồn tại.";
            case "319013":
                return "Chính sách thu tiền không tồn tại.";
            case "319014":
                return "Mô tả của chính sách thu tiền không tồn tại.";
            case "319015":
                return "Thuê bao không dùng dịch vụ không tồn tại.";
            case "319016":
                return "Thuê bao dùng dịch vụ không tồn tại.";
            case "319017":
                return "Thuê bao vừa yêu cầu dùng dịch vụ.";
            case "319018":
                return "Chức năng này đưuợc yêu cầu lại.";
            case "319019":
                return "Cờ thời gian khác nhau.";
            case "319020":
                return "Chính sách thu tiền đã tồn tại.";
            case "319021":
                return "Số lượng thuê bao yêu cầu dịch vụ vượt quá giới hạn.";
            case "319022":
                return "Thuê bao không thể gọi dịch vụ do sô thuê bao không nằm trong dải số cho phép.";
            case "320001":
                return "Thuê bao yêu cầu dịch vụ gọi đến.";
            case "320002":
                return "Thuê bao không yêu cầu dịch vụ gọi đến.";
            case "321001":
                return "Các cài đặt liên quan đến số thuê bao đã tồn tại.";
            case "321002":
                return "Cài đặt RBT của thuê bao không tồn tại.";
            default:
                break; // TODO: might not be correct. Was : Exit Select

                break;
        }
        return "Lỗi không thể xác định.";
    }

    private function getErrEN() {
        switch ($this->code) {
            case "000000":
                return "The requested operation is completed.";
            case "000001":
                return "The request is successfully accepted.";
            case "000002":
                return "Adding or modifying a package succeeds without any voice.";
            case "000003":
                return "The request for download is accepted. The RBT will be downloaded after the user registers the RBT service. Users can register the service upon downloading the RBT in non-real time.";
            case "100001":
                return "Unknown errors";
            case "100002":
                return "The system is busy, or other undefined errors occur.";
            case "100003":
                return "The operation times out.";
            case "100004":
                return "The network is abnormal.";
            case "100005":
                return "The database operation is abnormal.";
            case "100006":
                return "The database operation fails.";
            case "100007":
                return "The service does not exist currently.";
            case "100008":
                return "The internal execution process of the database fails.";
            case "100009":
                return "The relevant configuration item does not exist.";
            case "100010":
                return "The system does not support this operation.";
            case "200000":
                return "The verification configuration of parameters does not exist.";
            case "200001":
                return "The value of the mandatory parameter is null.";
            case "200002":
                return "The parameter format is incorrect.";
            case "200003":
                return "The parameter length exceeds the preset range.";
            case "200004":
                return "All the entered parameters are null.";
            case "200005":
                return "The time format of setting an RBT is incorrect.";
            case "200006":
                return "Redundant parameters are entered.";
            case "200007":
                return "The access account does not exist or the password is incorrect.";
            case "200008":
                return "The access account is not allowed to access the system with a low credit level.";
            case "200009":
                return "The time type is incorrect.";
            case "200010":
                return "The start time is later than the end time.";
            case "200011":
                return "The account does not exist.";
            case "200012":
                return "The password corresponding to the account is incorrect.";
            case "200013":
                return "The access Portal type corresponding to the account is incorrect.";
            case "201001":
                return "The phone number format is incorrect.";
            case "201002":
                return "The entered password is invalid.";
            case "201003":
                return "The password does not exist.";
            case "202001":
                return "The format of an RBT group code is incorrect.";
            case "202002":
                return "The format of an RBT code is incorrect.";
            case "300001":
                return "The number of members reaches the upper limit.";
            case "300002":
                return "Obtaining information fails.";
            case "301001":
                return "The subscriber does not exist.";
            case "301002":
                return "The subscriber exists already.";
            case "301003":
                return "The password is invalid.";
            case "301004":
                return "Sending an SM to the subscriber fails.";
            case "301005":
                return "Verifying authentication code fails.";
            case "301006":
                return "The subscriber is already in the modified status.";
            case "301008":
                return "Authentication code cannot be obtained due to subscriber status error.";
            case "301009":
                return "Service register is not allowed because of subscriber status error.";
            case "301010":
                return "Service deregister is not allowed because of subscriber status error.";
            case "301011":
                return "The subscriber owns fee.";
            case "301012":
                return "The authentication code is not generated.";
            case "301013":
                return "Downloading is not allowed due to the service status of the subscriber.";
            case "301014":
                return "Setting is not allowed due to the service status of the subscriber.";
            case "301015":
                return "This operation is not allowed due to the service status of the subscriber.";
            case "301016":
                return "The presented parties do not allow others to copy their RBTs.";
            case "301017":
                return "The system configures that this item cannot be copied.";
            case "301018":
                return "The phone number of the subscriber whose RBTs are copied does not exist.";
            case "301019":
                return "The RBT list includes invalid RBTs. (The RBTs do not belong to a corp or the status of the RBTs is incorrect.) ";
            case "301020":
                return "The RBT list number does not belong to the department of the corp.";
            case "301021":
                return "The consumption limit is specified.";
            case "301022":
                return "The ID of the consumption limit does not exist.";
            case "301023":
                return "The consumption limit exceeds.";
            case "301024":
                return "The brand does not exist.";
            case "301025":
                return "The new charging system is the same as the original one and no change is required.";
            case "309123":
                return "The times of registering the service in a day by the subscriber reaches its upper limit.";
            case "301026":
                return "The new service brand is the same as the original one and no change is required.";
            case "301027":
                return "The system does not support the language code.";
            case "301028":
                return "The times of getting the password back by the subscriber exceeds its limit.";
            case "301029":
                return "The phone number of the subscriber is not in the area number segment.";
            case "301030":
                return "The phone number of a subscriber is blacklisted.";
            case "301031":
                return "The phone number of a subscriber is not in the number segment of this province.";
            case "301032":
                return "The brand exists.";
            case "301033":
                return "The brand does not exist.";
            case "301034":
                return "The password of the subscriber is not saved on the RBT platform.";
            case "301035":
                return "Changing the subscriber phone number fails.";
            case "301036":
                return "The added system default RBT is not an ordinary RBT uploaded by a CP.";
            case "302001":
                return "The RBT exists.";
            case "302002":
                return "Transmitting the RBT file fails.";
            case "302003":
                return "The RBT does not exist.";
            case "302004":
                return "The RBT has already been requested for deletion.";
            case "302005":
                return "The RBT that the CP requests for operation is not the one uploaded by the CP.";
            case "302006":
                return "The RBT has already been requested for modification.";
            case "302007":
                return "The number of query results is 0.";
            case "302008":
                return "The subscriber is already in the modified status.";
            case "302009":
                return "Errors occur when the category voice is uploaded.";
            case "302010":
                return "The charging fails.";
            case "302011":
                return "The RBT downloading is repeated.";
            case "302012":
                return "The uploaded RBT files or listening files are not in the temporary category.";
            case "302015":
                return "The RBT is in the hidden status.";
            case "302016":
                return "The RBT is in the displayed status.";
            case "302017":
                return "The music box does not exist.";
            case "302018":
                return "The RBT has not been downloaded.";
            case "302019":
                return "The RBT expires.";
            case "302020":
                return "The number of RBTs in the music box exceeds its maximum.";
            case "302021":
                return "The category type does not exist.";
            case "302022":
                return "The unique internal ID of a category does not exist.";
            case "302023":
                return "Creating a category fails.";
            case "302024":
                return "The CP does not own the RBT.";
            case "302025":
                return "The CP is in the status of unable to upload RBTs.";
            case "302026":
                return "The RBT in the current status cannot be hidden.";
            case "302027":
                return "The RBT in current status cannot be displayed.";
            case "302028":
                return "The RBT is in to-be-approved status.";
            case "302029":
                return "Invalid absolute expiry date.The absolute expiry date is earlier than the current time or the relative validity period of the RBT.";
            case "302030":
                return "The time for setting RBTs overlaps.";
            case "302031":
                return "The ID of the category type does not exist or the category type is abnormal.";
            case "302032":
                return "The category is not a leaf category and RBTs cannot be stored in it.";
            case "302033":
                return "The parent category is a leaf category and it contains RBTs.Only a leaf category can be stored with RBTs.";
            case "302034":
                return "You cannot delete the category, because it still contains RBTs.";
            case "302035":
                return "You cannot delete the category because it contains sub-directories.";
            case "302037":
                return "Copying all RBTs in batches fails.";
            case "302038":
                return "Copying several RBTs in batches partially fails.";
            case "302039":
                return "The records of the to-be-approved table cannot be modified because they are in the status of deletion sent for approval.";
            case "302040":
                return "The language does not exist.";
            case "302041":
                return "The corp does not exist.";
            case "302042":
                return "The area does not exist.";
            case "302043":
                return "Incorrect file name or content format of the voice file of uploaded music boxes or RBT directories";
            case "302044":

                return "RBTs in the music box cannot be hidden or deleted.";

            case "302046":
                return "The parent category does not exist.";
            case "302047":
                return "The RBT category exists.";
            case "302048":
                return "The music box exists.";
            case "302049":
                return "The number of RBTs uploaded by the CP reaches its maximum.";
            case "302050":
                return "Uploading DIY RBTs is not allowed due to the current status of the subscriber.";
            case "302051":
                return "The number of RBTs in the corp reaches its maximum.";
            case "302052":
                return "The music box expires.";
            case "302053":
                return "The music box is in to-be-approved status.";
            case "302054":
                return "The music box in current status cannot be hidden.";
            case "302055":
                return "The music box in the current status cannot be displayed.";
            case "302056":
                return "The RBT category does not exist.";
            case "302057":
                return "The RBT category is in to-be-approved status.";
            case "302058":
                return "The RBT category in the current status cannot be hidden.";
            case "302059":
                return "The RBT category in the current status cannot be displayed.";
            case "302060":
                return "Approving in batches partially fails.";
            case "302061":
                return "Approving in batches entirely fails.";
            case "302062":
                return "After the PLUS RBT is approved, RBT downloading fails. Downloading RBTs fails after the DIY RBTs are approved.";
            case "302063":
                return "Charging fails after corp RBTs are approved.";
            case "302064":
                return "The number of music boxes that can be uploaded by the CP reaches the maximum.";
            case "302065":
                return "The expiry date of the music box is earlier than the current time.";
            case "302066":
                return "You cannot modify the music box because it is in the status of deletion sent for approval.";
            case "302067":
                return "The music box cannot be modified.";
            case "302068":
                return "The RBT that does not belong to an RBT list exists.";
            case "302069":
                return "All RBTs in the RBT list are included. Delete the RBT list directly.";
            case "302070":
                return "Obtaining the working category of the music box voice file fails.";
            case "302071":
                return "The records of the calling party and the called party exist.";
            case "302072":
                return "The records of the calling party and the called party do not exist.";
            case "302073":
                return "The subscriber or RBT resources do not exist.";
            case "302074":
                return "The RBT cannot be cut.";
            case "302075":
                return "In configuration items, the background music code does not exist.";
            case "302076":
                return "The background music does not exist.";
            case "302077":
                return "The RBT does not match the background music type when they are mixed.";
            case "302078":
                return "Mixing RBTs fails.";
            case "302079":
                return "The called number has been set.";
            case "302080":
                return "The relative validity period is invalid when exceeding the absolute expiry date of the RBT.";
            case "302081":
                return "The type of the listened RBT file is different from the set one.";
            case "302082":
                return "The validity period of a music box later than the maximum validity period of the RBTs in it. It is not used at present.";
            case "302083":
                return "The type of a new subscriber is the same as the old one.";
            case "302084":
                return "The music channel cannot be uploaded.";
            case "302085":
                return "The RBTs in the mode of the relative validity period or the fixed end bill date cannot be renewed.";
            case "302086":
                return "The supported device and the device type are not configured.";
            case "302087":
                return "The folder where the listened RBT files are stored is not configured.";
            case "302088":
                return "The subscriber does not download the RBT or music box.";
            case "302089":
                return "The Web or IVR device is not configured.";
            case "302090":
                return "The RBT cannot be renewed because it is in the mode of the non-relative validity period.";
            case "302091":
                return "The RBT or music box expires and they cannot be renewed.";
            case "302093":
                return "The validity period of a package is earlier than the current time.";
            case "302094":
                return "The CP does not exist.";
            case "302095":
                return "A package with the same name as that of the CP exists.";
            case "302096":
                return "The package does not exist.";
            case "302097":
                return "The supported device and its type are not configured.";
            case "302098":
                return "The package is in the abnormal or hidden status.";
            case "302099":
                return "The system administrator does not exist.";
            case "302100":
                return "RBTs with the same CP, song name and singer name exist.";
            case "302101":
                return "The voice file does not exist.";
            case "302102":
                return "Copying voices fails.";
            case "302103":
                return "The system default ID of the RBT does not exist.";
            case "302104":
                return "The RBT package in the current status cannot be hidden.";
            case "302105":
                return "The RBT package in the current status cannot be displayed.";
            case "302106":
                return "If the package is the one that does not distinguish different CPs, the CP flag cannot be entered.";
            case "302107":
                return "If the package is the one distinguishing different CPs, the CP flag needs to be entered.";
            case "302108":
                return "The subscriber has downloaded all the RBTs in the RBT package.";
            case "302109":
                return "The package is in the uploaded status because adding or modifying the package succeeds, or activating the package fails.";
            case "302110":
                return "The relative validity period of the RBT is invalid when the end time of the relative validity period exceeds the absolute expiry date.";
            case "302111":
                return "The CP does not exist or the CP status is abnormal.";
            case "302112":
                return "The relative validity period is invalid because the absolute expiry date of an RBT or a music box is earlier than the cumulative time of the relative validity periods.";
            case "302113":
                return "The package object is not in the uploaded status.";
            case "302114":
                return "Records in the to-be-approved table have been modified already.";
            case "302115":
                return "The additional information of resources does not exist.";
            case "302116":
                return "The additional information of resources exists.";
            case "302117":
                return "The additional information of resources is not in the to-be-approved status.";
            case "302118":
                return "The additional information of resources is in the to-be-approved status.";
            case "302119":
                return "The RBT status is incorrect.";
            case "302120":
                return "The resource type is different from the category type.";
            case "302121":
                return "The parent category is in the to-be-approved status and a subcategory is not allowed to adding to it.";
            case "302122":
                return "The parent category is in the to-be-approved status and it cannot approve a subcategory.";
            case "302123":
                return "The RBT exists in the personal tone library.";
            case "302124":
                return "The RBT types are different. There are PLUS RBTs and ordinary RBTs.";
            case "302125":
                return "The set RBT type does not comply with the type set in the RBT list. For example, you set RBT type to PLUS RBT, but the RBT type in the RBT list is ordinary RBT.";
            case "302126":
                return "The ordinary RBT is not uploaded by the CP.";
            case "302127":
                return "Resource information does not exist.";
            case "302128":
                return "The number of groups exceeds its maximum defined by the brand.";
            case "302129":
                return "The number of set calling parties exceeds its maximum defined by the brand.";
            case "302130":
                return "The number of uploaded DIY RBTs exceeds its maximum defined by the brand.";
            case "302131":
                return "The setting record does not exist.";
            case "302132":
                return "The number of uploaded PLUS RBTs exceeds its maximum defined by the brand.";
            case "302133":
                return "The number of downloaded RBTs exceeds its maximum defined by the brand.";
            case "302200":
                return "All the category owners are invalid.";
            case "302201":
                return "In the to-be-approved music box, there are RBTs whose statuses are abnormal or RBTs that are expired.";
            case "302202":
                return "In the uploaded music box, there are RBTs whose statuses are abnormal or RBTs that are expired.";
            case "302203":
                return "The length of an RBT code is incorrect.";
            case "302205":
                return "Errors occur when the system automatically generates an RBT code.";
            case "302206":
                return "Errors occur when the system automatically generates a music box code or a music package code.";
            case "302207":
                return "The system does not support uploading the RBT of this format.";
            case "302208":
                return "The effective period field of a valid RBT or music box cannot be modified.";
            case "302209":
                return "The current RBT coding rule does not support uploading an RBT of this type.";
            case "302210":
                return "The RBT cannot be downloaded in this method.";
            case "303001":
                return "The information of the calling group exists, such as the name and serial number.";
            case "303002":
                return "The calling group does not exist when it is deleted, modified or queried.";
            case "303003":
                return "You cannot add a calling group any more because the number of calling groups exceeds its maximum.";
            case "303004":
                return "The calling group cannot be deleted because it contains members.";
            case "303011":
                return "The member exists in the calling group when you add it to the group.";
            case "303012":
                return "The member does not exist in the calling group when it is deleted, modified or queried.";
            case "303013":
                return "The number of members in the calling group reaches its upper limit.";
            case "303014":
                return "The calling number to be modified is the member of the called number group.";
            case "303015":
                return "The number of calling parties reaches or exceeds its maximum.";
            case "303021":
                return "The RBT exists already in the personal tone library When you download it to the personal tone library.";
            case "303023":
                return "The number of downloaded tones reaches its maximum.";
            case "303024":
                return "The number of set RBTs reaches its maximum.";
            case "303025":
                return "The downloaded package does not exist.";
            case "303026":
                return "Subscribers have downloaded packages without distinguishing CPs, so they are not allowed to download packages distinguishing CPs.";
            case "303027":
                return "Subscribers have downloaded packages distinguishing CPs, so they are not allowed to download packages without distinguishing CPs.";
            case "303028":
                return "The to-be-downloaded package has been downloaded before.";
            case "303029":
                return "The subscriber does not download the package.";
            case "303030":
                return "The subscriber is not allowed to download multiple packages of a CP.";
            case "303031":
                return "The RBT group exists already.";
            case "303032":
                return "The RBT group does not exist.";
            case "303033":
                return "The owner of the RBT group does not exist.";
            case "303041":
                return "When you add an RBT to an RBT group, the RBT already exists in the RBT group.";
            case "303042":
                return "The RBT does not exist when you delete, modify or query it.";
            case "303043":
                return "The content (such as a music box) of the RBT group cannot be modified.";
            case "303051":
                return "When you set an RBT, the record shows that the setting already exists.";
            case "303052":
                return "The RBT settings do not exist.";
            case "303053":
                return "The group or department does not exist.";
            case "303054":
                return "The service status of the group or the department is abnormal.";
            case "303055":
                return "You are not allowed to modify a set RBT group when setting charging conditions.";
            case "303056":
                return "The RBT is not in the personal tone library of the copied party.";
            case "303057":
                return "The essential system configuration information does not exist.";
            case "303058":
                return "Subscribers cannot download the corp RBT because they are not the members of the corp.";
            case "303059":
                return "Malicious download";
            case "303060":
                return "The number of setting records exceeds its maximum defined by the brand.";
            case "304001":
                return "The statistical value is not found.";
            case "306001":
                return "The system default RBT does not exist.";
            case "306002":
                return "The system prompts an error when the display code of an RBT turns to the mapping internal ID.";
            case "306003":
                return "The system prompts an error when the internal ID turns to the display code of an RBT.";
            case "306004":
                return "The entered parameter type is incorrect.";
            case "306005":
                return "You cannot add a leaf number segment under the number segment one level up because the number segment one level up is also a leaf number segment.";
            case "306006":
                return "Number segments of a same number segment category are overlapped.";
            case "306007":
                return "The number segment does not exist.";
            case "306008":
                return "The number segment contains sub-number segments.";
            case "306009":
                return "Areas one level up do not exist.";
            case "306010":
                return "Areas one level up are the smallest leaf areas.";
            case "306011":
                return "The area code exists.";
            case "306012":
                return "The area code does not exist.";
            case "306013":
                return "Areas containing sub-areas cannot be set to the smallest areas.";
            case "306014":
                return "Areas containing sub-areas cannot be deleted.";
            case "306015":
                return "Forwarding the SM to the RBT gateway fails.";
            case "306016":
                return "The charging event number does not exist.";
            case "306017":
                return "The number segment ID exists already.";
            case "306018":
                return "The normal leaf category ID does not exist.";
            case "306019":
                return "The relation ID between a number segment and a category does not exist.";
            case "306020":
                return "The number segment ID does not exist.";
            case "306021":
                return "The area code exists already.";
            case "307001":
                return "The department exists.";
            case "307002":
                return "The department code does not exist.";
            case "307003":
                return "The member does not enable relevant services.";
            case "307004":
                return "The number of the group members of the corp department exceeds its maximum.";
            case "307005":
                return "The member is not a department member of the corp.";
            case "307006":
                return "The corp RBT cannot be modified due to its current status.";
            case "307007":
                return "Some subscribers fail to register the RBT service.";
            case "307008":
                return "Some subscribers fail to deregister the RBT service.";
            case "307009":
                return "The department of a corp does not exist.";
            case "307010":
                return "The member exists in the corp department.";
            case "307011":
                return "The department one level up does not exist.";
            case "307012":
                return "The member belongs to another department.";
            case "307013":
                return "The time segment exists already.";
            case "307014":
                return "The special holiday exists.";
            case "307015":
                return "The status of the corp is abnormal.";
            case "307016":
                return "The group has been set already.";
            case "307017":
                return "The time segment number does not exist.";
            case "307018":
                return "The special holiday does not exist.";
            case "307019":
                return "Adding all department members fails.";
            case "307020":
                return "Adding some department members succeeded.";
            case "307021":
                return "Deleting all department members fails.";
            case "307022":
                return "Deleting some department members succeeded.";
            case "307023":
                return "Activating or suspending all corp RBTs of corp members fails.";
            case "307024":
                return "Activating or suspending some corp RBTs of corp members succeeded.";
            case "307025":
                return "The corp cannot be modified due to its current status.";
            case "307026":
                return "The account of the department operator exists already.";
            case "307027":
                return "The internal ID of the corp does not exist.";
            case "307028":
                return "The internal ID of the department does not exist.";
            case "307029":
                return "The department does not belong to the corp.";
            case "307030":
                return "The internal ID of the department operator does not exist.";
            case "307181":
                return "The corp does not exist.";
            case "307183":
                return "The number of corp department reaches its maximum.";
            case "307184":
                return "The number of departments reaches the maximum of a corp.";
            case "307185":
                return "The maximum number of departments exceeds the maximum number the department one level up allows.";
            case "307186":
                return "The corp fails to subscribe to the RBT service.";
            case "308001":
                return "The presented party does not register the RBT service.";
            case "308002":
                return "The personal tone library of the presented party is full.";
            case "308003":
                return "The presented party to whom the RBT service is presented is not a local subscriber.";
            case "308004":
                return "In this month, the presented party has been presented the RBT service.";
            case "308005":
                return "In this month, the number of months during which the RBT service is presented exceeds the value specified by the system.";
            case "308006":
                return "The presented party to whom the RBT function is presented is an RBT subscriber.";
            case "308007":
                return "The presented parties are the restricted subscribers who cannot present to themselves.";
            case "308008":
                return "The RBT service expires.";
            case "308009":
                return "Part of batch downloading fails.";
            case "308010":
                return "The subscriber has default RBTs. This setting fails.";
            case "308011":
                return "An RBT cannot be added to the music box.";
            case "308012":
                return "The RBT exists in the RBT list.";
            case "308013":
                return "Downloading in batches fails.";
            case "308014":
                return "Presenting in batches fails.";
            case "308015":
                return "Setting in batches fails.";
            case "308016":
                return "Part of batch presenting fails.";
            case "308017":
                return "Part of batch setting fails.";
            case "308019":
                return "The presenting number does not exist. It is not used at present, and is reserved for the service development.";
            case "308020":
                return "Generating the presenting secret key fails.";
            case "308021":
                return "The presenting secret key does not exist.";
            case "308022":
                return "The RBT to be activated is in the activated status.";
            case "308023":
                return "The RBT has been presented. More exactly, the presenting party has presented the same RBT to the same presented party.";
            case "308024":
                return "The number of RBTs downloaded by the subscriber reaches its maximum defined by the brand.";
            case "308025":
                return "The number of RBTs set by the subscriber reaches its maximum defined by the brand.";
            case "308026":
                return "If the reply time of presented party and the presenting time of presenting party are not in the same year and month, presenting fails.";
            case "308027":
                return "The number of RBTs or music boxes presented exceeds the number set in the system.";
            case "308028":
                return "The number of RBTs that are downloaded by the subscriber exceeds the limit.";
            case "308029":
                return "The number of RBTs that are copied by the subscriber exceeds the limit.";
            case "309001":
                return "The system capacity exceeds its limit.";
            case "309002":
                return "The authentication code is needed.";
            case "309003":
                return "Service register or deregister strategy is not found.";
            case "309004":
                return "Registering the service through the Portal fails.";
            case "309005":
                return "The access type is not set.";
            case "309006":
                return "The number of users registering the service in a day reaches its maximum.";
            case "309007":
                return "Registering or deregistering the service fails.";
            case "309008":
                return "Service register or deregister is being processed.";
            case "309009":
                return "The corp member who has to register the service is not an ordinary RBT subscriber.";
            case "309010":
                return "The number of corp members registering the service reaches its maximum.";
            case "309011":
                return "The corp member does not exist because of service deregister.";
            case "309012":
                return "The corp member registers the service.";
            case "309113":
                return "Users cannot register the RBT service due to their current statuses.";
            case "309114":
                return "Subscribers cannot deregister the RBT service due to their current statuses.";
            case "309115":
                return "The subscriber type is not set.";
            case "309116":
                return "The subscriber type and access type are not set.";
            case "309117":
                return "The number of subscribers who deregister the service in a day reaches its maximum.";
            case "309118":
                return "Subscribers cannot register the RBT service due to their number segments.";
            case "309119":
                return "The area where the subscriber is located does not allow registering the service by a subscriber.";
            case "309120":
                return "The time of registering or deregistering the service is in the limited time segment.";
            case "309121":
                return "The subscriber belongs to another corp.";
            case "309122":
                return "Registering the service is processed successfully, but the system fails to send a notification SM. Notify the subscriber to obtain the password through the Web page.";
            case "309124":
                return "The CorpLicense file cannot be obtained.";
            case "309125":
                return "The number of corp members registering the services reaches the limit set in the CorpLicense file.";
            case "319030":
                return "The subscriber does not download the relevant package service.";
            case "309013":
                return "The user data is incorrect.";
            case "309014":
                return "The user does not enable the RBT service.";
            case "309015":
                return "The special service cannot be enabled.";
            case "309016":
                return "The special service cannot be canceled.";
            case "309017":
                return "The subscriber enables the RBT service.";
            case "309018":
                return "The user is in the normal service subscription status and not allowed subscribing again.";
            case "309019":
                return "The subscriber is in the Suspended status. Service subscription is not allowed.";
            case "309020":
                return "The subscriber is in the before service subscription status. Service subscription is not allowed.";
            case "309021":
                return "The subscriber is in the Suspended status because of arrearage. Service subscription is not allowed.";
            case "310001":
                return "The balance of the subscriber is not sufficient.";
            case "311001":
                return "The charging device address is incorrect.";
            case "311002":
                return "The I/O abnormalities occur on the charging device.";
            case "312002":
                return "The CP cannot be deleted because it contains RBTs that are available or invalid.";
            case "312003":
                return "The area code does not exist.";
            case "312004":
                return "The account of the subscriber is not granted the relevant operation authority.";
            case "312005":
                return "The role code does not exist.";
            case "312006":
                return "This number segment does not exist.";
            case "312007":
                return "The CP index exists.";
            case "312008":
                return "The administrator does not exist.";
            case "312009":
                return "The internal authentication account of the system exists.";
            case "312010":
                return "The internal authentication account of the system does not exist.";
            case "312011":
                return "The old password is incorrect when the password is modified.";
            case "312012":
                return "The account of the group operator or the department operator exists.";
            case "312013":
                return "The internal code of the group or department does not exist.";
            case "312014":
                return "The internal code of the group operator or department operator does not exist.";
            case "312015":
                return "The CP access code exists.";
            case "312016":
                return "The modified number segment of the administrator cannot contain the number segments of their inferior administrators.";
            case "312017":
                return "The administrator has no operation authority over the subscriber.";
            case "312018":
                return "The corp charging account exists.";
            case "312019":
                return "The corp charging account is incorrect before it is modified.";
            case "312020":
                return "The corp charging account is used after it is modified.";
            case "312021":
                return "The account is locked.";
            case "312022":
                return "The password expires.";
            case "312023":
                return "The operator one level up does not exist.";
            case "312024":
                return "The operation is not allowed to perform.";
            case "312025":
                return "The password is permanent, so, the time for reminding of the expiry and the outdated time are null.";
            case "312026":
                return "The record of the time of generating the password is not found and obtaining the outdated time and the time for reminding of the expiry fails.";
            case "313001":
                return "The return code does not exist.";
            case "313002":
                return "Stopping several tasks fails because unknown task names exist.";
            case "313003":
                return "Restoring tasks partially succeeded because unknown task names exist.";
            case "313004":
                return "Modifying the task running time fails.";
            case "314001":
                return "The parameter name does not exist.";
            case "314002":
                return "The new parameter value does not conform to the authentication rule.";
            case "314003":
                return "Parameter that can be updated does not exist.";
            case "314004":
                return "The queried parameter type does not exist.";
            case "314005":
                return "The database return code is unknown.";
            case "314006":
                return "The configuration item exists.";
            case "314007":
                return "The entered parameter is incorrect or it does not match the configuration strategy item.";
            case "314008":
                return "Updating configuration items of machines in other clusters.";
            case "315001":
                return "The rank list does not exist.";
            case "315002":
                return "Entered place of a rank list is invalid.";
            case "315003":
                return "The content of a rank list is invalid.";
            case "315004":
                return "The rank list settings exist.";
            case "315005":
                return "The rank list cannot be deleted due its current status.";
            case "315006":
                return "The place exists in the rank list.";
            case "315007":
                return "The effective time of the rank list is earlier than the current time.";
            case "316001":
                return "The transaction request exists.";
            case "316002":
                return "No RBT maps with the place in the rank list.";
            case "316003":
                return "The RBT ID does not exist.";
            case "316004":
                return "The activated RBT does not exist or its status is abnormal.";
            case "317001":
                return "The PLUS service exists.";
            case "317002":
                return "The RBT subscriber cannot enable the PLUS service due to an abnormal status.";
            case "317003":
                return "The subscriber does not enable the PLUS service.";
            case "317004":
                return "The RBT subscriber cannot deregister the PLUS service due to an abnormal status.";
            case "317005":
                return "The CP has no right to upload an RBT that can be cut.";
            case "317006":
                return "The RBT is not the PLUS RBT.";
            case "317007":
                return "You cannot upload PLUS RBTs to the personal library of the subscriber because it is full.";
            case "317008":
                return "The subscriber cannot upload PLUS RBTs due to the current status.";
            case "317009":
                return "The PLUS subscriber does not exist or the status is abnormal.";
            case "317010":
                return "RBT downloading fails after the PLUS RBT is approved.";
            case "318001":
                return "The approval flow relevant to the operation does not exist.";
            case "318002":
                return "The step relevant to the operation does not exist in the procedure.";
            case "318003":
                return "The person specified to approve the step does not exist.";
            case "318004":
                return "You cannot delete or modify the step that contains records that are not completely approved.";
            case "318005":
                return "The approval invoker relevant to the operation does not exist.";
            case "318006":
                return "The ID of the relation between the operation approval step and the invoker does not exist.";
            case "318007":
                return "The approval flow exists.More exactly, the information and steps of the approval flow are the same as those of the previous one).";
            case "318008":
                return "The approval step is performed again.More exactly, the same person approves the same step.";
            case "318009":
                return "The same operator maps with multiple flows. More exactly, the information of the flow is the same as that of other flows, but the steps in the flow are different.";
            case "318010":
                return "The strings of the approval steps contain step information that need not be approved.";
            case "319003":
                return "The rule cannot be applied to the RBT content service.";
            case "319004":
                return "The rule is not applied to the RBT function service.";
            case "319005":
                return "The service is subscribed and it cannot be deleted.";
            case "319006":
                return "The service is not complete, so, it cannot be subscribed.";
            case "319007":
                return "The charging policy is in the service rule, so, it cannot be deleted.";
            case "319008":
                return "The rule of the service fee exists.";
            case "319009":
                return "The service exists.";
            case "319010":
                return "The service rule exists.";
            case "319011":
                return "The service does not exist, or the service is hidden.";
            case "319012":
                return "The service rule does not exist.";
            case "319013":
                return "The charging policy does not exist.";
            case "319014":
                return "The detailed charging policy does not exist.";
            case "319015":
                return "The subscriber does not subscribe to the service.";
            case "319016":
                return "The service owner does not exist.";
            case "319017":
                return "The subscriber has subscribed to the service.";
            case "319018":
                return "The subscriber has subscribed to the RBT function service";
            case "319019":
                return "The relative time flag is different.";
            case "319020":
                return "The charging policy exists.";
            case "319021":
                return "The number of subscribers subscribing to the service reaches its maximum.";
            case "319022":
                return "The subscribers cannot subscribe to the service because their phone numbers are not in the number segment.";
            case "319023":
                return "The subscription relationship does not exist before it is changed.";
        }
        return "Unknow error";
    }

    private function getPresentToneCode() {
        switch ($this->code) {
            case "000000":
                return __("The requested operation is completed.");
            case "000001":
                return __("The request is successfully accepted.");
            case "000002":
                return __("Adding or modifying a package succeeds without any voice.");
            case "000003":
                return __("The request for download is accepted. The RBT will be downloaded after the user registers the RBT service. Users can register the service upon downloading the RBT in non-real time.");
            case "100001":
                return __("Unknown errors");
            case "100002":
                return __("The system is busy, or other undefined errors occur.");
            case "100003":
                return __("The operation times out.");
            case "100004":
                return __("The network is abnormal.");
            case "100005":
                return __("The database operation is abnormal.");
            case "100006":
                return __("The database operation fails.");
            case "100007":
                return __("The service does not exist currently.");
            case "100008":
                return __("The internal execution process of the database fails.");
            case "100009":
                return __("The relevant configuration item does not exist.");
            case "100010":
                return __("The system does not support this operation.");
            case "200000":
                return __("The verification configuration of parameters does not exist.");
            case "200001":
                return __("The value of the mandatory parameter is null.");
            case "200002":
                return __("The parameter format is incorrect.");
            case "200003":
                return __("The parameter length exceeds the preset range.");
            case "200004":
                return __("All the entered parameters are null.");
            case "200005":
                return "The time format of setting an RBT is incorrect.";
            case "200006":
                return "Redundant parameters are entered.";
            case "200007":
                return "The access account does not exist or the password is incorrect.";
            case "200008":
                return "The access account is not allowed to access the system with a low credit level.";
            case "200009":
                return "The time type is incorrect.";
            case "200010":
                return "The start time is later than the end time.";
            case "200011":
                return "The account does not exist.";
            case "200012":
                return "The password corresponding to the account is incorrect.";
            case "200013":
                return "The access Portal type corresponding to the account is incorrect.";
            case "201001":
                return "The phone number format is incorrect.";
            case "201002":
                return "The entered password is invalid.";
            case "201003":
                return "The password does not exist.";
            case "202001":
                return "The format of an RBT group code is incorrect.";
            case "202002":
                return "The format of an RBT code is incorrect.";
            case "300001":
                return "The number of members reaches the upper limit.";
            case "300002":
                return "Obtaining information fails.";
            case "301001":
                return "The subscriber does not exist.";
            case "301002":
                return "The subscriber exists already.";
            case "301003":
                return "The password is invalid.";
            case "301004":
                return "Sending an SM to the subscriber fails.";
            case "301005":
                return "Verifying authentication code fails.";
            case "301006":
                return "The subscriber is already in the modified status.";
            case "301008":
                return "Authentication code cannot be obtained due to subscriber status error.";
            case "301009":
                return "Service register is not allowed because of subscriber status error.";
            case "301010":
                return "Service deregister is not allowed because of subscriber status error.";
            case "301011":
                return "The subscriber owns fee.";
            case "301012":
                return "The authentication code is not generated.";
            case "301013":
                return "Downloading is not allowed due to the service status of the subscriber.";
            case "301014":
                return "Setting is not allowed due to the service status of the subscriber.";
            case "301015":
                return "This operation is not allowed due to the service status of the subscriber.";
            case "301016":
                return "The presented parties do not allow others to copy their RBTs.";
            case "301017":
                return "The system configures that this item cannot be copied.";
            case "301018":
                return "The phone number of the subscriber whose RBTs are copied does not exist.";
            case "301019":
                return "The RBT list includes invalid RBTs. (The RBTs do not belong to a corp or the status of the RBTs is incorrect.) ";
            case "301020":
                return "The RBT list number does not belong to the department of the corp.";
            case "301021":
                return "The consumption limit is specified.";
            case "301022":
                return "The ID of the consumption limit does not exist.";
            case "301023":
                return "The consumption limit exceeds.";
            case "301024":
                return "The brand does not exist.";
            case "301025":
                return "The new charging system is the same as the original one and no change is required.";
            case "309123":
                return "The times of registering the service in a day by the subscriber reaches its upper limit.";
            case "301026":
                return "The new service brand is the same as the original one and no change is required.";
            case "301027":
                return "The system does not support the language code.";
            case "301028":
                return "The times of getting the password back by the subscriber exceeds its limit.";
            case "301029":
                return "The phone number of the subscriber is not in the area number segment.";
            case "301030":
                return "The phone number of a subscriber is blacklisted.";
            case "301031":
                return "The phone number of a subscriber is not in the number segment of this province.";
            case "301032":
                return "The brand exists.";
            case "301033":
                return "The brand does not exist.";
            case "301034":
                return "The password of the subscriber is not saved on the RBT platform.";
            case "301035":
                return "Changing the subscriber phone number fails.";
            case "301036":
                return "The added system default RBT is not an ordinary RBT uploaded by a CP.";
            case "302001":
                return "The RBT exists.";
            case "302002":
                return "Transmitting the RBT file fails.";
            case "302003":
                return "The RBT does not exist.";
            case "302004":
                return "The RBT has already been requested for deletion.";
            case "302005":
                return "The RBT that the CP requests for operation is not the one uploaded by the CP.";
            case "302006":
                return "The RBT has already been requested for modification.";
            case "302007":
                return "The number of query results is 0.";
            case "302008":
                return "The subscriber is already in the modified status.";
            case "302009":
                return "Errors occur when the category voice is uploaded.";
            case "302010":
                return "The charging fails.";
            case "302011":
                return "The RBT downloading is repeated.";
            case "302012":
                return "The uploaded RBT files or listening files are not in the temporary category.";
            case "302015":
                return "The RBT is in the hidden status.";
            case "302016":
                return "The RBT is in the displayed status.";
            case "302017":
                return "The music box does not exist.";
            case "302018":
                return "The RBT has not been downloaded.";
            case "302019":
                return "The RBT expires.";
            case "302020":
                return "The number of RBTs in the music box exceeds its maximum.";
            case "302021":
                return "The category type does not exist.";
            case "302022":
                return "The unique internal ID of a category does not exist.";
            case "302023":
                return "Creating a category fails.";
            case "302024":
                return "The CP does not own the RBT.";
            case "302025":
                return "The CP is in the status of unable to upload RBTs.";
            case "302026":
                return "The RBT in the current status cannot be hidden.";
            case "302027":
                return "The RBT in current status cannot be displayed.";
            case "302028":
                return "The RBT is in to-be-approved status.";
            case "302029":
                return "Invalid absolute expiry date.The absolute expiry date is earlier than the current time or the relative validity period of the RBT.";
            case "302030":
                return "The time for setting RBTs overlaps.";
            case "302031":
                return "The ID of the category type does not exist or the category type is abnormal.";
            case "302032":
                return "The category is not a leaf category and RBTs cannot be stored in it.";
            case "302033":
                return "The parent category is a leaf category and it contains RBTs.Only a leaf category can be stored with RBTs.";
            case "302034":
                return "You cannot delete the category, because it still contains RBTs.";
            case "302035":
                return "You cannot delete the category because it contains sub-directories.";
            case "302037":
                return "Copying all RBTs in batches fails.";
            case "302038":
                return "Copying several RBTs in batches partially fails.";
            case "302039":
                return "The records of the to-be-approved table cannot be modified because they are in the status of deletion sent for approval.";
            case "302040":
                return "The language does not exist.";
            case "302041":
                return "The corp does not exist.";
            case "302042":
                return "The area does not exist.";
            case "302043":
                return "Incorrect file name or content format of the voice file of uploaded music boxes or RBT directories";
            case "302044":

                return "RBTs in the music box cannot be hidden or deleted.";

            case "302046":
                return "The parent category does not exist.";
            case "302047":
                return "The RBT category exists.";
            case "302048":
                return "The music box exists.";
            case "302049":
                return "The number of RBTs uploaded by the CP reaches its maximum.";
            case "302050":
                return "Uploading DIY RBTs is not allowed due to the current status of the subscriber.";
            case "302051":
                return "The number of RBTs in the corp reaches its maximum.";
            case "302052":
                return "The music box expires.";
            case "302053":
                return "The music box is in to-be-approved status.";
            case "302054":
                return "The music box in current status cannot be hidden.";
            case "302055":
                return "The music box in the current status cannot be displayed.";
            case "302056":
                return "The RBT category does not exist.";
            case "302057":
                return "The RBT category is in to-be-approved status.";
            case "302058":
                return "The RBT category in the current status cannot be hidden.";
            case "302059":
                return "The RBT category in the current status cannot be displayed.";
            case "302060":
                return "Approving in batches partially fails.";
            case "302061":
                return "Approving in batches entirely fails.";
            case "302062":
                return "After the PLUS RBT is approved, RBT downloading fails. Downloading RBTs fails after the DIY RBTs are approved.";
            case "302063":
                return "Charging fails after corp RBTs are approved.";
            case "302064":
                return "The number of music boxes that can be uploaded by the CP reaches the maximum.";
            case "302065":
                return "The expiry date of the music box is earlier than the current time.";
            case "302066":
                return "You cannot modify the music box because it is in the status of deletion sent for approval.";
            case "302067":
                return "The music box cannot be modified.";
            case "302068":
                return "The RBT that does not belong to an RBT list exists.";
            case "302069":
                return "All RBTs in the RBT list are included. Delete the RBT list directly.";
            case "302070":
                return "Obtaining the working category of the music box voice file fails.";
            case "302071":
                return "The records of the calling party and the called party exist.";
            case "302072":
                return "The records of the calling party and the called party do not exist.";
            case "302073":
                return "The subscriber or RBT resources do not exist.";
            case "302074":
                return "The RBT cannot be cut.";
            case "302075":
                return "In configuration items, the background music code does not exist.";
            case "302076":
                return "The background music does not exist.";
            case "302077":
                return "The RBT does not match the background music type when they are mixed.";
            case "302078":
                return "Mixing RBTs fails.";
            case "302079":
                return "The called number has been set.";
            case "302080":
                return "The relative validity period is invalid when exceeding the absolute expiry date of the RBT.";
            case "302081":
                return "The type of the listened RBT file is different from the set one.";
            case "302082":
                return "The validity period of a music box later than the maximum validity period of the RBTs in it. It is not used at present.";
            case "302083":
                return "The type of a new subscriber is the same as the old one.";
            case "302084":
                return "The music channel cannot be uploaded.";
            case "302085":
                return "The RBTs in the mode of the relative validity period or the fixed end bill date cannot be renewed.";
            case "302086":
                return "The supported device and the device type are not configured.";
            case "302087":
                return "The folder where the listened RBT files are stored is not configured.";
            case "302088":
                return "The subscriber does not download the RBT or music box.";
            case "302089":
                return "The Web or IVR device is not configured.";
            case "302090":
                return "The RBT cannot be renewed because it is in the mode of the non-relative validity period.";
            case "302091":
                return "The RBT or music box expires and they cannot be renewed.";
            case "302093":
                return "The validity period of a package is earlier than the current time.";
            case "302094":
                return "The CP does not exist.";
            case "302095":
                return "A package with the same name as that of the CP exists.";
            case "302096":
                return "The package does not exist.";
            case "302097":
                return "The supported device and its type are not configured.";
            case "302098":
                return "The package is in the abnormal or hidden status.";
            case "302099":
                return "The system administrator does not exist.";
            case "302100":
                return "RBTs with the same CP, song name and singer name exist.";
            case "302101":
                return "The voice file does not exist.";
            case "302102":
                return "Copying voices fails.";
            case "302103":
                return "The system default ID of the RBT does not exist.";
            case "302104":
                return "The RBT package in the current status cannot be hidden.";
            case "302105":
                return "The RBT package in the current status cannot be displayed.";
            case "302106":
                return "If the package is the one that does not distinguish different CPs, the CP flag cannot be entered.";
            case "302107":
                return "If the package is the one distinguishing different CPs, the CP flag needs to be entered.";
            case "302108":
                return "The subscriber has downloaded all the RBTs in the RBT package.";
            case "302109":
                return "The package is in the uploaded status because adding or modifying the package succeeds, or activating the package fails.";
            case "302110":
                return "The relative validity period of the RBT is invalid when the end time of the relative validity period exceeds the absolute expiry date.";
            case "302111":
                return "The CP does not exist or the CP status is abnormal.";
            case "302112":
                return "The relative validity period is invalid because the absolute expiry date of an RBT or a music box is earlier than the cumulative time of the relative validity periods.";
            case "302113":
                return "The package object is not in the uploaded status.";
            case "302114":
                return "Records in the to-be-approved table have been modified already.";
            case "302115":
                return "The additional information of resources does not exist.";
            case "302116":
                return "The additional information of resources exists.";
            case "302117":
                return "The additional information of resources is not in the to-be-approved status.";
            case "302118":
                return "The additional information of resources is in the to-be-approved status.";
            case "302119":
                return "The RBT status is incorrect.";
            case "302120":
                return "The resource type is different from the category type.";
            case "302121":
                return "The parent category is in the to-be-approved status and a subcategory is not allowed to adding to it.";
            case "302122":
                return "The parent category is in the to-be-approved status and it cannot approve a subcategory.";
            case "302123":
                return "The RBT exists in the personal tone library.";
            case "302124":
                return "The RBT types are different. There are PLUS RBTs and ordinary RBTs.";
            case "302125":
                return "The set RBT type does not comply with the type set in the RBT list. For example, you set RBT type to PLUS RBT, but the RBT type in the RBT list is ordinary RBT.";
            case "302126":
                return "The ordinary RBT is not uploaded by the CP.";
            case "302127":
                return "Resource information does not exist.";
            case "302128":
                return "The number of groups exceeds its maximum defined by the brand.";
            case "302129":
                return "The number of set calling parties exceeds its maximum defined by the brand.";
            case "302130":
                return "The number of uploaded DIY RBTs exceeds its maximum defined by the brand.";
            case "302131":
                return "The setting record does not exist.";
            case "302132":
                return "The number of uploaded PLUS RBTs exceeds its maximum defined by the brand.";
            case "302133":
                return "The number of downloaded RBTs exceeds its maximum defined by the brand.";
            case "302200":
                return "All the category owners are invalid.";
            case "302201":
                return "In the to-be-approved music box, there are RBTs whose statuses are abnormal or RBTs that are expired.";
            case "302202":
                return "In the uploaded music box, there are RBTs whose statuses are abnormal or RBTs that are expired.";
            case "302203":
                return "The length of an RBT code is incorrect.";
            case "302205":
                return "Errors occur when the system automatically generates an RBT code.";
            case "302206":
                return "Errors occur when the system automatically generates a music box code or a music package code.";
            case "302207":
                return "The system does not support uploading the RBT of this format.";
            case "302208":
                return "The effective period field of a valid RBT or music box cannot be modified.";
            case "302209":
                return "The current RBT coding rule does not support uploading an RBT of this type.";
            case "302210":
                return "The RBT cannot be downloaded in this method.";
            case "303001":
                return "The information of the calling group exists, such as the name and serial number.";
            case "303002":
                return "The calling group does not exist when it is deleted, modified or queried.";
            case "303003":
                return "You cannot add a calling group any more because the number of calling groups exceeds its maximum.";
            case "303004":
                return "The calling group cannot be deleted because it contains members.";
            case "303011":
                return "The member exists in the calling group when you add it to the group.";
            case "303012":
                return "The member does not exist in the calling group when it is deleted, modified or queried.";
            case "303013":
                return "The number of members in the calling group reaches its upper limit.";
            case "303014":
                return "The calling number to be modified is the member of the called number group.";
            case "303015":
                return "The number of calling parties reaches or exceeds its maximum.";
            case "303021":
                return "The RBT exists already in the personal tone library When you download it to the personal tone library.";
            case "303023":
                return "The number of downloaded tones reaches its maximum.";
            case "303024":
                return "The number of set RBTs reaches its maximum.";
            case "303025":
                return "The downloaded package does not exist.";
            case "303026":
                return "Subscribers have downloaded packages without distinguishing CPs, so they are not allowed to download packages distinguishing CPs.";
            case "303027":
                return "Subscribers have downloaded packages distinguishing CPs, so they are not allowed to download packages without distinguishing CPs.";
            case "303028":
                return "The to-be-downloaded package has been downloaded before.";
            case "303029":
                return "The subscriber does not download the package.";
            case "303030":
                return "The subscriber is not allowed to download multiple packages of a CP.";
            case "303031":
                return "The RBT group exists already.";
            case "303032":
                return "The RBT group does not exist.";
            case "303033":
                return "The owner of the RBT group does not exist.";
            case "303041":
                return "When you add an RBT to an RBT group, the RBT already exists in the RBT group.";
            case "303042":
                return "The RBT does not exist when you delete, modify or query it.";
            case "303043":
                return "The content (such as a music box) of the RBT group cannot be modified.";
            case "303051":
                return "When you set an RBT, the record shows that the setting already exists.";
            case "303052":
                return "The RBT settings do not exist.";
            case "303053":
                return "The group or department does not exist.";
            case "303054":
                return "The service status of the group or the department is abnormal.";
            case "303055":
                return "You are not allowed to modify a set RBT group when setting charging conditions.";
            case "303056":
                return "The RBT is not in the personal tone library of the copied party.";
            case "303057":
                return "The essential system configuration information does not exist.";
            case "303058":
                return "Subscribers cannot download the corp RBT because they are not the members of the corp.";
            case "303059":
                return "Malicious download";
            case "303060":
                return "The number of setting records exceeds its maximum defined by the brand.";
            case "304001":
                return "The statistical value is not found.";
            case "306001":
                return "The system default RBT does not exist.";
            case "306002":
                return "The system prompts an error when the display code of an RBT turns to the mapping internal ID.";
            case "306003":
                return "The system prompts an error when the internal ID turns to the display code of an RBT.";
            case "306004":
                return "The entered parameter type is incorrect.";
            case "306005":
                return "You cannot add a leaf number segment under the number segment one level up because the number segment one level up is also a leaf number segment.";
            case "306006":
                return "Number segments of a same number segment category are overlapped.";
            case "306007":
                return "The number segment does not exist.";
            case "306008":
                return "The number segment contains sub-number segments.";
            case "306009":
                return "Areas one level up do not exist.";
            case "306010":
                return "Areas one level up are the smallest leaf areas.";
            case "306011":
                return "The area code exists.";
            case "306012":
                return "The area code does not exist.";
            case "306013":
                return "Areas containing sub-areas cannot be set to the smallest areas.";
            case "306014":
                return "Areas containing sub-areas cannot be deleted.";
            case "306015":
                return "Forwarding the SM to the RBT gateway fails.";
            case "306016":
                return "The charging event number does not exist.";
            case "306017":
                return "The number segment ID exists already.";
            case "306018":
                return "The normal leaf category ID does not exist.";
            case "306019":
                return "The relation ID between a number segment and a category does not exist.";
            case "306020":
                return "The number segment ID does not exist.";
            case "306021":
                return "The area code exists already.";
            case "307001":
                return "The department exists.";
            case "307002":
                return "The department code does not exist.";
            case "307003":
                return "The member does not enable relevant services.";
            case "307004":
                return "The number of the group members of the corp department exceeds its maximum.";
            case "307005":
                return "The member is not a department member of the corp.";
            case "307006":
                return "The corp RBT cannot be modified due to its current status.";
            case "307007":
                return "Some subscribers fail to register the RBT service.";
            case "307008":
                return "Some subscribers fail to deregister the RBT service.";
            case "307009":
                return "The department of a corp does not exist.";
            case "307010":
                return "The member exists in the corp department.";
            case "307011":
                return "The department one level up does not exist.";
            case "307012":
                return "The member belongs to another department.";
            case "307013":
                return "The time segment exists already.";
            case "307014":
                return "The special holiday exists.";
            case "307015":
                return "The status of the corp is abnormal.";
            case "307016":
                return "The group has been set already.";
            case "307017":
                return "The time segment number does not exist.";
            case "307018":
                return "The special holiday does not exist.";
            case "307019":
                return "Adding all department members fails.";
            case "307020":
                return "Adding some department members succeeded.";
            case "307021":
                return "Deleting all department members fails.";
            case "307022":
                return "Deleting some department members succeeded.";
            case "307023":
                return "Activating or suspending all corp RBTs of corp members fails.";
            case "307024":
                return "Activating or suspending some corp RBTs of corp members succeeded.";
            case "307025":
                return "The corp cannot be modified due to its current status.";
            case "307026":
                return "The account of the department operator exists already.";
            case "307027":
                return "The internal ID of the corp does not exist.";
            case "307028":
                return "The internal ID of the department does not exist.";
            case "307029":
                return "The department does not belong to the corp.";
            case "307030":
                return "The internal ID of the department operator does not exist.";
            case "307181":
                return "The corp does not exist.";
            case "307183":
                return "The number of corp department reaches its maximum.";
            case "307184":
                return "The number of departments reaches the maximum of a corp.";
            case "307185":
                return "The maximum number of departments exceeds the maximum number the department one level up allows.";
            case "307186":
                return "The corp fails to subscribe to the RBT service.";
            case "308001":
                return "The presented party does not register the RBT service.";
            case "308002":
                return "The personal tone library of the presented party is full.";
            case "308003":
                return "The presented party to whom the RBT service is presented is not a local subscriber.";
            case "308004":
                return "In this month, the presented party has been presented the RBT service.";
            case "308005":
                return "In this month, the number of months during which the RBT service is presented exceeds the value specified by the system.";
            case "308006":
                return "The presented party to whom the RBT function is presented is an RBT subscriber.";
            case "308007":
                return "The presented parties are the restricted subscribers who cannot present to themselves.";
            case "308008":
                return "The RBT service expires.";
            case "308009":
                return "Part of batch downloading fails.";
            case "308010":
                return "The subscriber has default RBTs. This setting fails.";
            case "308011":
                return "An RBT cannot be added to the music box.";
            case "308012":
                return "The RBT exists in the RBT list.";
            case "308013":
                return "Downloading in batches fails.";
            case "308014":
                return "Presenting in batches fails.";
            case "308015":
                return "Setting in batches fails.";
            case "308016":
                return "Part of batch presenting fails.";
            case "308017":
                return "Part of batch setting fails.";
            case "308019":
                return "The presenting number does not exist. It is not used at present, and is reserved for the service development.";
            case "308020":
                return "Generating the presenting secret key fails.";
            case "308021":
                return "The presenting secret key does not exist.";
            case "308022":
                return "The RBT to be activated is in the activated status.";
            case "308023":
                return "The RBT has been presented. More exactly, the presenting party has presented the same RBT to the same presented party.";
            case "308024":
                return "The number of RBTs downloaded by the subscriber reaches its maximum defined by the brand.";
            case "308025":
                return "The number of RBTs set by the subscriber reaches its maximum defined by the brand.";
            case "308026":
                return "If the reply time of presented party and the presenting time of presenting party are not in the same year and month, presenting fails.";
            case "308027":
                return "The number of RBTs or music boxes presented exceeds the number set in the system.";
            case "308028":
                return "The number of RBTs that are downloaded by the subscriber exceeds the limit.";
            case "308029":
                return "The number of RBTs that are copied by the subscriber exceeds the limit.";
            case "309001":
                return "The system capacity exceeds its limit.";
            case "309002":
                return "The authentication code is needed.";
            case "309003":
                return "Service register or deregister strategy is not found.";
            case "309004":
                return "Registering the service through the Portal fails.";
            case "309005":
                return "The access type is not set.";
            case "309006":
                return "The number of users registering the service in a day reaches its maximum.";
            case "309007":
                return "Registering or deregistering the service fails.";
            case "309008":
                return "Service register or deregister is being processed.";
            case "309009":
                return "The corp member who has to register the service is not an ordinary RBT subscriber.";
            case "309010":
                return "The number of corp members registering the service reaches its maximum.";
            case "309011":
                return "The corp member does not exist because of service deregister.";
            case "309012":
                return "The corp member registers the service.";
            case "309113":
                return "Users cannot register the RBT service due to their current statuses.";
            case "309114":
                return "Subscribers cannot deregister the RBT service due to their current statuses.";
            case "309115":
                return "The subscriber type is not set.";
            case "309116":
                return "The subscriber type and access type are not set.";
            case "309117":
                return "The number of subscribers who deregister the service in a day reaches its maximum.";
            case "309118":
                return "Subscribers cannot register the RBT service due to their number segments.";
            case "309119":
                return "The area where the subscriber is located does not allow registering the service by a subscriber.";
            case "309120":
                return "The time of registering or deregistering the service is in the limited time segment.";
            case "309121":
                return "The subscriber belongs to another corp.";
            case "309122":
                return "Registering the service is processed successfully, but the system fails to send a notification SM. Notify the subscriber to obtain the password through the Web page.";
            case "309124":
                return "The CorpLicense file cannot be obtained.";
            case "309125":
                return "The number of corp members registering the services reaches the limit set in the CorpLicense file.";
            case "319030":
                return "The subscriber does not download the relevant package service.";
            case "309013":
                return "The user data is incorrect.";
            case "309014":
                return "The user does not enable the RBT service.";
            case "309015":
                return "The special service cannot be enabled.";
            case "309016":
                return "The special service cannot be canceled.";
            case "309017":
                return "The subscriber enables the RBT service.";
            case "309018":
                return "The user is in the normal service subscription status and not allowed subscribing again.";
            case "309019":
                return "The subscriber is in the Suspended status. Service subscription is not allowed.";
            case "309020":
                return "The subscriber is in the before service subscription status. Service subscription is not allowed.";
            case "309021":
                return "The subscriber is in the Suspended status because of arrearage. Service subscription is not allowed.";
            case "310001":
                return "The balance of the subscriber is not sufficient.";
            case "311001":
                return "The charging device address is incorrect.";
            case "311002":
                return "The I/O abnormalities occur on the charging device.";
            case "312002":
                return "The CP cannot be deleted because it contains RBTs that are available or invalid.";
            case "312003":
                return "The area code does not exist.";
            case "312004":
                return "The account of the subscriber is not granted the relevant operation authority.";
            case "312005":
                return "The role code does not exist.";
            case "312006":
                return "This number segment does not exist.";
            case "312007":
                return "The CP index exists.";
            case "312008":
                return "The administrator does not exist.";
            case "312009":
                return "The internal authentication account of the system exists.";
            case "312010":
                return "The internal authentication account of the system does not exist.";
            case "312011":
                return "The old password is incorrect when the password is modified.";
            case "312012":
                return "The account of the group operator or the department operator exists.";
            case "312013":
                return "The internal code of the group or department does not exist.";
            case "312014":
                return "The internal code of the group operator or department operator does not exist.";
            case "312015":
                return "The CP access code exists.";
            case "312016":
                return "The modified number segment of the administrator cannot contain the number segments of their inferior administrators.";
            case "312017":
                return "The administrator has no operation authority over the subscriber.";
            case "312018":
                return "The corp charging account exists.";
            case "312019":
                return "The corp charging account is incorrect before it is modified.";
            case "312020":
                return "The corp charging account is used after it is modified.";
            case "312021":
                return "The account is locked.";
            case "312022":
                return "The password expires.";
            case "312023":
                return "The operator one level up does not exist.";
            case "312024":
                return "The operation is not allowed to perform.";
            case "312025":
                return "The password is permanent, so, the time for reminding of the expiry and the outdated time are null.";
            case "312026":
                return "The record of the time of generating the password is not found and obtaining the outdated time and the time for reminding of the expiry fails.";
            case "313001":
                return "The return code does not exist.";
            case "313002":
                return "Stopping several tasks fails because unknown task names exist.";
            case "313003":
                return "Restoring tasks partially succeeded because unknown task names exist.";
            case "313004":
                return "Modifying the task running time fails.";
            case "314001":
                return "The parameter name does not exist.";
            case "314002":
                return "The new parameter value does not conform to the authentication rule.";
            case "314003":
                return "Parameter that can be updated does not exist.";
            case "314004":
                return "The queried parameter type does not exist.";
            case "314005":
                return "The database return code is unknown.";
            case "314006":
                return "The configuration item exists.";
            case "314007":
                return "The entered parameter is incorrect or it does not match the configuration strategy item.";
            case "314008":
                return "Updating configuration items of machines in other clusters.";
            case "315001":
                return "The rank list does not exist.";
            case "315002":
                return "Entered place of a rank list is invalid.";
            case "315003":
                return "The content of a rank list is invalid.";
            case "315004":
                return "The rank list settings exist.";
            case "315005":
                return "The rank list cannot be deleted due its current status.";
            case "315006":
                return "The place exists in the rank list.";
            case "315007":
                return "The effective time of the rank list is earlier than the current time.";
            case "316001":
                return "The transaction request exists.";
            case "316002":
                return "No RBT maps with the place in the rank list.";
            case "316003":
                return "The RBT ID does not exist.";
            case "316004":
                return "The activated RBT does not exist or its status is abnormal.";
            case "317001":
                return "The PLUS service exists.";
            case "317002":
                return "The RBT subscriber cannot enable the PLUS service due to an abnormal status.";
            case "317003":
                return "The subscriber does not enable the PLUS service.";
            case "317004":
                return "The RBT subscriber cannot deregister the PLUS service due to an abnormal status.";
            case "317005":
                return "The CP has no right to upload an RBT that can be cut.";
            case "317006":
                return "The RBT is not the PLUS RBT.";
            case "317007":
                return "You cannot upload PLUS RBTs to the personal library of the subscriber because it is full.";
            case "317008":
                return "The subscriber cannot upload PLUS RBTs due to the current status.";
            case "317009":
                return "The PLUS subscriber does not exist or the status is abnormal.";
            case "317010":
                return "RBT downloading fails after the PLUS RBT is approved.";
            case "318001":
                return "The approval flow relevant to the operation does not exist.";
            case "318002":
                return "The step relevant to the operation does not exist in the procedure.";
            case "318003":
                return "The person specified to approve the step does not exist.";
            case "318004":
                return "You cannot delete or modify the step that contains records that are not completely approved.";
            case "318005":
                return "The approval invoker relevant to the operation does not exist.";
            case "318006":
                return "The ID of the relation between the operation approval step and the invoker does not exist.";
            case "318007":
                return "The approval flow exists.More exactly, the information and steps of the approval flow are the same as those of the previous one).";
            case "318008":
                return "The approval step is performed again.More exactly, the same person approves the same step.";
            case "318009":
                return "The same operator maps with multiple flows. More exactly, the information of the flow is the same as that of other flows, but the steps in the flow are different.";
            case "318010":
                return "The strings of the approval steps contain step information that need not be approved.";
            case "319003":
                return "The rule cannot be applied to the RBT content service.";
            case "319004":
                return "The rule is not applied to the RBT function service.";
            case "319005":
                return "The service is subscribed and it cannot be deleted.";
            case "319006":
                return "The service is not complete, so, it cannot be subscribed.";
            case "319007":
                return "The charging policy is in the service rule, so, it cannot be deleted.";
            case "319008":
                return "The rule of the service fee exists.";
            case "319009":
                return "The service exists.";
            case "319010":
                return "The service rule exists.";
            case "319011":
                return "The service does not exist, or the service is hidden.";
            case "319012":
                return "The service rule does not exist.";
            case "319013":
                return "The charging policy does not exist.";
            case "319014":
                return "The detailed charging policy does not exist.";
            case "319015":
                return "The subscriber does not subscribe to the service.";
            case "319016":
                return "The service owner does not exist.";
            case "319017":
                return "The subscriber has subscribed to the service.";
            case "319018":
                return "The subscriber has subscribed to the RBT function service";
            case "319019":
                return "The relative time flag is different.";
            case "319020":
                return "The charging policy exists.";
            case "319021":
                return "The number of subscribers subscribing to the service reaches its maximum.";
            case "319022":
                return "The subscribers cannot subscribe to the service because their phone numbers are not in the number segment.";
            case "319023":
                return "The subscription relationship does not exist before it is changed.";
        }
        return "Unknow error";
    }
    
}

?>
