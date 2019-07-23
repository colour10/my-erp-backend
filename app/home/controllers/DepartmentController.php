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

        // 判断结果是json还是对象
        // 如果是json，那就是string类型，直接返回错误信息，返回就把对象交给后续的步骤
        if (gettype($departments) == 'string') {
            return $departments;
        }

        // 交给下面的格式化为目录树处理并返回
        return $this->success(Util::format_tree($departments->toArray()));
    }    

    /**
     * 公司内部部门一维数组
     * @return false|string
     */
    public function singleAction()
    {
        // 取出部门列表
        $departments = $this->getlist();
        // 判断结果是json还是对象
        // 如果是json，那就是string类型，直接返回错误信息，返回就把对象交给后续的步骤
        if (gettype($departments) == 'string') {
            return $departments;
        }

        // 交给下面的格式化为目录树处理并返回
        return $this->reportJson(["data" => Util::format_tree_single_array($departments->toArray())]);
    }

    /**
     * 取出部门列表
     */
    private function getlist()
    {
        // 取出公司下面的所有部门
        $departments = TbDepartment::find([
            sprintf("companyid=%d", $this->companyid)
        ]);

        if(!$departments->toArray()) {
            $msg = $this->getValidateMessage('department-list', 'template', 'notexist');
            return $this->error([$msg]);
        }
        return $departments;
    }
}
