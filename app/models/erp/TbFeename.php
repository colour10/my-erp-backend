<?php
namespace Asa\Erp;

/**
 * 费用名称
 */
class TbFeename extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_feename');
    }
}
