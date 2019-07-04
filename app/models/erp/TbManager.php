<?php

namespace Asa\Erp;

/**
 * 超级管理员表
 */
class TbManager extends BaseCompanyModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_manager');
    }
}
