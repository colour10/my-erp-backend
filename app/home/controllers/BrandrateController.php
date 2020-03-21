<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBrandRate;

/**
 * 品牌倍率表
 * Class BrandrateController
 * @package Multiple\Home\Controllers
 */
class BrandrateController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBrandRate');
    }

    function getrateAction()
    {
        $rate = TbBrandRate::findFirst(
            sprintf("brandid=%d and ageseasonid=%d and brandgroupid=%d", $_POST['brandid'], $_POST['ageseason'], $_POST['brandgroupid'])
        );

        if ($rate != false) {
            return $this->success($rate->rate);
        } else {
            return $this->success("");
        }
    }

    function addAction()
    {
        $this->db->begin();
        $array = explode(",", $_POST['brandgroupid']);
        foreach ($array as $brandgroupid) {
            $obj = new TbBrandRate();
            $obj->brandid = $_POST['brandid'];
            $obj->ageseasonid = $_POST['ageseasonid'];
            $obj->rate = $_POST['rate'];
            $obj->modifystaff = $this->currentUser;
            $obj->modifytime = date("Y-m-d H:i:s");
            $obj->brandgroupid = $brandgroupid;

            if ($obj->create() == false) {
                $this->db->rollback();
                throw new \Exception("/1002/添加品牌倍率失败/");
            }
        }
        $this->db->commit();
        return $this->success();
    }

    function before_page()
    {
        $this->injectParam('__orderby', "ageseasonid desc");
    }

    function before_edit($row)
    {
        $_POST["modifytime"] = date("Y-m-d H:i:s");
        $_POST["modifystaff"] = $this->currentUser;
    }
}