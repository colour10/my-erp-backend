<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbExchangeRate;

/**
 * 汇率表
 */
class ExchangerateController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbExchangeRate');
    }

    function before_add() {
        $_POST['companyid'] = $this->companyid;
        $_POST['begin_time'] = date("Y-m-d H:i:s");
        $_POST['status'] = 0;

        //检查是否设置过汇率。
        $row = TbExchangeRate::findFirst(
            sprintf("companyid=%d and currency_from=%d and currency_to=%d and status=0", $this->companyid, $_POST['currency_from'], $_POST['currency_to'])
        );

        if($row!=false) {
            throw new \Exception("/1101/不能重复添加/");            
        }
    }

    function before_page() {
        $this->injectParam('companyid', $this->companyid);
        $this->injectParam('status', 0);
        $_POST["__orderby"] = "currency_from asc,currency_to asc";
    }

    function editAction() {
        $row = TbExchangeRate::findFirst(
            sprintf("id=%d and status=0", $_POST['id'])
        );

        if($row==false || $row->companyid!=$this->companyid) {
            throw new \Exception("/1001/数据非法/");
        }
        else if($row->rate == $_POST['rate']) {
            throw new \Exception("/1102/不需要更改/");
        }

        $this->db->begin();
        $row->end_time = date("Y-m-d H:i:s");
        $row->status = 1;
        if($row->update()==false) {
            $this->db->rollback();
            throw new \Exception("/1001/更新汇率失败/");
        }

        $newRecord = new TbExchangeRate();
        $newRecord->companyid = $row->companyid;
        $newRecord->currency_from = $row->currency_from;
        $newRecord->currency_to = $row->currency_to;
        $newRecord->status = 0;
        $newRecord->begin_time = $row->end_time;
        $newRecord->rate =  $_POST['rate'];
        if($newRecord->create()==false) {
            $this->db->rollback();
            throw new \Exception("/1001/创建新汇率失败/");
        }
        $this->db->commit();
        return $this->success();
    }

    function historyAction() {
        $result = TbExchangeRate::find([
            sprintf("companyid=%d and currency_from=%d and currency_to=%d and status=1", $this->companyid, $_POST['currency_from'], $_POST['currency_to']),
            "order" => "begin_time desc"
        ]);

        return $this->success($result->toArray());
    }
}
