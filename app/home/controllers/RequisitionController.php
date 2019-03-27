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
            $memo = $submitData['form']['memo'];
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
        echo $this->success($result->toArray());
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

        if($requisition!=false) {
            //如果total为0，说明全部都被拒绝了。调拨单无需拆单
            $total = $submitData['total'];
            $this->db->begin();

            if($total=='0' || $total==0) {
                $requisition->status = 1;
                if($requisition->update()==false) {
                    $this->db->rollback();
                    return $this->error($requisition);
                }
            }
            else if($total =="all") {
                //全部通过
                $requisition->status = 3;
                if($requisition->update()==false) {
                    $this->db->rollback();
                    echo $this->error($requisition);
                    return ;
                }
            }
            else {
                //需要拆单
                $apply = $submitData['list'];
                
                $details = $requisition->requisitionDetail;

                $return_array = [];
                foreach($details as $detail) {
                    if(isset($apply[$detail->id])) {
                        if($detail->number>=$apply[$detail->id]) {
                            //有一部分被拒绝了
                            //
                            $arr = $detail->toArray();
                            $arr['number'] = $detail->number-$apply[$detail->id];//拒绝的数量
                            $return_array[] = $arr;

                            $detail->out_number = $apply[$detail->id]; //出库数量
                            if($detail->update()==false) {
                                $this->db->rollback();
                                echo $this->error($detail);
                                return ;
                            }
                        }
                        else {
                            $this->db->rollback();
                            return "";
                        }
                    }
                    else {
                        $this->db->rollback();
                        return "";
                    }
                }

                //拒绝的出库明细生成另外一个单
                $newrequisition = new TbRequisition();
                $newrequisition->status = 1;
                $newrequisition->out_id = $requisition->out_id;
                $newrequisition->in_id = $requisition->in_id;
                $newrequisition->apply_staff = $requisition->apply_staff;
                $newrequisition->apply_date = $requisition->apply_date;
                $newrequisition->companyid = $requisition->companyid;
                $newrequisition->memo = "out refuse";
                if($newrequisition->create()==false) {
                    $this->db->rollback();
                    return $this->error($newrequisition);
                }

                //增加调拨明细
                foreach($return_array as $row) {
                    $data = [
                        "productid" => $row['productid'],
                        "sizecontentid" => $row['sizecontentid'],
                        "number" => $row['number'],
                        "requisitionid" => $newrequisition->id
                    ];
                    $result = $newrequisition->addDetal($data);
                    if($result!==true) {
                        $this->db->rollback();
                        return $this->error($result);
                    }
                }
            }            


            $this->db->commit();

            echo $this->success();
        }
    }

    /**
     * 确认入库
     * @return [type] [description]
     */
    function confirminAction() {

    }
}
