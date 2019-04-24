<?php
namespace Asa\Erp;

/**
 * 基础资料，材质备注表
 */
class TbMaterialnote extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_materialnote');
    }
}
