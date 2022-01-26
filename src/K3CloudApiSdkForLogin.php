<?php

namespace Kingdeephp\K3cloud;

use Kingdeephp\K3cloud\Consts\ApiPathConst;
use Kingdeephp\K3cloud\Core\WebApiClient;

class K3CloudApiSdkForLogin
{
    // 金蝶域名或者IP地址;/K3Cloud/
    public string $cloudUrl = '';

    //语言ID,中文2052,繁体3076，英文1033
    public int $LCID = 2052;

    public WebApiClient $webApiClient;

    public function __construct(string $cloudUrl, string $acctId, string $username, string $password, int $LCID = 2052)
    {
        $this->cloudUrl = rtrim($cloudUrl, "/") . "/";
        $this->LCID = $LCID;
        //$this->loginData = [$acctID, $username, $password, $this->LCID];
        $this->webApiClient = new WebApiClient();
        $this->login($acctId, $username, $password);
    }

    /**
     * 登陆
     * @param $acctID
     * @param $username
     * @param $password
     * @return mixed|string|void
     */
    public function login($acctID, $username, $password)
    {
        $url = $this->cloudUrl . ApiPathConst::LOGIN_API;
        $postData = [
            'acctid' => $acctID,
            'userName' => $username,
            'password' => $password,
            'lcid' => $this->LCID,
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