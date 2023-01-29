<?php

require __DIR__ . '/vendor/autoload.php';
//实例化SDK 实例化同时完成登陆

// $server = new \Kingdeephp\K3cloud\Core\WebApiClient();

$config = [
    "host_url" => "http://192.168.10.12/k3cloud/",
    "appid" => "223280_076IQzCO1JpUQU8HR43OT+9vztTUQrKo",
    "appsecret" => "97d906c117dd4475bd98d45ecf2a9002",
    "acct_id" => "61ea6d9d20b119",
    "username" => "administrator",
    "password" => "Tb181101@",
    "lcid" => "2052",
    "auth_type" => "1",
];

$config_t440 = [
    'auth_type' => 1,
    // 'host_url' => 'http://4pc7rk.natappfree.cc/k3cloud/', //金蝶授权请求地址 natapp 国内映射
    'host_url' => 'http://192.168.10.82/k3cloud/', //金蝶授权请求地址
    'acct_id' => '61ea6d9d20b119', //账户ID
    'username' => 'administrator', // 用户名
    'password' => 'Tb181101@', // 密码
    'appid' => '223280_076IQzCO1JpUQU8HR43OT+9vztTUQrKo', // 应用ID
    'appsecret' => '97d906c117dd4475bd98d45ecf2a9002', // 应用Secret
    'lcid' => 2052,
    'org_num' => 0,
    'bxjm_org_id' => 1,
    'log' => [
        'name' => 'k3cloud',
        'path' => __DIR__ ,
    ],
    'mysql_log' => [
        'host' => 'rm-2zewt6g4u7798ap9g9o.mysql.rds.aliyuncs.com',
        'port' => '3306',
        'database' => 'tb_log',
        'username' => 'testuser',
        'password' => 'Bxjm1688@',
        'table' => 'tb_log_kingdee_api_access',
    ],
];

$config_sh = [
    'auth_type' => 3,
    // 'host_url' => 'http://4pc7rk.natappfree.cc/k3cloud/', //金蝶授权请求地址 natapp 国内映射
    'host_url' => 'http://sh.bianxingjimu.com.cn:1111/k3cloud/', //金蝶授权请求地址
    'acct_id' => '61878598016ce1', //账户ID
    'username' => 'administrator', // 用户名
    'password' => 'kd123!@#', // 密码
    'appid' => '223372_54bIwzuF0rlbS5UKX5xtQY+L2M0VQMot', // 应用ID
    'appsecret' => '13d573b7d27246b4a94297311c5b2ef1', // 应用Secret
    'lcid' => 2052,
    'org_num' => 0,
    'bxjm_org_id' => 1,
    'log' => [
        'name' => 'k3cloud',
        'path' => __DIR__ ,
    ],
    'mysql_log' => [
        'host' => 'rm-2zewt6g4u7798ap9g9o.mysql.rds.aliyuncs.com',
        'port' => '3306',
        'database' => 'tb_log',
        'username' => 'testuser',
        'password' => 'Bxjm1688@',
        'table' => 'tb_log_kingdee_api_access',
    ],
];

$server = new \Kingdeephp\K3cloud\K3CloudApiSdk($config_t440);


//单元数据
$data = [
    'FormId' => 'PUR_Requisition',
    'data' => [
        'FormId' => 'PUR_Requisition',
        "Ids" => [],
        'Numbers' => ['CGSQ000037'],
        'UserId' => 100199,
        'ApprovalType' => 1,
    ]
];

// print_r(__DIR__ );die;
// $result = $server->executeBillQuery($data);
// $result = $server->workflowAudit($data);
// $result = $server->getDataCenterList();


//取消分配
$data = [
    'PkIds' => 165008,
    "TOrgIds" => 111912
];
$result = $server->cancelAllocate('BAS_PreBaseDataFour', $data, 'string');

print_r($result);
