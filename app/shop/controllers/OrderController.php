<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbMemberAddress;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbShoporder;
use Asa\Erp\TbShoporderCommon;
use Asa\Erp\TbBuycar;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

/**
 * 订单操作类
 * Class OrderController
 * @package Multiple\Shop\Controllers
 */
class OrderController extends AdminController
{

    public function initialize()
    {
    	
    }

    /**
     * 订单详情首页
     */
    public function detailAction()
    {
        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            exit('Params error!');
        }
        // 赋值
        $id = $params[0];

        // 判断是否登录
        if($rs = $this->session->get('member')) {
            $order = TbShoporderCommon::findFirst(
                "member_id = ".$rs['id'].' and id='.$id
            );
            // 判断是否存在
            if ($order) {
                $data['common'] = $order;
                $data['product'] = $order->shoporder;
                $data['addresses'] = TbMemberAddress::find("member_id=".$rs['id']);
                // 转成数组
                $data = json_decode(json_encode($data), true);
                // 给商品加入封面图和id
                foreach ($data['product'] as $k => $item) {
                    $product = TbProductSearch::findFirstById($item['product_id']);
                    $data['product'][$k]['picture'] = $this->file_prex . $product->picture;
                    $data['product'][$k]['product_detail_id'] = $product->productid;
                }
            } else {
                // 如果没有符合条件的订单，那么就赋值为空数组
                $data['common'] = [];
                $data['product'] = [];
            }

            // 分配模板
            $this->view->setVars([
                'data' => $data,
            ]);
        } else {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }
    }


    /**
     * 把购物车添加到订单
     * @return false|string
     */
    public function addOrderAction()
    {
        // 逻辑
    	if($rs = $this->session->get('member')) {
    	    // 因为逻辑涉及到操作多个表，所以务必使用事务处理，以保证完整性
            // 采用事务处理
            $this->db->begin();

            // 首先判断是否有库存，如果没有库存就不能下单
            // 因为下单的时候是按照尺码，颜色分别下单的，这个时候需要汇总统计
            // 声明一个新数组来保存最终统计的变量
            $stock = [];
            // 遍历
            foreach ($_POST['data'] as $k => $item) {
                if (!isset($stock[$item['product_id']])) {
                    $stock[$item['product_id']] = [
                        'id' => $item['product_id'],
                        'number' => $item['number'],
                    ];
                } else {
                    $stock[$item['product_id']]['number'] += $item['number'];
                }
            }

            // 接着判断库存够不够
            // 生成订单的时候验证库存，同时付款的时候也要再检查一次
            foreach ($stock as $item) {
                // 取出数据库中的库存进行对比
                $product = TbProductSearch::findFirstById($item['id']);
                if ($product->number < $item['number']) {
                    // 回滚
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('out-of-stock');
                    return $this->error([$msg]);
                }
            }

            // 这个逻辑感觉不太合理，先注释掉，有的时候客户忘记了付款，直接删除掉会让客户感觉到困惑
            // // 查找该会员下面未支付的订单
            // $order = TbShoporderCommon::findFirst(
            //     "member_id = ".$rs['id'].' and order_status=1'
            // );

            // // 如果存在，就删除
            // if($order) {
            //     $product = TbShoporder::find(
            //         "order_commonid = ".$order->toArray()['id']
            //     );
            //     foreach($product as $record){
            //         if (!$record->delete()) {
            //             // 回滚
            //             $this->db->rollback();
            //             $msg = $this->getValidateMessage('orderdetail', 'db', 'delete-failed');
            //             return $this->error([$msg]);
            //         }
            //     }
            //     if (!$order->delete()) {
            //         // 回滚
            //         $this->db->rollback();
            //         $msg = $this->getValidateMessage('order', 'db', 'delete-failed');
            //         return $this->error([$msg]);
            //     }
            // }

            // 重新写入订单主表
            // 为了防止篡改，只接收传过来的商品id，价格什么的统一由后台进行计算
            // 声明变量用来保存订单
            // 商品总价格
            $total_price = 0;
            // 运费，默认为0
            $freight_price = 0;
            // 最终成交价格
            $final_price = 0;
            // 购物车一维数组
            $buycars = [];
            // 遍历获取
            foreach ($_POST['data'] as $k => $item) {
                // 商品价格重新从数据库提取，不能从页面直接拿过来
                $product = TbProductSearch::findFirstById($item['product_id']);
                // 如果商品不存在，那么就回滚报错
                if (!$product) {
                    // 回滚
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('order', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
                // 存在就计算总金额
                $total_price += $product->realprice;
                // 然后把新的从数据库查询出来的数据装进post数组里
                $_POST['data'][$k]['product_total_price'] = $product->realprice * $item['number'];
                $_POST['data'][$k]['product'] = $product->toArray();
                // 购物车
                $buycars[] = $item['id'];
            }

            // 最终成交价格=商品总价格+运费
            $final_price = $total_price + $freight_price;

            // 开始添加订单主表
            $model_common = new TbShoporderCommon();
            $model_common->total_price = $total_price;
            $model_common->send_price = $freight_price;
            $model_common->final_price = $final_price;
            $model_common->create_time = date("Y-m-d H:i:s");
            $model_common->member_id = $rs['id'];
            // 订单号
            $model_common->order_no = $this->generate_trade_no();
            if(!$model_common->save()) {
                // 回滚
                $this->db->rollback();
                // 取出错误信息
                return $this->error($model_common);
            }

            // 接着添加订单详情表
            $data_common = [];
            foreach($_POST['data'] as $key => $value) {
                $data_common = [
                    'order_commonid' => $model_common->id,
                    'product_id' => $value['product_id'],
                    'product_name' => $value['product_name'],
                    'price' => $value['product']['realprice'],
                    'number' => $value['number'],
                    'total_price' => $value['product_total_price'],
                    'color_id' => $value['color_id'],
                    'color_name' => $value['color_name'],
                    'size_id' => $value['size_id'],
                    'size_name' => $value['size_name'],
                ];
                $shoporderdetail = new TbShoporder;
                if (!$shoporderdetail->create($data_common)) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($shoporderdetail);
                }
            }

            // 然后把原来的购物车删除
            foreach ($buycars as $buycar) {
                $model = TbBuycar::findFirstById($buycar);
                if (!$model) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    $msg = $this->getValidateMessage('buycar', 'template', 'notexist');
                    return $this->error([$msg]);
                }
                if (!$model->delete()) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($model);
                }
            }

            // 提交事务
            $this->db->commit();

            // 返回提交成功，并且返回新订单的ID
            return $this->success($model_common->id);

    	} else {
    	    // 返回错误信息
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
    	}
    }


    /**
     * 支付订单
     * @return false|string
     */
    public function confirmAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            if($rs = $this->session->get('member')) {
                // 判断是否有传过来参数id，如果有就针对针对单个订单进行支付，否则就针对所有未支付的订单进行支付
                // 初始化一个变量
                $id = '';
                // 过滤
                $params = $this->dispatcher->getParams();
                if (!$params && preg_match('/^[1-9]+\d*$/', $params[0])) {
                    $id = $params[0];
                }

                // 因为逻辑涉及到操作多个表，所以务必使用事务处理，以保证完整性
                // 采用事务处理
                $this->db->begin();

                // 如果$id没有值，说明要支付的是所有的订单，否则就是针对当前的id订单进行支付
                if (!$id) {
                    // 查找当前用户所有未支付的订单
                    $order = TbShoporderCommon::findFirst(
                        "member_id = ".$rs['id'].' and order_status=1'
                    );
                } else {
                    // 查找当前id的未支付的订单
                    $order = TbShoporderCommon::findFirst(
                        "member_id = ".$rs['id'].' and order_status=1 and id='.$id
                    );
                }

                // 如果不存在就报错
                if (!$order) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    $msg = $this->getValidateMessage('payment-failed');
                    return $this->error([$msg]);
                }

                // 存在则付款
                // 但是在付款之前，要先检查是否还有库存，如果没有库存，则提示库存不足
                // 声明一个新数组来保存最终统计的变量
                $stock = [];
                // 遍历
                foreach ($order->shoporder as $k => $item) {
                    if (!isset($stock[$item->product_id])) {
                        $stock[$item->product_id] = [
                            'id' => $item->product_id,
                            'number' => $item->number,
                        ];
                    } else {
                        $stock[$item->product_id]['number'] += $item->number;
                    }
                }

                // 接着判断库存够不够
                // 生成订单的时候验证库存，同时付款的时候也要再检查一次
                foreach ($stock as $item) {
                    // 取出数据库中的库存进行对比
                    $model = TbProductSearch::findFirstById($item['id']);
                    if (!$model) {
                        // 回滚
                        $this->db->rollback();
                        // 取出错误信息
                        $msg = $this->getValidateMessage('product', 'template', 'notexist');
                        return $this->error([$msg]);
                    }
                    if ($model->number < $item['number']) {
                        // 回滚
                        $this->db->rollback();
                        $msg = $this->getValidateMessage('out-of-stock');
                        return $this->error([$msg]);
                    }
                }

                // 付款的过程通过另外的接口处理，这里只假设为成功或者失败
                $payment_result = $this->paymentapiAction();
                if ($payment_result['result_code'] != 'SUCCESS') {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    $msg = $this->getValidateMessage('payment-failed');
                    return $this->error([$msg]);
                }

                // 付款成功，开始执行数据库写入操作
                // 如果客户之前存入了地址，就从地址中选择一个插入
                if (isset($_POST['address_id'])) {
                    // 查找地址是否存在
                    $addressModel = TbMemberAddress::findFirst("member_id=".$rs['id']." and id=".$_POST['address_id']);
                    if (!$addressModel) {
                        // 回滚
                        $this->db->rollback();
                        // 取出错误信息
                        $msg = $this->getValidateMessage('address-doesnot-exist');
                        return $this->error([$msg]);
                    }
                    // 赋值
                    $order->reciver_name = $addressModel->name;
                    $order->reciver_phone = $addressModel->tel;
                    // 身份证暂时不需要，注释掉
                    // $order->reciver_no = $address->idno;
                    $order->reciver_address = $addressModel->address;
                } else {
                    // 否则就新建一个地址
                    // 但是要先验证数据合法性
                    // 不能为空
                    if (!$_POST['reciver_name'] || !$_POST['reciver_phone'] || !$_POST['reciver_address']) {
                        // 回滚
                        $this->db->rollback();
                        $msg = $this->getValidateMessage('fill-out-required-fields');
                        return $this->error([$msg]);
                    }
                    // 验证手机号
                    if (!preg_match("/^1[34578]\d{9}$/", $_POST['reciver_phone'])) {
                        // 回滚
                        $this->db->rollback();
                        $msg = $this->getValidateMessage('mobile-invalid');
                        return $this->error([$msg]);
                    }

                    // 开始插入
                    $order->reciver_name = $name = $_POST['reciver_name'];
                    $order->reciver_phone = $tel = $_POST['reciver_phone'];
                    // 身份证暂时不需要，注释掉
                    // $order->reciver_no = $idno = $_POST['reciver_no'];
                    $order->reciver_address = $address = $_POST['reciver_address'];
                    $member_id = $rs['id'];
                    $is_default = '1';

                    // 新建赋值之后给地址表生成一条新纪录，并且属性为默认地址
                    $new_address_model = new TbMemberAddress();
                    if (!$new_address_model->save(compact('name', 'tel', 'address', 'member_id', 'is_default'))) {
                        // 回滚
                        $this->db->rollback();
                        // 取出错误信息
                        return $this->error($new_address_model);
                    }
                }

                // 给剩下的赋值
                $order->pay_time = date("Y-m-d H:i:s");
                $order->pay_style = $_POST['pay_style'];
                $order->order_status = 2;
                // 失败则回滚
                if (!$order->save()) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($order);
                }

                // 如果支付成功，则减库存，但是对tb_product_search减库存不太好，需要对原表进行操作，这里为了演示，就用tb_product_search表做测试好了
                // 分别减库存
                foreach ($stock as $product) {
                    $model = TbProductSearch::findFirstById($product['id']);
                    // 做减法
                    // 本来应该检测是否超卖的，但是上一步已经验证有库存，所以最终值不会小于0
                    $model->number -= $product['number'];
                    if (!$model->save()) {
                        // 回滚
                        $this->db->rollback();
                        // 取出错误信息
                        return $this->error($model);
                    }
                }

                // 提交事务
                $this->db->commit();

                // 返回成功信息
                return $this->success();
            }
        }
    }


    /**
     * 我的订单列表
     */
    public function listAction()
    {
    	// 逻辑
        // 判断是否登录
        if (!$member = $this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }

        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);

        // 找到所有的主订单列表，并且按照创建时间倒叙排列
        $orders = TbShoporderCommon::find([
            'member_id' => $member['id'],
            'order' => 'create_time desc',
        ]);

        // 整合子订单
        $orders_array = $orders->toArray();
        foreach ($orders as $k => $order) {
            $orders_array[$k]['orderdetails'] = $order->shoporder->toArray();
            // 支付状态
            $orders_array[$k]['order_status_desc'] = $this->paystatus($order->order_status);
            // 子订单加入额外信息
            foreach ($orders_array[$k]['orderdetails'] as $key => $value) {
                $model = TbProductSearch::findFirstById($value['product_id']);
                // 封面图
                $orders_array[$k]['orderdetails'][$key]['picture'] = $this->file_prex . $model->picture;
                // id
                $orders_array[$k]['orderdetails'][$key]['product_detail_id'] = $model->productid;
                // 付款情况
                // 如果是1或4，则是未付款
                if ($order->order_status == '1' || $order->order_status == '4') {
                    $orders_array[$k]['orderdetails'][$key]['payment_amount'] = '0.00';
                } else {
                    $orders_array[$k]['orderdetails'][$key]['payment_amount'] = $value['total_price'];
                }
            }
        }

        // 创建分页对象，使用数组分页
        $paginator = new PaginatorArray(
            [
                "data"  => $orders_array,
                "limit" => 5,
                "page"  => $currentPage,
            ]
        );

        // 展示分页
        $page = $paginator->getPaginate();

        // 分配给模板
        $this->view->setVars([
            'orders' => $orders_array,
            'page' => $page,
        ]);
    }


    /**
     * 第三方付款接口
     * @return array
     */
    public function paymentapiAction()
    {
        // 逻辑
        // result_code的值SUCCESS则付款成功，FAIL则为付款失败
        return ['result_code' => 'SUCCESS'];
    }

    /**
     * 第三方退款接口
     * @return array
     */
    public function refundapiAction()
    {
        // 逻辑
        // result_code的值SUCCESS则退款成功，FAIL则为退款成功
        return ['result_code' => 'SUCCESS'];
    }

    /**
     * 生成唯一订单号
     * @return string
     */
    public function generate_trade_no()
    {
        // 逻辑
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    /**
     * 取出支付状态
     * @param $paystatus tb_shoporder_common中order_status的值
     * @return string 支付状态说明
     */
    public function paystatus($paystatus)
    {
        // 逻辑
        switch ($paystatus) {
            case '1':
                $paystatus_desc = '未支付';
                break;
            case '2':
                $paystatus_desc = '已支付未完成';
                break;
            case '3':
                $paystatus_desc = '已完成';
                break;
            case '4':
                $paystatus_desc = '已取消';
                break;
            case '5':
                $paystatus_desc = '退款中';
                break;
            case '6':
                $paystatus_desc = '已退款';
                break;
            default:
                $paystatus_desc = '未支付';
        }
        // 返回
        return $paystatus_desc;
    }

    /**
     * 取消订单
     * @return false|string
     */
    public function cancleAction()
    {
        // 逻辑
        // 先过滤
        if ($this->request->isPost()) {
            if ($rs = $this->session->get('member')) {
                $params = $this->dispatcher->getParams();
                if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                    exit('Params error!');
                }
                // 赋值
                $id = $params[0];
                // 查找订单是否存在，订单要求为未付款状态
                $order = TbShoporderCommon::findFirst("member_id=".$rs['id']." and id=".$id." and order_status=1");
                if (!$order) {
                    // 取出错误信息
                    $msg = $this->getValidateMessage('order', 'template', 'notexist');
                    return $this->error([$msg]);
                }
                // 变更状态
                $data = [
                    'order_status' => '4',
                ];
                if (!$order->save($data)) {
                    // 报错
                    $msg = $this->getValidateMessage('order', 'db', 'save-failed');
                    return $this->error([$msg]);
                }
                // 最终返回成功
                return $this->success();
            } else {
                // 报错
                $msg = $this->getValidateMessage('model-delete-message');
                return $this->error([$msg]);
            }
        }
    }

    /**
     * 订单退款
     * @return false|string
     */
    public function refundAction()
    {
        // 逻辑
        // 先过滤
        if ($this->request->isPost()) {
            if ($rs = $this->session->get('member')) {
                $params = $this->dispatcher->getParams();
                if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                    exit('Params error!');
                }
                // 赋值
                $id = $params[0];
                // 查找订单是否存在，订单要求为已付款未完成状态
                $order = TbShoporderCommon::findFirst("member_id=".$rs['id']." and id=".$id." and order_status=2");
                if (!$order) {
                    // 取出错误信息
                    $msg = $this->getValidateMessage('order', 'template', 'notexist');
                    return $this->error([$msg]);
                }
                // 变更状态，向第三方接口申请退款，这个最好用异步通知来做
                $refund_result = $this->refundapiAction();
                // 如果退款成功，状态变为6-已退款
                if ($refund_result['result_code'] == 'SUCCESS') {
                    // 变更状态为已退款
                    $data = [
                        'order_status' => '6',
                    ];
                } else {
                    // 否则变为退款中
                    $data = [
                        'order_status' => '5',
                    ];
                }
                // 写入变更状态
                if (!$order->save($data)) {
                    // 报错
                    $msg = $this->getValidateMessage('order', 'db', 'save-failed');
                    return $this->error([$msg]);
                }
                // 最终返回成功
                return $this->success();
            } else {
                // 报错
                $msg = $this->getValidateMessage('model-delete-message');
                return $this->error([$msg]);
            }
        }
    }
    
}
