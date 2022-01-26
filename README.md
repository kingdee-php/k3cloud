## Kingdeephp/K3cloud

A PHP SDK for KingDee

## Install

Continue to improve

Via Composer

``` bash
$ composer require kingdee-php/k3cloud
```

## Usage (API)

``` php
<?php

$cloud_url = 'http||https://xxxxxxxxxxxxxxxxx/k3cloud/'; //金蝶授权请求地址
$acctId = 'xxxxxxxxxx'; // 账户ID
$username = 'xxxxxxxxxx'; // 用户名
$password 'xxxxxxxx'; // 密码
$LCID = 2052; // 语言ID,中文2052,繁体3076，英文1033

$config = [
    'cloud_url' => 'http://sh.bianxingjimu.com.cn:1111/k3cloud/',
    'acct_id' => '61878598016ce1',
    'username' => 'Administrator',
    'password' => 'kd123!@#',
    'lcid' => 3076,
];

//实例化SDK 实例化同时完成登陆
$server = new \Kingdeephp\K3cloud\K3CloudApiSdkForLogin($cloudUrl, $acctId, $username, $password, $LCID);

//单据查询
$billQueryParams = [
    // 业务对象表单Id 例如物料 BD_MATERIAL 【必填】
    'FormId' => 'BD_MATERIAL', 
    // 需查询的字段key集合，字符串类型，格式：'key1, key2, ...'【必填】
    //注（查询单据体内码,需加单据体Key和下划线,如：FEntryKey_FEntryId）
    'FieldKeys' => 'FName,FModifierId', 
    //过滤条件【非必录】
    'FilterString' => [''],
    //排序字段【非必录】
    'OrderString' => '',
    //返回总行数，整型【非必录】
    'TopRowCount' => '',
    //开始行索引，整型【非必录】
    'StartRow' => 0,
    //最大行数，整型，不能超过2000【非必录】
    'Limit' => '',
    //子系统标识ID【非必录】
    'SubSystemId' => '',
];
$server->billQuery($billQueryParams)

//元数据查询
$queryBusinessInfoParams = [
    // 业务对象表单Id 例如物料 BD_MATERIAL 【必填】
    'FormId' => 'BD_MATERIAL', 
];
$server->queryBusinessInfo($queryBusinessInfoParams)

```

