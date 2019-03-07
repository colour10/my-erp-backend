<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbDepartment;

/**
 * 部门表
 */
class DepartmentController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbDepartment');
    }
    
    function indexAction() {
        $result = array();
        
        $result[] = array(
            "label" => "爱莎",
            "description" => "",
            "id" => 1,
            "children" => array($this->createNode("销售部",2,"销售部说明"), $this->createNode("技术部",3,"技术部备注"))
        );
        //print_r($result);
        //echo json_encode($result);exit;
        $this->view->setVar("depart_tree",json_encode($result));
    }
    
    /*
     * 保存部门信息
     */
    function saveAction() {        
        $this->doEdit();
    }
    
    private function createNode($label, $id, $description) {
        return array(
            "label" => $label,
            "description" => $description,
            "id" => $id,
            "children" => array()
        );   
    }
}