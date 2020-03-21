<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbSizecontent;

/**
 * 商品尺码明细信息表
 * Class SizecontentController
 * @package Multiple\Home\Controllers
 */
class SizecontentController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSizecontent');
    }

    function pageAction()
    {
        $result = TbSizecontent::find([
            sprintf("topid=%d", $_POST['topid']),
            "order" => "displayindex asc",
        ]);

        return $this->success($result->toArray());
    }

    function before_add()
    {
        $max_displayindex = TbSizecontent::maximum([
            sprintf("topid=%d", $_POST['topid']),
            "column" => "displayindex",
        ]);
        $_POST['displayindex'] = $max_displayindex + 1;
    }

    function upAction()
    {
        $properry = TbSizecontent::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doUp();
        }
        return $this->success();
    }

    function downAction()
    {
        $properry = TbSizecontent::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doDown();
        }
        return $this->success();
    }

    function topAction()
    {
        $properry = TbSizecontent::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doTop();
        }
        return $this->success();
    }

    function bottomAction()
    {
        $properry = TbSizecontent::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doBottom();
        }
        return $this->success();
    }
}
