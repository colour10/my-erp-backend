<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbRequisition;
use Asa\Erp\TbRequisitionDetail;
use Asa\Erp\TbProductstock;

/**
 * 调拨单主表
 * ErrorCode 1112
 */
class RequisitionController extends BaseController {
    public function initialize() {
	    parent::initialize();
    }

    public function pageAction() {
        $params = [$this->getSearchCondition()];
        $params["order"] = "id desc";

        $result = TbRequisition::find($params);

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new \Phalcon\Paginator\Adapter\Model(
            [
                "data"  => $result,
                "limit" => $pageSize,
                "page"  => $page,
            ]
        );

        // Get the paginated results
        $pageObject = $paginator->getPaginate();

        $data = [];
        foreach($pageObject->items as $row) {
            $data[] = $row->toArray();
        }

        $pageinfo = [
            //"previous"      => $pageObject->previous,
            "current"       => $pageObject->current,
            "totalPages"    => $pageObject->total_pages,
            //"next"          => $pageObject->next,
            "total"    => $pageObject->total_items,
            "pageSize"     => $pageSize
        ];
        echo $this->reportJson(array("data"=>$data, "pagination" => $pageinfo),200,[]);
    }

    function getSearchCondition() {
        $where = array(
            sprintf("companyid=%d", $this->companyid)
        );

        /*if(isset($_POST["keyword"]) && trim($_POST["keyword"])!="") {
            $where[] = sprintf("orderno like '%%%s%%'", addslashes(strtoupper($_POST["keyword"])));
        }*/

        $names = ['out_id', 'in_id', 'status'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isInclude($name, $_POST[$name]);
            }
        }

        /*$names = ['brandids'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isMatch($name, $_POST[$name]);
            }
        }*/

        //echo implode(' and ', $where);
        return implode(' and ', $where);
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

        try {
            foreach($array as $key => $rows) {
                $temp = explode('_', $key);

                $requisition = new TbRequisition();
                $requisition->status = 2;
                $requisition->out_id = $temp[0];
                $requisition->in_id = $temp[1];
                $requisition->apply_staff = $this->currentUser;
                $requisition->apply_date = date('Y-m-d H:i:s');
                $requisition->memo = $submitData['memo'];
                $requisition->companyid = $this->companyid;
                if($requisition->create()==false) {
                    throw new \Exception('/11120101/生成调拨单失败。/');
                }

                //增加调拨明细
                foreach($rows as $row) {
                    $out_productstock = TbProductstock::getProductStock($row['productid'], $row['sizecontentid'], $row['out_id'], $row['property'], $row['defective_level']);

                    $requisition->addDetail([
                        "out_productstockid" => $out_productstock->id,
                        "in_productstockid" => $requisition->inWarehouse->getLocalStock($out_productstock)->id,
                        "number" => $row['number'],
                        "requisitionid" => $requisition->id
                    ]);
                }
            }
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        // 提交事务
        $this->db->commit();
        TbProductstock::sendStockChange();

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

    function cancelAction() {
        $submitData = json_decode($_POST["params"], true);
        $id = $submitData["id"];
        $requisition = TbRequisition::findFirst(
            sprintf("id=%d and companyid=%d", $submitData["id"], $this->companyid)
        );

        //print_r($submitData);

        if($requisition!=false) {
            $requisition->cancel();
            return $this->success($requisition->getDetail());
        }
    }
}
