<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbRequisition;
use Asa\Erp\TbRequisitionDetail;

/**
 * 调拨单主表
 */
class RequisitionController extends BaseController {
    public function initialize() {
	    parent::initialize();
    }

    public function pageAction() {
        $result = TbRequisition::find(
            sprintf("companyid=%d", $this->companyid)
        );
        echo $this->success($result->toArray());
    }

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
        foreach($submitData['list'] as $row) {
            $key = sprintf("%d_%d", $row['out_id'], $row["in_id"]);
            if(isset($array[$key] )) {
                $array[$key][] = $row;
            }
            else {
                $array[$key] = [$row];
            }
        }
        // 采用事务处理
        $this->db->begin();

        foreach($array as $key => $rows) {
            $temp = explode('_', $key);

            $requisition = new TbRequisition();
            $requisition->status = 2;
            $requisition->out_id = $temp[0];
            $requisition->in_id = $temp[1];
            $requisition->apply_staff = $this->currentUser;
            $requisition->apply_date = date('Y-m-d H:i:s');
            $requisition->companyid = $this->companyid;
            if($requisition->create()==false) {
                $this->db->rollback();
                return $this->error($requisition);
            }

            //增加调拨明细
            foreach($rows as $row) {
                $data = [
                    "productid" => $row['productid'],
                    "sizecontentid" => $row['sizecontentid'],
                    "number" => $row['number'],
                    "requisitionid" => $requisition->id
                ];
                $result = $requisition->addDetal($data);
                if($result!==true) {
                    $this->db->rollback();
                    return $this->error($result);
                }
            }            
        }        

        // 提交事务
        $this->db->commit();
        // 最终成功返回
        echo $this->success();
    }

    function loadAction() {
        $result = TbRequisitionDetail::find(
            sprintf("requisitionid=%d", $_POST['requisitionid'])
        );
        //print_r($result->toArray());
        $array = [];
        foreach($result as $row) {
            $productstock = $row->productstock;
            $array[] = array_merge($productstock->toArray(), $row->toArray());
        }
        echo $this->success($array);
    }

    /**
     * 确认出库
     * @return [type] [description]
     */
    function confirmoutAction() {
        $submitData = json_decode($_POST["params"], true);
        $id = $submitData["id"];
        $requisition = TbRequisition::findFirst(
            sprintf("id=%d and companyid=%d", $submitData["id"], $this->companyid)
        );

        //print_r($submitData);

        if($requisition!=false) {            
            if($requisition->doOut($submitData['list'])) {
                echo $this->success($requisition->toArray());
            }
            else {
                echo $this->error(['fail']);
            }            
        }
    }

    /**
     * 确认入库
     * @return [type] [description]
     */
    function confirminAction() {
        $submitData = json_decode($_POST["params"], true);
        $id = $submitData["id"];
        $requisition = TbRequisition::findFirst(
            sprintf("id=%d and companyid=%d", $submitData["id"], $this->companyid)
        );

        //print_r($submitData);

        if($requisition!=false) {            
            if($requisition->doIn($submitData['list'])) {
                echo $this->success($requisition->toArray());
            }
            else {
                echo $this->error(['fail']);
            }            
        }
    }
}
