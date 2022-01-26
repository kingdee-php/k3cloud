<?php
require('../vendor/autoload.php');
//use Kingdeephp\K3cloud\K3CloudApiSdkForLogin;

$server = new \Kingdeephp\K3cloud\K3CloudApiSdkForLogin('http://sh.bianxingjimu.com.cn:1111/k3cloud/', '61878598016ce1', 'Administrator', 'kd123!@#', '2052');
//print_r($server->login('61878598016ce1', 'Administrator', 'kd123!@#', '2052'));;
print_r($server->queryBusinessInfo('BD_MATERIAL'));

