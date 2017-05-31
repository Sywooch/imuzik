<?php

/*
 * Created by KhanhNQ16@viettel.com.vn
 * Alright reserve by Viettel Group 
 */

namespace common\libs;

use Yii;
use yii\web\Request;
use yii\web\NotAcceptableHttpException;

/**
 * Description of WapRequest
 *
 * @author khanhnq16
 */
class WapRequest extends Request
{

    //put your code here
    private $_csrfToken;

    public function getCsrfToken()
    {
        if ($this->_csrfToken === null) {
            $csrfToken = Yii::$app->session->get($this->csrfParam);
            if ($csrfToken === null) {
                $csrfToken = self::generateCsrfToken();
            }
            $this->_csrfToken = $csrfToken;
        }

        return $this->_csrfToken;
    }

    public function validateCsrfToken($token)
    {
        $method = $this->getMethod();
        $session = Yii::$app->session;
        $valid = false;
        // only validate POST requests
        if ($method == "POST") {
            if (!$token) {
//                $token = self::getCsrfTokenFromHeader();
                if ($this->getBodyParam($this->csrfParam)) {
                    $token = $this->getBodyParam($this->csrfParam);
                } else if ($this->getCsrfTokenFromHeader()) {
                    $token = $this->getBodyParam($this->csrfParam);
                } else {
                    $token = '';
                }
            };
            if ($session->has($this->csrfParam) && $token) {
                $tokenFromSession = $session->get($this->csrfParam);
                $valid = $tokenFromSession === $token;
            } else
                $valid = false;
            if(!$this->isAjax){
                self::generateCsrfToken(); //refresh token                
            }
        } else {
            if (!$this->enableCsrfValidation || in_array($method, ['GET', 'HEAD', 'OPTIONS'], true)) {
                $valid = true;
            }
        }
        if (!$valid)
            throw new NotAcceptableHttpException;
        return $valid;
    }

    public function generateCsrfToken()
    {
        $csrfToken = sha1(uniqid(mt_rand(), true));
        Yii::$app->session->set($this->csrfParam, $csrfToken);
        return $csrfToken;
    }

}
