## Kingdeephp/K3cloud

A PHP SDK for KingDee
## Install

Via Composer

``` bash
$ composer require kingdee-php/k3cloud
```

## Usage (API)

``` php
<?php

$cloudUrl = 'http||https://xxxxxxxxxxxxxxxxx/k3cloud/'; //金蝶授权请求地址
$acctId = 'xxxxxxxxxx'; // 账户ID
$username = 'xxxxxxxxxx'; // 用户名
$password 'xxxxxxxx'; // 密码
$LCID = 2052; // 语言 2052-中文

$server = new \Kingdeephp\K3cloud\K3CloudApiSdkForLogin($cloudUrl, $acctId, $username, $password, $LCID);
print_r($server->queryBusinessInfo('BD_MATERIAL')); //获取物料元数据列表

```

