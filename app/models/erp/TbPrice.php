<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * 
 */
class TbPrice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price');
    }
}
