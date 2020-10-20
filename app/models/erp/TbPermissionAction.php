<?php

namespace Asa\Erp;

/**
 * 权限模型关联表
 *
 * Class TbPermissionAction
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $permissionid 权限id
 * @property string|null $controller 控制器名称
 * @property string|null $action 方法名称
 */
class TbPermissionAction extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_action');
    }
}
