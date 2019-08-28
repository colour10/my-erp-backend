<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbBill;
use Asa\Erp\TbSalesReceive;

/**
 * 对账单
 * ErrorCode 1118
 */
class BillController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbBill');
    }

    function addAction() {
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/11180101/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        //print_r($submitData);

        $this->db->begin();
        try {
            $bill = new TbBill();
            $bill->status = 1;
            $bill->companyid = $this->companyid;
            $bill->billno = \Asa\Erp\TbCode::getCode($this->companyid, "DZ", date("y"));
            $bill->createtime = date('Y-m-d H:i:s');
            $bill->createstaff = $this->currentUser;
            $bill->amount = $submitData['form']['amount'];
            $bill->billtype = $submitData['form']['billtype'];
            $bill->out_billno = $submitData['form']['out_billno'];
            $bill->supplierid = $submitData['form']['supplierid'];
            $bill->invoiceid = $submitData['form']['invoiceid'];
            $bill->currencyid = $submitData['form']['currencyid'];
            $bill->memo = $submitData['form']['memo'];
            $bill->amount_origin = $submitData['form']['amount_origin'];

            if($bill->save()==false) {
                throw new \Exception('/11180102/对账单生成失败/');
            }

            foreach($submitData['list'] as $receiveid) {
                $receive = TbSalesReceive::findFirstById($receiveid);
                if($receive==false || $receive->companyid!=$this->companyid || $receive->billid>0) {
                    throw new \Exception('/11180103/对账单明细不存在/');
                }

                $receive->billid = $bill->id;
                if($receive->save()==false) {
                    throw new \Exception('/11180104/对账单明细添加失败/');
                }
            }
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
        return $this->success($bill->id);
    }

    /**
     * 加载对账单的明细数据
     * @return [type] [description]
     */
    function loadAction() {
        $bill = TbBill::findFirstById($_POST['id']);
        if($bill==false || $bill->companyid!=$this->companyid) {
            throw new \Exception('/11180201/对账单不存在/');
        }

        $rows = TbSalesReceive::find(
            sprintf("billid=%d", $bill->id)
        );

        $result = [];
        foreach($rows as $row) {
            $array = $row->toArray();
            $array['sales'] = $row->sales->toArray();
            $result[] = $array;
        }
        return $this->success(['form'=>$bill->toArray(), 'list'=>$result]);
    }
}
