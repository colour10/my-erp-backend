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

    function saveAction() {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);
        $form = $submitData['form'];

        if($form['id']>0) {
            return $this->editShipping($submitData);
        }

        // 采用事务处理
        $this->db->begin();
        

        $shipping = new TbShipping();            
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
        foreach ($submitData['list'] as $k => $item) {
            $detail = new TbShippingDetail();
            $detail->productid = $item['productid'];
            $detail->sizecontentid = $item['sizecontentid'];
            $detail->number = $item['number'];
            $detail->discount = $item['discount'];
            $detail->price = $item['price'];
            $detail->createdate = date("Y-m-d H:i:s");
            $detail->orderdetailsid = $item['orderdetailsid'];
            $detail->orderid = $item['orderid'];
            $detail->shippingid= $shipping->id;
            if($detail->create()==false) {
                $this->db->rollback();
                throw new \Exception("/110115/添加订单明细失败/");
            }

            //更新订单中的已发货数量
            if($item['orderdetailsid']>0) {
                $orderDetail = TbOrderdetails::findFirstById($item['orderdetailsid']);
                if($orderDetail!=false) {
                    $orderDetail->shipping_number = $orderDetail->shipping_number + $detail->number;

                    if($orderDetail->update()==false) {
                        $this->db->rollback();
                        return $this->error($orderDetail);
                    }
                }
            }    
        }

        // 提交事务
        $this->db->commit();
        return $this->success($shipping->getDetail());
    }

    private function editShipping($submitData) {
        // 采用事务处理
        $this->db->begin();
        $form = $submitData['form'];

        $shipping = TbShipping::findFirstById($form['id']);
        if($shipping==false || $shipping->companyid!=$this->companyid) {
            throw new \Exception("/110102/发货单不存在。/");
        }

        if($shipping->status==2) {
            throw new \Exception("/110101/发货单已经入库，不能修改。/");
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

        //开始更新出库单明细
        $orderDetailNumberArray = [];//用来记录每一个订单明细的发货数量的变化
        $detail_id_array = [];
        foreach ($submitData['list'] as $k => $item) {
            $detail = false;
            if(isset($item['id']) && $item['id']>0) {
                $detail = TbShippingDetail::findFirstById($item['id']);
            }

            if($detail!=false) {
                if($detail->orderdetailsid>0) {
                    if(!isset($orderDetailNumberArray[$detail->orderdetailsid])) {
                        $orderDetailNumberArray[$detail->orderdetailsid] = 0;
                    }
                    $orderDetailNumberArray[$detail->orderdetailsid] += $item['number']-$detail->number;
                }                

                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->price = $item['price'];

                if($detail->update()==false) {
                    $this->db->rollback();
                    throw new \Exception("/110103/更新发货单明细失败/");
                }

                $detail_id_array[] = $detail->id;
            }
            else {
                $detail = new TbShippingDetail();
                $detail->productid = $item['productid'];
                $detail->sizecontentid = $item['sizecontentid'];
                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->price = $item['price'];
                $detail->createdate = date("Y-m-d H:i:s");
                $detail->orderdetailsid = $item['orderdetailsid'];
                $detail->orderid = $item['orderid'];
                $detail->shippingid= $shipping->id;
                if($detail->create()==false) {
                    $this->db->rollback();
                    throw new \Exception("/110104/添加订单明细失败/");
                }

                if($detail->orderdetailsid>0) {
                    if(!isset($orderDetailNumberArray[$detail->orderdetailsid])) {
                        $orderDetailNumberArray[$detail->orderdetailsid] = 0;
                    }
                    $orderDetailNumberArray[$detail->orderdetailsid] += $detail->number;
                }

                $detail_id_array[] = $detail->id;
            }
        }

        //删除不在列表中的发货单明细
        if(count($detail_id_array)>0) {
            $results = TbShippingDetail::find(
                sprintf("shippingid=%d and id not in (%s)", $shipping->id, implode(',', $detail_id_array))
            );
        }
        else {
            $results = TbShippingDetail::find(
                sprintf("shippingid=%d", $shipping->id)
            );
        }

        foreach($results as $detail) {
            if($detail->orderdetailsid>0) {
                if(!isset($orderDetailNumberArray[$detail->orderdetailsid])) {
                    $orderDetailNumberArray[$detail->orderdetailsid] = 0;
                }
                $orderDetailNumberArray[$detail->orderdetailsid] = $orderDetailNumberArray[$detail->orderdetailsid]-$detail->number;
            }

            if($detail->delete()==false) {
                $this->db->rollback();
                throw new \Exception("/110105/发货单明细删除失败/");
            }
        }

        //更新订单中的已发货数量
        foreach($orderDetailNumberArray as $orderdetailsid=>$number) {
            if($number==0) {
                continue;
            }

            $orderDetail = TbOrderdetails::findFirstById($orderdetailsid);
            if($orderDetail!=false) {
                $orderDetail->shipping_number = $orderDetail->shipping_number + $number;

                if($orderDetail->update()==false) {
                    $this->db->rollback();
                    return $this->error($orderDetail);
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
            $this->db->begin();
            $details = $shipping->shippingDetail;
            foreach ($details as $detail) {
                if($detail->orderbrandid>0) {
                    //已经加入外部订单的订单明细不能删除
                    $this->db->rollback();
                    throw new \Exception("/110106/不能删除已经加入外部订单的订单明细/");
                }

                if($detail->delete()==false) {
                    $this->db->rollback();
                    throw new \Exception("/110107/删除订单明细失败。/");
                }
            }

            if($shipping->delete()==false) {
                $this->db->rollback();
                    throw new \Exception("/110108/订单不能删除/");
            }

            $this->db->commit();

            return $this->success();
        }
        else {
            throw new \Exception("/110109/订单不存在/");
            
        }
    }

    function warehousingAction() {
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
            $shipping->warehousingstaff = $this->currentUser;
            $shipping->warehousingtime = date('Y-m-d H:i:s');
            $shipping->status = 2;

            // 判断是否成功
            if(!$shipping->save()) {
                $this->db->rollback();

                // 验证类错误给出提示
                return $this->error($shipping);
            }

            $detail_id_array = [];
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
                }
                
                $detail->warehousingnumber = $item['number'];

                
                if($detail->save()==false) {
                    $this->db->rollback();
                    throw new \Exception("/110113/入库单详情入库数量更新失败/");
                }  

                //增加库存
                if($detail->warehousingnumber>0) {
                    $productStock = $detail->getProductStock();
                    $productStock->addStock($detail->warehousingnumber, TbProductstock::WAREHOSING, $detail->id);
                }                

                $detail_id_array[] = $detail->id;
            }

            //清除不存在的详情id
            if(count($detail_id_array)>0) {
                $details = TbShippingDetail::find(
                    sprintf("shippingid=%d and id not in(%s)", $shipping->id, implode(',', $detail_id_array))
                );
                foreach($details as $detail) {
                    $detail->warehousingnumber = 0;
                    $detail->shippingid = 0;
                    if($detail->update()==false) {
                        $this->db->rollback();
                        throw new \Exception("/110114/入库单详情确认数量失败/");                    
                    }
                }
            }

            // 提交事务
            $this->db->commit();

            // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
            echo $this->success();
        }
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
            //减掉库存
            if($detail->warehousingnumber>0) {
                $productStock = $detail->getProductStock();
                if($productStock->number>=$detail->warehousingnumber) {
                    $productStock->reduceStock($detail->warehousingnumber, TbProductstock::WAREHOSING, $detail->id);
                }    
                else {
                    throw new \Exception("/101117/库存不足，不能取消。/");
                }            
            }  

            $detail->warehousingnumber = 0;
            if($detail->save()==false) {
                $this->db->rollback();
                throw new \Exception("/101116/发货单明细取消入库失败。/");
            } 
        }

        $this->db->commit();
        return $this->success();
    }
}
