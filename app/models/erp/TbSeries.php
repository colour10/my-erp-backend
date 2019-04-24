<?php
namespace Asa\Erp;

/**
 * 品牌系列，品牌相关数据
 */
class TbSeries extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_series');
    }
}
