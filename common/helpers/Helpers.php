<?php

namespace common\helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * author: Toanhv9
 */

use common\libs\RemoveSign;
use common\libs\Search;
use Exception;
use Yii;
use yii\db\Exception as Exception2;
use yii\helpers\HtmlPurifier;
use yii\imagine\Image;
use yii\web\UploadedFile;

class Helpers {

    public static function generateStructurePath() {
        $uniqueFileName = uniqid();
        $mash = 255;
        $hashCode = crc32($uniqueFileName);
        $firstDir = $hashCode & $mash;
        $firstDir = vsprintf("%02x", $firstDir);
        $secondDir = ($hashCode >> 8) & $mash;
        $secondDir = vsprintf("%02x", $secondDir);
        $thirdDir = ($hashCode >> 4) & $mash;
        $thirdDir = vsprintf("%02x", $thirdDir);
        return $firstDir . "/" . $secondDir . "/" . $thirdDir . '/' . uniqid();
    }

    public static function removeJstag($str) {

        $stripArr = array(
            'script', 'onblur', 'onchange', 'alert', 'onclick', 'ondblclick', 'onfocus', 'onmousedown', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onkeydown', 'onkeypress', 'onkeyup', 'onselect', 'object', 'embed'
        );
        foreach ($stripArr as $tag) {
            $str = str_replace($tag, '', $str);
            $tag = strtoupper($tag);
            $str = str_replace($tag, '', $str);
        }
        return $str;
    }

    public static function getOnlyMediaImage($path) {
        return Yii::$app->params['media_path'] . $path;
    }

    public static function safeInput($input) {
        if (!is_array($input)) {
            $p = new HtmlPurifier();
            if (preg_match('/^[0-9]*$/', $input)) {
                return intval($input);
            } else {
                return $p->process($input);
            }
        } else {
            foreach ($input as &$item) {
                $item = Helpers::safeInput($item);
            }
        }
        return $input;
    }

    /**
     * KhanhNQ16
     * @param $tonename
     * @param $tonesingername
     */
    public static function getListRBT($tonename, $tonesingername, $limit) {
        try {
            $result = array();
            $queryName = strtolower(RemoveSign::removeSign($tonename . " " . $tonesingername));
            $lenName = strtolower(RemoveSign::removeSignAndSpace($tonename . $tonesingername));

            $listRbt1 = Search::searchDismax($queryName . ' ' . $lenName, $limit); //tim chuoi dua len + chuoi remove space

            $array = array();
            if ($listRbt1['full_items']) {//neu co ket qua
                foreach ($listRbt1['full_items'] as $rbt1) {
                    array_push($array, array(
                        'huawei_tone_id' => $rbt1->huawei_tone_id,
                        'huawei_tone_code' => $rbt1->huawei_tone_code,
                        'huawei_tone_name' => $rbt1->huawei_tone_name,
                        'huawei_singer_name' => $rbt1->huawei_singer_name,
                        'huawei_order_times' => $rbt1->huawei_order_times,
                        'huawei_price' => $rbt1->huawei_price,
                        'score' => $rbt1->score,
                        'vt_link' => $rbt1->vt_link,
                    ));
                }
            }
            usort($array, function ($a, $b) {
                return $b['score'] - $a['score'];
            });
            $return = array_slice($array, 0, $limit);

            $result['errorCode'] = 0;
            //sap xep lai theo luot tai
            usort($return, function ($a, $b) {
                return $b['huawei_order_times'] - $a['huawei_order_times'];
            });
            //check xem trong 3 ket qua co cai nao phu hop

            return $return;
        } catch (Exception $e) {
            return false;
        }
    }

    /*
     * KhanhNQ16
     */

    public static function textCompare($t1, $t2) {
        similar_text($t1, $t2, $per);
        return $per;
    }

    /**
     * KhanhNQ16
     * @param $phoneNumber
     * @return bool
     */
    public static function checkViettelPhoneNumber($phoneNumber) {
        $phoneNumber = trim($phoneNumber);
        if (substr($phoneNumber, 0, 1) == '+') {
            $phoneNumber = substr($phoneNumber, 1);
        }
        if (preg_match(\Yii::$app->params['viettel_phone_expression'], $phoneNumber)) {
            return true;
        }
        return false;
    }

    /**
     * Kiem tra moi gia tri mang $childArray co thuoc mang $parentArray ko?
     * @param $childArray
     * @param $parentArray
     * @return bool
     */
    public static function checkChildArray($childArray, $parentArray) {
        foreach ($childArray as $child) {
            if (!in_array($child, $parentArray)) {
                return false;
            }
        }
        return true;
    }

    public static function moneyFormat($money, $delimiter = '.') {
        $return = '';
        $len = strlen($money);
        while ($len > 3) {
            if ($return == '') {
                $return = substr($money, $len - 3);
            } else {
                $return = substr($money, $len - 3) . $delimiter . $return;
            }
            $money = substr($money, 0, $len - 3);
            $len = strlen($money);
        }
        return $money . $delimiter . $return;
    }

    public static function getFirstWordSingerByAlias($alias) {
        $alias = trim($alias);
        $alias = trim($alias, '"');
        $alias = trim($alias, "'");
        if ($alias) {
            $first = substr(static::vi2en($alias), 0, 1);
            if (preg_match('/[A-Za-z]/', $first)) {
                return strtoupper($first);
            }
        }
        return '#';
    }

    public static function vi2en($str) {
        return str_replace(RemoveSign::$hasSign, RemoveSign::$noSignOnly, $str);
    }

    public static function getArrayColumn($array, $column_name) {
        if (!function_exists("array_column")) {
            return array_map(function ($element) use ($column_name) {
                return $element[$column_name];
            }, $array);
        }
        return array_column($array, $column_name);
    }

    public static function getPriceInfoSub($subId, $price) {
        $name = 'đ';
        switch ($subId) {
            case SUB_DAILY:
                $name = 'đ/ngày';
                break;
            case SUB_WEEKLY:
                $name = 'đ/tuần';
                break;
            case SUB_MONTHLY:
                $name = 'đ/tháng';
                break;
        }
        return Helpers::moneyFormat($price) . $name;
    }

    public static function imagePath($path, $type = "album") {
        try {
            if (strlen($path) == 0) {
                return Yii::$app->params[$type . '_default_media_path'];
            } else {
                $filename = Yii::$app->params['upload_path'] . $path;
                if (\is_file($filename)) {
                    return Yii::$app->params['media_path'] . $path;
                } else {
                    return Yii::$app->params[$type . '_default_media_path'];
                }
            }
        } catch (Exception2 $e) {
            return Yii::$app->params[$type . '_default_media_path'];
        }
    }

    /**
     * Upload file
     * @return mixed the uploaded image instance
     */
    public function uploadFile($fileName, $fileNameType, $filePath, $fileField) {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $file = UploadedFile::getInstance($this, $fileField);

        // if no file was uploaded abort the upload
        if (empty($file)) {
            return false;
        } else {
            // set fileName by fileNameType
            switch ($fileNameType) {
                case "original":
                    // get original file name
                    $name = $file->name;
                    break;
                case "casual":
                    // generate a unique file name
                    $name = Yii::$app->security->generateRandomString();
                    break;
                default:
                    // get item title like filename
                    $name = $fileName;
                    break;
            }
            // file extension
            $fileExt = end((explode(".", $file->name)));
            // purge filename
            $fileName = $this->generateFileName($name);
            // set field to filename.extensions
            $this->$fileField = $fileName . ".{$fileExt}";
            // update file->name
            $file->name = $fileName . ".{$fileExt}";
            // save images to imagePath
            $file->saveAs($filePath . $fileName . ".{$fileExt}");

            // the uploaded file instance
            return $file;
        }
    }

    /**
     * createThumbImages files
     * @return mixed the uploaded image instance
     */
    public function createThumbImages($image, $imagePath, $imgOptions, $thumbPath) {
        $imageName = $image->name;
        $imageLink = $imagePath . $image->name;

        // Save Image Thumbs
        Image::thumbnail($imageLink, $imgOptions['small']['width'], $imgOptions['small']['height'])
                ->save($thumbPath . "small/" . $imageName, ['quality' => $imgOptions['small']['quality']]);
        Image::thumbnail($imageLink, $imgOptions['medium']['width'], $imgOptions['medium']['height'])
                ->save($thumbPath . "medium/" . $imageName, ['quality' => $imgOptions['medium']['quality']]);
        Image::thumbnail($imageLink, $imgOptions['large']['width'], $imgOptions['large']['height'])
                ->save($thumbPath . "large/" . $imageName, ['quality' => $imgOptions['large']['quality']]);
        Image::thumbnail($imageLink, $imgOptions['extra']['width'], $imgOptions['extra']['height'])
                ->save($thumbPath . "extra/" . $imageName, ['quality' => $imgOptions['extra']['quality']]);
    }

    /**
     * Generate fileName
     * @return string fileName
     */
    public function generateFileName($name) {
        // remove any duplicate whitespace, and ensure all characters are alphanumeric
        $str = preg_replace(array('/\s+/', '/[^A-Za-z0-9\-]/'), array('-', ''), $name);
        // lowercase and trim
        $str = trim(strtolower($str));

        return $str;
    }

    public static function AntiSQLInjection($cautruyvan) {
        $cautruyvan = strtolower($cautruyvan);
        $tukhoa = array('update', 'insert', 'drop', 'create');

        $kiemtra = str_replace($tukhoa, '*', $cautruyvan);
        if ($cautruyvan != $kiemtra) {
            die("Định ăn gian à!!! <br> Đi chỗ khác nhá...! <br> $cautruyvan");
        }
    }

    public static function checkHighSchool($msisdn) {
        try {
            $urlWS = \Yii::$app->params['bccs']['wsdl'];
            $user = \Yii::$app->params['bccs']['user'];
            $pass = \Yii::$app->params['bccs']['pass'];
            $infoCode = \Yii::$app->params['bccs']['infoCode'];
            $error = 1;
            $message = 'Hệ thống đang bận. Bạn vui lòng thử lại sau!';

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
                \Yii::info("PRODUCT_CODE > $msisdn > $code");
                if (in_array($code, \Yii::$app->params['product_code']['highschool'])) {
                    $error = 0;
                } else {
                    $message = 'Đăng ký gói cước highschool thất bại do thuê bao không phải thuê bao highschool!';
                    $error = 1;
                }
            }
        } catch (\mongosoft\soapclient\Exception $ex) {
            Yii::error($ex->getMessage());
        }
        return ['error' => $error, 'message' => $message];
    }

    public static function convertCountView($count) {
        if ($count > 1000000) {
            return number_format(floor($count / 1000000)) . "M";
        }
        return number_format($count);
    }

}
