<?php

namespace common\libs;

use common\helpers\Helpers;
use Solarium\Core\Query\Helper;
use nusoap_client;
use soapval;

//use common\libs\VtCrbtReturnCode;

/**
 * Description of VtCrbtService
 *
 * @author Ico
 */
class CrbtService {
    /* -crbtpresent-region-start----------------------------------------------- */

    public static final function getPrefix($msisdn) {
        if ($msisdn != "") {
            if ($msisdn[0] . $msisdn[1] != '16')
                return substr($msisdn, 0, \Yii::$app->params['vcrbt_msisdn_length']);
            else
                return substr($msisdn, 0, \Yii::$app->params['vcrbt_msisdn_length']);
        }
        return '';
    }

    public static function routeService($msisdn) {
        $strlistvCRBT = (string) (\Yii::$app->params['vcrbt_list_msisdn']);
        $strarravCRBT = (string) (\Yii::$app->params['vcrbt_arr_msisdn']);


        $msisdn = self::remove084PhoneNumber($msisdn);


        if ($strarravCRBT != '') {
            $arrayCRBT = explode(',', $strarravCRBT);
            if (in_array($msisdn, $arrayCRBT))
                return 'vcrbt';
        }

        if ($strlistvCRBT != '') {
            $listCRBT = explode(',', $strlistvCRBT);
            if (in_array(self::getPrefix($msisdn), $listCRBT))
                return 'vcrbt';
        }
        return 'huawei';
    }

    /**
     * @description   download ringback tone
     * @param         $phone_no
     * @param         $tone_code
     * @return array
     * 2: query failed
     * 1: crbt error
     * 0: success
     */
    public static function orderTone($phone_no, $tone_code) {
        if ($tone_code == '') {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
                'crbtDescription' => "Ringback tone has not been attached to video"
            );
        }
        $phone_no = self::remove084PhoneNumber($phone_no);
        $orderToneCode = self::batchOrderTone($phone_no, $tone_code);
        $orderReturnCode = new VtCrbtReturnCode($orderToneCode['crbtReturnCode']);
        if ($orderToneCode['resultCode'] == 0) {
            if ($orderReturnCode->isSuccess()) {
                return array(
                    'resultCode' => 0,
                    'crbtReturnCode' => $orderReturnCode->getCode(),
                    'crbtDescription' => $orderReturnCode->getDescription()
                );
            }
            return array(
                'resultCode' => 1,
                'crbtReturnCode' => $orderReturnCode->getCode(),
                'crbtDescription' => $orderReturnCode->getDescription()
            );
        }
        return array(
            'resultCode' => 2,
            'crbtReturnCode' => $orderReturnCode->getCode(),
            'crbtDescription' => $orderReturnCode->getDescription()
        );
    }

    /**
     * author: thongnq1
     * ham thuc hien tang qua nhac cho cho so thue bao khac
     * @param type $from_phone_no
     * @param type $to_phone_no
     * @param type $tone_code
     * @return resultCode: 0: thanh cong - 1: co loi xay ra
     * @return crbtReturnCode ma cua nhac cho
     * @return crbtDescription mo ta loi cua ws tang nhac cho
     */
    public static function presentRbt($from_phone_no, $to_phone_no, $tone_code, $tone_name = "") {
        $tone_code = trim($tone_code);
        if ($tone_code == '') {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
                'crbtDescription' => "NO RBT"
            );
        }

        $presentToneResult = self::presentTone($from_phone_no, $to_phone_no, $tone_code);
        if ($presentToneResult['resultCode'] == 0 && $presentToneResult["returnCode"] == "000001") {
            //tuanbm bo sung 11/07/2012 them ham xu ly nhan tin
            $confirm_code = $presentToneResult["resultInfo"];
            $from_phone_no = self::remove084PhoneNumber($from_phone_no);
            $to_phone_no = self::remove084PhoneNumber($to_phone_no);
            $resultSendSms = self::sendSmsPresentTone($from_phone_no, $to_phone_no, $tone_name, $tone_code, $confirm_code);
            $resultInfo = new VtCrbtReturnCode($resultSendSms['returnCode']);
            return array(
                'resultCode' => $resultSendSms["resultCode"],
                'crbtReturnCode' => $resultSendSms["returnCode"],
                'crbtDescription' => $resultInfo->getDescription()
            );
        }
        $resultInfo = new VtCrbtReturnCode($presentToneResult['returnCode']);
        return array(
            'resultCode' => $presentToneResult["resultCode"],
            'crbtReturnCode' => $presentToneResult["returnCode"],
            'crbtDescription' => $resultInfo->getDescription()
        );
    }

    /**
     * @author: tuanbm2
     * @description   present ringback tone
     * @param         $isdn: La kieu ISDN (VD: 988091985)
     * @param         $song_name: ten bai nhac cho
     * @param         $confirm_code: ma xac nhan nguoi dung muon nhan bai hat
     * @return code
     */
    private static function sendSmsPresentTone($from_isdn, $to_isdn, $song_name, $tone_code, $confirm_code) {
//        if ($song_name == "") {
//            $toneInfo = self::getToneInfoByRbtCode($tone_code);
//            $arrayInfos = $toneInfo["queryToneInfos"];
//            if (is_null($arrayInfos) == false && count($arrayInfos) > 0) {
//                $song_name = $toneInfo["queryToneInfos"][0]["toneName"];
//            }
//        }
        $end_time = date("d/m/Y, H:i", strtotime("+5 hour"));
//        $messageContent = 'Chao ban, thue bao ' . $from_isdn . ' vua gui tang bai hat '
//                . $song_name . ', ma cua bai hat nay la ' . $tone_code
//                . '.Ma khoa xac nhan la ' . $confirm_code
//                . '.De xac nhan tra loi tin nhan "co ' . $confirm_code . '"'
//                . ' (de dong y) hoac "ko ' . $confirm_code . '"'
//                . ' (de tu choi) truoc ngay ' . $end_time;
        $messageContent = 'Quy khach da duoc thue bao  ' . $from_isdn . ' gui tang bai hat nhac cho: '
                . $song_name
                . '.Soan tin CO ' . $confirm_code
                . ' (de chap nhan) hoac KO ' . $confirm_code
                . ' (de tu choi) gui 1221 truoc ' . $end_time . '. Tran trong.';
        return self::sendSms($messageContent, $to_isdn);
    }

    public static function sendSms($messageContent, $to_isdn) {
        $client = new nusoap_client(\Yii::$app->params['huawei_system'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return -1;
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
//            'portalType' => CrbtPortalTypeEnum::SMS, //tin nhan
            'role' => '3', //administrator
            'roleCode' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'timeType' => '2',
            'smContent' => $messageContent,
            'phoneNumbers' => $to_isdn
        );
        $params = array('SendSmEvt' =>
            new soapval('SendSmEvt', NULL, $param, false, 'http://crbtpresent.ivas.huawei.com')
        );
        $result = $client->call('sendSm', $params, '', '');
        return $result;
    }

    /**
     * @static
     * @param $phone_no
     * @param $tone_code
     * @param $discount
     * @return array
     * 1: failed
     * 0: query success
     * modified by: thongnq1
     * updated_at:23/10
     * them kiem tra ket qua tra ve co thanh cong khong
     * modified: doanhpv1 - cho phep order disc
     */
    private static function batchOrderTone($phone_no, $tone_code, $resourceType = '1') {
//      $client = new nusoap_client(\Yii::$app->params['app_huawei_crbtpresent'), false,

        $client = new nusoap_client(\Yii::$app->params[self::routeService($phone_no) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 1
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();

        $chargeFlag = '';


        if (self::checkAllowFreeCharge($phone_no)) {
            $chargeFlag = '0';
        }

        if (\Yii::$app->params['free_order_tone'] == '1') {//neu cho phep KM
            if (\Yii::$app->params['free_order_tone_type'] == '1') {
                if (self::checkAllowFreeDay($phone_no))
                    $chargeFlag = '0';
            } elseif (\Yii::$app->params['free_order_tone_type'] == '2') {
                if (self::checkAllowFreeWeek($phone_no))
                    $chargeFlag = '0';
            }
        }

        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($phone_no) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($phone_no) . '_service_apppassword']),
            'role' => '1',
            'roleCode' => $phone_no,
            'phoneNumber' => $phone_no,
            'resourceCode' => $tone_code,
            'resourceType' => $resourceType, // doanhpv1 sửa, mặc giá trị mặc định là 1
            'portalType' => '12', //khanhnqthem vao
            'moduleCode' => '00IMUZIKweb'
        );
        if ($chargeFlag == '0') {
            $param['discount'] = '0';
        }

        $params = array('OrderToneEvt' =>
            new soapval('OrderToneEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );

        try {
            $result = $client->call('orderTone', $params, '', '');
        } catch (Exception $e) {
            //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            return array(
                'resultCode' => 1
            );
        }


        // echo '<br/>';
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;
        if ($client->fault) {
            //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ');
            return array(
                'resultCode' => 1
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1
                );
            } //thongnq1 edit: kiem xem returnCode co success khong
            elseif ($result['returnCode'] == \Yii::$app->params[self::routeService($phone_no) . '_success_code']) {
//        $user->setAttribute($phone_no.'_number_downloaded', $numCrbt+1);
                return array(
                    'resultCode' => 0,
                    'crbtReturnCode' => $result['returnCode']
                );
            } else {
                return array(
                    'resultCode' => 1,
                    'crbtReturnCode' => $result['returnCode']
                );
            }
            //end thongnq1 edit
        }
    }

    private static function checkAllowFreeCharge($phoneFree) {
        $listPhoneFree = (string) (\Yii::$app->params['phone_allow_free']);
        if ($listPhoneFree == "" || Helpers::checkViettelPhoneNumber($phoneFree) == false) {
            return false;
        } else {
            $phones = explode(",", $listPhoneFree);
            foreach ($phones as $phone) {
                if ($phone === $phoneFree) {
                    return true;
                }
            }
        }
    }

    /**
     * khanhnq16
     * @param $phoneFree
     * @return bool
     */
    private static function checkAllowFreeDay($phoneFree) {
        $dateKM = date('Y/m/d');
        $listDayFree = (string) (\Yii::$app->params['free_download_from']);
        $inday = false;
        if ($listDayFree == "" || Helpers::checkViettelPhoneNumber($phoneFree) == false) {
            return false;
        } else {
            $days = explode(",", $listDayFree);
            foreach ($days as $day) {
                if ($dateKM == $day) {
                    $inday = true;
                }
            }
            if (!$inday) {
                return false;
            } else
                return true;
        }
    }

    private static function checkAllowFreeWeek($phoneFree) {

        $dateKM = date('Y/m/d');
        $listDayFree = (string) (\Yii::$app->params['free_download_from']);
        if ($listDayFree == "" || Helpers::checkViettelPhoneNumber($phoneFree) == false) {
            return false;
        } else {
            if ((strtotime(\Yii::$app->params['free_download_from']) > $dateKM) || (strtotime(\Yii::$app->params['free_download_to']) < $dateKM)) {
                return false;
            }
            return true;
        }
    }

    /**
     * @static
     * @param $phone_no
     * @param $tone_code
     * @return array
     * 1: failed
     * 0: query success
     */
    private static function batchSetTone($phone_no, $tone_code) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($phone_no) . '_crbtpresent'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 1
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();

        $chargeFlag = '1';

        if (self::checkAllowFreeCharge($phone_no) == true) {
            $chargeFlag = '0';
            self::WriteLogger("Tai mien phi bai nhac cho(batchSetTone)" . $tone_code . " tu SDT " . $phone_no); //tuanbm
        }

        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => CrbtPortalTypeEnum::Web,
            'role' => 1,
            'roleCode' => $phone_no,
            'phoneNumbers' => array(0 => $phone_no),
            'toneCode' => $tone_code,
            'chargeFlag' => $chargeFlag,
            'setPrinciple' => 2
        );
        $params = array('BatchSetToneEvt' =>
            new soapval('BatchSetToneEvt', NULL, $param, false, 'http://crbtpresent.ivas.huawei.com')
        );


        try {
            $result = $client->call('batchSetTone', $params, '', '');
        } catch (Exception $e) {
            //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            return array(
                'resultCode' => 1
            );
        }


        if ($client->fault) {
            return array(
                'resultCode' => 1
            );
        } else {
            $err = $client->getError();
            if ($err)
                return array(
                    'resultCode' => 1
                );
            else
                return array(
                    'resultCode' => 0,
                    'crbtReturnCode' => $result['returnCode']
                );
        }
    }

    /**
     * @description   present ringback tone
     * @param         $from_phone_no
     * @param         $to_phone_no
     * @param         $tone_code
     * @return array
     * 1: failed
     * 0: query success
     */
    private static function presentTone($from_phone_no, $to_phone_no, $tone_code) {
        if ($tone_code == '') {
            return array(
                'resultCode' => 1,
                'crbtReturnCode' => 'N/A',
                'crbtDescription' => "Ringback tone has not been attached to video"
            );
        }
        $client = new nusoap_client(\Yii::$app->params[self::routeService($from_phone_no) . '_crbtpresent'], false, '', '', '', '');
        $from_phone_no = self::remove084PhoneNumber($from_phone_no);
        $to_phone_no = self::remove084PhoneNumber($to_phone_no);
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 1,
                'crbtReturnCode' => 'N/A'
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($from_phone_no) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($from_phone_no) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => '1',
            'roleCode' => $from_phone_no,
            'fromUserPhoneNumber' => $from_phone_no,
            'toUserPhoneNumber' => $to_phone_no,
            'resourceType' => '1',
            'resourceCode' => $tone_code
        );
        $params = array('PresentToneEvt' =>
            new soapval('PresentToneEvt', NULL, $param, false, 'http://crbtpresent.ivas.huawei.com')
        );
        $result = $client->call('presentTone', $params, '', '');
        return $result;
    }

    /**
     * @static
     * @param $audition_key
     * @param $affirm_Flag
     * @return array
     * 1: failed
     * 0: query success
     */
    public static function presentToneAffirm($audition_key, $affirm_Flag) {
        if ($audition_key == '') {
            return array(
                'resultCode' => 1,
                'crbtReturnCode' => 'N/A',
                'crbtDescription' => 'NULL key'
            );
        }

        $client = new nusoap_client(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_crbtpresent'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 1,
                'crbtReturnCode' => 'N/A'
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => CrbtPortalTypeEnum::Web,
            'role' => "3",
            'roleCode' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'auditionkey' => $audition_key,
            'affirmFlag' => $affirm_Flag
        );
        $params = array('PresentToneAffirmEvt' =>
            new soapval('PresentToneAffirmEvt', NULL, $param, false, 'http://crbtpresent.ivas.huawei.com')
        );


        try {
            $result = $client->call('presentToneAffirm', $params, '', '');
        } catch (Exception $e) {
            //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            return array(
                'resultCode' => 1
            );
        }


//    $result = $client->call('presentToneAffirm', $params, '', '');
//    echo '<br/>';
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        if ($client->fault) {
            return array(
                'resultCode' => 1,
                'crbtReturnCode' => $result['returnCode']
            );
        } else {
            $err = $client->getError();
            if ($err)
                return array(
                    'resultCode' => 1,
                    'crbtReturnCode' => $result['returnCode']
                );
            else
                return array(
                    'resultCode' => 0,
                    'crbtReturnCode' => $result['returnCode']
                );
        }
    }

    /* -crbtpresent-region-end------------------------------------------------- */


    /* -operatormanage-region-start-------------------------------------------- */




    /* -statquery-region-end--------------------------------------------------- */


    /* -system-region-end------------------------------------------------------ */

    /**
     * @static
     * @param $phones_no string separate by '|'
     * @param $mess_content string
     * @return array
     * 1:
     */
    public static function sendMessage($phones_no, $mess_content) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($phones_no) . '_system'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 1
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => CrbtPortalTypeEnum::SMS,
            'role' => "3",
            'roleCode' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'timeType' => "2",
            'smContent' => $mess_content,
            'phoneNumbers' => explode('|', $phones_no)
        );
        $params = array('SendSmEvt' =>
            new soapval('SendSmEvt', NULL, $param, false, 'http://system.ivas.huawei.com')
        );


        try {
            $result = $client->call('sendSm', $params, '', '');
        } catch (Exception $e) {
            //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());

            return array(
                'resultCode' => 1
            );
        }


//    $result = $client->call('sendSm', $params, '', '');
        if ($client->fault) {
            return array(
                'resultCode' => 1
            );
        } else {
            $err = $client->getError();
            if ($err)
                return array(
                    'resultCode' => 1
                );
            else
                return array(
                    'resultCode' => 0,
                    'crbtReturnCode' => $result['returnCode']
                );
        }
    }

    /* -system-region-end------------------------------------------------------ */


    /* -toneprovide-region-end------------------------------------------------- */




    /**
     * @static You can query all the RBTs, or query RBTs by CP, keyword, ID, and state, RBT approving modes.
     * @param $toneName
     * @param $cpId
     * @return array {'resultCode'}
     * 3: tones not found
     * 2: connect to webservice error;
     * 1: query error
     * 0: successful
     */
    /* -toneprovide-region-end------------------------------------------------- */


    /* -usermanage-region-end-------------------------------------------------- */

    /**
     * @static
     * @param $phone_no
     * @return array {'resultCode'}
     * 3: query error
     * 2: connect to webservice error;
     * 1: not registered
     * 0: registered
     */
    public static function getUser($phone_no) {
        $client = new \nusoap_client(\Yii::$app->params[self::routeService($phone_no) . '_usermanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $phone_no = self::remove084PhoneNumber($phone_no);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($phone_no) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($phone_no) . '_service_apppassword']),
            'startRecordNum' => "1",
            'endRecordNum' => "1",
            'queryType' => "2",
            'phoneNumber' => $phone_no
        );
        $params = array('QueryUserEvt' =>
            new soapval('QueryUserEvt', NULL, $param, false, 'http://usermanage.ivas.huawei.com')
        );


        try {
            $result = $client->call('query', $params, '', '');
//        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//        die;
        } catch (Exception $e) {
//      //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            self::WriteLogger('Loi goi webservice: ' . $e->getMessage()); //tuanbm
            return array(
                'resultCode' => 2
            );
        }

//    $result = $client->call('query', $params, '', '');
        if ($client->fault) {
            return array(
                'resultCode' => 2
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 4
                );
            } else {
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($phone_no) . '_success_code']) {
                    if (count($result['userInfos']) > 0) {
                        return array(
                            'resultCode' => 0,
                            'returnCode' => $result['returnCode'],
                            'userInfos' => $result['userInfos']
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode']
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode']
                );
            }
        }
    }

    /**
     * modified: thongnq1
     * them ma loi tra ve tu service
     * @param type $phone_no
     * @return array {'resultCode'}
     * 3: query error
     * 2: connect to webservice error;
     * 1: nok
     * 0: ok
     */
    public static function subscribe($phone_no, $brandID) {
        $client = new \nusoap_client(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_usermanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {

            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $phone_no = self::remove084PhoneNumber($phone_no);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1",
            'roleCode' => $phone_no,
            'phoneNumber' => $phone_no,
            'validateCode' => '',
            'tradeMark' => $brandID
        );
        //KM thang 10/2013
        $dateKM = strtotime(date('Y/m/d'));
        //echo \Yii::$app->params['app_free_register_from');
        //echo \Yii::$app->params['app_free_register_to');
        //echo \Yii::$app->params['app_free_register_flag'); 
        //die;
        if (\Yii::$app->params['app_free_register_flag'] == '1') {

            $dateKM = strtotime(date('Y/m/d'));
            if ((strtotime(\Yii::$app->params['app_free_register_from']) <= $dateKM) && (strtotime(\Yii::$app->params['app_free_register_to']) >= $dateKM)) {
                $param['tradeMark'] = '52';
            }
        }
//end KM
        $params = array('SubscribeEvt ' =>
            new soapval('SubscribeEvt ', NULL, $param, false, 'http://usermanage.ivas.huawei.com')
        );


        try {
            $result = $client->call('subscribe', $params, '', '');
        } catch (Exception $e) {
            //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            return array(
                'resultCode' => 2
                , 'crbtReturnCode' => 'N/A',
            );
        }


//    $result = $client->call('subscribe', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
////    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    echo $client->getError();
//    die;
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => $result['returnCode'],
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 3,
                    'crbtReturnCode' => $result['returnCode'],
                );
            } else {
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'crbtReturnCode' => $result['returnCode'],
                    );
                } else {
                    return array(
                        'resultCode' => 1,
                        'crbtReturnCode' => $result['returnCode'],
                    );
                }
            }
        }
    }

    /* -usermanage-region-end-------------------------------------------------- */

    /**
     * modified: thongnq1
     * them ma tra ve tu webservice vao ket qua tra ve
     * @param type $phone_no
     * @return array {'resultCode'}
     * 3: query error
     * 2: connect to webservice error;
     * 1: nok
     * 0: ok
     */
    public static function activeAndPauseService($phone_no, $type) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_usermanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $phone_no = self::remove084PhoneNumber($phone_no);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => SMS_TYPE,
            'role' => "1",
            'roleCode' => $phone_no,
            'type' => $type, //2: suspend,1 :active
            'phoneNumber' => $phone_no
        );
        $params = array('ActivateAndPauseEvt' =>
            new soapval('ActivateAndPauseEvt', NULL, $param, false, 'http://usermanage.ivas.huawei.com')
        );


        try {
            $result = $client->call('activateAndPause', $params, '', '');
        } catch (Exception $e) {
//      //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            self::WriteLogger('Loi goi webservice: ' . $e->getMessage()); //tuanbm
            return array(
                'resultCode' => 2
            );
        }

//    $result = $client->call('activateAndPause', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    echo "<pre />";
//   echo $result['returnCode'];
//    die;
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 3,
                    'crbtReturnCode' => 'N/A',
                );
            } else {
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'crbtReturnCode' => $result['returnCode'],
                    );
                } else {
                    return array(
                        'resultCode' => 1,
                        'crbtReturnCode' => $result['returnCode'],
                    );
                }
            }
        }
    }

    /* result code: 

     * 0: success
     * 1: prameter null
     */

    public static function csUnSubscribe($phone_no) {
        $phone_no = self::remove084PhoneNumber($phone_no);
        $client = new nusoap_client(\Yii::$app->params[self::routeService($phone_no) . '_usermanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($phone_no) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($phone_no) . '_service_apppassword']),
            'portalType' => SMS_TYPE,
            'role' => "1",
            'roleCode' => $phone_no,
            'phoneNumber' => $phone_no
        );
        $params = array('CsUnSubscribeEvt' =>
            new soapval('CsUnSubscribeEvt', NULL, $param, false, 'http://usermanage.ivas.huawei.com')
        );


        try {
            $result = $client->call('csUnSubscribe', $params, '', '');
        } catch (Exception $e) {
            //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            return array(
                'resultCode' => 2
            );
        }


//    $result = $client->call('csUnSubscribe', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
////    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    echo $client->getError();
//    die;
        if ($client->fault) {
            return array(
                'resultCode' => 2
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 3
                );
            } else {
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'crbtReturnCode' => $result['returnCode']
                    );
                } else {
                    return array(
                        'resultCode' => 1,
                        'crbtReturnCode' => $result['returnCode']
                    );
                }
            }
        }
    }

    /**
     * author: thongnq1
     * created: 25010-2012
     * han thuc hien huy dang ki dich vu nhac cho
     * @param type $msisdn : so thue bao
     * @return array
     * resultCode: ket qua tra ve, 0: thanh cong, <>0: that bai
     * crbtReturnCode: ma loi tra ve cua service (N/A : ket noi service that bai)
     */
    public static function unSubcribe($msisdn) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_usermanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $phone_no = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => CrbtPortalTypeEnum::SMS,
            'role' => "1",
            'roleCode' => $phone_no,
            'phoneNumber' => $phone_no,
        );
        $params = array('CsUnSubscribeEvt' =>
            new soapval('CsUnSubscribeEvt', NULL, $param, false, 'http://usermanage.ivas.huawei.com')
        );


        try {
            $result = $client->call('unSubscribe', $params, '', '');
        } catch (Exception $e) {
//      //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            self::WriteLogger('Loi goi webservice: ' . $e->getMessage()); //tuanbm
            return array(
                'resultCode' => 2
            );
        }

//    $result = $client->call('unSubscribe', $params, '', '');
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 3,
                    'crbtReturnCode' => 'N/A',
                );
            } else {
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'crbtReturnCode' => $result['returnCode'],
                    );
                } else {
                    return array(
                        'resultCode' => 1,
                        'crbtReturnCode' => $result['returnCode'],
                    );
                }
            }
        }
    }

    /* -usertonemanage-region-end---------------------------------------------- */

    /**
     * modified: thongnq1
     * updated:26-10-2012
     * them return khi thuc hien xoa thanh cong
     * @param type $msisdn
     * @param type $toneCode
     * @return type
     */
    public static function delInboxTone($msisdn, $toneCode) {

        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2
            );
        }
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portType' => PORTAL_TYPE,
            'role' => '1',
            'roleCode' => $msisdn,
            'phoneNumber' => $msisdn,
            'personId' => $toneCode
        );
        $params = array('DelInboxToneEvt' =>
            new soapval('DelInboxToneEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        try {
            $result = $client->call('delInboxTone', $params, '', '');
        } catch (Exception $e) {
            return array(
                'resultCode' => 2
            );
        }

        if ($client->fault) {
            return array(
                'resultCode' => 2
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1
                );
            } else {
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    //thongnq1 edit
                    return array(
                        'resultCode' => $result['returnCode'],
                    );
                } else
                    return array(
                        'resultCode' => $result['returnCode'],
                    );
            }
        }
    }

    /**
     * ham thuc hien lay ra cac rbt theo so dien thue bao
     * @return array {'resultCode'}
     * 3: user not found
     * 2: connect to webservice error;
     * 1: query error
     * 0: successful
     * modified: doanhpv1 - cho phep lay thong tin disc nhac
     */
    public static function getUserTones($msisdn, $resourceType = '1') {
        $client = new \nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
//    $client->setHTTPProxy("192.168.174.2", '3128');
//    $client->setHTTPProxy("192.168.168.205",1080);
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2
            );
        }
        $client->setUseCurl('1');
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'startRecordNum' => "1",
            'endRecordNum' => "100",
            // doanhpv1 thêm vào cho phép lấy disc hoặc song
            'resourceType' => $resourceType, //resource = 1 : rbt, =2: tbr group
            'phoneNumber' => $msisdn
        );
        $params = array('QueryInboxToneEvt' =>
            new soapval('QueryInboxToneEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );

        try {
            $result = $client->call('queryInboxTone', $params, '', '');
        } catch (Exception $e) {
//      //sfContext::getInstance()->getLogger()->log('Loi goi webservice: ' . $e->getMessage());
            self::WriteLogger('Loi goi webservice: ' . $e->getMessage()); //tuanbm
            return array(
                'resultCode' => 2
            );
        }
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;
        if ($client->fault) {
            return array(
                'resultCode' => 2
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1
                );
            } else {
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    // doanhpv1: kiem tra xem co disc hoac song hay khong
                    if (count($result['toneInfos']) > 0 || count($result['toneBoxInfos']) > 0) {
                        if (count($result['toneInfos']) > 0)
                            return array(
                                'resultCode' => 0,
                                'queryToneInfos' => $result['toneInfos']
                            );
                        else
                            return array(
                                'resultCode' => 0,
                                'queryToneInfos' => $result['toneBoxInfos']
                            );
                    }
                    return array(
                        'resultCode' => 1,
                        'queryToneInfos' => array()
                    );
                }
                return array(
                    'resultCode' => 3
                );
            }
        }
    }

    /* -usertonemanage-region-end---------------------------------------------- */

    private static function strBeginWith($needle, $haystack) {
        return (substr($haystack, 0, strlen($needle)) == $needle);
    }

    private static function remove084PhoneNumber($phone_no) {
        return RemoveSign::convertMsisdn($phone_no, 'simple');
    }

    /**
     * change PW CRBT by user PW
     * @author vos_khanhnq16
     * @static
     * @param $phone_no
     */

    /**
     * check trang thai CRBT cua sdt, dua ve 3 gia tri
     * @author thongnq1
     * @modified khanhnq16
     * @static
     * @param $phone_no
     * @return array
     */
    public static function checkStatusCRBT($phone_no) {
//    die("den day");
        $return = Array();
        $userCRBT = self::getUser($phone_no);
        //co ket qua tra ve
        if ($userCRBT["returnCode"] == \Yii::$app->params[self::routeService($phone_no) . '_success_code']) {
            if (count($userCRBT['userInfos']) <= 0) {
                // thue bao chua bao gio dang ky crbt, ko co trong csdl crbt
                $return['statusCRBT'] = 0;
            }
            switch ($userCRBT['userInfos'][0]['status']) {
                case REGISTED :
                    $return['statusCRBT'] = 1;
                    break;
                case UN_REGISTED :
                    $return['statusCRBT'] = 0;
                    break;
                case SUSPENDING :
                    $return['statusCRBT'] = 2;
                    break;
                case BEING_REGISTED :
                    $return['statusCRBT'] = 1;
                    break;
                case BEING_DELETE_REGISTED :
                    $return['statusCRBT'] = 0;
                    break;
            }
            $return['userInfos'] = $userCRBT['userInfos'];
        } else { //khong co ket qua tra ve
            $return['statusCRBT'] = -1;
        }

        return $return;
    }

    public static function getStatusCRBT($phone_no) {
        $return = Array();
        $userCRBT = self::getUser($phone_no);
        if ($userCRBT["returnCode"] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
            if (count($userCRBT['userInfos']) <= 0) {
                $return['statusCRBT'] = 0;
            }
            switch ($userCRBT['userInfos'][0]['status']) {
                case VtStatusPhoneNumberRbtServiceEnum::REGISTED :
                    $return['statusCRBT'] = 1;
                    break;
                case VtStatusPhoneNumberRbtServiceEnum::UN_REGISTED :
                    $return['statusCRBT'] = 0;
                    break;
                case VtStatusPhoneNumberRbtServiceEnum::SUSPENDING :
                    $return['statusCRBT'] = 2;
                    break;
                case VtStatusPhoneNumberRbtServiceEnum::BEING_REGISTED :
                    $return['statusCRBT'] = 1;
                    break;
                case VtStatusPhoneNumberRbtServiceEnum::BEING_DELETE_REGISTED :
                    $return['statusCRBT'] = 0;
                    break;
            }
            $return['userInfos'] = $userCRBT['userInfos'];
        } else {
            $return['statusCRBT'] = isset($userCRBT['userInfos'][0]['status']) ? $userCRBT['userInfos'][0]['status'] : 4;
        }

        return $return['statusCRBT'];
    }

    /* -crbt-group-manage-start----------------------------------------------- */

    /**
     * Lay danh sach nhom goi den
     * khanhnq16
     * @author HoangL
     * @param $msisdn
     * @return array
     */
    public static function queryGroup($msisdn) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'startRecordNum' => "1",
            'endRecordNum' => "1000",
            'queryType' => '2', //kieu lay du lieu
            'phoneNumber' => $msisdn
        );
        $params = array('QueryGroupEvt' =>
            new soapval('QueryGroupEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('queryGroup', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    if (count($result['groupInfos']) > 0) {
                        return array(
                            'resultCode' => 0,
                            'queryGroupInfos' => $result['groupInfos'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Them moi nhom goi den
     * @author HoangL
     * @param $msisdn
     * @param $groupCode
     * @param $groupName
     * @param $groupDescription
     * @return array
     */
    public static function addGroup($msisdn, $groupCode, $groupName, $groupDescription = "default") {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
//      echo base64_decode(\Yii::$app->params['app_'.self::routeService(\Yii::$app->user->identity->phonenumber).'_service_apppassword']);die;
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1",
            'roleCode' => $msisdn,
            'phoneNumber' => $msisdn,
            'groupCode' => $groupCode,
            'groupName' => $groupName,
            'description' => $groupDescription,
        );
        $params = array('AddGroupEvt' =>
            new soapval('AddGroupEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('addGroup', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    if ($result['groupID'] > 0) {
                        return array(
                            'resultCode' => 0,
                            'groupId' => $result['groupID'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Chinh sua thong tin nhom goi den crbt
     * @author HoangL
     * @param $msisdn
     * @param $groupCode
     * @param $groupName
     * @param $groupDescription
     * @return array
     */
    public static function editGroup($msisdn, $groupCode, $groupName, $groupDescription) {
        $i18n = sfContext::getInstance()->getI18N();
        $client = new nusoap_client(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => $i18n->__("Mất kết nối đến hệ thống CRBT")
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => CrbtPortalTypeEnum::Web,
            'role' => "1",
            'roleCode' => $msisdn,
            'phoneNumber' => $msisdn,
            'groupCode' => $groupCode,
            'groupName' => $groupName,
            'description' => $groupDescription,
        );
        $params = array('EditGroupEvt' =>
            new soapval('EditGroupEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('editGroup', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => $i18n->__("Không thể thực hiện chức năng")
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => $i18n->__("Có lỗi khi thực hiện chức năng")
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Xoa nhom goi den
     * @author HoangL
     * @param $msisdn
     * @param $groupCode
     * @return array
     */
    public static function delGroup($msisdn, $groupCode) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1",
            'roleCode' => $msisdn,
            'phoneNumber' => $msisdn,
            'groupCode' => $groupCode,
        );
        $params = array('DelGroupEvt' =>
            new soapval('DelGroupEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('delGroup', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Lay danh sach nguoi dung trong nhom
     * @author HoangL
     * @param $msisdn
     * @param $groupCode
     * @return array
     */
    public static function queryGroupMember($msisdn, $groupCode) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'groupCode' => $groupCode,
            'phoneNumber' => $msisdn
        );
        $params = array('QueryGroupMemberEvt' =>
            new soapval('QueryGroupMemberEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('queryGroupMember', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    if (count($result['groupMemberInfos']) > 0) {
                        return array(
                            'resultCode' => 0,
                            'groupMemberInfos' => $result['groupMemberInfos'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Them moi nguoi dung vao nhom
     * @author HoangL
     * @param $msisdn
     * @param $groupCode
     * @param $memNumber
     * @param $memName
     * @param $memDetail
     * @return array
     */
    public static function addGroupMember($msisdn, $groupCode, $memNumber, $memName, $memDetail) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1",
            'roleCode' => $msisdn,
            'phoneNumber' => $msisdn,
            'groupCode' => $groupCode,
            'memberNumber' => $memNumber,
            'memberName' => $memName,
            'memberDetails' => $memDetail,
        );
        $params = array('AddGroupEvt' =>
            new soapval('AddGroupEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('addGroupMember', $params, '', '');


        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Chinh sua thong tin nhom goi den
     * @author HoangL
     * @param $msisdn
     * @param $groupCode
     * @param $memNumber
     * @param $newMemberNumber
     * @param $memName
     * @param $memDetail
     * @return array
     */
    public static function editGroupMember($msisdn, $groupCode, $memNumber, $newMemberNumber, $memName, $memDetail) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1",
            'roleCode' => $msisdn,
            'phoneNumber' => $msisdn,
            'memberNumber' => $memNumber,
            'newMemberNumber' => $newMemberNumber,
            'memberName' => $memName,
            'memberDetails' => $memDetail,
            'moduleCode' => $groupCode,
        );
        $params = array('EditGroupMemberEvt' =>
            new soapval('EditGroupMemberEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('editGroupMember', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Xoa thanh vien trong nhom
     * @author HoangL
     * @param $msisdn
     * @param $groupCode
     * @param $memNumber
     * @return array
     */
    public static function delGroupMember($msisdn, $groupCode, $memNumber) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1",
            'roleCode' => $msisdn,
            'phoneNumber' => $msisdn,
            'groupCode' => $groupCode,
            'memberNumber' => $memNumber,
        );
        $params = array('DelGroupMemberEvt' =>
            new soapval('DelGroupMemberEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('delGroupMember', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Lay cac thong tin cau hinh goi nhom
     * @author HoangL
     * @param $msisdn
     * @return array
     */
    public static function querySetting($msisdn) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'calledUserType' => "1", //normal subscriber
            'calledUserID' => $msisdn
        );
        $params = array('QuerySettingEvt' =>
            new soapval('QuerySettingEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('querySetting', $params, '', '');

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    if (count($result['settingInfos']) > 0) {
                        return array(
                            'resultCode' => 0,
                            'querySettingInfos' => $result['settingInfos'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Dat cau hinh nhom goi den
     * @author HoangL
     * @param $msisdn
     * @param $toneBoxID
     * @param $setType
     * @param $callerNumber
     * @param $timeType
     * @param $startTime
     * @param $endTime
     * @return array
     * modified: doanhpv1 - cho phep set disc lam nhac cho cho nhom
     */
    public static function setTone($msisdn, $toneBoxID, $setType, $callerNumber, $loopType, $timeType, $startTime, $endTime, $resourceType = '1') {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1", // end-user
            'roleCode' => $msisdn,
            'toneBoxID' => $toneBoxID,
            'calledUserType' => "1", // normal subscriber
            'calledUserID' => $msisdn,
            'resourceType' => $resourceType, // personal RBT list
            'loopType' => $loopType, // in sequence
            'setType' => $setType,
            'callerNumber' => $callerNumber,
            'timeType' => $timeType,
            'startTime' => $startTime,
            'endTime' => $endTime, // The same format with startTime
        );
        $params = array('SetToneEvt' =>
            new soapval('SetToneEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('setTone', $params, '', '');

//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    if ($result['settingID'] > 0) {
                        return array(
                            'resultCode' => 0,
                            'settingID' => $result['settingID'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Chinh sua cau hinh nhom goi den
     * @author HoangL
     * @param $msisdn
     * @param $settingId
     * @param $setType
     * @param $callerNumber
     * @param $timeType
     * @param $startTime
     * @param $endTime
     * @return array
     */
    public static function editSetting($msisdn, $settingId, $setType, $callerNumber, $loopType, $timeType, $startTime, $endTime, $toneboxid, $resourceType = '1') {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1", // end-user
            'roleCode' => $msisdn,
            'settingID' => $settingId,
//            'calledUserType' => "1", // normal subscriber
            'calledUserID' => $msisdn,
            'loopType' => $loopType, // in sequence
            'setType' => $setType,
//            'callerNumber' => $callerNumber,
//            'toneBoxID' => $toneboxid,
            'timeType' => $timeType,
            'startTime' => $startTime,
            // When the value of timeType is 2, the time format:
            // HH:mm:ss
            // When the value of timeType is 3, 4, 5, or 6, the time format:
            // yyyy-MM-dd HH:mm:ss
            'endTime' => $endTime, // The same format with startTime
//            'resourceType' => $resourceType,
        );
//        var_dump($param);
        $params = array('EditSettingEvt' =>
            new soapval('EditSettingEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('editSetting', $params, '', '');
//         echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//         echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//         die;
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }

                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * sua thong tin box am nhac trong cai dat cuoc goi den
     * @author khanhnq16
     * @param type $msisdn
     * @param type $settingId
     * @param type $toneboxId
     * @return type
     */
    public static function editToneboxSetting($msisdn, $settingId, $toneboxId) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1", // end-user
            'roleCode' => $msisdn,
            'settingID' => $settingId,
            'calledUserID' => $msisdn,
            'resourceType' => '2',
            'toneBoxID' => $toneboxId
                // When the value of timeType is 2, the time format:
                // HH:mm:ss
                // When the value of timeType is 3, 4, 5, or 6, the time format:
                // yyyy-MM-dd HH:mm:ss
        );
        $params = array('EditSettingEvt' =>
            new soapval('EditSettingEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('editSetting', $params, '', '');

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }

                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Xoa cau hinh nhom goi den
     * @author HoangL
     * @param $msisdn
     * @param $settingId
     * @return array
     */
    public static function delSetting($msisdn, $settingId) {
        $i18n = sfContext::getInstance()->getI18N();
        $client = new nusoap_client(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => $i18n->__("Mất kết nối đến hệ thống CRBT")
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => CrbtPortalTypeEnum::Web,
            'role' => "1", // end-user
            'roleCode' => $msisdn,
            'calledUserID' => $msisdn,
            'calledUserType' => "1", // normal subscriber
            'settingID' => $settingId,
        );
        $params = array('DelSettingEvt' =>
            new soapval('DelSettingEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('delSetting', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => $i18n->__("Không thể thực hiện chức năng")
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => $i18n->__("Có lỗi khi thực hiện chức năng")
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Lay tat ca cac box nhac cho da cai dat
     * @author HoangL
     * @param $msisdn
     * @return array
     */
    public static function queryToneBox($msisdn) {
        $i18n = sfContext::getInstance()->getI18N();
        $client = new nusoap_client(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => $i18n->__("Mất kết nối đến hệ thống CRBT")
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_service_apppassword']),
            'portalType' => CrbtPortalTypeEnum::Web,
            'toneBoxType' => "1", //RBT list set by a subscriber
            'startRecordNum' => "1",
            'endRecordNum' => "1000",
            'queryType' => CrbtQueryTypeEnum::Data,
            'approveType' => "2", //approved RBT groups
            'ownertype' => "1", //subscriber
            'ownerid' => $msisdn
        );
        $params = array('QueryToneBoxEvt' =>
            new soapval('QueryToneBoxEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('queryToneBox', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => $i18n->__("Không thể thực hiện chức năng")
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => $i18n->__("Có lỗi khi thực hiện chức năng")
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService(\Yii::$app->user->identity->phonenumber) . '_success_code']) {
                    if (count($result['toneBoxInfos']) > 0) {
                        return array(
                            'resultCode' => 0,
                            'queryToneBoxInfos' => $result['toneBoxInfos'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Lay danh sach cac bai nhac cho thuoc box nhac cho
     * @author HoangL
     * @param $toneBoxId
     * @return array
     */
    public static function queryTbTone($phonenumber, $toneBoxId) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($phonenumber) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($phonenumber) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($phonenumber) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'type' => "1", //Subscribers set RBT groups
            'approveType' => "2", //RBT groups in the working table
            'toneBoxID' => $toneBoxId,
        );
        $params = array('QueryTbToneEvt' =>
            new soapval('QueryTbToneEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('queryTbTone', $params, '', '');
        //var_dump($result); die;
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;

        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($phonenumber) . '_success_code']) {
                    if (count($result['toneInfos']) > 0) {
                        return array(
                            'resultCode' => 0,
                            'queryToneInfos' => $result['toneInfos'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Them tao box nhac voi cac bai nhac cho co san
     * @author HoangL
     * @param $msisdn
     * @param $toneBoxName
     * @param $arrToneCode
     * @return array
     */
    public static function addToneBox($msisdn, $toneBoxName, $arrToneCode) {
//    die('2');
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }

        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1", // end-user
            'roleCode' => $msisdn,
            'objectRole' => '1',
            'objectCode' => $msisdn,
            'name' => $toneBoxName,
            'toneID' => $arrToneCode
        );
        $params = array('AddToneBoxEvt' =>
            new soapval('AddToneBoxEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('addToneBox', $params, '', '');
        // echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        // echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        // die;
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => " Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    if ($result['toneBoxID'] > 0) {
                        // var_dump($result); die;            
                        return array(
                            'resultCode' => 0,
                            'toneBoxID' => $result['toneBoxID'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /**
     * Cap nhat box nhac voi cac bai nhac cho co san
     * @author HoangL
     * @param $msisdn
     * @param $toneBoxName
     * @param $arrToneCode
     * @param $toneBoxId
     * @return array
     */
    public static function editToneBox($msisdn, $toneBoxName, $arrToneCode, $toneBoxId, $type = 1) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1", // end-user
            'roleCode' => $msisdn,
            'name' => $toneBoxName,
//      'toneID'      => $arrToneCode,
            'type' => "1", // RBT group set by a subscriber
            'toneBoxID' => $toneBoxId,
        );
        if ($type == 1) {
            $param['toneID'] = $arrToneCode;
        } else {
            $param['toneCode'] = $arrToneCode;
        }

        $params = array('EditToneBoxEvt' =>
            new soapval('EditToneBoxEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('editToneBox', $params, '', '');
//    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//    die;
//        var_dump($params);die;
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    return array(
                        'resultCode' => 0,
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

    /* -crbt-group-manage-end------------------------------------------------- */
    /* edit set tone after buy */

    /**
     * new order Tone
     * set tone by default after buy success
     * @author khanhnq16 
     * @param type $phone_no
     * @param type $tone_code
     * @return type
     * modified: doanhpv1 - cho phep order disc
     */
    public static function newOrderTone($phone_no, $tone_code, $resourceType = '1', $rbtId = '') {

        if ($tone_code == '') {
            return array(
                'resultCode' => 2,
                'crbtReturnCode' => 'N/A',
                'crbtDescription' => "Ringback tone has not been attached to video"
            );
        }

        $phone_no = self::remove084PhoneNumber($phone_no);
        $orderToneCode = self::batchOrderTone($phone_no, $tone_code, $resourceType);
        $orderReturnCode = new VtCrbtReturnCode($orderToneCode['crbtReturnCode']);

        if ($orderToneCode['resultCode'] == 0) {
            if ($orderReturnCode->isSuccess()) {
                if ($resourceType == '1') {
                    $addToneBoxResult = self::addRbtDefault($phone_no, $tone_code);
                } else {
                    $resultSettingQuery = self::querySetting($phone_no);
                    if ($resultSettingQuery['resultCode'] == 0) {
                        $settings = $resultSettingQuery['querySettingInfos'];
                        foreach ($settings as $setting) {
                            if ($setting['setType'] == '2') {
                                $isDefault = true;
                                break;
                            }
                        }
                    }
                    if ($isDefault) {
                        $addToneBoxResult = self::editSetting($phone_no, $setting['settingID'], $setting['setType'], $setting['callerNumber'], $setting['loopType'], $setting['timeType'], $setting['startTime'], $setting['endTime'], $rbtId, $resourceType); //TODO: dung edit setting
                    } else
                        $addToneBoxResult = self::setToneDefault($phone_no, $rbtId, '2');
                }
                $addToneBoxReturn = new VtCrbtReturnCode($addToneBoxResult['returnCode']);
                if (!$addToneBoxReturn->isSuccess()) {
                    return array(
                        'crbtReturnCode' => $orderReturnCode->getCode(),
                        'crbtDescription' => $orderReturnCode->getDescription()
                    );
                }


                return array(
                    'resultCode' => 0,
                    'crbtReturnCode' => $orderReturnCode->getCode(),
                    'crbtDescription' => $orderReturnCode->getDescription()
                );
            }
            return array(
                'resultCode' => 1,
                'crbtReturnCode' => $orderReturnCode->getCode(),
                'crbtDescription' => $orderReturnCode->getDescription()
            );
        }
        return array(
            'resultCode' => 2,
            'crbtReturnCode' => $orderReturnCode->getCode(),
            'crbtDescription' => $orderReturnCode->getDescription()
        );
    }

    public static function addToneBoxDefault($phone_no, $tone_code, $type = 1) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($phone_no) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err)
        //    return VtCrbtMessageHelper::CodeToMessage("COMMON_FAIL_UNKNOWN");
            return array(
                'resultCode' => 2
            );
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($phone_no) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($phone_no) . '_service_apppassword']),
            'portalType' => '1',
            'role' => '1',
            'roleCode' => $phone_no,
            'objectRole' => '1',
            'objectCode' => $phone_no,
            'name' => 'userToneBox',
//            'toneCode' => $tone_code
        );
        if ($type == 1) {
            $param['toneCode'] = $tone_code;
        } else {
            $param['toneID'] = $tone_code;
        }
        $params = array('AddToneBoxEvt' =>
            new soapval('AddToneBoxEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('addToneBox', $params, '', '');
        return $result;
    }

    /*
     * modified: doanhpv1 - cho phep set disc lam nhac cho mac dinh
     */

    public static function setToneDefault($phone_no, $tone_box_id, $resourceType = '1') {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($phone_no) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err)
        // return VtCrbtMessageHelper::CodeToMessage("COMMON_FAIL_UNKNOWN");
            return array(
                'resultCode' => 2
            );
        $client->setUseCurl('0');
        $client->useHTTPPersistentConnection();
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($phone_no) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($phone_no) . '_service_apppassword']),
            'portalType' => '1',
            'role' => '1',
            'roleCode' => $phone_no,
            'calledUserID' => $phone_no,
            'toneBoxID' => $tone_box_id,
            'resourceType' => $resourceType // doanhpv1 them vao de set disc default
        );
        $params = array('SetToneEvt' =>
            new soapval('SetToneEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('setTone', $params, '', '');
        return $result;
    }

    /**
     * modified: doanhpv1 - them cac truong hop lien quan toi disc
     */
    public static function addRbtDefault($phonenumber, $rbtCode) {

        //khanhnq16 - them nhac cho mac dinh cho thue bao
        $isDefault = false;
        $resultSettingQuery = self::querySetting($phonenumber);
        if ($resultSettingQuery['resultCode'] == 0) {
            $settings = $resultSettingQuery['querySettingInfos'];
            foreach ($settings as $setting) {
                if ($setting['setType'] == '2') {
                    $isDefault = true;
                    break;
                }
            }
        }
//        var_dump($isDefault);
//        die("den day roi");
        if ($isDefault) {
            // doanhpv1 edit, cho phep set nhac cho mac dinh la 1 danh sach bai hat, hoac 1 bai, 1 disc
            if ($setting['resourceType'] == "1") {// Neu nhac cho mac dinh hien tai la songs, them bai hat nay vao danh sach do
                $resultToneSetting = self::queryTbTone($phonenumber, $setting['toneBoxID']);
                $arrayTones = $resultToneSetting['queryToneInfos'];
                $arrayToneIds = array();
                foreach ($arrayTones as $tones) {
                    $arrayToneIds[] = $tones['toneCode'];
                }
                $arrayToneIds[] = $rbtCode;
                $editSettingTone = self::editToneBox($phonenumber, 'default', $arrayToneIds, $setting['toneBoxID'], 2);
                if ($editSettingTone['resultCode'] == 0) {
                    return array(
                        'errorCode' => '2',
                        'message' => 'Cài đặt mặc định chưa thành công!'
                    );
                } else {
                    return array(
                        'errorCode' => '2',
                        'message' => $editSettingTone['message']
                    );
                }
            } else {
                // Neu nhac cho mac dinh hien tai la disc, set bai hat nay lam nhac cho mac dinh
                $arrayToneIds = array();
                $arrayToneIds[] = $rbtCode;
                $editSettingTone = self::addToneBoxDefault($phonenumber, $arrayToneIds);
                if ($editSettingTone['resultCode'] == 0) {
                    $setDefaultTone = self::editSetting($phonenumber, $setting['settingID'], $setting['setType'], $setting['callerNumber'], $setting['loopType'], $setting['timeType'], $setting['startTime'], $setting['endTime'], $editSettingTone['toneBoxID'], "1"); //TODO: dung edit setting
                    if ($setDefaultTone['crbtReturnCode'] != 0) {
                        return array(
                            'errorCode' => '2',
                            'message' => 'Cài đặt mặc định chưa thành công!'
                        );
                    }
                } else {
                    return array(
                        'errorCode' => '2',
                        'message' => $editSettingTone['message']
                    );
                }
            }
        } else {
            // Neu chua co box nhac mac dinh thi tao 1 box nhac roi set mac dinh
//            $resultToneSetting = self::getUserTones($phonenumber);
//            if ($resultToneSetting['resultCode'] == 0) {
            $arrayToneIds = array();
            $arrayToneIds[] = $rbtCode;
            $editSettingTone = self::addToneBoxDefault($phonenumber, $arrayToneIds);
            if ($editSettingTone['resultCode'] == 0) {
                $setDefaultTone = self::setToneDefault($phonenumber, $editSettingTone['toneBoxID']);
//                  $setDefaultTone = self::editSetting($phonenumber,$setting['settingID'],$setting['setType'],$setting['callerNumber'],$setting['loopType'],$setting['timeType'],$setting['startTime'],$setting['endTime'],$editSettingTone['toneBoxID'],"1");//TODO: dung edit setting
                if ($setDefaultTone['crbtReturnCode'] != 0) {
                    return array(
                        'errorCode' => '2',
                        'message' => ''
                    );
                }
            } else {
                return array(
                    'errorCode' => '2',
                    'message' => $editSettingTone['message']
                );
            }
//            }
//            else
//                return array(
//                    'errorCode' => '2',
//                    'message' => 'Không có nhóm mặc định'
//                );
        }
        return array(
            'errorCode' => '0',
            'message' => 'success'
        );
    }

    public static function setToneBox($msisdn, $toneBoxID, $callerNumber) {
        $client = new nusoap_client(\Yii::$app->params[self::routeService($msisdn) . '_usertonemanage'], false, '', '', '', '');
        $err = $client->getError();
        if ($err) {
            return array(
                'resultCode' => 2,
                'message' => "Mất kết nối đến hệ thống CRBT"
            );
        }
        $client->setUseCurl('0');
        $client->soap_defencoding = 'UTF-8';
        $client->decodeUTF8(false);
        $client->useHTTPPersistentConnection();
        $msisdn = self::remove084PhoneNumber($msisdn);
        $param = array(
            'portalAccount' => \Yii::$app->params[self::routeService($msisdn) . '_service_appcode'],
            'portalPwd' => base64_decode(\Yii::$app->params[self::routeService($msisdn) . '_service_apppassword']),
            'portalType' => PORTAL_TYPE,
            'role' => "1", // end-user
            'roleCode' => $msisdn,
            'toneBoxID' => $toneBoxID,
            'calledUserType' => "1", // normal subscriber
            'calledUserID' => $msisdn,
            'resourceType' => "2", // personal RBT list
            'setType' => "3",
            'callerNumber' => $callerNumber
        );
        $params = array('SetToneEvt' =>
            new soapval('SetToneEvt', NULL, $param, false, 'http://usertonemanage.ivas.huawei.com')
        );
        $result = $client->call('setTone', $params, '', '');
        if ($client->fault) {
            return array(
                'resultCode' => 2,
                'message' => "Không thể thực hiện chức năng"
            );
        } else {
            $err = $client->getError();
            if ($err) {
                return array(
                    'resultCode' => 1,
                    'message' => "Có lỗi khi thực hiện chức năng"
                );
            } else {
                $vtCrbtReturnCode = new VtCrbtReturnCode($result['returnCode']);
                if ($result['returnCode'] == \Yii::$app->params[self::routeService($msisdn) . '_success_code']) {
                    if ($result['settingID'] > 0) {
                        return array(
                            'resultCode' => 0,
                            'settingID' => $result['settingID'],
                            'message' => $vtCrbtReturnCode->getDescription()
                        );
                    }
                    return array(
                        'resultCode' => 1,
                        'returnCode' => $result['returnCode'],
                        'message' => $vtCrbtReturnCode->getDescription()
                    );
                }
                return array(
                    'resultCode' => 3,
                    'returnCode' => $result['returnCode'],
                    'message' => $vtCrbtReturnCode->getDescription()
                );
            }
        }
    }

}
