<?php
require('../vendor/autoload.php');
//use Kingdeephp\K3cloud\K3CloudApiSdkForLogin;

$config = [
    'cloud_url' => 'http://sh.bianxingjimu.com.cn:1111/k3cloud/',
    'acct_id' => '61878598016ce1',
    'username' => 'Administrator',
    'password' => 'kd123!@#',
    'lcid' => 2052,
];

$server = new \Kingdeephp\K3cloud\K3CloudApiSdkForLogin($config);
//print_r($server->login('61878598016ce1', 'Administrator', 'kd123!@#', '2052'));;
print_r($server->queryBusinessInfo(['FormId' => 'BD_MATERIAL']));

