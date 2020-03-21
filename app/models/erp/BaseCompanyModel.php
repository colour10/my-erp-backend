<?php

namespace Asa\Erp;

/**
 * 需要获取公司 id 的逻辑
 * Class BaseCompanyModel
 * @package Asa\Erp
 */
class BaseCompanyModel extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
    }

    function getCompanyid()
    {
        return $this->getDI()->get("currentCompany");
    }
}