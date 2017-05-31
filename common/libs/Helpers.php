<?php

namespace common\libs;

/**
 * Created by PhpStorm.
 * User: khanhnq16
 * Date: 17-Oct-15
 * Time: 2:54 PM
 */
class Helpers {

    private static $hasSign = array(
        "à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
        "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
        "ì", "í", "ị", "ỉ", "ĩ",
        "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
        "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
        "ỳ", "ý", "ỵ", "ỷ", "ỹ",
        "đ",
        "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
        "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
        "Ì", "Í", "Ị", "Ỉ", "Ĩ",
        "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
        "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
        "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
        "Đ",
    );
    private static $noSign = array(
        "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "i", "i", "i", "i", "i",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "y", "y", "y", "y", "y",
        "d",
        "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "i", "i", "i", "i", "i",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "y", "y", "y", "y", "y",
        "d");
    private static $noSignOnly = array(
        "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "i", "i", "i", "i", "i",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "y", "y", "y", "y", "y",
        "d",
        "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
        "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
        "I", "I", "I", "I", "I",
        "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
        "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
        "Y", "Y", "Y", "Y", "Y",
        "D");

    public static function createTokenCsrf() {
        echo $_SERVER['SERVER_NAME'];
        die();
//        $domain = $_SERVER['SERVER_NAME'];
        $domain = \Yii::$app->params['server_name'];
        $cookies = \Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'sToken',
            'value' => uniqid(rand(), true),
            'domain' => $domain
        ]));

//        \Yii::$app->response->setCookie('sToken', uniqid(rand(), true), NULL, "/", $domain
//            sfConfig::get("app_main_domain", "localhost")
    }

    public static function checkHomePhone($msisdn) {
        $msisdn = self::convertMsisdn($msisdn);
        if (in_array(substr($msisdn, 0, 3), \Yii::$app->params['viettel_home_phone'])) {
            return true;
        }
        return false;
    }

    public static function checkHighschool($msisdn) {
        try {
            $urlWS = \Yii::$app->params['bccs']['wsdl'];
            $user = \Yii::$app->params['bccs']['user'];
            $pass = \Yii::$app->params['bccs']['pass'];
            $infoCode = \Yii::$app->params['bccs']['infoCode'];

            $soap_request = "<?xml version=\"1.0\"?>\n";
            $soap_request .= '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sale.bccs.viettel.com/">
                            <soapenv:Header>
                             <wsse:Security soapenv:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
                                  <wsse:UsernameToken wsu:Id="UsernameToken-32ce50e8-4a5d-4040-af71-c3428d92daa7">
                                         <!--Optional: Giải thích tham số wsse:Username : User name gọi ESB-->
                                     <wsse:Username>' . $user . '</wsse:Username>
                                         <!--Optional:Pass gọi ESB-->
                                     <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">' . $pass . '</wsse:Password>
                                  </wsse:UsernameToken>
                               </wsse:Security>
                            </soapenv:Header>

                            <soapenv:Body>
                               <ser:getBccsInfo>
                                  <!--Optional:-->
                                  <infoCode>' . $infoCode . '</infoCode>
                                  <!--Optional:-->
                                  <paramList>' . $msisdn . '</paramList>
                                  <!--Optional:-->
                                  <wsUsername>' . $user . '</wsUsername>
                                  <!--Optional:-->
                                  <wsPassword>' . $pass . '</wsPassword>
                               </ser:getBccsInfo>
                            </soapenv:Body>
                         </soapenv:Envelope>';

            $soap_do = curl_init();
            curl_setopt($soap_do, CURLOPT_URL, $urlWS);
            curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($soap_do, CURLOPT_TIMEOUT, 30);
            curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($soap_do, CURLOPT_POST, true);
            curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
            curl_setopt($soap_do, CURLOPT_HTTPHEADER, 0);

            $result = curl_exec($soap_do);

            if ($result) {
                $str = explode('PRODUCT_CODE>', $result);
                $code = trim(trim($str[1], '</'), '&lt;');
                return in_array($code, \Yii::$app->params['product_code']['highschool']);
            }
        } catch (\mongosoft\soapclient\Exception $ex) {
            Yii::error($ex->getMessage());
        }
        return false;
    }

    /**
     * KhanhNQ16 - 17/10/2015
     * @param $msisdn
     */
    public static function convertMsisdn($msisdn, $type = 'simple') {
//        Trungth 22/06/2016: trim trước khi convert
        $msisdn = trim($msisdn);
        if ($msisdn != "") {
            switch ($type) {
                case 'simple':
                    if ($msisdn[0] == '0') {
                        while ($msisdn[0] == '0') {
                            $msisdn = substr($msisdn, 1);
                        }
                        return $msisdn;
                    } else if ($msisdn[0] . $msisdn[1] == '84')
                        return substr($msisdn, 2);
                    else
                        return $msisdn;
                    break;
                case '84':
                    if ($msisdn[0] == '0') {
                        while ($msisdn[0] == '0') {
                            $msisdn = substr($msisdn, 1);
                        }
                        return '84' . $msisdn;
                    } else if ($msisdn[0] . $msisdn[1] != '84')
                        return '84' . $msisdn;
                    else
                        return $msisdn;
                    break;

                default:
                    if ($msisdn[0] == '0') {
                        while ($msisdn[0] == '0') {
                            $msisdn = substr($msisdn, 1);
                        }
                        return '84' . $msisdn;
                    } else if ($msisdn[0] . $msisdn[1] != '84')
                        return '84' . $msisdn;
                    else
                        return $msisdn;
                    break;
            }
        }
    }

    /**
     * KhanhNQ16
     * @param $str
     * @return string
     */
    public static function removeSign($str) {
        //Sign
        $str = str_replace(self::$hasSign, self::$noSign, $str);
        //Special string
        $spcStr = "/[^A-Za-z0-9]+/";
        $str = preg_replace($spcStr, ' ', $str);
        $str = trim($str);
        //Space
        $str = preg_replace("/( )+/", '-', $str);
        return strtolower($str);
    }

    public static function removeSignAndSpace($str) {
        //Sign
        $str = str_replace(self::$hasSign, self::$noSign, $str);
        //Special string
        $spcStr = "/[^A-Za-z0-9]+/";
        $str = preg_replace($spcStr, ' ', $str);
        $str = trim($str);
        //Space
        $str = preg_replace("/( )+/", '-', $str);
        return strtolower($str);
    }

    public static function name2slug($str) {
        //Sign
        $str = str_replace(self::$hasSign, self::$noSign, $str);
        //Special string
        $spcStr = "/[^A-Za-z0-9]+/";
        $str = preg_replace($spcStr, ' ', $str);
        $str = trim($str);
        //Space
        $str = preg_replace("/( )+/", '-', $str);
        return strtolower($str);
    }

    public static function removeSignAndSpecialChars($str) {
        //Sign
        $str = str_replace(self::$hasSign, self::$noSign, $str);
        $needEscape = array('\\', '+', '-', '&&', '||', '!', '(', ')', '{', '}', '[', ']', '^', '"', '~', '*', '?', ':', '/');
        $escaped = array('\\\\', '\+', '\-', '\&&', '\||', '\!', '\(', '\)', '\{', '\}', '\[', '\]', '\^', '\"', '\~', '\*', '\?', '\:', '\/');
        $str = str_replace($needEscape, $escaped, $str);
        return strtolower($str);
    }

}
