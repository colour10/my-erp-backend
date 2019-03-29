<?php
namespace Multiple\Home\Controllers;

use Asa\Erp\TbProduct;
use Asa\Erp\ZlChildproductgroup;
use Phalcon\Mvc\Controller;
use Asa\Erp\ZlBrandgroup;
use Asa\Erp\Util;

class BrandgroupController extends ZadminController
{

    public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\ZlBrandgroup');

        // $this->setTitle("品类维护");
    }
}
