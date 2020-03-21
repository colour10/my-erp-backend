<?php

namespace Asa\Erp;

/**
 * 货币表
 */
class TbCurrency extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_currency');
    }

    function delete()
    {
        throw new \Exception("/1003/币种信息不允许删除/");
    }
}
