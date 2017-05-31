<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\libs;

/**
 * Description of MobileRecognized
 *
 * @author nghiald
 */
use Yii;
use common\libs\ImuzikSoapClient;

class MobileRecognized {

    /**
     *  Get Remote IP client
     * @return type
     * @created_at: 8/21/14 11:09 AM
     */
    public static function getRemoteIp() {
//        $ip = '--unknow--';
//        if (isset($_SERVER['REMOTE_ADDR']) 
//                && $_SERVER['REMOTE_ADDR'] != "10.58.50.125" 
//                && $_SERVER['REMOTE_ADDR'] != "127.0.0.1") {
//            $ip = $_SERVER['REMOTE_ADDR'];
//        Yii::info('recognized IP: REMOTE_ADDR: '.$ip);
//        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//            Yii::info('recognized IP: HTTP_X_FORWARDED_FOR: '.$ip);
//        }
//        return $ip;
//        return $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * xet xem ip có thuoc dải private ko
     * @param <type> $ip
     */
    public static function inPriateIpRange($ip) {
        $ip = ip2long($ip);
        //        echo ip2long('10.0.0.0') . "\n";
        //        echo ip2long('10.255.255.255') . "\n";
        //        echo ip2long('172.16.0.0') . "\n";
        //        echo ip2long('172.31.255.255') . "\n";
        //        echo ip2long('127.0.0.0') . "\n";
        //        echo ip2long('127.0.0.255') . "\n";
        //        echo ip2long('192.168.0.0') . "\n";
        //        echo ip2long('192.168.255.255') . "\n";
        return ($ip >= 167772160 && $ip <= 184549375) ||
                ($ip >= -1408237568 && $ip <= -1407188993) ||
                ($ip >= -1062731776 && $ip <= -1062666241) ||
                ($ip >= 2130706432 && $ip <= 2130706687);
    }

    /**
     * xet xem ip co thuoc tu ipmin den ipmax ko
     * @param <type> $ip
     * @param <type> $ipmin
     * @param <type> $ipmax
     * @return <type>
     */
    public static function ipInRange($ip, $ipmin, $ipmax) {
        $ip = sprintf('%u', ip2long($ip));
        $ipmin = sprintf('%u', ip2long($ipmin));
        $ipmax = sprintf('%u', ip2long($ipmax));

        return $ip >= $ipmin && $ip <= $ipmax;
    }

    /**
     * check ip co thuoc 1 dai mang hay khong. 192.168.133.31 co thuoc 192.168.133.0/24 ko?
     * @param type $IP
     * @param type $CIDR
     * @return type
     */
    public static function ipCIDRCheck($IP, $CIDR) {
        list ($net, $mask) = explode("/", $CIDR);

        $ip_net = ip2long($net);
        $ip_mask = ~((1 << (32 - $mask)) - 1);

        $ip_ip = ip2long($IP);

        $ip_ip_net = $ip_ip & $ip_mask;

        return ($ip_ip_net == $ip_net);
    }

    // The last octect of the IP address is removed to anonymize the user.
    private static function _GAGetIP($remoteAddress) {
        if (empty($remoteAddress)) {
            return "";
        }
        // Capture the first three octects of the IP address and replace the forth
        // with 0, e.g. 124.455.3.123 becomes 124.455.3.0
        $regex = "/^([^.]+\.[^.]+\.[^.]+\.).*/";
        if (preg_match($regex, $remoteAddress, $matches)) {
            return $matches[1] . "0";
        } else {
            return "";
        }
    }

    /**
     * todo: fixit
     * @param <type> $msisdn
     * @return <type>
     */
    public static final function convertMsisdn($msisdn) {
        $msisdn = trim($msisdn);
//        $start = substr($msisdn, 0, 1);
//        if (empty($msisdn))
//            return null;
//        if ($start == '0') {
//            $msisdn = '84' . substr($msisdn, 1);
//        } elseif (in_array($start, array('1', '9'))) {
//            $msisdn = '84' . $msisdn;
//        }
//
//        return $msisdn;

        if ($msisdn[0] == '0')
            return '84' . substr($msisdn, 1);
        else if ($msisdn[0] . $msisdn[1] != '84')
            return '84' . $msisdn;
        else
            return $msisdn;
    }

    public static function getMsisdnFromAgent() {
        $ipaddr = MobileRecognized::getRemoteIp();
        Yii::info("msisdn from ip: " . $ipaddr);
        $ippools = Yii::$app->params['ip_pools'];
        foreach ($ippools as $ipcidr) {
            if ($ipcidr && MobileRecognized::ipCIDRCheck($ipaddr, $ipcidr)) {
                $pass = true;
                break;
            }
        }
        $msisdn = "";
        if ($pass) {
            $msisdn = MobileRecognized::callRadius($ipaddr);
        }
        Yii::info("IP client: $ipaddr" . " ipcidr: $ipcidr" . " msisdn: $msisdn", "mobile");
        return $msisdn;
    }

    /**
     * Kiem tra thue bao co phai thue bao dcom khong
     * @param type $msisdn
     * @return string
     * @author linhnt43
     * @created_at: 11/17/14 9:27 AM
     */
    public static function checkDcom($msisdn) {
        return false;
//        try {
//            $wsdlConfig = sfConfig::get("app_dcom_wsdl");
//            $msisdn = VtHelper::getMobileNumber($msisdn, VtHelper::MOBILE_GLOBAL);
//            $params = array(
//                'userName' => $wsdlConfig['username'],
//                'password' => $wsdlConfig['password'],
//                'msisdn' => $msisdn,
//            );
//            $method = "CheckDCOM";
//            $soapUtils = new SoapUtils($wsdlConfig['wsdl'], $params, $method);
//            $result = $soapUtils->callService();
//            if ($result->errorCode == 0) {
//                if(strtolower(trim($result->type)) == 'dcom'){
//                    return true;
//                } else {
//                    return false;
//                }
//            } else {
//                return array('code' => $result->errorCode, 'message' => "Hệ thống đang bận, vui lòng thử lại sau");
//            }
//        } catch (CallSoapErrorException $exc) {
//            //thuc hien ghi log
//            return array('code' => $exc->getCode(), 'message' => "Hệ thống đang bận, vui lòng thử lại sau");
//        }
    }

    /**
     * Kiem tra thong tin client
     * @param type $ipaddr - ip client
     * @return string
     * @author NghiaLD <nghiald@viettel.com>
     * @created_at: 8/21/14 1:27 PM
     */
    public static function callRadius($ipaddr) {
        try {
            $radiusConfig = Yii::$app->params['radius'];
            $wsdl = $radiusConfig['wsdl'];
            $params = array();
            $options = array();
            $method = $radiusConfig['method'];
            $options['connect_timeout'] = $radiusConfig['connect_timeout'];
            $options['timeout'] = $radiusConfig['timeout'];
            $options['cache_wsdl'] = WSDL_CACHE_NONE;
            $options['trace'] = 1;
            $params['username'] = $radiusConfig['username'];
            $params['password'] = $radiusConfig['password'];
            $params['ip'] = $ipaddr;
            $soapClient = new ImuzikSoapClient($wsdl, $options);
            if (!$soapClient) {
                return '';
            }
            $response = $soapClient->__soapCall($method, array($params));
            $stdClass = $response->return;
            Yii::info('request: : ' . $soapClient->__getLastRequest(), "mobile");
            Yii::info('response: : ' . $soapClient->__getLastResponse(), "mobile");
//            if($ipaddr == '171.255.26.210' || $ipaddr == '171.253.30.206' || $ipaddr == '100.69.238.120'){
//                var_dump($stdClass);die;
//            }
            if ($stdClass->code == 1)
                return '';
            if ($stdClass->code == 0) {
                return RemoveSign::convertMsisdn($stdClass->desc);
            }
        } catch (Exception $ex) {
            return '';
        }
    }

    /**
     * Nhận diện loại số điện thoại
     * @param type $msisdn
     * @author NghiaLD <nghiald@viettel.com>
     * @created_at: 8/21/14 2:48 PM
     */
    public static function callMobileRecognized($msisdn) {
        try {
            $mobileRecognizedCfg = sfConfig::get("app_mobile_recognize", array());
            $wsdl = $mobileRecognizedCfg['wsdl'];
            $method = $mobileRecognizedCfg['method'];
            $params = array();
            $params['username'] = $mobileRecognizedCfg['username'];
            $params['password'] = $mobileRecognizedCfg['password'];
            $params['msisdn'] = $msisdn;
            $soapClient = new SoapUtils($wsdl, $params, $method);

            $response = $soapClient->callService();
            $stdClass = $response->return;
//            sfContext::getInstance()->getLogger()->info("Mobile recognized: errorCode=" . $stdClass->errorCode . "&description=" . $stdClass->description);
            if ($stdClass->errorCode == '0000')
                return $stdClass;
            else {
                return null;
            }
        } catch (Exception $ex) {
//            sfContext::getInstance()->getLogger()->debug("Mobile recognized: call Mobile recognized with [msidn=" . $msisdn . "] failed," . var_export($ex, true));
            return null;
        };
    }

    /**
     * KhanhNQ16
     * @return type
     */
    public static function getMsisdnFromHeader() {
        if (isset($_SERVER['HTTP_MSISDN'])) {
            return $_SERVER['HTTP_MSISDN'];
        } else
            return "";
    }

    public static function getMsisdn() {
        return self::getMsisdnFromAgent(); //TODO: remove khi chạy thật
        $msisdn1 = self::getMsisdnFromHeader();
        $msisdn2 = self::getMsisdnFromAgent();
        Yii::info('getMsisdnFromHeader: ' . $msisdn1, "mobile");
        Yii::info('getMsisdnFromAgent: ' . $msisdn2, "mobile");
        if (!$msisdn1 || !$msisdn2) {
            return "";
        }
        if ($msisdn1 && $msisdn2 && MobileRecognized::convertMsisdn($msisdn1) == MobileRecognized::convertMsisdn($msisdn2)) {
            Yii::info('[vaaa] success header =' . $msisdn1 . '; vaaa =' . $msisdn2, "mobile");
            return $msisdn2;
        }
        Yii::info('[vaaa] fail header =' . $msisdn1 . '; vaaa =' . $msisdn2, "mobile");
        return "";
    }

}

?>
