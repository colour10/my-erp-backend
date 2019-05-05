<?php

namespace Asa\Erp;

/**
 * 语言配置表
 */
class TbLanguage extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_language');
    }
}