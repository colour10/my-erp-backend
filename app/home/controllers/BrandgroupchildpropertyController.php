<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBrandgroupchildProperty;

/**
 * 基础资料，ASA颜色模板表
 */
class BrandgroupchildpropertyController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBrandgroupchildProperty');
    }

    function pageAction()
    {
        $result = TbBrandgroupchildProperty::find([
            sprintf("brandgroupchildid=%d", $_POST['brandgroupchildid']),
            "order" => "displayindex asc",
        ]);

        return $this->success($result->toArray());
    }

    function upAction()
    {
        $properry = TbBrandgroupchildProperty::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doUp();
        }
        return $this->success();
    }

    function downAction()
    {
        $properry = TbBrandgroupchildProperty::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doDown();
        }
        return $this->success();
    }

    function topAction()
    {
        $properry = TbBrandgroupchildProperty::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doTop();
        }
        return $this->success();
    }

    function bottomAction()
    {
        $properry = TbBrandgroupchildProperty::findFirstById($_POST['id']);
        if ($properry != false) {
            $properry->doBottom();
        }
        return $this->success();
    }
}
