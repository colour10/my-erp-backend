<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Message as Message;

/**
 * 
 */
class BaseCompanyModel extends BaseModel {
    protected $companyid;
    
    public function initialize() {
        parent::initialize();
    }

    function getCompanyid() {
        return $this->getDI()->get("currentCompany");
    }
}