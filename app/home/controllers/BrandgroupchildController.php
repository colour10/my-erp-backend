<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbBrandgroupchild;

/**
 * 基础资料，子品类表
 */
class BrandgroupchildController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbBrandgroupchild');
    }
}
