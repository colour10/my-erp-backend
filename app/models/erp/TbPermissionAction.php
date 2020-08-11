<?php

namespace Asa\Erp;

/**
 * 权限模型关联表
 *
 * Class TbPermissionAction
 * @package Asa\Erp
 */
class TbPermissionAction extends BaseModel
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
    public $permissionid;

    /**
     *
     * @var string
     */
    public $controller;

    /**
     *
     * @var string
     */
    public $action;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_action');
    }
}
