<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbProductstock;
use Asa\Erp\TbRequisition;
use Exception;

/**
 * 调拨单主表，这个主要用户调拨简单模型使用，重写了 RequisitionController 的部分方法
 * Class RequisitionController
 * @package Multiple\Home\Controllers
 */
class RequisitionsimpleController extends RequisitionController
{
    /**
     * 生成调拨单
     *
     * @return false|string
     * @throws Exception
     */
    public function saveAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            $msg = $this->getValidateMessage('order-params', 'template', 'required');
            return $this->error([$msg]);
        }
        // 转换成数组
        $submitData = json_decode($params, true);

        $array = [];
        foreach ($submitData['list'] as $row) {
            $key = sprintf("%d_%d", $row['out_id'], $row["in_id"]);
            if (isset($array[$key])) {
                $array[$key][] = $row;
            } else {
                $array[$key] = [$row];
            }
        }

        // 采用事务处理
        $this->db->begin();

        try {
            foreach ($array as $key => $rows) {
                $temp = explode('_', $key);

                $requisition = new TbRequisition();
                // 状态，之前的状态出库待确认，但是这个是简单模型，出库就代表直接调拨完成了，所以状态直接就是完毕5
                $requisition->status = TbRequisition::STATUS_FINISHED;
                $requisition->out_id = $temp[0];
                $requisition->in_id = $temp[1];
                // 制单人及制单时间
                $requisition->apply_staff = $this->currentUser;
                $requisition->apply_date = date('Y-m-d H:i:s');
                $requisition->memo = $submitData['memo'];
                $requisition->companyid = $this->companyid;
                // 调入、调出同时完毕
                $requisition->turnout_staff = $this->currentUser;
                $requisition->turnout_date = date('Y-m-d H:i:s');
                $requisition->turnin_staff = $this->currentUser;
                $requisition->turnin_date = date('Y-m-d H:i:s');
                // 创建
                if ($requisition->create() == false) {
                    throw new Exception('/11120101/生成调拨单失败。/');
                }

                // 增加调拨明细
                foreach ($rows as $row) {
                    $out_productstock = TbProductstock::getProductStock($row['productid'], $row['sizecontentid'], $row['out_id'], $row['property'], $row['defective_level']);
                    // 记录上面的值
                    error_log("RequisitionsimpleController => saveAction => \$out_productstock的值是：" . print_r($out_productstock->toArray(), true));
                    // 开始写入
                    $tb_requisition_detail = $requisition->addDetail([
                        // 调出仓库
                        "out_productstockid" => $out_productstock->id,
                        // 调入仓库
                        "in_productstockid"  => $requisition->inWarehouse->getLocalStock($out_productstock)->id,
                        // 调拨数量
                        "number"             => $row['number'],
                        // 调拨单id
                        "requisitionid"      => $requisition->id,
                        // 因为是立即入库，所以把出库和入库数量直接填入，相当于做了出库和入库确认
                        'out_number'         => $row['number'],
                        'in_number'          => $row['number'],
                    ]);

                    // 记录这个返回值
                    error_log('RequisitionsimpleController => saveAction => $tb_requisition_detail的值是' . print_r($tb_requisition_detail->toArray(), true));

                    // 因为调入和调出的关系，直接影响库存表的变化
                    // 判断 $requisitiontype，如果是1，则是先调出，后调入
                    // 首先从调出仓库出库
                    $tb_requisition_detail->outProductstock->preReduceStockExecute($tb_requisition_detail->out_number, TbProductstock::REQUISITION_OUT, $tb_requisition_detail->id);
                    // 然后再进入
                    $tb_requisition_detail->inProductstock->preAddStock($tb_requisition_detail->out_number, TbProductstock::REQUISITION_IN, $tb_requisition_detail->id);
                }
            }
        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        // 提交事务
        $this->db->commit();
        TbProductstock::sendStockChange();

        // 最终成功返回
        echo $this->success();
    }
}
