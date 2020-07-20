<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbBuycar;
use Asa\Erp\TbColortemplate;
use Asa\Erp\TbCompany;
use Asa\Erp\TbMemberAddress;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbShoporder;
use Asa\Erp\TbShoporderCommon;
use Asa\Erp\TbSizecontent;
use Asa\Erp\Util;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\View;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;
use Yansongda\Pay\Log;

/**
 * 订单操作类
 * Class OrderController
 * @package Multiple\Shop\Controllers
 */
class OrderController extends AdminController
{
    /**
     * 关闭index控制器
     */
    public function indexAction()
    {
        // 逻辑
        // 传递错误
        return $this->renderError('make-an-error', '404-not-found');
    }


    /**
     * 订单详情首页
     * @param int $id
     * @return false|Response|ResponseInterface|string|void
     */
    public function detailAction($id)
    {
        // 如果是post请求
        if ($member = $this->member && $this->request->isPost()) {
            if (!$order = TbShoporderCommon::findFirst("id=" . $id)) {
                return $this->error($this->getValidateMessage('no-data'));
            }
            return $this->success($order->toArray());
        }

        // 下面是普通get请求
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 但是如果是超级管理员，是可以看到他公司的所有用户的订单的，这个毋庸置疑
        if ($this->issuperadmin) {
            $sql = "id = " . $id;
        } else {
            if ($this->isadmin) {
                // 如果是普通管理员，只能查看属于本公司的所有订单
                $sql = "company_id = " . $this->currentCompany . " and id = " . $id;
            } else {
                // 如果是普通用户，只能查看属于自己的订单
                $sql = "member_id = " . $member['id'] . ' and id=' . $id;
            }
        }
        // 查看订单
        $order = TbShoporderCommon::findFirst($sql);
        // 判断是否存在
        if ($order) {
            // 写入最新的订单状态
            $data['order_status'] = $order->getSimpleOrderStatus();
            // 是否允许付款
            $data['isAllowPaymentOrder'] = $order->isAllowPaymentOrder();
            // 显示订单的最新状态
            $data['getOrderStatus'] = $order->getOrderStatus();
            // 赋值
            $data['common'] = $order;
            $data['product'] = $order->getShoporder();
            $data['addresses'] = TbMemberAddress::find("member_id=" . $member['id']);
            // 转成数组
            $data = json_decode(json_encode($data), true);
            // 给商品加入封面图和id
            foreach ($data['product'] as $k => $item) {
                $data['product'][$k]['picture'] = $this->file_prex . $item['picture'];
                $data['product'][$k]['product_detail_id'] = $item['product_id'];
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
    }


    /**
     * 订单结算页面
     * @param int $id 订单id
     * @return Response|ResponseInterface|View|void
     */
    public function paymentAction($id)
    {
        // 下面是普通的get请求
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }
        // 判断订单是否存在
        if (!$order = TbShoporderCommon::findFirst("id=$id AND member_id=" . $member['id'])) {
            $title = 'make-an-error';
            $msg = $this->getValidateMessage('order', 'template', 'notexist');
            return $this->renderError($title, $msg);
        }
        // 开始组装数据
        // 写入最新的订单状态
        $data['order_status'] = $order->getOrderStatus();
        // 是否允许付款
        $data['isAllowPaymentOrder'] = $order->isAllowPaymentOrder();

        // 赋值
        $data['common'] = $order;
        $data['product'] = $order->getShoporder();
        // 转成数组
        $data = json_decode(json_encode($data), true);
        // 给商品加入封面图和id
        foreach ($data['product'] as $k => $item) {
            $data['product'][$k]['picture'] = $this->file_prex . $item['picture'];
            $data['product'][$k]['product_detail_id'] = $item['product_id'];
        }
        // 分配模板
        $this->view->setVars([
            'data' => $data,
        ]);
    }


    /**
     * 把购物车添加到订单
     * @return false|string|void
     */
    public
    function addOrderAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 判断是否登录
            if ($rs = $this->member) {

                // 判断地址是否为空
                if (!$this->request->get('address_id')) {
                    return $this->error($this->getValidateMessage('please-choose-address'));
                }

                // 首先判断地址是否是当前用户的
                if (!$addressModel = TbMemberAddress::findFirst("id={$this->request->get('address_id')} AND member_id=" . $rs['id'])) {
                    return $this->error($this->getValidateMessage('address', 'template', 'notexist'));
                }

                // 因为逻辑涉及到操作多个表，所以务必使用事务处理，以保证完整性
                // 采用事务处理
                $this->db->begin();

                // 首先判断是否有库存，如果没有库存就不能下单
                // 因为下单的时候是按照尺码下单的，这个时候需要分别统计
                // 首先取出销售端口，查库存用
                // 在取出库存之前，首先获取销售端口
                $company = TbCompany::findFirstById($rs['companyid']);
                $saleport = $company->shopSaleport;
                $array = Util::recordListColumn($saleport->saleportWarehouses, 'warehouseid');

                // 遍历
                // 多语言字段
                $name = $this->getlangfield('name');
                // 并取出当前尺码的实际库存
                foreach ($_POST['data'] as $k => $item) {
                    // 产品模型
                    $productModel = TbProductSearch::findFirstById($item['product_id']);
                    // 尺码模型
                    $sizecontentModel = TbSizecontent::findFirstById($item['size_id']);
                    // 如果商品不存在，那么就回滚报错
                    if (!$productModel) {
                        // 回滚
                        $this->db->rollback();
                        return $this->error($this->getValidateMessage('product', 'template', 'notexist'));
                    }
                    // 如果尺码不存在，也回滚报错
                    if (!$sizecontentModel) {
                        // 回滚
                        $this->db->rollback();
                        return $this->error($this->getValidateMessage('sizecontent', 'template', 'notexist'));
                    }
                    // 组装库存数据列表
                    $stockModel = TbProductstock::sum([
                        sprintf("warehouseid in (%s) and defective_level=0 and productid = %s and sizecontentid = %s", implode(',', $array), $productModel->productid, $item['size_id']),
                        "group"  => 'productid, sizecontentid',
                        "column" => 'number',
                    ]);
                    // 如果库存信息存在
                    if ($stockModel) {
                        $stock = $stockModel->toArray();
                        $stocknumber = $stock[0]['sumatory'];
                    } else {
                        $stocknumber = 0;
                    }
                    // 把实际库存数量放回原来的数组
                    $_POST['data'][$k]['stocknumber'] = $stocknumber;
                    // 尺码名称也放进去
                    $_POST['data'][$k]['size_name'] = $sizecontentModel->name;
                    // 颜色也放进去
                    $_POST['data'][$k]['color_id'] = $productModel->color;
                    // 颜色描述默认为空
                    $color_name = '';
                    if ($productModel->color) {
                        $colorids = explode(',', $productModel->color);
                        $colornames = [];
                        foreach ($colorids as $colorid) {
                            $colorModel = TbColortemplate::findFirstById($colorid);
                            if ($colorModel) {
                                $colorname = $colorModel->$name;
                            } else {
                                $colorname = '';
                            }
                            $colornames[] = $colorname;
                        }
                        // 合并为字符串
                        $color_name = implode(',', $colornames);
                    }
                    $_POST['data'][$k]['color_name'] = $color_name;
                    // 产品模型也放进去
                    $_POST['data'][$k]['product'] = $productModel->toArray();
                    // 产品价格
                    $_POST['data'][$k]['product']['realprice'] = $productModel->product->wordprice;
                }


                // 接着判断库存够不够
                // 生成订单的时候验证库存，同时付款的时候也要再检查一次
                // 重新写入订单主表
                // 为了防止篡改，只接收传过来的商品id，价格什么的统一由后台进行计算
                // 声明变量用来保存订单
                // 商品总价格
                $total_price = 0;
                // 运费，默认为0
                $send_price = $_POST['send_price'];
                // 购物车一维数组
                $buycars = [];
                foreach ($_POST['data'] as $k => $item) {
                    // 挨个库存进行对比
                    if ($item['number'] > $item['stocknumber']) {
                        // 回滚
                        $this->db->rollback();
                        return $this->error($this->getValidateMessage('out-of-stock'));
                    }
                    // 然后计算总金额
                    // 然后把新的从数据库查询出来的数据装进post数组里
                    $_POST['data'][$k]['total_price'] = $item['product']['realprice'] * $item['number'];
                    // 重新计算总金额，采用高精度计算
                    $total_price = bcadd($total_price, $item['product']['realprice'] * $item['number'], 2);
                    // 把购物车订单也组合起来
                    $buycars[] = $item['id'];
                }

                // 最终成交价格=商品总价格+运费，采用高精度计算
                $final_price = bcadd($total_price, $send_price, 2);
                // 如果总价格为0，则提示不能下单
                if ($final_price == 0) {
                    // 回滚
                    $this->db->rollback();
                    return $this->error($this->getValidateMessage('zero-not-allow-to-order'));
                }


                // 首先更改用户地址表的最后使用时间
                $date = date('Y-m-d H:i:s');
                $addressModel->setLastUsedAt($date);
                if (!$addressModel->save()) {
                    // 回滚
                    $this->db->rollback();
                    return $this->error($this->getValidateMessage('address', 'db', 'save-failed'));
                }


                // 开始添加订单主表
                // 默认订单有效期为1个小时，但是如果用户不需要锁库存，那么就不添加订单有效期
                $now = time();
                // 生成唯一订单号
                $generate_trade_no = TbShoporderCommon::getAvailableOrderNo();
                $model_common = new TbShoporderCommon();
                // 添加地址信息
                $model_common->setAddress([
                    'address' => $addressModel->getFullAddress() ?: '',
                    'name'    => $addressModel->getName() ?: '',
                    'tel'     => $addressModel->getTel() ?: '',
                    'zipcode' => $addressModel->getZipcode() ?: '',
                ]);
                $model_common->setTotalPrice($total_price);
                $model_common->setSendPrice($send_price);
                $model_common->setFinalPrice($final_price);
                $model_common->setCreateTime(date("Y-m-d H:i:s", $now));
                $model_common->setExpireTime(date("Y-m-d H:i:s", $now + 3600));
                $model_common->setMemberId($rs['id']);
                $model_common->setCompanyId($rs['companyid']);
                // 把订单号加入到更新变量
                $model_common->setOrderNo($generate_trade_no);
                if (!$model_common->save()) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($model_common);
                }

                // 接着添加订单详情表
                $data_common = [];
                foreach ($_POST['data'] as $key => $value) {
                    $data_common = [
                        'order_commonid' => $model_common->getId(),
                        'product_id'     => $value['product_id'],
                        'product_name'   => $value['product']['productname'],
                        'price'          => $value['product']['realprice'],
                        'number'         => $value['number'],
                        'total_price'    => $value['total_price'],
                        'picture'        => $value['product']['picture'],
                        'picture2'       => $value['product']['picture2'],
                        'color_id'       => $value['color_id'],
                        'color_name'     => $value['color_name'],
                        'size_id'        => $value['size_id'],
                        'size_name'      => $value['size_name'],
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
                foreach ($buycars as $buycarid) {
                    $model = TbBuycar::findFirstById($buycarid);
                    if (!$model) {
                        // 回滚
                        $this->db->rollback();
                        // 取出错误信息
                        return $this->error($this->getValidateMessage('buycar', 'template', 'notexist'));
                    }
                    if (!$model->delete()) {
                        // 回滚
                        $this->db->rollback();
                        // 取出错误信息
                        return $this->error($model);
                    }
                }


                // 因为有的客户下单不锁库存，所以要先判断，如果is_lockstock是1才锁库存
                // 商品表执行减库存操作逻辑
                if (isset($rs['is_lockstock']) && $rs['is_lockstock']) {
                    foreach ($_POST['data'] as $item) {
                        // 产品库存模型，采用悲观锁
                        $model = TbProductSearch::findFirst([
                            'conditions' => 'id=' . $item['product_id'],
                            'for_update' => true,
                        ]);
                        // 做减法
                        // 本来应该检测是否超卖的，但是上一步已经验证有库存，所以最终值不会小于0
                        $model->number -= $item['number'];
                        if (!$model->save()) {
                            // 回滚
                            $this->db->rollback();
                            // 取出错误信息
                            return $this->error($model);
                        }
                    }
                }


                // 提交事务
                $this->db->commit();

                // 把这个新订单推送到队列中，如果1个小时不付款，那么就直接删除该订单
                if ($this->queue) {
                    $this->queue->choose('my_checkorder_tube');
                    // 只把必要的参数传递给队列即可，剩下的逻辑交给Beanstalk吧。
                    $this->queue->put($model_common->getId(), $this->config->queue->toArray());
                }

                // 返回提交成功，并且返回新订单的ID
                return $this->success($model_common->getId());

            } else {
                // 返回错误信息
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }
    }


    /**
     * 我的订单列表
     * @return Response|ResponseInterface|void
     */
    public
    function listAction()
    {
        // 逻辑
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);

        // 找到所有的主订单列表，并且按照创建时间倒叙排列
        $orders = TbShoporderCommon::find("member_id = " . $member['id'] . " order by create_time desc");

        // 整合子订单
        $orders_array = $orders->toArray();
        foreach ($orders as $k => $order) {
            // 子订单信息
            $orders_array[$k]['orderdetails'] = $order->getShoporder()->toArray();
            // 订单状态
            $orders_array[$k]['order_status'] = $order->getSimpleOrderStatus();
            // 是否显示截至时间
            $orders_array[$k]['isShowExpiretime'] = $order->isShowExpiretime();
            // 是否显示计算后的价格
            $orders_array[$k]['isShowTotalprice'] = $order->isShowTotalprice();
            // 是否显示去支付和取消订单按钮
            $orders_array[$k]['isShowPayAndCancledButtons'] = $order->isShowPayAndCancledButtons();
            // 是否显示退款按钮
            $orders_array[$k]['isShowRefundButton'] = $order->isShowRefundButton();
            // 是否显示订单已经过了截至时间
            $orders_array[$k]['isShowOverExpired'] = $order->isShowOverExpired();
            // 是否显示订单已经被用户主动取消了
            $orders_array[$k]['isShowCancled'] = $order->isShowCancled();
            // 是否显示退款状态
            $orders_array[$k]['isShowRefundStatus'] = $order->isShowRefundStatus();

            // 子订单加入额外信息
            foreach ($orders_array[$k]['orderdetails'] as $key => $value) {
                // 封面图
                $orders_array[$k]['orderdetails'][$key]['picture'] = $this->file_prex . $value['picture'];
                // id
                $orders_array[$k]['orderdetails'][$key]['product_detail_id'] = $value['product_id'];
                // 如果是未付款或者订单已关闭，则实付价格为0
                if ($order->getOrderStatus() == $this->getValidateMessage('order-unpaid') || $order->getOrderStatus() == $this->getValidateMessage('order-closed')) {
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
            'page'   => $page,
        ]);
    }


    /**
     * 取出支付状态
     * @param string $paystatus tb_shoporder_common中order_status的值
     * @return string 支付状态说明
     */
    public
    function paystatus($paystatus)
    {
        // 逻辑
        switch ($paystatus) {
            case '1':
                $paystatus_desc = $this->getValidateMessage('unpaid');
                break;
            case '2':
                $paystatus_desc = $this->getValidateMessage('payment-not-completed');
                break;
            case '3':
                $paystatus_desc = $this->getValidateMessage('completed');
                break;
            case '4':
                $paystatus_desc = $this->getValidateMessage('cancelled');
                break;
            case '5':
                $paystatus_desc = $this->getValidateMessage('refunding');
                break;
            case '6':
                $paystatus_desc = $this->getValidateMessage('refunded');
                break;
            default:
                $paystatus_desc = $this->getValidateMessage('unpaid');
        }
        // 返回
        return $paystatus_desc;
    }


    /**
     * 用户主动取消订单
     * @param int $id
     * @return false|Response|ResponseInterface|string|void
     */
    public
    function cancleAction($id)
    {
        // 逻辑
        // 先过滤
        if ($this->request->isPost()) {
            if ($rs = $this->member) {
                // 查找订单是否存在，订单要求为未付款状态
                $order = TbShoporderCommon::findFirst("member_id=" . $rs['id'] . " and id=" . $id . " and pay_time is null");
                if (!$order) {
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
                }

                // 判断有没有传递第二个参数，如果有则说明是主动取消的订单
                if (isset($params[1])) {
                    $expire_time = NULL;
                } else {
                    $expire_time = $order->getExpireTime();
                }

                // 取出每个订单下面具体商品信息
                $shoporders = $order->getShoporder();

                // 开启事务处理，因为涉及到库存变化
                $this->db->begin();
                // 变更状态
                $data = [
                    'closed'      => '1',
                    'expire_time' => $expire_time,
                ];
                if (!$order->save($data)) {
                    // 回滚
                    $this->db->rollback();
                    // 报错
                    return $this->error($this->getValidateMessage('order', 'db', 'save-failed'));
                }


                // 锁定库存还原
                // 如果不锁定库存，那么库存无需还原
                if (isset($rs['is_lockstock']) && $rs['is_lockstock']) {
                    foreach ($shoporders as $shoporder) {
                        // 执行写入，为了安全，这里采用悲观锁进行处理
                        $productSearchModel = TbProductSearch::findFirst([
                            'conditions' => 'id=' . $shoporder->product_id,
                            'for_update' => true,
                        ]);
                        // 商品不存在回滚
                        if (!$productSearchModel) {
                            // 回滚
                            $this->db->rollback();
                            return $this->error($this->getValidateMessage('product-doesnot-exist'));
                        }
                        // 开始还原
                        $productSearchModel->number += $shoporder->number;
                        if (!$productSearchModel->save()) {
                            // 回滚
                            $this->db->rollback();
                            return $this->error($this->getValidateMessage('order', 'db', 'save-failed'));
                        }
                    }
                }

                // 事务提交
                $this->db->commit();
                // 最终返回成功
                return $this->success();
            } else {
                // 报错
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }
    }


    /**
     * 订单申请退款
     * @param int $id
     * @return false|Response|ResponseInterface|string|void
     */
    public
    function applyrefundAction($id)
    {
        // 逻辑
        // 判断订单是否存在
        if ($this->request->isPost() && $rs = $this->member) {
            // 查找订单是否存在，订单要求为已付款状态，订单不能关闭，退款状态必须为pending
            $order = TbShoporderCommon::findFirst("member_id=" . $rs['id'] . " and id=" . $id);
            if (!$order) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
            }

            // 判断订单是否已付款，如果没付款则不能退款
            if (!$order->getPayTime()) {
                return $this->error($this->getValidateMessage('paid-not-allowed-to-refund'));
            }
            // 判断订单退款状态是否正确
            if ($order->getRefundStatus() !== TbShoporderCommon::REFUND_STATUS_PENDING) {
                return $this->error($this->getValidateMessage('order-has-been-refunded'));
            }
            // 将用户输入的退款理由放到订单的 extra 字段中
            $extra = $order->getExtra() ?: [];
            $extra['refund_reason'] = $this->request->get('reason');
            // 将订单退款状态改为已申请退款
            $order->setRefundStatus(TbShoporderCommon::REFUND_STATUS_APPLIED)->setExtra($extra);
            // 如果更新失败
            if (!$order->save()) {
                return $this->getValidateMessage('order', 'db', 'save-failed');
            }
            // 如果不报错，则默认成功
            return $this->success();
        }
    }

    /**
     * 更改未支付订单的截止时间
     * @return false|\Phalcon\Http\Response|ResponseInterface|string|void
     */
    public
    function updatetimeAction()
    {
        // 逻辑
        // 必须为管理员，而且是post请求
        if ($member = $this->member && $this->member['membertype'] && $this->request->isPost()) {
            // 赋值
            $id = $this->request->get('id');
            $expire_time = $this->request->get('expire_time');

            // 取出参数
            if (!$id || !$expire_time) {
                return $this->error($this->getValidateMessage('params-error'));
            }

            // 取出订单
            if (!$model = TbShoporderCommon::findFirst([
                "id = :id: AND pay_time is null AND closed = 0",
                'bind' => [
                    'id' => $id,
                ],
            ])) {
                return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
            }

            // 开始更改截止时间
            if (!$model->save(compact('expire_time'))) {
                return $this->error($this->getValidateMessage('order', 'db', 'save-failed'));
            } else {
                return $this->success();
            }
        }
    }


    /**
     * 订单退款逻辑
     * @param TbShoporderCommon $order 订单模型
     * @return false|Response|ResponseInterface|string
     */
    public
    function refundOrder(TbShoporderCommon $order)
    {
        // 逻辑
        Util::closeDisplayErrors();
        // 判断该订单的支付方式
        switch ($order->getPaymentMethod()) {
            // 微信支付
            case 'wechat':
                // 生成退款订单号
                $refundNo = TbShoporderCommon::getAvailableRefundNo();
                // 用try，cache捕捉错误
                try {
                    $this->wechat_pay->refund([
                        'out_trade_no'  => $order->getOrderNo(), // 之前的订单流水号
                        'total_fee'     => $order->getFinalPrice() * 100, //原订单金额，单位分
                        'refund_fee'    => $order->getFinalPrice() * 100, // 要退款的订单金额，单位分
                        'out_refund_no' => $refundNo, // 退款订单号
                        // 微信支付的退款结果并不是实时返回的，而是通过退款回调来通知，因此这里需要配上退款回调接口地址
                        'notify_url'    => $this->config['pay']['wechat']['notify_url'],
                    ]);
                } catch (\Exception $e) {
                    // 定义退款失败
                    // 把失败原因记录日志
                    Log::error('订单号' . $order->getOrderNo() . '退款失败：', $e->raw);
                    return $this->getValidateMessage('refund_status_failed');
                }
                // 将订单状态改成退款中
                $order->save([
                    'refund_no'     => $refundNo,
                    'refund_status' => TbShoporderCommon::REFUND_STATUS_PROCESSING,
                ]);
                break;
            // 支付宝支付
            case 'alipay':
                // 用我们刚刚写的方法来生成一个退款订单号
                $refundNo = TbShoporderCommon::getAvailableRefundNo();
                // 调用支付宝支付实例的 refund 方法
                try {
                    $ret = $this->alipay->refund([
                        'out_trade_no'   => $order->getOrderNo(), // 之前的订单流水号
                        'refund_amount'  => $order->getFinalPrice(), // 退款金额，单位元
                        'out_request_no' => $refundNo, // 退款订单号
                    ]);
                } catch (\Exception $e) {
                    // 定义退款失败
                    // 把失败原因记录日志
                    Log::error('订单号' . $order->getOrderNo() . '退款失败：', $e->raw);
                    return $this->getValidateMessage('refund_status_failed');
                }

                // 根据支付宝的文档，如果返回值里有 sub_code 字段说明退款失败
                if ($ret->sub_code) {
                    // 将退款失败的保存存入 extra 字段
                    // 首先取出原来的内容
                    $extra = $order->getExtra();
                    if (is_array($extra)) {
                        $extra['refund_failed_code'] = $ret->sub_code;
                    }
                    // 将订单的退款状态标记为退款失败
                    $order->save([
                        'refund_no'     => $refundNo,
                        'refund_status' => TbShoporderCommon::REFUND_STATUS_FAILED,
                        'extra'         => $extra,
                    ]);
                } else {
                    // 将订单的退款状态标记为退款成功并保存退款订单号
                    $order->save([
                        'refund_no'     => $refundNo,
                        'refund_status' => TbShoporderCommon::REFUND_STATUS_SUCCESS,
                    ]);
                }
                break;
            default:
                // 原则上不可能出现，这个只是为了代码健壮性
                // 取出错误信息
                return $this->getValidateMessage('unknown_refund_method');
        }

        // 如果没有返回，则最终确认成功
        return $this->success();
    }


    /**
     * 同意退款
     * @param int $id 订单编号
     * @return false|Response|ResponseInterface|string|void
     */
    public function refundagreeAction($id)
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member && $this->isadmin) {
            // 取出订单
            $order = TbShoporderCommon::findFirst("id=" . $id);
            if (!$order) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
            }
            // 判断订单状态是否正确
            if ($order->getRefundStatus() !== TbShoporderCommon::REFUND_STATUS_APPLIED) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('shoporder-status-error'));
            }

            // 开始调用退款逻辑
            // 调用退款逻辑
            $result = $this->refundOrder($order);
            // 如果是json，则退款成功，否则退款失败
            if (!Util::is_json($result)) {
                return $this->error($result);
            }

            // // 开始执行还原库存操作，还原库存涉及物流，这里暂时不处理这个逻辑
            // // 用户锁库存才涉及到库存还原，否则直接无视即可。
            // if (isset($member['is_lockstock']) && $member['is_lockstock']) {
            //     // 取出每个订单下面具体商品信息
            //     $shoporders = $order->getShoporder();
            //     // 如果是已退款，还得还原库存，还原库存同样采用悲观锁处理
            //     foreach ($shoporders as $shoporder) {
            //         // 执行写入，为了安全，这里采用悲观锁进行处理
            //         $productSearchModel = TbProductSearch::findFirst([
            //             'conditions' => 'id=' . $shoporder->product_id,
            //             'for_update' => true,
            //         ]);
            //         // 商品不存在报错
            //         if (!$productSearchModel) {
            //             return $this->error($this->getValidateMessage('product-doesnot-exist'));
            //         }
            //         // 开始还原
            //         $productSearchModel->number += $shoporder->number;
            //         if (!$productSearchModel->save()) {
            //             return $this->error($this->getValidateMessage('order', 'db', 'save-failed'));
            //         }
            //     }
            // }

            // 如果到现在为止没有任何返回，则最终成功
            return $this->success();
        }
    }


    /**
     * 不同意退款
     * @param int $id 订单编号
     * @return false|Response|ResponseInterface|string|void
     */
    public function refunddisagreeAction($id)
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member && $this->isadmin) {
            // 取出order
            $order = TbShoporderCommon::findFirst("id=" . $id);
            if (!$order) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
            }
            // 判断订单状态是否正确
            if ($order->getRefundStatus() !== TbShoporderCommon::REFUND_STATUS_APPLIED) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('shoporder-status-error'));
            }
            // 将拒绝退款理由放到订单的 extra 字段中
            $extra = $order->getExtra() ?: [];
            $extra['refund_disagree_reason'] = $this->request->get('reason');
            // 将订单的退款状态改为未退款
            $order->setRefundStatus(TbShoporderCommon::REFUND_STATUS_PENDING)->setExtra($extra);
            if (!$order->save()) {
                return $this->getValidateMessage('order', 'db', 'save-failed');
            }
            // 如果没有任何错误返回，则说明成功
            return $this->success();
        }
    }


    /**
     * 订单发货，必须是管理员
     * @param int $id 订单编号
     * @return false|Response|ResponseInterface|string|void
     */
    public function shipAction($id)
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member && $this->isadmin) {
            // 物流发货信息不能为空
            if (!$this->request->get('express_company') || !$this->request->get('express_no')) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('logistics-incomplete'));
            }
            // 赋值
            $express_company = $this->request->get('express_company');
            $express_no = $this->request->get('express_no');
            // 取出order
            $order = TbShoporderCommon::findFirst("id=" . $id);
            if (!$order) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
            }
            // 判断当前订单是否已支付
            if (!$order->getPayTime()) {
                return $this->error($this->getValidateMessage('order-unpaid'));
            }
            // 判断当前订单发货状态是否为未发货
            if ($order->getShipStatus() !== TbShoporderCommon::SHIP_STATUS_PENDING) {
                return $this->error($this->getValidateMessage('order-shipped'));
            }
            // 将订单发货状态改为已发货，并存入物流信息
            $shipData = [
                'express_company' => $express_company,
                'express_no'      => $express_no,
            ];
            $order->setShipStatus(TbShoporderCommon::SHIP_STATUS_DELIVERED)->setShipData($shipData);
            if (!$order->save()) {
                return $this->getValidateMessage('order', 'db', 'save-failed');
            }
            // 如果没有任何错误返回，则说明成功
            return $this->success();
        }
    }


    /**
     * 确认收货，这个必须是本人才能操作，不需要管理员权限
     * @param int $id 订单编号
     * @return false|Response|ResponseInterface|string|void
     */
    public function receiveAction($id)
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member) {
            // 取出order
            $order = TbShoporderCommon::findFirst("id=" . $id);
            if (!$order) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
            }
            // 判断订单的发货状态是否为已发货
            if ($order->getShipStatus() !== TbShoporderCommon::SHIP_STATUS_DELIVERED) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('incorrect-delivery-status'));
            }
            // 将订单发货状态改为已签收
            $order->setShipStatus(TbShoporderCommon::SHIP_STATUS_RECEIVED);
            if (!$order->save()) {
                return $this->getValidateMessage('order', 'db', 'save-failed');
            }
            // 如果没有任何错误返回，则说明成功
            return $this->success();
        }
    }

}
