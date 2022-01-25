<?php
//require('vendor/autoload.php');
//use kingdeephp\k3cloud\K3CloudApiSdkForLogin;

require_once '/Users/yangxin/PhpstormProjects/kingdee/src/K3CloudApiSdkForLogin.php';
//$server = new K3CloudApiSdkForLogin('http://sh.bianxingjimu.com.cn:1111/k3cloud/', '61878598016ce1', 'Administrator', 'kd123!@#', '2052');
$server = new \kingdeephp\k3cloud\K3CloudApiSdkForLogin('http://sh.bianxingjimu.com.cn:1111/k3cloud/', '61878598016ce1', 'Administrator', 'kd123!@#', '2052');
print_r($server);die;
//print_r($server->login('61878598016ce1', 'Administrator', 'kd123!@#'));