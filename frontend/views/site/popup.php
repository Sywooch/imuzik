<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

\yii\bootstrap\Modal::begin([
    'id' => "modal-login",
]);

echo '<div id="id01" class="modal-login">';
\yii\bootstrap\Modal::end();


$this->registerJs(
        "$(document).on('ready pjax:success', function() {            
                    $('#modal-login').modal('show').find('#id01').load('/site/login');
                    });
                ");
