<?php

namespace Asa\Erp;

/**
 * 权限-组模型
 *
 * Class TbPermissionGroup
 * @package Asa\Erp
 */
class TbPermissionGroup extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $groupid;

    /**
     *
     * @var integer
     */
    public $permissionid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_group');
    }
}
