<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbSalesReceive;
use Exception;

/**
 * 销售单收款信息表
 * Class SalesreceiveController
 * @package Multiple\Home\Controllers
 */
class SalesreceiveController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSalesReceive');
    }

    function before_add()
    {
        $_POST['makestaff'] = $this->currentUser;
        $_POST['companyid'] = $this->companyid;
        $_POST['maketime'] = date("Y-m-d H:i:s");
        $_POST['status'] = 0;

        if (isset($_POST['confirmstaff']) || isset($_POST['confirmtime'])) {
            throw new Exception("/1001/数据非法/");
        }
    }

    function before_edit($row)
    {
        $_POST['status'] = 0;

        if (isset($_POST['confirmstaff']) || isset($_POST['confirmtime'])) {
            throw new Exception("/1001/数据非法/");
        }

        if ($row->status != 0 || $row->makestaff != $this->currentUser) {
            throw new Exception('/1002/不允许修改/');
        }
    }

    function before_delete($row)
    {
        if ($row->status != 0 || $row->makestaff != $this->currentUser) {
            throw new Exception('/1002/不允许删除/');
        }
    }

    function before_page()
    {
        $_POST['companyid'] = $this->companyid;
    }

    function searchAction()
    {
        return $this->pageAction();
    }

    /**
     * 确认该笔款已经支付
     * @return false|string [type] [description]
     * @throws Exception
     */
    function confirmAction()
    {
        $row = TbSalesReceive::findFirstById($this->request->getPost("id"));
        if ($row != false && $row->companyid == $this->companyid) {
            if ($row->status == 1) {
                throw new Exception('/1002/付款已经确认过了。/');
            }
            $row->confirmtime = date("Y-m-d H:i:s");
            $row->confirmstaff = $this->currentUser;
            $row->paymentdate = $this->request->getPost("paymentdate");
            $row->memo = $this->request->getPost("memo");
            $row->status = 1;

            if ($row->save() == false) {
                return $this->error($row);
            } else {
                return $this->success($row->toArray());
            }
        } else {
            throw new Exception('/1001/记录不存在。/');
        }
    }

    /**
     * 销售对账单新建的时候，查询明细数据
     * @return false|string [type] [description]
     */
    function searchlistAction()
    {
        $conditions = [
            sprintf("companyid=%d and billid=0 and paymentdate>='%s' and paymentdate<='%s'", $this->companyid, addslashes($_POST['begin']), addslashes($_POST['end'])),
        ];

        $rows = TbSalesReceive::find(
            implode(' and ', $conditions)
        );

        $result = [];
        foreach ($rows as $row) {
            $array = $row->toArray();
            $array['sales'] = $row->sales->toArray();
            $result[] = $array;
        }
        return $this->success($result);
    }
}
