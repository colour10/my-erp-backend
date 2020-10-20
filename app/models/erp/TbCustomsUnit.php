<?php

namespace Asa\Erp;

/**
 * 海关销售单位表
 *
 * Class TbCustomsUnit
 * @package Asa\Erp
 * @property int $id 主键ID
 * @property string $name 名称
 * @property int $displayindex 排序
 * @property string $code 编码
 */
class TbCustomsUnit extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_unit');
    }
}
