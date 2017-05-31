<?php

namespace common\models;

use Yii;

class LoginFailTimesBase extends \common\models\db\VtLoginFailTimesDB {

    public static function getLoginFailCount($username) {
        return LoginFailTimesBase::find()
                        ->where(['phone_number' => $username])
                        ->count();
    }

    public static function getFailByTime($username, $time) {
        try {
            return LoginFailTimesBase::find()
                            ->where(['phone_number' => $username])
                            ->andWhere(['>', 'created_time', date("Y-m-d H:i:s", $time)])
                            ->count();
        } catch (\yii\db\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function delByPhonenumber($phonenumber) {
        return LoginFailTimesBase::deleteAll(['phone_number' => $phonenumber]);
    }

}
