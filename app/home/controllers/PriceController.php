<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPrice;

/**
 * 
 */
class PriceController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbPrice');
    }

    function before_add() {
        $_POST['companyid'] = $this->companyid;
        $_POST['sort_value'] = $this->getSortValue();
    }

    function before_edit($row) {
        if(isset($_POST['companyid']) || $row->companyid!=$this->companyid) {
            throw new \Exception("/1001/数据非法/");
        }

        $_POST['sort_value'] = $this->getSortValue();
    }

    function before_delete($row) {
        if($row->companyid!=$this->companyid) {
            throw new \Exception('/1002/数据非法/');
        }
    }

    function before_page() {
        $_POST['companyid'] = $this->companyid;
        $_POST["__orderby"] = "sort_value asc";
    }

    private function getSortValue() {
        $brandid = $this->request->getPost("brandid", "int", 0);
        $brandgroupid = $this->request->getPost("brandgroupid", "int", 0);
        $brandgroupchildid = $this->request->getPost("brandgroupchildid", "int", 0);
        $ageseasonid = $this->request->getPost("ageseasonid", "int", 0);
        $seriesid = $this->request->getPost("seriesid", "int", 0);
        return sprintf("%012d%012d%012d%012d%012d", $brandid, $brandgroupid, $brandgroupchildid, $ageseasonid, $seriesid);
    }
}
