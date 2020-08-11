<?php

namespace Asa\Erp;

/**
 * 权限表
 *
 * Class TbPermission
 * @package Asa\Erp
 */
class TbPermission extends BaseModel
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
    public $pid;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $memo_cn;

    /**
     *
     * @var string
     */
    public $memo_en;

    /**
     *
     * @var string
     */
    public $memo_hk;

    /**
     *
     * @var string
     */
    public $memo_fr;

    /**
     *
     * @var string
     */
    public $memo_it;

    /**
     *
     * @var string
     */
    public $memo_sp;

    /**
     *
     * @var string
     */
    public $memo_de;

    /**
     *
     * @var integer
     */
    public $is_only_superadmin;

    /**
     *
     * @var integer
     */
    public $display_index;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission');
    }
}
