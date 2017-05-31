<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace frontend\controllers;
use yii\web\Controller;

class RankController extends AppController {
    public function actionIndex() {
        return $this->render('/rank/index');
    }
}

