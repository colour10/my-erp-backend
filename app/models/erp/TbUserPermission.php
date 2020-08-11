<?php

namespace Asa\Erp;

/**
 * 用户权限表
 * Class TbBillConfirm
 * @package Asa\Erp
 */
class TbUserPermission extends BaseModel
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
    public $userid;

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
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_user_permission');
    }
}
