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

//实例化SDK 实例化同时完成登录
$config = [
    'auth_type' => 3,//授权类型：1用户名+密码；2 第三方授权应用ID+应用密钥；3签名；
    'host_url' => 'http||https://xxxxxxxxxxxxxxxxx/k3cloud/', //金蝶授权请求地址
    'acct_id' => 'xxxxxxxxxx', //账户ID
    'username' => 'xxxxxxxxxx', // 用户名（授权类型为1时必须）
    'password' => 'xxxxxxxxxx', // 密码（授权类型为1时必须）
    'appid' => 'xxxxxxxxxx', // 应用ID（授权类型为2或3时必须）
    'appsecret' => 'xxxxxxxxxx', // 应用Secret（授权类型为2或3时必须）
    'lcid' => 2052, // 账套语系，默认2052
];
$server = new \Kingdeephp\K3cloud\K3CloudApiSdk($config);

//返回值格式 可不传 默认string 所有接口通用
$format = 'string';
//单据查询
$executeBillQueryParams = [
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
$server->executeBillQuery($billQueryParams, $format);

//元数据查询
$queryBusinessInfoParams = [
    // 业务对象表单Id 例如物料 BD_MATERIAL 【必填】
    'FormId' => 'BD_MATERIAL', 
];
$server->queryBusinessInfo($queryBusinessInfoParams)


//详情查询
$formId = 'BD_MATERIAL'; //业务对象表单Id 例如物料 BD_MATERIAL 【必填】
$viewParams = [
    //创建者组织内码，字符串类型【非必录】
    'CreateOrgId' => 0,
    //单据编码，字符串类型【使用编码时必录】
    'Number' => '', 
    //表单内码【使用内码时必录】
    'Id' => '', 
];
$server->view($formId, $viewParams);

```

