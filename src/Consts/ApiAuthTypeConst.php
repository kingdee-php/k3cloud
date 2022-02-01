<?php

namespace Kingdeephp\K3cloud\Consts;

class ApiAuthTypeConst
{
    // 登录方式：用户名+密码
    const USER_ID_PASSWORD = 1;
    // 登录方式：第三方授权应用ID+应用密钥
    const APP_ID_SECRET = 2;
    // 非登录方式：API签名
    const API_SIGNATURE = 3;
}
