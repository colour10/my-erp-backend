<?php
namespace Asa\Erp;

/**
 * 子系列，品牌相关
 */
class TbSeries2 extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_series2');
    }
}
        