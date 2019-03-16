<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProduct;

/**
 * 商品表
 */
class ProductController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbProduct');
    }
    
    function searchAction() {
        if($this->request->isPost()) {
            $where = array(
                sprintf("sys_delete_flag=0 and companyid=%d", $this->companyid)
            );
            if(isset($_POST["productname"]) && trim($_POST["productname"])!="") {
                $where[] = sprintf("productname like '%%%s%%'", addslashes($_POST["productname"]));
            }
            
            $result = TbProduct::find(
                implode(" and ", $where)
            );    
            
            echo json_encode($result->toArray());
        }
        
        $this->view->disable();     
    }
    
    public function beforeExecuteRoute($dispatcher)
    {
        // 这个方法会在每一个能找到的action前执行
        $action = $dispatcher->getActionName();
        if ($action=='add') {

            $_POST["adduserid"] = $this->currentUser;
        }
    }
}
