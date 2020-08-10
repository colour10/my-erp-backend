<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbCode;
use Asa\Erp\TbOrderBrandDetail;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\TbShipping;
use Asa\Erp\TbShippingDetail;
use Exception;

/**
 * 发货单主表 - 和入库单是 一对一关系，这个继承自原始的 ShippingController，简化了一些流程，所以单独摘了出来
 *
 * Class ShippingsimpleController
 * @package Multiple\Home\Controllers
 */
class ShippingsimpleController extends ShippingController
{
    /**
     * 保存发货单，这个是完整的，也就是客户订单 => 品牌订单 => 发货单, 这个是保存订单即发货，入库成功，一体的，目前已经作废。
     *
     * @return false|string|void
     * @throws Exception
     */
    // public function saveAction()
    // {
    //     // 判断是否有params参数提交过来
    //     $params = $this->request->get('params');
    //     if (!$params) {
    //         throw new Exception("/1001/参数错误/");
    //     }
    //
    //     // 转换成数组
    //     $submitData = json_decode($params, true);
    //     $form = $submitData['form'];
    //
    //     // 记录下这个值，方便错误排查
    //     error_log('ShippingsimpleController => saveAction => $submitData的值是：' . print_r($submitData, true));
    //
    //     // 采用事务处理
    //     $this->db->begin();
    //
    //     // 汇率必须大于0
    //     if ($form["exchangerate"] <= 0) {
    //         throw new Exception("/11011209/汇率不合法。/");
    //     }
    //     // 赋值
    //     $exchangerate = $form["exchangerate"];
    //
    //     // 存在 id 即为编辑，否则为新建
    //     if ($form['id'] > 0) {
    //         // 判断发货单是否存在
    //         $shipping = TbShipping::findFirstById($form['id']);
    //         if ($shipping == false || $shipping->companyid != $this->companyid) {
    //             throw new Exception("/11010101/发货单不存在。/");
    //         }
    //
    //         // status = 2 代表已经入库
    //         if ($shipping->status == TbShipping::STATUS_STORAGE) {
    //             throw new Exception("/11010102/发货单已经入库，不能修改。/");
    //         }
    //
    //         // 开始更新
    //         $shipping->supplierid = $form["supplierid"];
    //         $shipping->finalsupplierid = $form["finalsupplierid"];
    //         $shipping->ageseason = $form["ageseason"];
    //         $shipping->seasontype = $form["seasontype"];
    //         $shipping->property = $form["property"];
    //         $shipping->currency = $form["currency"];
    //         $shipping->bussinesstype = $form["bussinesstype"];
    //         $shipping->warehouseid = $form["warehouseid"];
    //         $shipping->total = $form["total"];
    //         $shipping->exchangerate = $form["exchangerate"];
    //         $shipping->paydate = $form["paydate"];
    //         $shipping->apickingdate = $form["apickingdate"];
    //         $shipping->flightno = $form["flightno"];
    //         $shipping->flightdate = $form["flightdate"];
    //         $shipping->mblno = $form["mblno"];
    //         $shipping->hblno = $form["hblno"];
    //         $shipping->dispatchport = $form["dispatchport"];
    //         $shipping->deliveryport = $form["deliveryport"];
    //         $shipping->box_number = $form["box_number"];
    //         $shipping->weight = $form["weight"];
    //         $shipping->volume = $form["volume"];
    //         $shipping->chargedweight = $form["chargedweight"];
    //         $shipping->transcompany = $form["transcompany"];
    //         $shipping->invoiceno = $form["invoiceno"];
    //         $shipping->aarrivaldate = $form["aarrivaldate"];
    //         $shipping->buyerid = $form["buyerid"];
    //         $shipping->sellerid = $form["sellerid"];
    //         $shipping->transporttype = $form["transporttype"];
    //         $shipping->paytype = $form["paytype"];
    //         $shipping->estimatedate = $form["estimatedate"];
    //
    //         // 如果更新失败则回滚
    //         if ($shipping->update() === false) {
    //             //返回失败信息
    //             $this->db->rollback();
    //             return $this->error($shipping);
    //         }
    //
    //         // 开始写入订单详情表
    //         $change = [];
    //         $detail_id_array = [];
    //         foreach ($submitData['list'] as $k => $item) {
    //             // 编辑
    //             if ($item["id"] > 0) {
    //                 $detail = TbShippingDetail::findFirstById($item["id"]);
    //                 if ($detail == false) {
    //                     throw new Exception("/11010103/发货单明细数据不存在。/");
    //                 }
    //
    //                 $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] - $detail->number : $item['number'] - $detail->number;
    //
    //                 $detail->discount = $item['discount'];
    //                 $detail->number = $item['number'];
    //                 if ($detail->update() == false) {
    //                     $this->db->rollback();
    //                     throw new Exception("/11010104/更新发货单明细失败/");
    //                 }
    //             } else {
    //                 // 新增
    //                 $detail = new TbShippingDetail();
    //                 $detail->productid = $item['productid'];
    //                 $detail->sizecontentid = $item['sizecontentid'];
    //                 $detail->number = $item['number'];
    //                 $detail->discount = $item['discount'];
    //                 $detail->price = $item['price'];
    //                 $detail->factoryprice = $item['factoryprice'];
    //                 $detail->currencyid = $item['currencyid'];
    //                 $detail->createdate = date("Y-m-d H:i:s");
    //                 $detail->orderdetailid = $item['orderdetailid'];
    //                 $detail->orderid = $item['orderid'];
    //                 $detail->orderbranddetailid = $item['orderbranddetailid'];
    //                 $detail->orderbrandid = $item['orderbrandid'];
    //                 $detail->shippingid = $shipping->id;
    //                 if ($detail->create() == false) {
    //                     $this->db->rollback();
    //                     throw new Exception("/11010105/添加发货单明细失败/");
    //                 }
    //
    //                 $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] : $item['number'];
    //             }
    //
    //             $detail_id_array[] = $detail->id;
    //         }
    //
    //         //删除那些不在列表中的明细数据
    //         if (count($detail_id_array) > 0) {
    //             $deleteDetails = TbShippingDetail::find(
    //                 sprintf('shippingid=%d and id not in (%s)', $shipping->id, implode(",", $detail_id_array))
    //             );
    //
    //             foreach ($deleteDetails as $detail) {
    //                 $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] - $detail->number : $detail->number * -1;
    //                 if ($detail->delete() == false) {
    //                     $this->db->rollback();
    //                     throw new Exception("/11010106/删除发货单明细失败/");
    //                 }
    //             }
    //         }
    //
    //         //更新订单明细中的，brand_number 字段
    //         foreach ($change as $orderbranddetailid => $number) {
    //             $orderDetail = TbOrderBrandDetail::findFirstById($orderbranddetailid);
    //             if ($orderDetail != false) {
    //                 $orderDetail->shipping_number = $orderDetail->shipping_number + $number;
    //                 if ($orderDetail->update() === false) {
    //                     //返回失败信息
    //                     $this->db->rollback();
    //                     throw new Exception("/11010107/更新客户端订单明细失败/");
    //                 }
    //             } else {
    //                 throw new Exception("/11010108/客户端订单明细不存在。/");
    //             }
    //         }
    //     } else {
    //         $shipping = new TbShipping();
    //         // status = 3 代表 已经入库
    //         $shipping->status = TbShipping::STATUS_AMORTIZED;
    //         $shipping->supplierid = $form["supplierid"];
    //         $shipping->finalsupplierid = $form["finalsupplierid"];
    //         $shipping->ageseason = $form["ageseason"];
    //         $shipping->seasontype = $form["seasontype"];
    //         $shipping->property = $form["property"];
    //         $shipping->currency = $form["currency"];
    //         $shipping->bussinesstype = $form["bussinesstype"];
    //         $shipping->warehouseid = $form["warehouseid"];
    //         $shipping->total = $form["total"];
    //         $shipping->exchangerate = $form["exchangerate"];
    //         $shipping->paydate = $form["paydate"];
    //         $shipping->apickingdate = $form["apickingdate"];
    //         $shipping->flightno = $form["flightno"];
    //         $shipping->flightdate = $form["flightdate"];
    //         $shipping->mblno = $form["mblno"];
    //         $shipping->hblno = $form["hblno"];
    //         $shipping->dispatchport = $form["dispatchport"];
    //         $shipping->deliveryport = $form["deliveryport"];
    //         $shipping->box_number = $form["box_number"];
    //         $shipping->weight = $form["weight"];
    //         $shipping->volume = $form["volume"];
    //         $shipping->chargedweight = $form["chargedweight"];
    //         $shipping->transcompany = $form["transcompany"];
    //         $shipping->invoiceno = $form["invoiceno"];
    //         $shipping->aarrivaldate = $form["aarrivaldate"];
    //         $shipping->buyerid = $form["buyerid"];
    //         $shipping->sellerid = $form["sellerid"];
    //         $shipping->transporttype = $form["transporttype"];
    //         $shipping->paytype = $form["paytype"];
    //         $shipping->estimatedate = $form["estimatedate"];
    //
    //         // 添加制单人及制单日期
    //         $shipping->makestaff = $this->currentUser;
    //         $shipping->maketime = date('Y-m-d H:i:s');
    //         $shipping->companyid = $this->companyid;
    //         // 生成订单号
    //         $shipping->orderno = TbCode::getCode($this->companyid, "SO", date("y"));
    //         if ($shipping->create() === false) {
    //             //返回失败信息
    //             $this->db->rollback();
    //             return $this->error($shipping);
    //         }
    //
    //         // 开始写入发货单详情表
    //         $change = [];
    //         foreach ($submitData['list'] as $k => $item) {
    //             $detail = new TbShippingDetail();
    //             $detail->productid = $item['productid'];
    //             $detail->sizecontentid = $item['sizecontentid'];
    //             $detail->number = $item['number'];
    //             $detail->discount = $item['discount'];
    //             $detail->price = $item['price'];
    //             $detail->factoryprice = $item['factoryprice'];
    //             $detail->currencyid = $item['currencyid'];
    //             $detail->createdate = date("Y-m-d H:i:s");
    //             $detail->orderdetailid = $item['orderdetailid'];
    //             $detail->orderid = $item['orderid'];
    //             $detail->orderbranddetailid = $item['orderbranddetailid'];
    //             $detail->orderbrandid = $item['orderbrandid'];
    //             $detail->shippingid = $shipping->id;
    //             if ($detail->create() == false) {
    //                 $this->db->rollback();
    //                 throw new Exception("/11010109/添加发货单明细失败/");
    //             }
    //
    //             $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] : $item['number'];
    //         }
    //
    //         // 更新订单明细中的，brand_number 字段，也就是每个品牌订单的发货数量
    //         foreach ($change as $orderbranddetailid => $number) {
    //             $orderDetail = TbOrderBrandDetail::findFirstById($orderbranddetailid);
    //             if ($orderDetail != false) {
    //                 // 同时更新每个品牌订单明细的发货数
    //                 $orderDetail->shipping_number = $orderDetail->shipping_number + $number;
    //                 if ($orderDetail->update() === false) {
    //                     //返回失败信息
    //                     $this->db->rollback();
    //                     throw new Exception("/11010110/更新客户端订单明细失败/");
    //                 }
    //             } else {
    //                 throw new Exception("/11010111/客户端订单明细不存在。/");
    //             }
    //         }
    //     }
    //
    //     // 取出 detail，并记录
    //     $shippingDetail = $shipping->getDetail();
    //     error_log('ShippingsimpleController => saveAction => $shippingDetail的值是：' . print_r($shippingDetail, true));
    //
    //     // $shipping代表新的发货单，不必判断是否存在，直接往下走就行
    //
    //     // 接下来开始计算摊销成本
    //     //本币id
    //     $auth = $this->auth;
    //     if (isset($auth['company']) && isset($auth['company']->currencyid)) {
    //         $currencyid = $auth['company']->currencyid;
    //     } else {
    //         $this->db->rollback();
    //         throw new Exception("/11011203/没有设置本币，不能计算成本/");
    //     }
    //
    //     //货币单位跟入库单保持一致
    //     $product_array = $shipping->getCostList();
    //
    //     //计算每件商品摊销后的成本
    //     $prodctstocks = TbProductstock::sum([
    //         sprintf("productid in (%s)", implode(",", array_keys($product_array))),
    //         "column" => "number",
    //         "group"  => "productid",
    //     ]);
    //
    //     $array = [];
    //     foreach ($product_array as $productid => $row) {
    //         $array[$productid] = [
    //             "amount" => $row['amount'] * $exchangerate,
    //             "number" => $row['number'],
    //         ];
    //     }
    //
    //     foreach ($prodctstocks as $row) {
    //         $product = TbProduct::getInstance($row->productid);
    //         if ($product == false) {
    //             $this->db->rollback();
    //             throw new Exception("/11011205/商品信息不存在。/");
    //         }
    //
    //         //当前库存的商品总价，全部转化成本币
    //         if (isset($array[$row->productid])) {
    //             $array[$row->productid]['amount'] += $product->cost * $row->sumatory;
    //             $array[$row->productid]['number'] += $row->sumatory;
    //         } else {
    //             $array[$row->productid] = [
    //                 "amount" => $product->cost * $row->sumatory,
    //                 "number" => $row->sumatory,
    //             ];
    //         }
    //     }
    //
    //     foreach ($array as $productid => $row) {
    //         $product = TbProduct::getInstance($productid);
    //
    //         if ($product && $row["number"] > 0) {
    //             // 入库之后，添加成本、成本货币单位、最后入库时间
    //             $product->cost = round($row['amount'] / $row["number"], 2);
    //             $product->costcurrency = $currencyid;
    //             $product->laststoragedate = date("Y-m-d H:i:s");
    //             if ($product->update() === false) {
    //                 $this->db->rollback();
    //                 throw new Exception("/11011206/更新商品成本失败/");
    //             }
    //         }
    //     }
    //
    //     // 判断入库的数量是否大于0 ，如果大于0，就进行库存的变动操作
    //     error_log('ShippingsimpleController => saveAction => [$shipping->shippingDetail]的值是：' . print_r($shipping->shippingDetail->toArray(), true));
    //     foreach ($shipping->shippingDetail as $detail) {
    //         //增加库存
    //         if ($detail->warehousingnumber > 0) {
    //             $productStock = $detail->getProductStock();
    //             $ret = $productStock->addStock($detail->warehousingnumber, TbProductstock::WAREHOSING, $detail->id);
    //             if ($ret === false) {
    //                 $this->db->rollback();
    //                 throw new Exception("/11011207/发货单入库更新库存失败。/");
    //             }
    //
    //             $row = $product_array[$detail->productid];
    //             $detail->cost = round($row['amount'] / $row["number"], 2);
    //             $detail->costcurrency = $currencyid;
    //             if ($detail->update() === false) {
    //                 $this->db->rollback();
    //                 throw new Exception("/11011208/更新发货单明细失败。/");
    //             }
    //         }
    //     }
    //
    //     // 添加入库人，入库时间, status=3代表分摊完毕
    //     $shipping->status = TbShipping::STATUS_AMORTIZED;
    //     $shipping->warehousingstaff = $this->currentUser;
    //     $shipping->warehousingtime = date('Y-m-d H:i:s');
    //     if ($shipping->save() == false) {
    //         throw new Exception("/11011202/发货单入库失败。/");
    //     }
    //
    //     // 提交事务, 并通知 OMS
    //     $this->db->commit();
    //     TbProductstock::sendStockChange();
    //     return $this->success();
    // }

    /**
     * 保存发货单，这个是简化版的，也就是客户订单 => 发货单
     *
     * @return false|string|void
     * @throws Exception
     */
    public function simplesaveAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);
        $form = $submitData['form'];

        // 记录下这个值，方便错误排查
        error_log('ShippingsimpleController => simplesaveAction => $submitData的值是：' . print_r($submitData, true));

        // 采用事务处理
        $this->db->begin();

        // 汇率必须大于0
        if ($form["exchangerate"] <= 0) {
            throw new Exception("/11011209/汇率不合法。/");
        }
        // 赋值
        $exchangerate = $form["exchangerate"];

        // 存在 id 即为编辑，否则为新建
        if ($form['id'] > 0) {
            // 判断发货单是否存在
            $shipping = TbShipping::findFirstById($form['id']);
            if ($shipping == false || $shipping->companyid != $this->companyid) {
                throw new Exception("/11010101/发货单不存在。/");
            }

            // status = 2 代表已经入库
            if ($shipping->status == TbShipping::STATUS_STORAGE) {
                throw new Exception("/11010102/发货单已经入库，不能修改。/");
            }

            // 开始更新
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

            // 如果更新失败则回滚
            if ($shipping->update() === false) {
                //返回失败信息
                $this->db->rollback();
                return $this->error($shipping);
            }

            // 开始写入订单详情表
            $change = [];
            $detail_id_array = [];
            foreach ($submitData['list'] as $k => $item) {
                // 编辑
                if ($item["id"] > 0) {
                    $detail = TbShippingDetail::findFirstById($item["id"]);
                    if ($detail == false) {
                        throw new Exception("/11010103/发货单明细数据不存在。/");
                    }
                    // 把之前的品牌订单明细 id 全部换成订单明细 id
                    $change[$detail->orderdetailid] = isset($change[$detail->orderdetailid]) ? $change[$detail->orderdetailid] + $item['number'] - $detail->number : $item['number'] - $detail->number;

                    $detail->discount = $item['discount'];
                    $detail->number = $item['number'];
                    if ($detail->update() == false) {
                        $this->db->rollback();
                        throw new Exception("/11010104/更新发货单明细失败/");
                    }
                } else {
                    // 新增
                    $detail = new TbShippingDetail();
                    $detail->productid = $item['productid'];
                    $detail->sizecontentid = $item['sizecontentid'];
                    $detail->number = $item['number'];
                    $detail->discount = $item['discount'];
                    $detail->price = $item['price'];
                    $detail->factoryprice = $item['factoryprice'];
                    $detail->currencyid = $item['currencyid'];
                    $detail->createdate = date("Y-m-d H:i:s");
                    $detail->orderdetailid = $item['orderdetailid'];
                    $detail->orderid = $item['orderid'];
                    $detail->orderbranddetailid = $item['orderbranddetailid'];
                    $detail->orderbrandid = $item['orderbrandid'];
                    $detail->shippingid = $shipping->id;
                    if ($detail->create() == false) {
                        $this->db->rollback();
                        throw new Exception("/11010105/添加发货单明细失败/");
                    }

                    // 把之前的品牌订单明细 id 全部换成订单明细 id
                    $change[$detail->orderdetailid] = isset($change[$detail->orderdetailid]) ? $change[$detail->orderdetailid] + $item['number'] : $item['number'];
                }

                $detail_id_array[] = $detail->id;
            }

            //删除那些不在列表中的明细数据
            if (count($detail_id_array) > 0) {
                $deleteDetails = TbShippingDetail::find(
                    sprintf('shippingid=%d and id not in (%s)', $shipping->id, implode(",", $detail_id_array))
                );

                foreach ($deleteDetails as $detail) {
                    $change[$detail->orderdetailid] = isset($change[$detail->orderdetailid]) ? $change[$detail->orderdetailid] - $detail->number : $detail->number * -1;
                    if ($detail->delete() == false) {
                        $this->db->rollback();
                        throw new Exception("/11010106/删除发货单明细失败/");
                    }
                }
            }

            // 更新订单明细
            foreach ($change as $orderdetailid => $number) {
                $orderDetail = TbOrderBrandDetail::findFirstById($orderdetailid);
                if ($orderDetail != false) {
                    $orderDetail->shipping_number = $orderDetail->shipping_number + $number;
                    if ($orderDetail->update() === false) {
                        //返回失败信息
                        $this->db->rollback();
                        throw new Exception("/11010107/更新客户端订单明细失败/");
                    }
                } else {
                    throw new Exception("/11010108/客户端订单明细不存在。/");
                }
            }
        } else {
            // 如果 id 不存在，则为新建
            $shipping = new TbShipping();
            // status = 1 代表 在途
            $shipping->status = TbShipping::STATUS_WAY;
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
            if ($shipping->create() === false) {
                //返回失败信息
                $this->db->rollback();
                return $this->error($shipping);
            }

            // 开始写入发货单详情表
            $change = [];
            foreach ($submitData['list'] as $k => $item) {
                $detail = new TbShippingDetail();
                $detail->productid = $item['productid'];
                $detail->sizecontentid = $item['sizecontentid'];
                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->price = $item['price'];
                $detail->factoryprice = $item['factoryprice'];
                $detail->currencyid = $item['currencyid'];
                $detail->createdate = date("Y-m-d H:i:s");
                $detail->orderdetailid = $item['orderdetailid'];
                $detail->orderid = $item['orderid'];
                $detail->orderbranddetailid = $item['orderbranddetailid'] ?? '';
                $detail->orderbrandid = $item['orderbrandid'] ?? '';
                $detail->shippingid = $shipping->id;
                if ($detail->create() == false) {
                    $this->db->rollback();
                    throw new Exception("/11010109/添加发货单明细失败/");
                }

                $change[$detail->orderdetailid] = isset($change[$detail->orderdetailid]) ? $change[$detail->orderdetailid] + $item['number'] : $item['number'];
            }

            // 记录 $change 的值
            error_log('ShippingsimpleController => simplesaveAction => $change的值是：' . print_r($change, true));

            // 更新订单明细中的每个订单的发货数量
            foreach ($change as $orderdetailid => $number) {
                $orderDetail = TbOrderdetails::findFirstById($orderdetailid);
                if ($orderDetail != false) {
                    // 同时更新每个品牌订单明细的发货数
                    $orderDetail->shipping_number = $orderDetail->shipping_number + $number;
                    if ($orderDetail->update() === false) {
                        //返回失败信息
                        $this->db->rollback();
                        throw new Exception("/11010110/更新客户端订单明细失败/");
                    }
                } else {
                    throw new Exception("/11010111/客户端订单明细不存在。/");
                }
            }
        }

        // 取出 detail，并记录
        $shippingDetail = $shipping->getDetail();
        error_log('ShippingsimpleController => simplesaveAction => $shippingDetail的值是：' . print_r($shippingDetail, true));

        // 提交事务
        $this->db->commit();
        return $this->success($shippingDetail);
    }

    /**
     * 前查，订单列表
     *
     * @return false|string
     * @throws Exception
     */
    public function orderlistAction()
    {
        $shipping = TbShipping::findFirstById($_POST['id']);
        if ($shipping != false && $shipping->companyid == $this->companyid) {
            return $this->success($shipping->getOrderList());
        } else {
            throw new Exception("/11011601/发货单不存在/");
        }
    }
}
