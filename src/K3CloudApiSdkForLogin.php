<?php

namespace Kingdeephp\K3cloud;

use Kingdeephp\K3cloud\Consts\ApiPathConst;
use Kingdeephp\K3cloud\Core\WebApiClient;

class K3CloudApiSdkForLogin
{
    // 金蝶域名或者IP地址;/K3Cloud/
    public string $cloudUrl = '';
    // 账户ID
    public string $acctId = '';
    // 用户名
    public string $username = '';
    // 密码
    public string $password = '';
    // 语言
    public int $lcid;

    public WebApiClient $webApiClient;

    public function __construct($config)
    {
        $this->cloudUrl = rtrim($config['cloud_url'], "/") . "/";
        $this->acctId = $config['acct_id'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->lcid = $config['lcid'] ?? 2052;
        $this->webApiClient = new WebApiClient();
        $this->login();
    }

    /**
     * 登陆
     * @return mixed|string|void
     */
    public function login()
    {
        $url = $this->cloudUrl . ApiPathConst::LOGIN_API;
        $postData = [
            'acctid' => $this->acctId,
            'userName' => $this->username,
            'password' => $this->password,
            'lcid' => $this->lcid,
        ];
        return $this->webApiClient->execute($url, [], $postData, 'string');
    }

    /**
     * 详情
     * @param $formId
     * @param $data
     * @return mixed|string|void
     */
    public function view($formId, $data)
    {
        $url = $this->cloudUrl . ApiPathConst::VIEW_API;
        $postData = [
            'formid' => $formId,
            'data' => $data
        ];
        return $this->webApiClient->execute($url, [], $postData, 'string');
    }

    /**
     *  单据查询
     * @param $data
     * @return mixed|string|void
     */
    public function billQuery($data)
    {
        $url = $this->cloudUrl . ApiPathConst::BILLQUERY_API;
        $postData = [
            'data' => $data
        ];
        return $this->webApiClient->execute($url, [], $postData, 'string');
    }

    /**
     * 元数据查询
     * @param $data
     * @return mixed|string|void
     */
    public function queryBusinessInfo($data)
    {
        $url = $this->cloudUrl . ApiPathConst::QUERYBUSINESSINFO_API;
        $postData = [
            'data' => $data
        ];
        return $this->webApiClient->execute($url, [], $postData, 'string');
    }

}