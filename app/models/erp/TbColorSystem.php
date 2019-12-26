<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;


/**
 * 基础资料，颜色色系表
 */
class TbColorSystem extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_color_system');
    }
}
