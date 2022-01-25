<?php

namespace kingdeephp\k3cloud;

use kingdeephp\k3cloud\Core\WebApiClient;

class K3CloudApiSdkForLogin
{
    const LOGIN_API = 'Kingdee.BOS.WebApi.ServicesStub.AuthService.ValidateUser.common.kdsvc';
    const SAVE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.save.common.kdsvc';
    const BATCHSAVE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.batchSave.common.kdsvc';
    const VIEW_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.view.common.kdsvc';
    const SUBMIT_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Submit.common.kdsvc';
    const AUDIT_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Audit.common.kdsvc';
    const PUSH_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Push.common.kdsvc';
    const DRAFT_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.draft.common.kdsvc';
    const DELETE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.delete.common.kdsvc';
    const GETBILL_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.ExecuteBillQuery.common.kdsvc';
    const QUERYINFO_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.QueryBusinessInfo.common.kdsvc';

    // 金蝶域名或者IP地址;/K3Cloud/
    public $cloudUrl = '';
    //登陆数据
    ///public $loginData = [];
    //语言ID,中文2052,繁体3076，英文1033
    public $LCID = 2052;

    public WebApiClient $webApiClient;

    public function __construct(string $cloudUrl, string $acctID, string $username, string $password, int $LCID = 2052)
    {
        $this->cloudUrl = rtrim($cloudUrl, "/") . "/";
        $this->LCID = $LCID;
        //$this->loginData = [$acctID, $username, $password, $this->LCID];
        $this->webApiClient = new WebApiClient();
        //$this->login($acctID, $username, $password);
    }


    /**
     * 登陆
     *
     * @return array
     */
    public function login($acctID, $username, $password)
    {
        $url = $this->cloudUrl . self::LOGIN_API;
        $postData = [
            'acctid' => $acctID,
            'userName' => $username,
            'password' => $password,
            'lcid' => $this->LCID,
        ];
        return $this->webApiClient->execute($url, [], $postData, 'string');
    }

    public function view()
    {

    }
}