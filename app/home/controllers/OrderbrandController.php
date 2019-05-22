<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbOrderBrand;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\Util;

/**
 * 品牌订单
 */
class OrderbrandController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbOrderBrand');
    }

    function saveAction() {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        // 判断是否有订单号，分别进行
        $orderid = $submitData['form']['id'];
        // 采用事务处理
        $this->db->begin();
        $form = $submitData['form'];

        // 判断逻辑
        if ($orderid) {
            // 有订单号就修改
            // 查找订单号是否存在或者非法
            // 只有status=1的订单才可以修改
            $order = TbOrderBrand::findFirst(
                sprintf("id=%d and companyid=%d", $orderid, $this->companyid)
            );
            if(!$order) {
                throw new \Exception("/1001/品牌订单不存在/");
            }
            else {
                if($order->status!=1) {
                    throw new \Exception("/1001/品牌订单不允许修改/");
                }
            }

            $order->supplierid = $form['supplierid'];
            $order->finalsupplierid = $form['finalsupplierid'];
            $order->ageseason = $form['ageseason'];
            $order->seasontype = $form['seasontype'];
            $order->foreignorderno = $form['foreignorderno'];
            //$order->discount = $form['discount'];
            $order->taxrebate = $form['taxrebate'];
            $order->memo = $form['memo'];
            $order->brandid = $form['brandid'];
            $order->discountbrand = $form['discountbrand'];
            $order->bussinesstype = $form['bussinesstype'];

            // 判断是否成功
            if (!$order->save()) {
                $this->db->rollback();
                // 验证类错误给出提示
                return $this->error($order);
            }
        }
        else {
            // 没有订单号就新增
            $order = new TbOrderBrand();            
            $order->supplierid = $form['supplierid'];
            $order->finalsupplierid = $form['finalsupplierid'];
            $order->ageseason = $form['ageseason'];
            $order->seasontype = $form['seasontype'];
            $order->foreignorderno = $form['foreignorderno'];
            //$order->discount = $form['discount'];
            $order->taxrebate = $form['taxrebate'];
            $order->memo = $form['memo'];
            $order->brandid = $form['brandid'];
            $order->discountbrand = $form['discountbrand'];
            $order->bussinesstype = $form['bussinesstype'];
            
            // 添加制单人及制单日期
            $order->makestaff = $this->currentUser;
            $order->maketime = date('Y-m-d H:i:s');
            $order->companyid = $this->companyid;
            $order->status = 1;
            // 生成订单号
            $order->orderno = sprintf(
                "B%s%s%s",
                substr("000000".$this->companyid, -6),
                date('YmdHis'),
                mt_rand(1000, 9999)
            );
            if($order->create() === false) {
                //返回失败信息
                $this->db->rollback();
                return $this->error($order);
            }
        }


        $detail_id_array = [];
        foreach ($submitData['list'] as $k => $item) {
            // 使用模型更新
            $details = TbOrderdetails::find(
                sprintf("companyid=%d and orderid=%d and productid=%d", $this->companyid, $item['orderid'], $item['productid'])
            );
            foreach($details as $detail) {
                if($detail->orderbrandid>0 && $detail->orderbrandid!=$order->id) {
                    $this->db->rollback();
                    throw new \Exception("/1002/订单明细已经加入其它品牌订单，不能重复操作。/");   
                }

                $detail->orderbrandid = $order->id;
                if($detail->update()==false) {
                    $this->db->rollback();
                    throw new \Exception("/1002/订单明细加入品牌订单失败/");                    
                }

                $detail_id_array[] = $detail->id;
            }            
        }
        //清除不存在的详情id
        if(count($detail_id_array)>0) {
            $details = TbOrderdetails::find(
                sprintf("orderbrandid=%d and id not in(%s)", $order->id, implode(",", $detail_id_array))
            );
            foreach($details as $detail) {
                $detail->orderbrandid = 0;
                if($detail->update()==false) {
                    $this->db->rollback();
                    throw new \Exception("/1002/订单明细从品牌订单中移除失败/");                    
                }
            }
        }

        // 提交事务
        $this->db->commit();

        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->success($order->toArray());
    }

    public function loadorderAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrderBrand::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($order!=false) {
            echo $this->success($order->getOrderDetail());
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
        $orderbrandid = $submitData['form']['id'];
        // 采用事务处理
        $this->db->begin();
        $form = $submitData['form'];

        // 判断逻辑
        if ($orderbrandid) {
            $orderbrand = TbOrderBrand::findFirst(
                sprintf("id=%d and companyid=%d", $orderbrandid, $this->companyid)
            );

            if(!$orderbrand) {
                throw new \Exception("/1001/订单不存在/");
            }
            $orderbrand->discountbrand = $form['discountbrand'];
            $orderbrand->confirmstaff = $this->currentUser;
            $orderbrand->confirmdate = date('Y-m-d');
            $orderbrand->status = 2;

            // 判断是否成功
            if(!$orderbrand->save()) {
                $this->db->rollback();

                // 验证类错误给出提示
                return $this->error($orderbrand);
            }

            $detail_id_array = [];
            foreach ($submitData['list'] as $k => $item) {
                // 使用模型更新
                $detail = TbOrderdetails::findFirst(
                    sprintf("companyid=%d and orderid=%d and productid=%d and sizecontentid=%d", $this->companyid, $item['orderid'], $item['productid'], $item['sizecontentid'])
                );
                
                if($detail!=false && $detail->orderbrandid==$orderbrand->id) {
                    $detail->confirm_number = $item['number'];
                    $detail->discountbrand = $item['discountbrand'];
                    $detail->status = 1;
                    if($detail->update()==false) {
                        $this->db->rollback();
                        throw new Exception("/1001/订单详情确认数量失败/");
                    }
                }   
                else {
                    $this->db->rollback();
                    throw new \Exception("/1001/订单详情不存在/");
                }   
            }

            //清除不存在的详情id
            if(count($detail_id_array)>0) {
                $details = TbOrderdetails::find(
                    sprintf("orderbrandid=%d and number=0", $orderbrand->id)
                );
                foreach($details as $detail) {
                    $detail->status = 1;
                    if($detail->update()==false) {
                        $this->db->rollback();
                        throw new \Exception("/1002/订单详情确认数量失败/");                    
                    }
                }
            }

            // 提交事务
            $this->db->commit();

            // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
            echo $this->success($orderbrand->toArray());
        }
    }

    function searchdetailAction() {
        //首先检索出来确认订单id
        $orders = TbOrderBrand::find(
            sprintf("companyid=%d and supplierid=%d and ageseason=%d and status=2", $this->companyid, $_POST['supplierid'], $_POST['ageseason'])
        );

        $array = Util::recordListColumn($orders, 'id');
        //print_r($array);
        if(count($array)>0) {
            $details = TbOrderdetails::find(
                sprintf("orderbrandid in(%s)", implode(",", $array))
            );

            return $this->success( $details->toArray() );
        }
        else {
            return $this->success( [] );
        }
    }
}
