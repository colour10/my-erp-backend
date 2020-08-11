<?php

namespace Asa\Erp;

/**
 * 调拨单明细表
 *
 * Class TbRequisitionDetail
 * @package Asa\Erp
 */
class TbRequisitionDetail extends BaseCompanyModel
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
    public $requisitionid;

    /**
     *
     * @var integer
     */
    public $out_productstockid;

    /**
     *
     * @var integer
     */
    public $in_productstockid;

    /**
     *
     * @var integer
     */
    public $number;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $out_number;

    /**
     *
     * @var integer
     */
    public $in_number;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_requisition_detail');

        // 库存-调入仓库，一对多反向
        $this->belongsTo(
            'out_productstockid',
            TbProductstock::class,
            'id',
            [
                'alias' => 'outProductstock',
            ]
        );

        // 调拨表-调出仓库，一对多反向
        $this->belongsTo(
            'in_productstockid',
            TbProductstock::class,
            'id',
            [
                'alias' => 'inProductstock',
            ]
        );
    }

    /**
     * 删除
     *
     * @return bool
     */
    function delete()
    {
        return false;
    }
}
