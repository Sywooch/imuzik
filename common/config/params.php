<?php

return [
    'crbt_brand_id' => [
        1 => [
            'name' => 'Gói cước tháng',
            'price' => '9.000đ/tháng'
        ],
        77 => [
            'name' => 'Gói cước highshool',
            'price' => '4.500đ/tháng'
        ],
        3 => [
            'name' => 'Gói cước homephone',
            'price' => '6.000đ/tháng'
        ],
        86 => [
            'name' => 'Gói cước tuần',
            'price' => '5.000đ/tuần'
        ],
        75 => [
            'name' => 'Gói cước ngày',
            'price' => '1.000đ/ngày'
        ]
    ],
    'viettel_home_phone' => ['625', '626', '627', '628', '629', '633', '664', '665', '666', '667', '668', '669', '220', '221', '222', '223', '224', '246', '247', '248', '249'],
    'viettel_phone_expression' => '/^8496\d{7}$|^8497\d{7}$|^8498\d{7}$|^8486\d{7}$|^8416\d{8}$|^0?96\d{7}$|^0?97\d{7}$|^0?98\d{7}$|^0?86\d{7}$|^0?16\d{8}$/',
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'vcrbt_crbtpresent' => 'http://10.60.19.29:9595/jboss-net/services/CRBTPresent',
    'vcrbt_usermanage' => 'http://10.60.19.29:9595/jboss-net/services/UserManage',
    'vcrbt_usertonemanage' => 'http://10.60.19.29:9595/jboss-net/services/UserToneManage',
    'vcrbt_service_appcode' => 'imuzik',
    'vcrbt_service_apppassword' => 'MTIzNDU2YUA=',
    'vcrbt_success_code' => '000000',
    'vcrbt_list_msisdn' => '163',
    'vcrbt_msisdn_length' => 3,
    'vcrbt_arr_msisdn' => '163',
    'huawei_crbtpresent' => 'http://192.168.228.236:8080/jboss-net/services/CRBTPresent',
    'huawei_usermanage' => 'http://192.168.228.236:8080/jboss-net/services/UserManage',
    'huawei_usertonemanage' => 'http://192.168.228.236:8080/jboss-net/services/UserToneManage?wsdl',
    'huawei_system' => 'http://192.168.228.236:8080/jboss-net/services/System',
    'huawei_service_appcode' => 'MusicPortal',
    'huawei_service_apppassword' => 'MTIz',
    'huawei_success_code' => '000000',
    'phone_allow_free' => '988781354,986953037,1692040587,1649600112,973549017,1674372633',
    'radius' => [
        'wsdl' => 'http://10.58.46.185:8180/RadiusGW/Radius?wsdl',
        'method' => 'getMSISDN',
        'username' => 'imzapp',
        'password' => 'UjxPz47',
        'connect_timeout' => 5,
        'timeout' => 5
    ],
    'ip_pools' => require(__DIR__ . '/ipools.php'),
    'mimetypes' => [
        'mp3' => 'audio/mpeg',
        'm4a' => 'audio/mp4',
        'm4v' => 'video/mp4'
    ],
    'bccs' => [
        //'wsdl' => 'http://10.60.96.246:8068/SALE_SERVICE/bpm/sale/SubscriberBusinessService?wsdl', // thật
        'wsdl' => 'http://10.60.108.62:8800/SALE_SERVICE/bpm/sale/SubscriberBusinessService?wsdl', //test
        'user' => 'test', //sale_imuzik
        'pass' => 'test', //saleimuzik#viette170517
        'infoCode' => '22_getInfoSubByIsdnImuzik', //saleimuzik#viette170517
    ],
    'upload_prefix' => '/media1',
    'upload_path' => $_SERVER['DOCUMENT_ROOT'] . '/uploads',
    'product_code' => [
        'highschool' => ['HISCL', 'HSH', 'HIS050_10'],
    ],
    'solr' => [
        'song' => [
            'endpoint' => array(
                'localhost' => array(
                    'host' => '192.168.146.252',
                    'port' => 9583,
                    'path' => '/solr/db',
                )
            )
        ],
        'rbt' => [
            'endpoint' => array(
                'localhost' => array(
                    'host' => '192.168.146.252',
                    'port' => 9583,
                    'path' => '/solr/db',
                )
            )
        ]
    ],
];
