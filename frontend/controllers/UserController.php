<?php

namespace frontend\controllers;

use common\helpers\Helpers;
use common\libs\CrbtService;
use common\libs\RemoveSign;
use frontend\models\LogRbtService;
use frontend\models\VtLogRingBackTone;
use frontend\models\VtRingBackTone;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;

class UserController extends AppController {

    public function checkStatusCrbt() {
        try {
            $user = Yii::$app->user->identity;
            if ($user) {
                $check = CrbtService::checkStatusCRBT($user->phonenumber);
                if ($check['statusCRBT'] == 1 || $check['statusCRBT'] == 2 || $check['statusCRBT'] == -1) {
                    return $check['statusCRBT'];
                }
            }
        } catch (Exception $e) {
            
        }
        return 0;
    }

    public function actionPresentRbt() {
        $this->layout = false;
        if (\Yii::$app->request->post()) {
            $user = \Yii::$app->user->identity;
            if (!$user) {
                return $this->goHome();
            }

            $phonenumber = trim(Yii::$app->request->post('phonenumber'));
            if (!Helpers::checkViettelPhoneNumber($phonenumber)) {
                echo 'Bạn phải nhập vào số điện thoại Viettel!';
                exit(0);
            }

            $toneCodes = Yii::$app->request->post('toneCode');
            if ($toneCodes) {
                foreach ($toneCodes as $toneCode) {
                    $rbt = VtRingBackTone::getOneByCode($toneCode);
                    if ($rbt) {
                        $toneName = $rbt->huawei_tone_name;

                        $result = CrbtService::presentRbt($user->phonenumber, $phonenumber, $toneCode, $toneName);

                        $vtlogDown = new VtLogRingBackTone();
                        $vtlogDown->tone_name = $toneName;
                        $vtlogDown->action = RBT_PRESENT;
                        $vtlogDown->member_id = $user->id;
                        $vtlogDown->from_phonenumber = $user->phonenumber;
                        $vtlogDown->to_phonenumber = RemoveSign::convertMsisdn($phonenumber);
                        $vtlogDown->username = $user->phonenumber;
                        $vtlogDown->return_code = $result['crbtReturnCode'];
                        $vtlogDown->tone_code = $toneCode;
                        $vtlogDown->tone_id = $rbt->huawei_tone_id;
                        $vtlogDown->tone_price = $rbt->huawei_price;
                        $vtlogDown->tone_availabledate = $rbt->huawei_available_datetime;
                        $vtlogDown->source = \Yii::$app->session->get('utm_source');
                        $vtlogDown->created_at = new \yii\db\Expression('now()');
                        $vtlogDown->save(false);

                        if ($result['crbtReturnCode'] == \Yii::$app->params[CrbtService::routeService($user->phonenumber) . '_success_code']) {
                            echo 'Yêu cầu tặng Nhạc chờ mã ' . $toneCode . ' đang được xử lý. Vui lòng đợi tin nhắn xác nhận từ hệ thống!<br><br>';
                        } elseif ($result['crbtReturnCode'] == NULL) {
                            echo 'Hệ thống đang bận, vui lòng thử lại sau!';
                            exit(0);
                        } else {
                            echo "($toneCode) " . $result['crbtDescription'] . '<br><br>';
                        }
                    }
                }
                exit(0);
            }
        }
        return $this->refresh();
    }

    public function actionRbtCopy() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $isRegister = 0;
        $check = CrbtService::checkStatusCRBT($user->phonenumber);
        if ($check['statusCRBT'] == -1) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Hệ thống đang lỗi, vui lòng thử lại sau!'));
            return $this->redirect('/user/package');
        }
        if ($check['statusCRBT'] == 1 || $check['statusCRBT'] == 2) {
            $isRegister = $check['statusCRBT'];
        }
        if ($check['userInfos'] && $isRegister) {
            $brandID = $check['userInfos'][0]['brand'];
        }
        if (!$isRegister) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách chưa đăng ký dịch vụ Nhạc chờ Imuzik. Hãy đăng ký để sử dụng!'));
            return $this->redirect('/user/package');
        } else if ($isRegister == 2) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách đang tạm ngưng dịch vụ Nhạc chờ Imuzik. Hãy kích hoạt để sử dụng!'));
            return $this->redirect('/user/rbt-service');
        }

        $lt = [];
        $msisdn = '';

        if (Yii::$app->request->isPost) {
            $msisdn = RemoveSign::convertMsisdn(trim(Yii::$app->request->post('msisdn')));
            if ($msisdn) {
                if (Helpers::checkViettelPhoneNumber($msisdn)) {
                    $getCollect = CrbtService::getUserTones($msisdn);
                    if ($getCollect['resultCode'] == 0) {
                        $lt = $getCollect['queryToneInfos'];
                    }
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Bạn phải nhập số điện thoại Viettel!'));
                }
            } else {
                \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Số điện thoại không được để trống!'));
            }
        }
        return $this->render('rbt-copy', [
                    'lt' => $lt,
                    'msisdn' => $msisdn
        ]);
    }

    public function actionDownrbt() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $rbtList = '';
        if (Yii::$app->request->isPost) {
            $registerSuccess = false;
            $status = self::checkStatusCrbt();
            if ($status == -1) {
                echo \Yii::t('frontend', 'Hệ thống đang lỗi, vui lòng thử lại sau!');
                exit(0);
            }
            if (!$status || $status == 2) {
                if (!$status) {
                    $regRbt = CrbtService::subscribe($user->phonenumber);
                } else if ($status == 2) {
                    $regRbt = CrbtService::activeAndPauseService($user->phonenumber, 1);
                }
                LogRbtService::write($user->id, $user->username, ACTION_REGISTER, $user->phonenumber, $regRbt['crbtReturnCode']);
                if ($regRbt['crbtReturnCode'] == '000000') {
                    $registerSuccess = true;
                } else {
                    echo "Tải không thành công do Quý khách chưa đăng ký dịch vụ nhạc chờ! Quý khách vui lòng soạn DK1 gửi 1221 hoặc liên hệ 198 (miễn phí)";
                    exit(0);
                }
            }

            $this->layout = false;
            $tonecodes = Yii::$app->request->post('tonecode');
            if ($tonecodes) {
                foreach ($tonecodes as $tonecode) {
                    $rbt = VtRingBackTone::findOne(['huawei_tone_code' => $tonecode]);
                    if ($rbt) {
                        $toneID = $rbt->huawei_tone_id;
                        $tonename = $rbt->huawei_tone_name;

                        $result = CrbtService::newOrderTone($user->phonenumber, $tonecode, '1', $toneID); //1 la nhac cho, 2 la disc

                        $rbtList .= $tonecode . ', ';

                        $vtlogDown = new VtLogRingBackTone();
                        $vtlogDown->tone_name = $tonename;
                        $vtlogDown->action = RBT_BUY;
                        $vtlogDown->member_id = $user->id;
                        $vtlogDown->from_phonenumber = $user->phonenumber;
                        $vtlogDown->username = $user->phonenumber;
                        $vtlogDown->return_code = $result['crbtReturnCode'];
                        $vtlogDown->to_phonenumber = '';
                        $vtlogDown->tone_code = $tonecode;
                        $vtlogDown->tone_id = $rbt->huawei_tone_id;
                        $vtlogDown->tone_price = $rbt->huawei_price;
                        $vtlogDown->tone_availabledate = $rbt->huawei_available_datetime;
                        $vtlogDown->source = \Yii::$app->session->get('utm_source');
                        $vtlogDown->created_at = new \yii\db\Expression('now()');
                        $vtlogDown->save(false);

                        $tonename = \yii\helpers\Html::encode($tonename);
                        if ($result['resultCode'] == 0) {
                            if ($registerSuccess) {
                                echo "Quý khách đã đăng ký dịch vụ nhạc chờ và tải bài hát $tonename ($tonecode) thành công!<br><br>";
                            } else {
                                echo "Quý khách đã tải bài hát $tonename ($tonecode) thành công!<br><br>";
                            }
                        } else {
                            echo "$tonename ($tonecode) - " . $result['crbtDescription'] . "<br><br>";
                        }
                    }
                }
            } else {
                echo 'Quý khách chưa chọn bài hát nào!';
            }
        }
        exit(0);
    }

    public function actionGroup() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $isRegister = self::checkStatusCrbt();
        if (!$isRegister) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách chưa đăng ký dịch vụ Nhạc chờ Imuzik. Hãy đăng ký để sử dụng!'));
            return $this->redirect('/user/package');
        } else if ($isRegister == 2) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách đang tạm ngưng dịch vụ Nhạc chờ Imuzik. Hãy kích hoạt để sử dụng!'));
            return $this->redirect('/user/rbt-service');
        } else if ($isRegister == -1) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Hệ thống đang lỗi, vui lòng thử lại sau!'));
            return $this->redirect('/');
        }
        $getGr = CrbtService::queryGroup($user->phonenumber);
        if ($getGr["resultCode"] == 0) {
            $gr = $getGr["queryGroupInfos"];
        }
        $getst = CrbtService::querySetting($user->phonenumber);
        if ($getst["resultCode"] == 0) {
            $st = $getst["querySettingInfos"];
        }

        if (\Yii::$app->request->post()) {
            $error = 0;
            $gName = trim(Yii::$app->request->post('gname'));
            $action = Yii::$app->request->post('action');
            $gid = Yii::$app->request->post('gid');
            if ($action == "add") {
                if (!$gName) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Tên nhóm không được để trống!'));
                    $error = 1;
                }

                if (strlen(RemoveSign::removeSign($gName)) > 250) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Tên nhóm chỉ tối đa 250 ký tự!'));
                    $error = 1;
                }

                $pattern = '/^[a-zA-ZÀÁÂÃÈÉÊẾÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ0-9_ ]*$/';
                if (!preg_match($pattern, $gName)) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Tên nhóm chỉ chứa chữ, số và ký tự dấu cách!'));
                    $error = 1;
                }

                $idGroup = array();
                $nameGroup = array();
                foreach ($gr as $g) {
                    $idGroup[] = $g['groupCode'];
                    $nameGroup[] = strtolower($g['groupName']);
                }
                if ($action == "add" && in_array(strtolower($gName), $nameGroup)) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Tên nhóm đã tồn tại!'));
                    $error = 1;
                }
                if ($error) {
                    return $this->render('/user/group', [
                                'user' => $user,
                                'gr' => $gr,
                                'st' => $st
                    ]);
                }

                do {
                    $gCode = rand(0, 1000);
                } while (in_array($gCode, $idGroup));
                $gCode = (string) $gCode;

                $add = CrbtService::addGroup($user->phonenumber, $gCode, $gName);
                if ($add["resultCode"] == 0) {
                    \Yii::$app->session->setFlash('success', \Yii::t('frontend', "Thêm nhóm $gName thành công!"));
                    $this->redirect(['edit-group', 'gid' => $add['groupId']]);
                } else {
                    \Yii::$app->session->setFlash('error', $add['message']);
                }
            } else if ($action = "remove") {
                if (!$gid || !is_numeric($gid)) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', "Nhóm $gName không hợp lệ!"));
                } else {
                    $remove = CrbtService::delGroup($user->phonenumber, $gid);
                    if ($remove["resultCode"] == 0) {
                        \Yii::$app->session->setFlash('success', \Yii::t('frontend', "Xóa nhóm $gName thành công!"));
                        $gr = [];
                    }
                }
            }

            $getGr = CrbtService::queryGroup($user->phonenumber);
            if ($getGr["resultCode"] == 0) {
                $gr = $getGr["queryGroupInfos"];
            }
        }
        return $this->render('group', [
                    'user' => $user,
                    'gr' => $gr,
                    'st' => $st
        ]);
    }

    public function actionEditGroup() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $gid = Yii::$app->request->getQueryParam('gid');
        if (!$gid) {
            return $this->redirect('group');
        }

        $result = CrbtService::queryGroup($user->phonenumber);
        $userGroups = null;
        if ($result["resultCode"] == 0) {
            $userGroups = $result["queryGroupInfos"];
        }

        $gr = "";
        if ($userGroups) {
            foreach ($userGroups as $group) {
                if ($group['groupCode'] == $gid || $group['groupID'] == $gid) {
                    $gr = $group;
                    $gid = $gr['groupCode'];
                    break;
                }
            }
            $getInfo = CrbtService::queryGroupMember($user->phonenumber, $gid);
            $ginfo = "";
            if ($getInfo["resultCode"] == 0) {
                $ginfo = $getInfo["groupMemberInfos"];
            }
            if ($gr) {
                if (Yii::$app->request->isPost) {
                    $error = 0;
                    $mname = (Yii::$app->request->post('mname')) ? trim(Yii::$app->request->post('mname')) : ' ';
                    $mnumber = trim(Yii::$app->request->post('mnumber'));
                    $action = Yii::$app->request->post('action');

                    if (!$mnumber) {
                        \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Số điện thoại không đúng!'));
                        $error = 1;
                    }

                    if (!preg_match('~(?=.*[0-9])^[0-9]{7,15}$~', $mnumber)) {
                        \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Số điện thoại chỉ chứa các ký tự số và nằm trong khoảng [7-15] ký tự'));
                        $error = 1;
                    }

                    if ($action == "add" && strlen(RemoveSign::removeSign($mname)) > 30) {
                        \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Tên thành viên chỉ tối đa 30 ký tự'));
                        $error = 1;
                    }

                    if ($error) {
                        return $this->render('edit-group', [
                                    'g' => $gr,
                                    'ginfo' => $ginfo
                        ]);
                    }

                    if ($action == "add") {
                        $result = CrbtService::addGroupMember($user->phonenumber, $gid, $mnumber, $mname, "");
                    } else if ($action = "remove") {
                        $result = CrbtService::delGroupMember($user->phonenumber, $gid, $mnumber);
                    }
                    if ($result["resultCode"] != 0) {
                        \Yii::$app->session->setFlash('error', $result['message']);
                    }
                    $ginfo = null;
                    $getInfo = CrbtService::queryGroupMember($user->phonenumber, $gid);
                    if ($getInfo["resultCode"] == 0) {
                        $ginfo = $getInfo["groupMemberInfos"];
                    }
                }
                return $this->render('edit-group', [
                            'g' => $gr,
                            'ginfo' => $ginfo
                ]);
            }
        }
        return $this->redirect(['group']);
    }

    public function actionSettingMusic() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $usedTone = array();
        $lt = array();
        $ltcode = array();
        $gid = Yii::$app->request->getQueryParam('gid');
        if (!$gid) {
            return $this->goHome();
        }
        $listSt = CrbtService::querySetting($user->phonenumber);
        if ($listSt['resultCode'] == 1) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách chưa có bài nhạc chờ nào trong bộ sưu tập!'));
            return $this->redirect("/");
        }
        if ($listSt['resultCode'] != 0) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Hệ thống có lỗi. Xin quý khách vui lòng thử lại sau!'));
            return $this->redirect("/");
        }
        $st = null;
        //neu la nhom mac dinh
        if ($gid == "default") {
            foreach ($listSt['querySettingInfos'] as $setting) {
                if ($setting['setType'] == DEFAULT_TONE) {
                    $st = $setting;
                    break;
                }
            }
        } else {//nhom user tao
            foreach ($listSt['querySettingInfos'] as $setting) {
                if ($setting['callerNumber'] == $gid) {
                    $st = $setting;
                    break;
                }
            }
        }
        if ($st) {//neu da ton tai cai dat, lay thong tin cac bai nhac cho da dung
            $result = CrbtService::queryTbTone($user->phonenumber, $st['toneBoxID']);
            if ($result["resultCode"] == 0) {
                $usedTone = $result["queryToneInfos"];
                foreach ($usedTone as $tone) {
                    $ltcode[] = $tone['toneCode'];
                }
            }
        }

        $result = CrbtService::getUserTones($user->phonenumber);
        if ($result["resultCode"] == 0) {
            $lt = $result["queryToneInfos"];
        }
        return $this->render('setting-music', [
                    'usedTone' => $usedTone,
                    'gid' => $gid,
                    'lt' => $lt,
                    'ltcode' => $ltcode
        ]);
    }

    public function actionSettingTime() {
        $this->layout = false;
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $ltid = array();
        $gid = Yii::$app->request->getQueryParam('gid');
        $gName = trim(Yii::$app->request->post('name'));
        if (!$gid)
            return $this->goHome();
        $listSt = CrbtService::querySetting($user->phonenumber);
        $st = null;
        //neu la nhom mac dinh
        if ($gid == "default") {
            foreach ($listSt['querySettingInfos'] as $setting) {
                if ($setting['setType'] == DEFAULT_TONE) {
                    $st = $setting;
                    break;
                }
            }
        } else {//nhom user tao
            foreach ($listSt['querySettingInfos'] as $setting) {
                if ($setting['callerNumber'] == $gid) {
                    $st = $setting;
                    break;
                }
            }
        }

        //neu la get va chua co cai dat thi ko the den buoc nay. Tro ve buoc chon nhac cho
        if (Yii::$app->request->isGet && !$st) {
            return $this->redirect("/setting-music/" + $gid);
        }

        //neu la post, thuc hien cap nhat nhac cho
        if (Yii::$app->request->isPost) {
            $rbts = Yii::$app->request->post('rbts');
            $result = CrbtService::getUserTones($user->phonenumber);
            if ($result["resultCode"] == 0) {
                foreach ($result["queryToneInfos"] as $tone) {
                    $ltid[] = $tone['toneID'];
                }
            }

            if (!Helpers::checkChildArray($rbts, $ltid)) {
                \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Nhạc chờ bạn chọn chưa đúng. Xin vui lòng chọn lại!'));
                return $this->redirect("/them-moi-cai-dat-cuoc-goi-den/" + $gid);
            }

            if ($st) {//neu da ton tai cai dat, cap nhat thong tin nhac cho (tonebox)
                $result = CrbtService::editToneBox($user->phonenumber, $gid, $rbts, $st["toneBoxID"]);
                if ($result["resultCode"] != 0) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Cập nhật nhạc chờ chưa thành công. Xin quý khách vui lòng chọn lại!'));
                    return $this->redirect("/them-moi-cai-dat-cuoc-goi-den/" + $gid);
                }
            } else {//neu chua co cai dat thi tao cai dat
                //tao tonebox truoc
                $ctb = CrbtService::addToneBox($user->phonenumber, $gid, $rbts);
                if ($ctb["resultCode"] == 0) {//neu tao tonebox thanh cong
                    $boxid = $ctb["toneBoxID"];
//                    $type = ($gid == "default" ? DEFAULT_TONE:GROUP_TONE);
                    $settone = CrbtService::setTone(
                                    $user->phonenumber//so dien thoai cai dat
                                    , $boxid// toneBoxID tonebox id cho cai dat
                                    , (string) GROUP_TONE // setType loai cai dat mac dinh hay cai dat cho nhom
                                    , $gid  // callerNumber id cua nhom
                                    , "2"   // loopTypelay randon tonebox. fix co dinh = 2
                                    , "1"   // timeType: kieu thoi gian: 1 la ca ngay, 2 khoang trong ngay, 3 trong tuan, 4 trong thang, 5 tron gnam, 6 khoang tg xac dinh
                                    , "2003-01-01 00:00:00"// startTime: dang set mac dinh khi timeType = 1
                                    , "2003-01-01 00:00:00"); // endTime: dang set mac dinh khi timeType = 1

                    if ($settone["resultCode"] != 0) {//tao setting ko thanh cong
                        \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Tạo cài đặt chưa thành công. Xin quý khách vui lòng chọn lại nhạc chờ!'));
                        return $this->redirect("/them-moi-cai-dat-cuoc-goi-den/" + $gid);
                    } else { //
                        $listSt = CrbtService::querySetting($user->phonenumber);
                        if ($listSt['resultCode'] == 0) {
                            foreach ($listSt['querySettingInfos'] as $setting) {
                                if ($settone['settingID'] == $setting['settingID']) {
                                    $st = $setting;
                                    break;
                                }
                            }
                        }
                    }
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Tạo box nhạc chưa thành công. Xin quý khách vui lòng chọn lại!'));
                    return $this->redirect("/them-moi-cai-dat-cuoc-goi-den/" + $gid);
                }
            }
        }

        return $this->render('setting-time', [
                    'gid' => $gid,
                    'st' => $st,
                    'gName' => $gName,
        ]);
    }

    public function actionFinishSetting() {
        if (Yii::$app->request->isPost) {
            $return = array(
                'errorCode' => 1,
                'message' => '',
                'url' => Url::to(['group'])
            );

            $user = \Yii::$app->user->identity;
            if (!$user) {
                return $this->goHome();
            }

            $gid = Yii::$app->request->post('gid');

            $listSt = CrbtService::querySetting($user->phonenumber);
            $st = null;
            //neu la nhom mac dinh
            if ($gid == "default") {
                foreach ($listSt['querySettingInfos'] as $setting) {
                    if ($setting['setType'] == DEFAULT_TONE) {
                        $st = $setting;
                        break;
                    }
                }
            } else {//nhom user tao
                foreach ($listSt['querySettingInfos'] as $setting) {
                    if ($setting['callerNumber'] == $gid) {
                        $st = $setting;
                        break;
                    }
                }
            }

            $timeType = Yii::$app->request->post('timeType');
            $startTime = Yii::$app->request->post('startTime');
            $endTime = Yii::$app->request->post('endTime');

            if ($timeType != 1) {
                if ($startTime == null || $startTime == "") {
                    $return['message'] = "Bạn phải chọn thời điểm bắt đầu!";
                    echo json_encode($return);
                    exit(0);
                }
                if ($endTime == null || $endTime == "") {
                    $return['message'] = "Bạn phải chọn thời điểm kết thúc!";
                    echo json_encode($return);
                    exit(0);
                }
            }
            switch ($timeType) {
                case 1: //  whole day
                    $startTime = null;
                    $endTime = null;
                    break;
                case 2: //  in day
                    $startTime = $startTime . ':00';
                    $endTime = $endTime . ':00';
                    break;
                case 3: //  in week
                    $startTime = sprintf("%02d", $startTime) . date('-m-Y H:i:s', time());
                    $endTime = sprintf("%02d", $endTime) . date('-m-Y H:i:s', time());
                    break;
                case 4: //  in month
                    $startTime = date('Y-m-d H:i:s', strtotime(sprintf("%02d", $startTime) . date('-m-Y H:i:s', time())));
                    $endTime = date('Y-m-d H:i:s', strtotime(sprintf("%02d", $endTime) . date('-m-Y H:i:s', time())));
                    break;
                case 5: // in year
                    $startTime = date('Y-m-d H:i:s', strtotime($startTime . date('-Y H:i:s', time())));
                    $endTime = date('Y-m-d H:i:s', strtotime($endTime . date('-Y H:i:s', time())));
                    break;
                case 6: //  time detail
                    $startTime = $startTime . ':00';
                    $endTime = $endTime . ':00';
                    break;
                default:
                    $return['message'] = "Cài đặt thời gian không hợp lệ! Bạn hãy refresh trang và thực hiện lại";
                    echo json_encode($return);
                    exit(0);
            }

            $result = CrbtService::editSetting($user->phonenumber, $st['settingID'], $st['setType'], $st['callerNumber'], $st['loopType'], (string) $timeType, $startTime, $endTime, $st['toneBoxID'], "2"); //TODO: dung edit setting

            if ($result['resultCode'] == 0) {
                $return['message'] = "Cài đặt thành công!";
                \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Cài đặt thành công!'));
                $return['errorCode'] = 0;
                echo json_encode($return);
                exit(0);
            } else {
                $return['message'] = $result['message'];
                \Yii::$app->session->setFlash('error', \Yii::t('frontend', $result['message']));
                $return['errorCode'] = 1;
                echo json_encode($return);
                exit(0);
            }
        } else {
            return $this->goHome();
        }
    }

    public function actionRbtService() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $isRegister = 0;
        if ($user) {
            $check = CrbtService::checkStatusCRBT($user->phonenumber);
            if ($check['statusCRBT'] == -1) {
                \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Hệ thống đang lỗi, vui lòng thử lại sau!'));
                return $this->redirect('/user/package');
            }
            if ($check['statusCRBT'] == 1 || $check['statusCRBT'] == 2) {
                $isRegister = $check['statusCRBT'];
            }
            if ($check['userInfos'] && $isRegister) {
                $brandID = $check['userInfos'][0]['brand'];
            }
        }

        if (!$isRegister) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách chưa đăng ký dịch vụ nhạc chờ!'));
            return $this->redirect('/user/package');
        }

        if (Yii::$app->request->isPost) {
            $action = Yii::$app->request->post('action');
            if ($action == "active") {
                $regRbt = CrbtService::activeAndPauseService($user->phonenumber, '1');
                \Yii::info("ACTION_ACTIVE > $user->phonenumber > " . $regRbt['resultCode']);
                LogRbtService::write($user->id, $user->username, ACTION_REGISTER, $user->phonenumber, $regRbt['crbtReturnCode'], $brandID);
                if ($regRbt['resultCode'] == 0) {
                    \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Kích hoạt dịch vụ thành công!'));
                    $isRegister = 1;
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Kích hoạt dịch vụ thất bại, vui lòng thử lại sau !'));
                }
            } else if ($action == "unregister") {
                $cancelStatus = CrbtService::csUnSubscribe($user->phonenumber);
                \Yii::info("ACTION_UNREGISTER > $user->phonenumber > " . $cancelStatus['resultCode']);
                LogRbtService::write($user->id, $user->username, ACTION_UNREGISTER, $user->phonenumber, $cancelStatus['crbtReturnCode'], $brandID);
                if ($cancelStatus['resultCode'] == 0) {
                    \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Hủy dịch vụ thành công!'));
                    return $this->redirect('/dang-ky-dich-vu');
                }
            } else if ($action == "pause") {
                $cancelStatus = CrbtService::activeAndPauseService($user->phonenumber, '2');
                \Yii::info("ACTION_SUPENDING > $user->phonenumber > " . $cancelStatus['resultCode']);
                LogRbtService::write($user->id, $user->username, ACTION_SUPENDING, $user->phonenumber, $cancelStatus['crbtReturnCode'], $brandID);
                if ($cancelStatus['resultCode'] == 0) {
                    \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Tạm dừng dịch vụ thành công!'));
                    $isRegister = 2;
                }
            }
        }
        return $this->render('rbt-service', [
                    'user' => $user,
                    'brandID' => $brandID,
                    'isRegister' => $isRegister
        ]);
    }

    public function actionPackage() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $isRegister = false;
        $brandID = 0;
        if ($user) {
            $check = CrbtService::checkStatusCRBT($user->phonenumber);
            if ($check['statusCRBT'] == 1 || $check['statusCRBT'] == 2) {
                $isRegister = true;
            }
            if ($check['userInfos'] && $isRegister) {
                $brandID = $check['userInfos'][0]['brand'];
            }
        }
        if (Yii::$app->request->isPost) {
            $action = Yii::$app->request->post('action');
            $brandID = Yii::$app->request->post('brand_id');

            //homephone
            if ($brandID == 3) {
                if (!\common\libs\Helpers::checkHomePhone($user->phonenumber)) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Đăng ký gói cước Homephone thất bại do thuê bao không phải thuê bao Homephone!'));
                    $action = '';
                }
            }

            //HightSchool
            if ($brandID == 77) {
                $checkHighshool = \common\helpers\Helpers::checkHighSchool($user->phonenumber);
                if ($checkHighshool['error'] != 0) {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', $checkHighshool['message']));
                    $action = '';
                }
            }

            if ($action == "register" && !$isRegister) {
                $regRbt = CrbtService::subscribe($user->phonenumber, $brandID);
                \Yii::info("ACTION_REGISTER > $user->phonenumber > $brandID > " . $regRbt['resultCode']);
                LogRbtService::write($user->id, $user->username, ACTION_REGISTER, $user->phonenumber, $regRbt['crbtReturnCode'], $brandID);
                if ($regRbt['resultCode'] == 0) {
                    \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Đăng ký dịch vụ thành công!'));
                    $isRegister = true;
                    return $this->redirect('/kich-hoat-huy-dung-dich-vu');
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Đăng ký dịch vụ thất bại, vui lòng thử lại sau!'));
                }
            } else if ($action == "unregister" && $isRegister) {
                $cancelStatus = CrbtService::csUnSubscribe($user->phonenumber);
                \Yii::info("ACTION_UNREGISTER > $user->phonenumber > $brandID > " . $regRbt['resultCode']);
                LogRbtService::write($user->id, $user->username, ACTION_UNREGISTER, $user->phonenumber, $cancelStatus['crbtReturnCode'], $brandID);
                if ($cancelStatus['resultCode'] == 0) {
                    \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Hủy dịch vụ thành công!'));
                    $isRegister = false;
                } else {
                    \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Hủy dịch vụ thất bại, vui lòng thử lại sau!'));
                }
            }
        }

        return $this->render('package', [
                    'user' => $user,
                    'isRegister' => $isRegister,
                    'brandID' => intval($brandID)
        ]);
    }

    public function actionMyRbt() {
        $user = \Yii::$app->user->identity;
        if (!$user) {
            return $this->goHome();
        }
        $isRegister = 0;
        $check = CrbtService::checkStatusCRBT($user->phonenumber);
        if ($check['statusCRBT'] == -1) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Hệ thống đang lỗi, vui lòng thử lại sau!'));
            return $this->redirect('/user/package');
        }
        if ($check['statusCRBT'] == 1 || $check['statusCRBT'] == 2) {
            $isRegister = $check['statusCRBT'];
        }
        if ($check['userInfos'] && $isRegister) {
            $brandID = $check['userInfos'][0]['brand'];
        }
        if (!$isRegister) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách chưa đăng ký dịch vụ Nhạc chờ Imuzik. Hãy đăng ký để sử dụng!'));
            return $this->redirect('/user/package');
        } else if ($isRegister == 2) {
            \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Quý khách đang tạm ngưng dịch vụ Nhạc chờ Imuzik. Hãy kích hoạt để sử dụng!'));
            return $this->redirect('/user/rbt-service');
        }

        $lt = [];
        $msisdn = $user->phonenumber;

        if (\Yii::$app->request->post()) {
            $personID = Yii::$app->request->post('personID');
            $deleteRBT = CrbtService::delInboxTone($msisdn, $personID);
            if ($deleteRBT['resultCode'] == \Yii::$app->params[CrbtService::routeService($msisdn) . '_success_code']) {
                \Yii::$app->session->setFlash('success', \Yii::t('frontend', 'Xóa thành công!'));
            } else {
                \Yii::$app->session->setFlash('error', \Yii::t('frontend', 'Xóa không thành công!'));
            }
        }

        $getCollect = CrbtService::getUserTones($msisdn);
        if ($getCollect['resultCode'] == 0) {
            $lt = $getCollect['queryToneInfos'];
        }
        return $this->render('my-rbt', [
                    'lt' => $lt,
                    'msisdn' => $msisdn
        ]);
    }

    public function actionDelMyRbt() {
        $this->layout = false;
        $user = \Yii::$app->user->identity;

        if ($user && \Yii::$app->request->post()) {
            $msisdn = $user->phonenumber;
            $personID = Yii::$app->request->post('personID');
            $toneCode = Yii::$app->request->post('toneCode');
            $deleteRBT = CrbtService::delInboxTone($msisdn, $personID);
            \Yii::info("DELETE_RBT > $user->phonenumber > $toneCode > " . $deleteRBT['resultCode']);
            if ($deleteRBT['resultCode'] == \Yii::$app->params[CrbtService::routeService($msisdn) . '_success_code']) {
                echo \Yii::t('frontend', 'Mã nhạc chờ ' . $toneCode . ' xóa thành công!');
            } else {
                echo \Yii::t('frontend', 'Mã nhạc chờ ' . $toneCode . ' xóa không thành công!');
            }
        } else {
            echo \Yii::t('frontend', 'Có lỗi xảy ra, Quý khách vui lòng thử lại sau ít phút!');
        }
        exit(0);
    }

}
