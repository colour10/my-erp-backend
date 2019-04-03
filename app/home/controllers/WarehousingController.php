<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbWarehousing;
use Asa\Erp\TdConfirmorder;
use Asa\Erp\TbWarehousingdetails;

/**
 * 入库单主表
 */
class WarehousingController extends BaseController {
    public function pageAction() {
        $result = TbWarehousing::find(
            sprintf("companyid=%d", $this->companyid)
        );

        echo $this->success($result->toArray());
    }

    /**
     * 订单保存
     */
    public function createAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            $msg = $this->getValidateMessage('order-params', 'template', 'required');
            return $this->error([$msg]);
        }
        // 转换成数组
        $submitData = json_decode($params, true);
        // 判断是否有订单号，分别进行
        $form = $submitData['form'];
        $orderid = $form['id'];

        $order = TbWarehousing::findFirst(
            sprintf("confirmorderid=%d and companyid=%d",  $form['confirmorderid'], $this->companyid)
        );
        if($order!=false) {
            exit;
        }

        // 采用事务处理
        $this->db->begin();

        $confirmorder = TdConfirmorder::findFirstById($form["confirmorderid"]);

        // 没有订单号就新增
        $order = new TbWarehousing();
        // 添加制单人及制单日期
        $order->entrydate = $form["entrydate"];
        $order->makestaff = $this->currentUser;
        $order->makedate = date('Y-m-d H:i:s');
        $order->companyid = $this->companyid;
        $order->warehouseid = $confirmorder->warehouseid;
        $order->confirmorderid = $confirmorder->id;

        // 生成订单号
        $order->orderno = sprintf(
            "T%s%s%s", 
            substr("000000".$this->companyid, -6),
            date('YmdHis'),
            mt_rand(1000, 9999)
        );

        if($order->create() === false) {
            //返回失败信息
            $this->db->rollback();

            return $this->error($order);
        }
          
        // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
        $detail_id_array = [];
        foreach ($submitData['list'] as $k => $item) {
            // 使用模型更新
            $data = [
                'number' => $item['number'],
                'companyid' => $this->companyid,
                'orderdetailsid' => $item['orderdetailsid'],
                'warehousingid' => $order->id,
                'confirmorderdetailsid'=> $item['confirmorderdetailsid']
            ];           

            if ($order->addDetail($data)===false) {
                $this->db->rollback();
                return $this->error("#1002#入库单明细添加失败#");
            }
        }

        // 提交事务
        $this->db->commit();

        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->reportJson(["id"=>$order->id]);
    }


    /**
     * 读取订单信息，必须传一个id参数，代表订单编号
     * @return false|string
     */
    public function loadAction()
    {
        $result = [];
        // 根据orderid查询出当前订单以及订单详情的所有信息
        
        $id = $this->dispatcher->getParam("id", 0);
        $confirmorderid = $_POST['confirmorderid'];

        $warehousing = TbWarehousing::findFirst(
            sprintf("(id=%d or confirmorderid=%d) and companyid=%d", $id, $confirmorderid, $this->companyid)
        );

        if ($warehousing!=false) {
            $result['form'] = $warehousing->toArray();
            $result['confirmorder'] = $warehousing->confirmorder->toArray();

            $result['list'] = $warehousing->confirmorder->confirmorderdetails->toArray();

        } 
        else {
            $confirmorder = TdConfirmorder::findFirst(
                sprintf("id=%d and companyid=%d", $confirmorderid, $this->companyid)
            );

            if ($confirmorder!=false) {
                $result['confirmorder'] = $confirmorder->toArray();

                $result['list'] = $confirmorder->confirmorderdetails->toArray();
            }
            else {
                $this->debug("参数错误");
                exit;
            }
        }               

        echo $this->success($result);
    }

    /**
     * 订单删除
     * @return false|string
     */
    public function deleteAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbWarehousing::findFirst(
            sprintf("id=%d and companyid=%d", $_GET["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($order!=false && $order->status!=1) {
            $this->doTableAction($order,"delete");
        }
    }
}
