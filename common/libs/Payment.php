<?php

/*
 * Created by KhanhNQ16@viettel.com.vn
 * Alright reserve by Viettel Group 
 */

namespace common\libs;

use yii\base\Exception;

/**
 * Description of Payment
 *
 * @author khanhnq16
 */
class Payment {
    /**
     *
     * @var SoapClient
     */

    public static function charge($msisdn, $objectType, $objectId, $fee = 0, $cpCode = "VT") {
        $wsdl = \Yii::$app->params['payment_wsdl'];

        $connectTimeout = \Yii::$app->params['payment_timeout'];
        $responseTimeout = \Yii::$app->params['payment_timeout'];
        $username = \Yii::$app->params['payment_username'];
        $password = \Yii::$app->params['payment_password'];
        try {
            $client = new ImuzikSoapClient($wsdl, array('connect_timeout' => $connectTimeout, 'timeout' => $responseTimeout,'trace'=>1));
        } catch (Exception $e) {
            \Yii::info(" connect error: ".$e->getMessage(),'charge');
            return false;
        }
        
        $args = array('req' =>
            array(
                'cmd' => \Yii::$app->params['payment_cmd'],
                'msisdn' => $msisdn,
                'param' => $objectType."|".$objectId."|".$fee."|".$cpCode,
                'password' => $password,
                'transId' => strtotime('now'),
                'userName' => $username,
            ));
        
        $result = false;
        try {
            $result = $client->__soapCall('callws', array($args));
            $errorCode = $result->return->errorCode;
            $errorMessage = $result->return->desc;
        } catch (Exception $e) {
            $errorCode = -1;
            $errorMessage = $e->getMessage();
        }
        \Yii::info("request: \n".$client->__getLastRequest()."  response: ".$client->__getLastResponse(),'charge');
        return $result;
    }

    public function getErrorMessage() {

        return $this->errorMessage;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
    
    

}
