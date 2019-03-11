<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbDepartment;
use Asa\Erp\Util;

/**
 * 部门表
 */
class DepartmentController extends CadminController {
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
    
    /**
     * 取出公司内部部门目录树
     * @return false|string
     */
    public function departmentsAction()
    {
        // 取出部门列表
        $departments = $this->getlist();

        // 交给下面的格式化为目录树处理并返回
        return json_encode(Util::format_tree($departments->toArray()));
    }
    
    function treeAction() {
        $result = array();
        
        $result[] = array(
            "label" => "爱莎",
            "description" => "",
            "id" => 1,
            "children" => array($this->createNode("销售部",2,"销售部说明"), $this->createNode("技术部",3,"技术部备注"))
        );
        //print_r($result);
        //echo json_encode($result);exit;
        echo json_encode($result);
        $this->view->disable();
    }

    /**
     * 公司内部部门一维数组
     * @return false|string
     */
    public function singleAction()
    {
        // 取出部门列表
        $departments = $this->getlist();

        // 交给下面的格式化为目录树处理并返回
        return json_encode(Util::format_tree_single_array($departments->toArray()));
    }

    /**
     * 取出部门列表
     */
    public function getlist()
    {
        // $auth = $this->auth;
        //
        // // 取出公司下面的所有部门
        // $departments = TbDepartment::find([
        //     sprintf("sys_delete_flag=0 and companyid=%d", $auth['companyid'])
        // ]);



        // 取出公司下面的所有部门
        $departments = TbDepartment::find([
            'companyid' => '1',
            'sys_delete_flag' => '0',
        ]);

        if(!$departments) {
            return $this->error(['departments are not exist']);
        }
        return $departments;
    }
}
