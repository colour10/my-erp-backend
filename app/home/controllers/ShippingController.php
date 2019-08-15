<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbShipping;
use Asa\Erp\TbShippingDetail;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\Util;
use Asa\Erp\TbCode;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbOrderBrandDetail;
use Asa\Erp\TbProduct;
use Asa\Erp\TbExchangeRate;


/**
 * 发货单主表
 * ErrorCode:1101
 */
class ShippingController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbShipping');
    }

    function addAction(){}
    function editAction(){}

    function getSearchCondition() {
        $where = array(
            sprintf("companyid=%d", $this->companyid)
        );

        $names = ['orderno', 'memo'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && trim($_POST[$name])!="") {
                $where[] = sprintf("%s like '%%%s%%'", $name, addslashes(strtoupper($_POST[$name])));
            }
        }


        $names = ['warehouseid', 'ageseason', 'supplierid', 'seasontype', 'bussinesstype', 'property', 'status'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isInclude($name, $_POST[$name]);
            }
        }

        return implode(' and ', $where);
    }

    function saveAction() {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);
        $form = $submitData['form'];

        // 采用事务处理
        $this->db->begin();

        if($form['id']>0) {
            $shipping = TbShipping::findFirstById($form['id']);
            if($shipping==false || $shipping->companyid!=$this->companyid) {
                throw new \Exception("/11010101/发货单不存在。/");
            }

            if($shipping->status==2) {
                throw new \Exception("/11010102/发货单已经入库，不能修改。/");
            }

            $shipping->supplierid = $form["supplierid"];
            $shipping->finalsupplierid = $form["finalsupplierid"];
            $shipping->ageseason = $form["ageseason"];
            $shipping->seasontype = $form["seasontype"];
            $shipping->property = $form["property"];
            $shipping->currency = $form["currency"];
            $shipping->bussinesstype = $form["bussinesstype"];
            $shipping->warehouseid = $form["warehouseid"];
            $shipping->total = $form["total"];
            $shipping->exchangerate = $form["exchangerate"];
            $shipping->paydate = $form["paydate"];
            $shipping->apickingdate = $form["apickingdate"];
            $shipping->flightno = $form["flightno"];
            $shipping->flightdate = $form["flightdate"];
            $shipping->mblno = $form["mblno"];
            $shipping->hblno = $form["hblno"];
            $shipping->dispatchport = $form["dispatchport"];
            $shipping->deliveryport = $form["deliveryport"];
            $shipping->box_number = $form["box_number"];
            $shipping->weight = $form["weight"];
            $shipping->volume = $form["volume"];
            $shipping->chargedweight = $form["chargedweight"];
            $shipping->transcompany = $form["transcompany"];
            $shipping->invoiceno = $form["invoiceno"];
            $shipping->aarrivaldate = $form["aarrivaldate"];
            $shipping->buyerid = $form["buyerid"];
            $shipping->sellerid = $form["sellerid"];
            $shipping->transporttype = $form["transporttype"];
            $shipping->paytype = $form["paytype"];
            $shipping->estimatedate = $form["estimatedate"];

            if($shipping->update() === false) {
                //返回失败信息
                $this->db->rollback();
                return $this->error($shipping);
            }

            // 开始写入订单详情表
            $change = [];
            $detail_id_array = [];
            foreach ($submitData['list'] as $k => $item) {
                if($item["id"]>0) {
                    $detail = TbShippingDetail::findFirstById($item["id"]);
                    if($detail==false) {
                        throw new \Exception("/11010103/发货单明细数据不存在。/");
                    }

                    $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] - $detail->number : $item['number'] - $detail->number;

                    $detail->discount = $item['discount'];
                    $detail->number = $item['number'];
                    if($detail->update()==false) {
                        $this->db->rollback();
                        throw new \Exception("/11010104/更新发货单明细失败/");
                    }
                }
                else {
                    $detail = new TbShippingDetail();
                    $detail->productid = $item['productid'];
                    $detail->sizecontentid = $item['sizecontentid'];
                    $detail->number = $item['number'];
                    $detail->discount = $item['discount'];
                    $detail->price = $item['price'];
                    $detail->currencyid = TbProduct::getInstance($item['productid'])->factorypricecurrency;
                    $detail->createdate = date("Y-m-d H:i:s");
                    $detail->orderdetailid = $item['orderdetailid'];
                    $detail->orderid = $item['orderid'];
                    $detail->orderbranddetailid = $item['orderbranddetailid'];
                    $detail->orderbrandid = $item['orderbrandid'];
                    $detail->shippingid= $shipping->id;
                    if($detail->create()==false) {
                        $this->db->rollback();
                        throw new \Exception("/11010105/添加发货单明细失败/");
                    }

                    $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] : $item['number'];
                }

                $detail_id_array[] = $detail->id;
            }

            //删除那些不在列表中的明细数据
            if(count($detail_id_array)>0) {
                $deleteDetails = TbShippingDetail::find(
                    sprintf('shippingid=%d and id not in (%s)', $shipping->id, implode(",", $detail_id_array))
                );

                foreach($deleteDetails  as $detail) {
                    $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] - $detail->number : $detail->number *-1;
                    if($detail->delete()==false) {
                        $this->db->rollback();
                        throw new \Exception("/11010106/删除发货单明细失败/");
                    }
                }
            }


            //更新订单明细中的，brand_number 字段
            foreach($change as $orderbranddetailid=>$number) {
                $orderDetail = TbOrderBrandDetail::findFirstById($orderbranddetailid);
                if($orderDetail!=false) {
                    $orderDetail->shipping_number = $orderDetail->shipping_number + $number;
                    if($orderDetail->update() === false) {
                        //返回失败信息
                        $this->db->rollback();
                        throw new \Exception("/11010107/更新客户端订单明细失败/");
                    }
                }
                else {
                    throw new \Exception("/11010108/客户端订单明细不存在。/");
                }
            }
        }
        else {
            $shipping = new TbShipping();
            $shipping->status = 1;
            $shipping->supplierid = $form["supplierid"];
            $shipping->finalsupplierid = $form["finalsupplierid"];
            $shipping->ageseason = $form["ageseason"];
            $shipping->seasontype = $form["seasontype"];
            $shipping->property = $form["property"];
            $shipping->currency = $form["currency"];
            $shipping->bussinesstype = $form["bussinesstype"];
            $shipping->warehouseid = $form["warehouseid"];
            $shipping->total = $form["total"];
            $shipping->exchangerate = $form["exchangerate"];
            $shipping->paydate = $form["paydate"];
            $shipping->apickingdate = $form["apickingdate"];
            $shipping->flightno = $form["flightno"];
            $shipping->flightdate = $form["flightdate"];
            $shipping->mblno = $form["mblno"];
            $shipping->hblno = $form["hblno"];
            $shipping->dispatchport = $form["dispatchport"];
            $shipping->deliveryport = $form["deliveryport"];
            $shipping->box_number = $form["box_number"];
            $shipping->weight = $form["weight"];
            $shipping->volume = $form["volume"];
            $shipping->chargedweight = $form["chargedweight"];
            $shipping->transcompany = $form["transcompany"];
            $shipping->invoiceno = $form["invoiceno"];
            $shipping->aarrivaldate = $form["aarrivaldate"];
            $shipping->buyerid = $form["buyerid"];
            $shipping->sellerid = $form["sellerid"];
            $shipping->transporttype = $form["transporttype"];
            $shipping->paytype = $form["paytype"];
            $shipping->estimatedate = $form["estimatedate"];

            // 添加制单人及制单日期
            $shipping->makestaff = $this->currentUser;
            $shipping->maketime = date('Y-m-d H:i:s');
            $shipping->companyid = $this->companyid;
            // 生成订单号
            $shipping->orderno = TbCode::getCode($this->companyid, "SO", date("y"));
            if($shipping->create() === false) {
                //返回失败信息
                $this->db->rollback();
                return $this->error($shipping);
            }

            // 开始写入订单详情表
            $change = [];
            foreach ($submitData['list'] as $k => $item) {
                $detail = new TbShippingDetail();
                $detail->productid = $item['productid'];
                $detail->sizecontentid = $item['sizecontentid'];
                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->price = $item['price'];
                $detail->currencyid = TbProduct::getInstance($item['productid'])->factorypricecurrency;
                $detail->createdate = date("Y-m-d H:i:s");
                $detail->orderdetailid = $item['orderdetailid'];
                $detail->orderid = $item['orderid'];
                $detail->orderbranddetailid = $item['orderbranddetailid'];
                $detail->orderbrandid = $item['orderbrandid'];
                $detail->shippingid= $shipping->id;
                if($detail->create()==false) {
                    $this->db->rollback();
                    throw new \Exception("/11010109/添加发货单明细失败/");
                }

                $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] : $item['number'];
            }

            //更新订单明细中的，brand_number 字段
            foreach($change as $orderbranddetailid=>$number) {
                $orderDetail = TbOrderBrandDetail::findFirstById($orderbranddetailid);
                if($orderDetail!=false) {
                    $orderDetail->shipping_number = $orderDetail->shipping_number + $number;
                    if($orderDetail->update() === false) {
                        //返回失败信息
                        $this->db->rollback();
                        throw new \Exception("/11010110/更新客户端订单明细失败/");
                    }
                }
                else {
                    throw new \Exception("/11010111/客户端订单明细不存在。/");
                }
            }
        }

        // 提交事务
        $this->db->commit();
        return $this->success($shipping->getDetail());
    }

    function loadAction() {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($shipping!=false) {
            //echo $this->success($shipping->getDetail(isset($_POST["type"]) && $_POST["type"]=='shipping'));
            echo $this->success($shipping->getDetail());
        }
    }

    public function deleteAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($shipping!=false) {
            if($shipping->status==2) {
                throw new \Exception("/11010701/已经入库的发货单不能删除。/");
            }

            $this->db->begin();
            $details = $shipping->shippingDetail;
            foreach ($details as $detail) {
                //更新品牌订单明细中的发货数量
                if($detail->orderbranddetailid>0) {
                    $orderbranddetail = TbOrderBrandDetail::findFirstById($detail->orderbranddetailid);
                    if($orderbranddetail!=false) {
                        $orderbranddetail->shipping_number = $orderbranddetail->shipping_number - $detail->number;
                        if($orderbranddetail->update() === false) {
                            //返回失败信息
                            $this->db->rollback();
                            throw new \Exception("/11010702/更新品牌订单明细失败。/");
                        }
                    }
                    else {
                        throw new \Exception("/11010703/客户订单明细不存在。/");
                    }
                }


                if($detail->delete()==false) {
                    $this->db->rollback();
                    throw new \Exception("/11010704/删除订单明细失败。/");
                }
            }

            if($shipping->delete()==false) {
                $this->db->rollback();
                throw new \Exception("/11010705/发货单删除失败。/");
            }

            $this->db->commit();

            return $this->success();
        }
        else {
            throw new \Exception("/11010706/发货单不存在。/");
        }
    }

    function confirmAction() {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        // 判断是否有订单号，分别进行
        $id = $submitData['form']['id'];
        // 采用事务处理
        $this->db->begin();
        $form = $submitData['form'];

        // 判断逻辑
        if ($id) {
            $shipping = TbShipping::findFirst(
                sprintf("id=%d and companyid=%d", $id, $this->companyid)
            );

            if(!$shipping) {
                throw new \Exception("/110111/发货单不存在/");
            }
            $shipping->confirmstaff = $this->currentUser;
            $shipping->confirmtime = date('Y-m-d H:i:s');
            $shipping->status = 2;

            // 判断是否成功
            if(!$shipping->save()) {
                $this->db->rollback();

                // 验证类错误给出提示
                return $this->error($shipping);
            }

            foreach ($submitData['list'] as $k => $item) {
                // 使用模型更新
                if($item['id']>0) {
                    $detail = TbShippingDetail::findFirstById($item['id']);

                    if($detail==false || $detail->shippingid!=$shipping->id) {
                        $this->db->rollback();
                        throw new \Exception("/110112/入库单详情错误/");
                    }
                }
                else {
                    $detail = new TbShippingDetail();
                    $detail->companyid = $this->companyid;
                    $detail->number = 0;
                    $detail->productid = $item['productid'];
                    $detail->sizecontentid = $item['sizecontentid'];
                    $detail->price = $item['price'];
                    $detail->currencyid = TbProduct::getInstance($item['productid'])->factorypricecurrency;
                    $detail->discount = $item['discount'];
                    $detail->createdate = date('Y-m-d H:i:s');
                    $detail->shippingid = $shipping->id;
                    $detail->orderid = 0;
                    $detail->orderdetailid = 0;
                    $detail->orderbrandid = 0;
                    $detail->orderbranddetailid = 0;
                }

                $detail->warehousingnumber = $item['number'];


                if($detail->save()==false) {
                    $this->db->rollback();
                    throw new \Exception("/110113/入库单详情入库数量更新失败/");
                }
            }

            // 提交事务
            $this->db->commit();

            // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
            echo $this->success();
        }
    }

    /**
     * 取消确认
     * @return [type] [description]
     */
    function cancelconfirmAction() {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if($shipping==false) {
            throw new \Exception("/110111/发货单不存在/");
        }

        $this->db->begin();

        $shipping->status = 1;
        $shipping->warehousingstaff = $this->currentUser;
        $shipping->warehousingtime = date('Y-m-d H:i:s');
        if($shipping->save()==false) {
            throw new \Exception("/101115/发货单取消入库失败。/");
        }

        foreach($shipping->shippingDetail as $detail) {
            $detail->warehousingnumber = 0;

            if($detail->orderid==0) {
                if($detail->delete()==false) {
                    $this->db->rollback();
                    throw new \Exception("/101116/删除发货单明细失败。/");
                }
            }
            else {
                if($detail->save()==false) {
                    $this->db->rollback();
                    throw new \Exception("/101116/发货单明细取消入库失败。/");
                }
            }
        }

        $this->db->commit();
        return $this->success();
    }

    /**
     * 入库，修改库存并摊销费用
     * @return [type] [description]
     */
    function warehousingAction() {
        $this->db->begin();

        $shipping = $this->saveinfo();

        $total_number = 0;//总数量
        $total_amount = 0;//总金额
        $exchangerate = $shipping->exchangerate;

        if($exchangerate<=0) {
            throw new \Exception('/11011209/汇率不合法。/');
        }

        //本币id
        $auth = $this->auth;
        if(isset($auth['company']) && isset($auth['company']->currencyid)) {
            $currencyid = $auth['company']->currencyid;
        }
        else {
            $this->db->rollback();
            throw new \Exception("/11011203/没有设置本币，不能计算成本/");
        }

        //货币单位跟入库单保持一致
        $product_array = $shipping->getCostList();

        //计算每件商品摊销后的成本
        $prodctstocks = TbProductstock::sum([
            sprintf("productid in (%s)", implode(",", array_keys($product_array))),
            "column" => "number",
            "group" => "productid"
        ]);

        $array = [];
        foreach($product_array as $productid=>$row) {
            $array[$productid] = [
                "amount" => $row['amount'] * $exchangerate,
                "number" => $row['number']
            ];
        }

        foreach($prodctstocks as $row) {
            $product = TbProduct::getInstance($row->productid);
            if($product==false) {
                $this->db->rollback();
                throw new \Exception("/11011205/商品信息不存在。/");
            }

            //当前库存的商品总价，全部转化成本币
            if(isset($array[$row->productid])) {
                $array[$row->productid]['amount'] += $product->cost*$row->sumatory;
                $array[$row->productid]['number'] += $row->sumatory;
            }
            else {
                $array[$row->productid] = [
                    "amount" => $product->cost*$row->sumatory,
                    "number" => $row->sumatory
                ];
            }
        }

        //print_r($array);exit;
        foreach($array as $productid=>$row) {
            $product = TbProduct::getInstance($productid);

            if($product && $row["number"]>0) {
                $product->cost = round($row['amount']/$row["number"], 2);

                $product->costcurrency = $currencyid;
                $product->laststoragedate = date("Y-m-d H:i:s");
                if($product->update()===false) {
                    $this->db->rollback();
                    throw new \Exception("/11011206/更新商品成本失败/");
                }
            }
        }

        foreach($shipping->shippingDetail as $detail) {
            //增加库存
            if($detail->warehousingnumber>0) {
                $productStock = $detail->getProductStock();
                $ret = $productStock->addStock($detail->warehousingnumber, TbProductstock::WAREHOSING, $detail->id);
                if($ret===false) {
                    $this->db->rollback();
                    throw new \Exception("/11011207/发货单入库更新库存失败。/");
                }

                $row = $product_array[$detail->productid];
                $detail->cost = round($row['amount']/$row["number"],2);
                $detail->costcurrency = $currencyid;
                if($detail->update()===false) {
                    $this->db->rollback();
                    throw new \Exception("/11011208/更新发货单明细失败。/");
                }
            }
        }

        $shipping->status = 3;
        $shipping->warehousingstaff = $this->currentUser;
        $shipping->warehousingtime = date('Y-m-d H:i:s');
        if($shipping->save()==false) {
            throw new \Exception("/11011202/发货单入库失败。/");
        }

        $this->db->commit();
        TbProductstock::sendStockChange();
        return $this->success();
    }

    /**
     * 取消入库
     * @return [type] [description]
     */
    function cancelAction() {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if($shipping==false) {
            throw new \Exception("/11011301/发货单不存在/");
        }

        $this->db->begin();

        if($shipping->status!=3) {
            throw new \Exception("/11011302/发货单不存在/");
        }

        //本币id
        $auth = $this->auth;
        if(isset($auth['company']) && isset($auth['company']->currencyid)) {
            $currencyid = $auth['company']->currencyid;
        }
        else {
            $this->db->rollback();
            throw new \Exception("/11011303/没有设置本币，不能计算成本/");
        }

        $costList = $shipping->getCostList();
        $prodctstocks = TbProductstock::sum([
            sprintf("productid in (%s)", implode(",", array_keys($costList))),
            "column" => "number",
            "group" => "productid"
        ]);

        //修改商品信息的成本价
        foreach($prodctstocks as $row) {
            $product = TbProduct::getInstance($row['productid']);

            if($product->costcurrency>0) {
                // 计算当前库存里的商品的总价格,本币
                $amount = $product->cost*$row->sumatory;

                // 开始计算，取消入库后的剩余库存商品的价格
                $info = $costList[$row->productid];

                //如果库存商品数量跟要取消入库的商品数量相同，需要再看一下商品总价格是否相同
                //  如果相同，说明是第一次进该商品，取消入库后，商品的库存数量为零，成本价没有意义了。
                //  如果库存数量大于要取消的商品数量，则计算摊销费用，减库存即可
                //  如果库存数量小于要取消的商品数量，则不能取消
                if($row->sumatory-$info['number']===0) {
                    // do nothing
                    continue;
                }
                else if($row->sumatory-$info['number']>0) {
                    $product->cost = round(($amount-$info['amount']*$shipping->exchangerate)/($row->sumatory-$info['number']),2);
                }
                else {
                    throw new \Exception("/11011309/库存不足，不能取消/");
                }

                //$product->costcurrency = $currencyid;
                //echo round(($amount['number']-$info['amount'])/($row->sumatory-$info['number']),2);
                if($product->update()===false) {
                    $this->db->rollback();
                    throw new \Exception("/11011304/更新发货单明细失败。/");
                }
            }
            else {
                $this->db->rollback();
                throw new \Exception("/11011305/数据错误。/");
            }
        }

        //检查库存是否足够取消。
        foreach($shipping->shippingDetail as $detail) {
            //减掉库存
            if($detail->warehousingnumber>0) {
                $productStock = $detail->getProductStock();
                $ret = $productStock->reduceStock($detail->warehousingnumber, TbProductstock::WAREHOSING, $detail->id);
                if($ret===false) {
                    throw new \Exception("/11011306/库存不足，不能取消。/");
                }
            }

            $detail->cost = 0;
            $detail->costcurrency = 0;

            if($detail->save()==false) {
                $this->db->rollback();
                throw new \Exception("/11011307/发货单明细取消入库失败。/");
            }
        }

        $shipping->status = 2;
        if($shipping->save()==false) {
            $this->db->rollback();
            throw new \Exception("/11011308/发货单取消入库失败。/");
        }

        $this->db->commit();
        TbProductstock::sendStockChange();
        return $this->success();
    }

    /**
     * 返回入库单费用统计，分别统计按数量摊销费用总和和按金额摊销费用总和
     */
    /*function feesumAction() {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if($shipping==false) {
            throw new \Exception("/11011401/发货单不存在/");
        }

        $by_number = 0;
        $by_amount = 0;
        foreach ($shipping->shippingFee as $shippingFee) {
            if($shippingFee->feename->is_amortize==1) {
                $fee_amount = TbExchangeRate::convert($this->companyid, $shippingFee->currencyid, $shipping->currency, $shippingFee->amount);

                if($shippingFee->feename->amortize_type==1) {
                    // 按数量摊销
                    $by_number += $fee_amount['number'];
                }
                else {
                    // 按金额摊销
                    $by_amount += $fee_amount['number'];
                }
            }
        }

        return $this->success([
            'by_number' => $by_number,
            'by_amount' => $by_amount,
        ]);
    }*/

    /**
     * 保存入库单的基本信息
     * @return [type] [description]
     */
    function saveinfoAction() {
        $this->saveinfo();
        return $this->success();
    }

    function orderbrandlistAction() {
        $shipping = TbShipping::findFirstById($_POST['id']);
        if($shipping!=false && $shipping->companyid==$this->companyid) {
            return $this->success($shipping->getOrderbrandList());
        }
        else {
            throw new \Exception("/11011601/发货单不存在/");
        }
    }

    private function saveinfo() {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if($shipping==false) {
            throw new \Exception("/11011501/发货单不存在/");
        }

        $shipping->supplierid = $_POST["supplierid"];
        $shipping->finalsupplierid = $_POST["finalsupplierid"];
        $shipping->ageseason = $_POST["ageseason"];
        $shipping->seasontype = $_POST["seasontype"];
        $shipping->property = $_POST["property"];
        $shipping->currency = $_POST["currency"];
        $shipping->bussinesstype = $_POST["bussinesstype"];
        $shipping->warehouseid = $_POST["warehouseid"];
        // $shipping->total = $_POST["total"];
        $shipping->exchangerate = $_POST["exchangerate"];
        $shipping->paydate = $_POST["paydate"];
        $shipping->apickingdate = $_POST["apickingdate"];
        $shipping->flightno = $_POST["flightno"];
        $shipping->flightdate = $_POST["flightdate"];
        $shipping->mblno = $_POST["mblno"];
        $shipping->hblno = $_POST["hblno"];
        $shipping->dispatchport = $_POST["dispatchport"];
        $shipping->deliveryport = $_POST["deliveryport"];
        $shipping->box_number = $_POST["box_number"];
        $shipping->weight = $_POST["weight"];
        $shipping->volume = $_POST["volume"];
        $shipping->chargedweight = $_POST["chargedweight"];
        $shipping->transcompany = $_POST["transcompany"];
        $shipping->invoiceno = $_POST["invoiceno"];
        $shipping->aarrivaldate = $_POST["aarrivaldate"];
        $shipping->buyerid = $_POST["buyerid"];
        $shipping->sellerid = $_POST["sellerid"];
        $shipping->transporttype = $_POST["transporttype"];
        $shipping->paytype = $_POST["paytype"];
        $shipping->estimatedate = $_POST["estimatedate"];

        if($shipping->update()==false) {
            throw new \Exception("/11011502/更新发货单基本信息失败。/");
        }

        return $shipping;
    }
}
