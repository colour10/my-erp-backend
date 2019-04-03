<?php
namespace Multiple\Home\Controllers;

use Asa\Erp\TbProduct;
use Asa\Erp\TbBrandgroupchild;
use Phalcon\Mvc\Controller;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\Util;

class BrandgroupController extends ZadminController
{

    public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\TbBrandgroup');

        // $this->setTitle("品类维护");
    }
}
