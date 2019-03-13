<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;

/**
 * 权限模型关联表
 */
class TbPermissionModule extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_module');

        // 与权限表关联，一对多反向
        $this->belongsTo(
            "permissionid",
            "\Asa\Erp\TbPermission",
            "id",
            [
                'alias' => 'permission',
            ]
        );
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // permissionid-权限id
        $validator->add('permissionid', new Regex(
            [
                "message" => "The permissionid is invalid",
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));

        // 返回验证结果
        return $this->validate($validator);
    }
}
