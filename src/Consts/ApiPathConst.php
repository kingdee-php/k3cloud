<?php

namespace Kingdeephp\K3cloud\Consts;

class ApiPathConst
{
    // 登录（通过用户名+密码）
    const LOGIN_API = 'Kingdee.BOS.WebApi.ServicesStub.AuthService.ValidateUser.common.kdsvc';
    // 登录（通过第三方授权应用ID+应用密钥）
    const LOGIN_API_APP_SECRET = 'Kingdee.BOS.WebApi.ServicesStub.AuthService.LoginByAppSecret.common.kdsvc';
    // 获取数据中心列表
    const GETDATACENTERLIST_API = 'Kingdee.BOS.ServiceFacade.ServicesStub.Account.AccountService.GetDataCenterList.common.kdsvc';
    // 操作
    const EXCUTEOPERATION_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.ExcuteOperation.common.kdsvc';
    // 保存
    const SAVE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.save.common.kdsvc';
    // 批量保存
    const BATCHSAVE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.batchSave.common.kdsvc';
    // 查看
    const VIEW_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.view.common.kdsvc';
    // 提交
    const SUBMIT_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Submit.common.kdsvc';
    // 审核
    const AUDIT_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Audit.common.kdsvc';
    // 下推
    const PUSH_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Push.common.kdsvc';
    // 暂存
    const DRAFT_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.draft.common.kdsvc';
    // 删除
    const DELETE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.delete.common.kdsvc';
    // 单据查询
    const EXECUTEBILLQUERY_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.ExecuteBillQuery.common.kdsvc';
    // 反审核
    const UNAUDIT_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.UnAudit.common.kdsvc';
    // 分配
    const ALLOCATE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Allocate.common.kdsvc';
    // 弹性域保存
    const FLEXSAVE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.FlexSave.common.kdsvc';
    // 发送消息
    const SENDMSG_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.SendMsg.common.kdsvc';
    // 分组保存
    const GROUPSAVE_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.GroupSave.common.kdsvc';
    // 拆单
    const DISASSEMBLY_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Disassembly.common.kdsvc';
    // 查询单据
    const QUERYBUSINESSINFO_API = 'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.QueryBusinessInfo.common.kdsvc';
    // 工作流审批
    const WORKFLOWAUDIT_API ='Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.WorkflowAudit.common.kdsvc';
    // 查询分组信息
    const QUERYGROUPINFO_API ='Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.QueryGroupInfo.common.kdsvc';
    // 分组删除
    const GROUPDELETE_API ='Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.GroupDelete.common.kdsvc';
}
