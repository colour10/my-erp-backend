<?php

namespace Asa\Erp;

/**
 * 包装代码表
 *
 * Class TbCustomsWrap
 * @package Asa\Erp
 * @property int $id 主键ID
 * @property string $code 包装代码
 * @property string $name 名称
 * @property string $sname 简称
 * @property int $displayindex 排序
 */
class TbCustomsWrap extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_wrap');
    }
}
