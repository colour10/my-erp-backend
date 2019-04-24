<?php
namespace Asa\Erp;

/**
 * 基础资料 别名表
 */
class TbAliases extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_aliases');
    }
}
