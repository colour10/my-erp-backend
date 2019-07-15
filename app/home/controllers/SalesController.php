<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSales;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;
use Asa\Erp\TbSalesdetails;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbCode;


/**
 * 销售单主表
 * ErrorCode 1107
 */
class SalesController extends BaseController
{
    // 销售单参数
    protected $saleParams;
    // 销售单id
    protected $salesid;
    // 销售单号
    protected $saleno;
    // 当前用户
    protected $userid;

    public function initialize()
    {
        parent::initialize();

        // 当前用户
        $this->userid = $this->auth['id'];
    }

    public function pageAction() {
        $params = [$this->getSearchCondition()];
        $params["order"] = "id desc";

        $result = TbSales::find($params);

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
        }

        $names = ['bookingid', 'ageseason', 'supplierid', 'seasontype', 'bussinesstype', 'property'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isInclude($name, $_POST[$name]);
            }
        }

        $names = ['brandids'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isMatch($name, $_POST[$name]);
            }
        }*/

        //echo implode(' and ', $where);
        return implode(' and ', $where);
    }

    /**
     * 销售单已售后，可以修改销售单的部分信息
     * @return [type] [description]
     */
    function saveAction() {
        $this->db->begin();
        try {
            $params = $this->request->get('params');
            if (!$params) {
                throw new \Exception("/11070101/参数错误/");
            }
            // 转换成数组
            $submitData = json_decode($params, true);



            $sale = TbSales::findFirst(
                sprintf("id=%d and companyid=%d", $submitData['form']['id'], $this->companyid)
            );


            if($sale==false || $sale->status!='2') {
                throw new \Exception("/11070601/销售单不存在。/");
            }

            $columns =["memberid", "salesstaff", "externalno", "salesdate", "ordercode", "pickingtype", "expresspaidtype", "expressno", "expressfee", "address", "saleportid"];

            // 开始更新
            foreach ($submitData['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                if(in_array($k, $columns)) {
                    $sale->$k = $item;
                }
            }

            if($sale->update()==false) {
                throw new \Exception("/11070602/销售单更新失败。/");
            }

            foreach ($submitData['list'] as $k => $item) {
                $detail = TbSalesdetails::findFirstById($item['id']);
                if($detail!=false) {
                    if($detail->dealprice!=$item["dealprice"]) {
                        $detail->dealprice = $item["dealprice"];
                        if($detail->update()===false) {
                            throw new \Exception("/11070603/销售明细更新失败。/");
                        }
                    }
                }
                else {
                    throw new \Exception("/11070604/销售明细不存在。/");
                }
            }
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
        echo $this->success();
    }


    /**
     * 销售单保存
     */
    public function savesaleAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/11070101/参数错误/");
        }
        // 转换成数组
        $submitData = json_decode($params, true);

        // 判断逻辑
        if ($submitData['form']['id']>0) {
            $sale = $this->updateSales($submitData);
        }
        else {
            $sale = $this->createSales($submitData);
        }

        // 取出单个模型及下级销售单详情逻辑
        echo $this->success($sale->getOrderDetail());
    }

    private function createSales($submitData) {
        $this->db->begin();
        try {
            $sale = new TbSales();

            // 开始更新
            foreach ($submitData['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                $sale->$k = $item;
            }

            $sale->companyid = $this->companyid;
            $sale->makestaff = $this->currentUser;
            $sale->makedate = date('Y-m-d H:i:s');
            // 生成订单号
            $sale->orderno = TbCode::getCode($this->companyid, "S", date("y"));

            if($sale->create()==false) {
                throw new \Exception("/11070201/销售单生成失败。/");
            }

            $array = [];
            foreach ($submitData['list'] as $k => $item) {
                // 使用模型更新
                $fromProductstock = TbProductstock::findFirstById($item['productstockid']);
                if($fromProductstock->warehouseid!=$sale->warehouseid) {
                    $productstock = $sale->warehouse->getLocalStock($fromProductstock);
                }
                else {
                    $productstock = $fromProductstock;
                }

                $data = [
                    'productstockid' => $item['productstockid'],
                    'dealprice' => $item['dealprice'],
                    'number' => $item['number'],
                    'price' => $item['price'],
                    'priceid' => $item['priceid'],
                    'salesid' => $sale->id
                ];
                $detail = $sale->addDetail($data);

                if($detail===false) {
                    throw new \Exception("/11070202/销售单明细更新失败。/");
                }

                //本地锁定库存
                $productstock->preReduceStock($detail->number, TbProductstock::SALES, $detail->id);

                //如果不在同一个仓库，则自动生成调拨单
                if($fromProductstock->warehouseid!=$sale->warehouseid) {
                    $key = $fromProductstock->warehouseid ."_". $sale->warehouseid;
                    if(!isset($array[$key])) {
                        $array[$key] = [];
                    }
                    $array[$key][] = [
                        "productstockid" => $item['productstockid'],
                        "number" => $item['number']
                    ];
                }
            }

            //生成调拨单
            foreach($array as $key=>$rows) {
                $temp = explode("_", $key);

                \Asa\Erp\TbRequisition::addRequisition($temp[0], $temp[1], $rows);
            }
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
        return $sale;
    }

    private function updateSales($submitData) {
        $this->db->begin();

        $sale = TbSales::findFirst(
            sprintf("id=%d and companyid=%d", $submitData['form']['id'], $this->companyid)
        );

        try {
            if($sale==false) {
                throw new \Exception("/11070301/销售单不存在。/");
            }

            $columns =["memberid", "salesstaff", "externalno", "salesdate", "ordercode", "pickingtype", "expresspaidtype", "expressno", "expressfee", "address", "warehouseid", "saleportid", "discount", "status", "priceid"];

            // 开始更新
            foreach ($submitData['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                if(in_array($k, $columns)) {
                    $sale->$k = $item;
                }
            }

            if($sale->update()==false) {
                $this->db->rollback();
                throw new \Exception("/11070302/销售单更新失败。/");
            }

            //只有预售状态的销售单才可以更改详情
            if($sale->status==1 || $sale->status=='1') {
                $detail_id_array = [];
                foreach ($submitData['list'] as $k => $item) {
                    // 使用模型更新


                    if(isset($item['id']) && $item['id']>0) {
                        $detail = TbSalesdetails::findFirstById($item['id']);
                        $oldNumber = $detail->number;
                        if($oldNumber!=$item['number'] || $detail->price!=$item['price'] || $detail->priceid!=$item['priceid']) {
                            $detail->dealprice = $item["dealprice"];
                            $detail->number = $item["number"];
                            if($detail!=false) {
                                if($detail->update()===false) {
                                    throw new \Exception("/11070303/销售明细更新失败。/");
                                }
                            }
                            else {
                                throw new \Exception("/11070304/销售明细不存在。/");
                            }

                            if($oldNumber!=$data['number']) {
                                //更新库存锁定
                                $detail->getLocalProductstock()->preReduceStock($detail->number-$oldNumber, TbProductstock::SALES, $detail->id);
                            }
                        }
                    }
                    else {
                        $data = [
                            'productstockid' => $item['productstockid'],
                            'dealprice' => $item['dealprice'],
                            'number' => $item['number'],
                            'price' => $item['price'],
                            'priceid' => $item['priceid'],
                            'salesid' => $sale->id
                        ];
                        $detail = $sale->addDetail($data);

                        //锁定库存
                        $detail->getLocalProductstock()->preReduceStock($detail->number, TbProductstock::SALES, $detail->id);

                        //如果不在同一个仓库，则自动生成调拨单
                        if($detail->productstock->warehouseid!=$sale->warehouseid) {
                            $key = $detail->productstock->warehouseid ."_". $sale->warehouseid;
                            if(!isset($array[$key])) {
                                $array[$key] = [];
                            }
                            $array[$key][] = [
                                "productstockid" => $item['productstockid'],
                                "number" => $item['number']
                            ];
                        }
                    }

                    $detail_id_array[] = $detail->id;
                }

                //清除不存在的详情id
                if(count($detail_id_array)>0) {
                    $details = TbSalesdetails::find(
                        sprintf("salesid=%d and id not in(%s)", $sale->id, implode(",", $detail_id_array))
                    );
                    foreach($details as $detail) {
                        //取消锁定库存
                        $detail->getLocalProductstock()->preReduceStockCancel($detail->number, TbProductstock::SALES, $detail->id);

                        //删除销售单明细
                        if($detail->delete()===false) {
                            throw new \Exception("/11070305/销售明细删除失败。/");
                        }
                    }
                }
            }
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
        return $sale;
    }

    /**
     * 将销售单的预售状态改成销售状态
     */
    public function saleAction() {
        $id = $_POST["id"];
        $sale = TbSales::findFirstById($id);

        $this->db->begin();
        try {
            if($sale!=false || $sale->status!=1) {
                $sale->status = 2;
                if($sale->update()==false) {
                    throw new \Exception("/11070401/销售单更新失败。/");
                }

                foreach($sale->salesdetails as $detail) {
                    $detail->getLocalProductstock()->preReduceStockExecute($detail->number, TbProductstock::SALES, $detail->id);
                }
            }
            else {
                throw new \Exception("/11070401/销售单不存在。/");
            }
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
        echo $this->success();
    }


    /**
     * 读取销售单信息，必须传一个id参数，代表销售单编号
     * @return false|string
     */
    public function loadsaleAction()
    {
        $order = TbSales::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($order!=false) {
            echo $this->success($order->getOrderDetail());
        }
    }

    /**
     * 销售单作废
     * @return false|string
     */
    public function cancelAction() {
        $salesid = $this->request->get('id');
        // 根据salesid查询出当前销售单以及销售单详情的所有信息
        $sale = TbSales::findFirstById($salesid);


        $this->db->begin();
        try {
            // 判断销售单是否存在
            if(!$sale) {
                throw new Exception("/11070501/销售单不存在。/");
            }

            foreach($sale->salesdetails as $detail) {
                $detail->getLocalProductstock()->preReduceStockCancel($detail->number, TbProductstock::SALES, $detail->id);
            }

            $sale->status = 3;
            if($sale->update()===false) {
                throw new \Exception("/11070502/销售单更新失败。/");
            }
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
        echo $this->success();
    }

    /**
     * 订单提交生效以后的修改
     * @return [type] [description]
     */
    private function save($sale, $form) {
        $columns =["memberid", "salesstaff", "externalno", "salesdate", "ordercode", "pickingtype", "expresspaidtype", "expressno", "expressfee", "address"];
        // 开始更新
        foreach ($form as $k => $item) {
            // 把里面的参数转成post参数传递过去
            if(in_array($k, $columns)) {
                $sale->$k = $item;
            }
        }

        if($sale->update()==false) {
            return $this->error(['updage-fail']);
        }
        else {
            return $this->success($sale->getOrderDetail());
        }
    }
}
