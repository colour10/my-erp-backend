<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbRequisition;
use Asa\Erp\TbRequisitionDetail;
use Asa\Erp\TbProductstock;

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
                $out_productstock = TbProductstock::findFirstById($row['productstockid']);

                if($out_productstock!=false) {
                    $data = [
                        "out_productstockid" => $out_productstock->id,
                        "in_productstockid" => $requisition->inWarehouse->getLocalStock($out_productstock)->id,
                        "number" => $row['number'],
                        "requisitionid" => $requisition->id
                    ];
                    $result = $requisition->addDetal($data);
                    if($result===false) {
                        $this->db->rollback();
                        return $this->error($result);
                    }
                }
                else {
                    $this->db->rollback();
                    return $this->error(["operate_fail"]);
                }
            }
        }

        // 提交事务
        $this->db->commit();
        // 最终成功返回
        echo $this->success();
    }

    function loadAction() {
        $requisition = TbRequisition::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if($requisition!=false) {
            echo $this->success($requisition->getDetail());
        }
        else {
            throw new \Exception("/1001/调拨单不存在/");
        }
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
                echo $this->success($requisition->getDetail());
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
                echo $this->success($requisition->getDetail());
            }
            else {
                echo $this->error(['fail']);
            }
        }
    }
}
