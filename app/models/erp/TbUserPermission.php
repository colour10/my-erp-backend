<?php

namespace Asa\Erp;

/**
 * 用户权限表
 *
 * Class TbBillConfirm
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $userid 用户id
 * @property int|null $groupid 权限组id
 * @property int|null $permissionid 权限id
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 */
class TbUserPermission extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_user_permission');
    }
}
