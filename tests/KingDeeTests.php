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
//print_r($server->login('61878598016ce1', 'Administrator', 'kd123!@#', '2052'));
//单据查询
$billQueryParams = [
    // 业务对象表单Id 例如物料 BD_MATERIAL 【必填】
    'FormId' => 'BD_MATERIAL',
    // 需查询的字段key集合，字符串类型，格式：'key1, key2, ...'【必填】
    //注（查询单据体内码,需加单据体Key和下划线,如：FEntryKey_FEntryId）
    'FieldKeys' => 'FName,FModifierId',
    //过滤条件【非必录】
    'FilterString' => [],
    //排序字段【非必录】
    'OrderString' => '',
    //返回总行数，整型【非必录】
    'TopRowCount' => 0,
    //开始行索引，整型【非必录】
    'StartRow' => 0,
    //最大行数，整型，不能超过2000【非必录】
    'Limit' => 0,
    //子系统标识ID【非必录】
    'SubSystemId' => '',
];
$res = $server->executeBillQuery($billQueryParams);
print_r($res);

