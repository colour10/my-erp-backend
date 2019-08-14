<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPermissionAction;

/**
 *
 */
class PermissionactionController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbPermissionAction');
    }

    function before_edit($row) {
        $this->check();
    }

    function before_add() {
        $this->check();
    }

    function before_delete($row) {
        $this->check();
    }

    function before_page() {
        $this->check();
    }

    private function check() {
        if($this->config->mode!='develop') {
            throw new \Exception("/11170101/内部错误/");
        }
    }
}
