<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBill;
use Asa\Erp\TbCode;
use Asa\Erp\TbSalesReceive;
use Exception;

/**
 * 对账单控制器
 * Class BillController
 * @package Multiple\Home\Controllers
 */
class BillController extends CadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBill');
    }

    /**
     * 添加逻辑
     *
     * @return false|string|void
     * @throws Exception
     */
    function addAction()
    {
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception("/11180101/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        // 采用事务处理
        $this->db->begin();
        try {
            $bill = new TbBill();
            // 未回款1
            $bill->status = TbBill::STATUS_NOT_PAYMENT;
            $bill->companyid = $this->companyid;
            $bill->billno = TbCode::getCode($this->companyid, "DZ", date("y"));
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

            if ($bill->save() == false) {
                throw new Exception('/11180102/对账单生成失败/');
            }

            foreach ($submitData['list'] as $receiveid) {
                $receive = TbSalesReceive::findFirstById($receiveid);
                if ($receive == false || $receive->companyid != $this->companyid || $receive->billid > 0) {
                    throw new Exception('/11180103/对账单明细不存在/');
                }

                $receive->billid = $bill->id;
                if ($receive->save() == false) {
                    throw new Exception('/11180104/对账单明细添加失败/');
                }
            }
        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
        return $this->success($bill->id);
    }

    /**
     * 加载对账单的明细数据
     * @return false|string [type] [description]
     * @throws Exception
     */
    function loadAction()
    {
        $bill = TbBill::findFirstById($_POST['id']);
        if ($bill == false || $bill->companyid != $this->companyid) {
            throw new Exception('/11180201/对账单不存在/');
        }

        $rows = TbSalesReceive::find(
            sprintf("billid=%d", $bill->id)
        );

        $result = [];
        foreach ($rows as $row) {
            $array = $row->toArray();
            $array['sales'] = $row->sales->toArray();
            $result[] = $array;
        }
        return $this->success(['form' => $bill->toArray(), 'list' => $result]);
    }
}
