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
     * @param string $format
     * @return mixed|string|void
     */
    public function view($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::VIEW_API;
        $postData = [
            'formid' => $formId,
            'data' => $data
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     *  单据查询
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function executeBillQuery($data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::EXECUTEBILLQUERY_API;
        $postData = [
            'data' => $data
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 元数据查询
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function queryBusinessInfo($data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::QUERYBUSINESSINFO_API;
        $postData = [
            'data' => $data
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 获取数据中心列表
     * @param string $format
     * @return mixed|string|void
     */
    public function getDataCenterList(string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::GETDATACENTERLIST_API;
        return $this->webApiClient->execute($url, [], [], $format);
    }

    /**
     * 保存
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function save($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::SAVE_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 批量保存
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function batchSave($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::BATCHSAVE_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 审核
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function audit($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::AUDIT_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 反审核
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function unAudit($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::UNAUDIT_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 提交
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function submit($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::SUBMIT_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 操作
     * @param $formId
     * @param $opNumber
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function operation($formId, $opNumber, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::EXCUTEOPERATION_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'opNumber' => $opNumber,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 下推
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function push($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::PUSH_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 暂存
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function draft($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::DRAFT_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 删除
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function delete($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::DELETE_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 分配
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function allocate($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::ALLOCATE_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 弹性域保存
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function flexSave($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::FLEXSAVE_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 发送消息
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function sendMsg($data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::SENDMSG_API;
        $postData = [
            'data' => [
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 分组保存
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function groupSave($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::GROUPSAVE_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 拆单
     * @param $formId
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function disassembly($formId, $data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::DISASSEMBLY_API;
        $postData = [
            'data' => [
                'formid' => $formId,
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 工作流审批
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function workflowAudit($data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::WORKFLOWAUDIT_API;
        $postData = [
            'data' => [
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 查询分组信息
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function queryGroupInfo($data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::QUERYGROUPINFO_API;
        $postData = [
            'data' => [
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }

    /**
     * 分组删除
     * @param $data
     * @param string $format
     * @return mixed|string|void
     */
    public function groupDelete($data, string $format = 'string')
    {
        $url = $this->cloudUrl . ApiPathConst::GROUPDELETE_API;
        $postData = [
            'data' => [
                'data' => $data
            ]
        ];
        return $this->webApiClient->execute($url, [], $postData, $format);
    }
}