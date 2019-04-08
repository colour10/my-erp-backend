<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProperty;

/**
 * 基础资料，ASA颜色模板表
 */
class PropertyController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbProperty');
    }

    function pageAction() {
        $result = TbProperty::find([
            sprintf("parent_type=%d and parent_id=%d",$_POST['parent_type'], $_POST['parent_id']),
            "order" => "displayindex asc"
        ]);

        return $this->success($result->toArray());
    }

    function before_add() {
        $max_displayindex = TbProperty::maximum([
            sprintf("parent_type=%d and parent_id=%d",$_POST['parent_type'], $_POST['parent_id']),
            "column" => "displayindex"
        ]);
        $_POST['displayindex'] = $max_displayindex+1;
    }

    function upAction() {
        $properry = TbProperty::findFirstById($_POST['id']);
        if($properry!=false) {
            $properry->doUp();
        }
        return $this->success();
    }

    function downAction() {
        $properry = TbProperty::findFirstById($_POST['id']);
        if($properry!=false) {
            $properry->doDown();
        }
        return $this->success();
    }
}
