<?php

namespace common\helper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Helper {

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

}
