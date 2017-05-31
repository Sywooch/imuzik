<?php

namespace frontend\models;

use Yii;

class LogRbtService extends \common\models\LogRbtServiceBase {

    public static function write($memberId, $username, $action, $phoneNumber, $returnCode, $brandId = 0) {
        $objLogRegService = new LogRbtService();
        $objLogRegService->member_id = $memberId;
        $objLogRegService->username = $username;
        $objLogRegService->phonenumber = $phoneNumber;
        $objLogRegService->action = $action;
        $objLogRegService->return_code = $returnCode;
        $objLogRegService->source = \Yii::$app->session->get('utm_source');
        $objLogRegService->brand_id = intval($brandId);
        $objLogRegService->created_at = new \yii\db\Expression('now()');
        $objLogRegService->save(false);
    }

}
