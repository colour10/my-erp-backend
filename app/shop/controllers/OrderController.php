<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbColortemplate;
use Asa\Erp\TbCompany;
use Asa\Erp\TbMemberAddress;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbShoporder;
use Asa\Erp\TbShoporderCommon;
use Asa\Erp\TbBuycar;
use Asa\Erp\TbSizecontent;
use Asa\Erp\Util;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;
use Yansongda\Pay\Pay;

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
     */
    public function detailAction()
    {
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            // 传递错误
            return $this->renderError();
        }
        // 赋值
        $id = $params[0];

        // 判断是否登录
        if ($rs = $this->member) {
            $order = TbShoporderCommon::findFirst(
                "member_id = " . $rs['id'] . ' and id=' . $id
            );
            // 判断是否存在
            if ($order) {
                // 写入最新的订单状态
                $data['order_status'] = $this->getOrderStatus($order);
                // 是否允许付款
                $data['is_allow_payment_order'] = $this->is_allow_payment_order($order);

                // 赋值
                $data['common'] = $order;
                $data['product'] = $order->shoporder;
                $data['addresses'] = TbMemberAddress::find("member_id=" . $rs['id']);
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
        } else {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }
    }

    /**
     * 订单付款
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|void
     */
    public function paymentAction()
    {
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            // 传递错误
            return $this->renderError();
        }
        // 赋值
        $id = $params[0];

        // 判断是否登录
        if ($rs = $this->member) {
            $order = TbShoporderCommon::findFirst(
                "member_id = " . $rs['id'] . ' and id=' . $id
            );
            // 判断是否存在
            if ($order) {
                // 写入最新的订单状态
                $data['order_status'] = $this->getOrderStatus($order);
                // 是否允许付款
                $data['is_allow_payment_order'] = $this->is_allow_payment_order($order);

                // 赋值
                $data['common'] = $order;
                $data['product'] = $order->shoporder;
                $data['addresses'] = TbMemberAddress::find("member_id=" . $rs['id']);
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
        } else {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }
    }

    /**
     * 获取最新的订单状态
     * @param Model $order 订单模型
     * @return string
     */
    private function getOrderStatus(Model $order)
    {
        // 逻辑
        // 是否关闭
        if ($order->closed) {
            return $this->getValidateMessage('order-closed');
        }
        // 是否退款
        if ($order->refund_no) {
            // 接着判断具体的退款状态
            switch ($order->refund_status) {
                case 'applied':
                    return $this->getValidateMessage('refund_status_applied');
                    break;
                case 'processing':
                    return $this->getValidateMessage('refund_status_processing');
                    break;
                case 'success':
                    return $this->getValidateMessage('refund_status_success');
                    break;
                case 'failed':
                    return $this->getValidateMessage('refund_status_failed');
                    break;
                default:
                    return $this->getValidateMessage('refund_status_applied');
                    break;
            }
        }
        // 是否支付
        if ($order->pay_time) {
            return $this->getValidateMessage('payment-success');
        }
        // 如果不符合以上任何情况，则订单未付款
        return $this->getValidateMessage('order-unpaid');
    }

    /**
     * 是否在订单列表中显示截至时间
     * @param TbShoporderCommon $order
     * @return bool
     */
    private function is_show_expireTime(TbShoporderCommon $order)
    {
        // 逻辑
        // 如果订单处于未支付状态，则显示
        if (!$order->getPayTime()) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示计算后的价格
     * @param TbShoporderCommon $order
     * @return bool
     */
    private
    function is_show_totalPrice(TbShoporderCommon $order)
    {
        // 逻辑
        // 如果订单处于支付状态，则显示
        if ($order->getPayTime()) {
            return true;
        }
        return false;
    }

    /**
     * 判断该订单是否允许付款
     * @param TbShoporderCommon $order
     * @return bool
     */
    private function is_allow_payment_order(TbShoporderCommon $order)
    {
        // 逻辑
        // 订单被关闭，不允许付款；
        // 订单有付款时间，不允许付款
        if ($order->getClosed() || $order->getPayTime()) {
            return false;
        }
        return true;
    }

    /**
     * 是否在订单列表中显示去支付和取消订单按钮
     * @param TbShoporderCommon $order
     * @return bool
     */
    private
    function is_show_payAndCancleButtons(TbShoporderCommon $order)
    {
        // 逻辑
        // 如果订单处于未支付状态，并且没有过截至时间，而且订单没有关闭
        if (!$order->getClosed() && !$order->getPayTime() && $order->getExpireTime() > date('Y-m-d H:i:s')) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示退款按钮
     * @param TbShoporderCommon $order
     * @return bool
     */
    private
    function is_show_refundButton(TbShoporderCommon $order)
    {
        // 逻辑
        // 如果订单已经支付，并且退款状态不是pending
        if ($order->getPayTime() && $order->getRefundStatus() !== 'pending') {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示订单已经过了截至时间，已经失效
     * @param TbShoporderCommon $order
     * @return bool
     */
    private
    function is_show_overExpired(TbShoporderCommon $order)
    {
        // 逻辑
        // 如果订单没有支付，并且已经过了截止时间，截至时间不能为空
        if (!$order->getPayTime() && $order->getClosed() && $order->getExpireTime() && $order->getExpireTime() < date('Y-m-d H:i:s')) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示订单已被用户取消的提示
     * @param TbShoporderCommon $order
     * @return bool
     */
    private
    function is_show_cancled(TbShoporderCommon $order)
    {
        // 逻辑
        // 如果订单没有支付，并且已经过了截止时间
        if ($order->getClosed() && !$order->getExpireTime()) {
            return true;
        }
        return false;
    }

    /**
     * 把购物车添加到订单
     * @return false|string
     */
    public
    function addOrderAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 判断是否登录
            if ($rs = $this->member) {
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
                        "group" => 'productid, sizecontentid',
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


                // 开始添加订单主表
                // 默认订单有效期为1个小时
                $now = time();
                $model_common = new TbShoporderCommon();
                $model_common->total_price = $total_price;
                $model_common->send_price = $send_price;
                $model_common->final_price = $final_price;
                $model_common->create_time = date("Y-m-d H:i:s", $now);
                $model_common->expire_time = date("Y-m-d H:i:s", $now + 3600);
                $model_common->member_id = $rs['id'];
                // 生成唯一订单号
                // 如果订单号重复，就一直生成
                do {
                    $generate_trade_no = $this->generate_trade_no();
                } while (TbShoporderCommon::findFirst("order_no = " . $generate_trade_no));

                // 把订单号加入到更新变量
                $model_common->order_no = $generate_trade_no;
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
                        'order_commonid' => $model_common->id,
                        'product_id' => $value['product_id'],
                        'product_name' => $value['product']['productname'],
                        'price' => $value['product']['realprice'],
                        'number' => $value['number'],
                        'total_price' => $value['total_price'],
                        'picture' => $value['product']['picture'],
                        'picture2' => $value['product']['picture2'],
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


                // 商品表执行减库存操作
                // 分别减库存
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

                // 提交事务
                $this->db->commit();

                // 把这个新订单推送到队列中，如果1个小时不付款，那么就直接删除该订单
                if ($this->queue) {
                    $this->queue->choose('my_checkorder_tube');
                    // 只把必要的参数传递给队列即可，剩下的逻辑交给Beanstalk吧。
                    $this->queue->put($model_common->id, [
                        // 任务优先级
                        'priority' => 250,
                        // 延迟时间，表示将job放入ready队列需要等待的秒数，10代表10秒
                        'delay' => 10,
                        // 运行时间，表示允许一个worker执行该job的秒数。这个时间将从一个worker 获取一个job开始计算
                        'ttr' => 3600,
                    ]);
                }

                // 返回提交成功，并且返回新订单的ID
                return $this->success($model_common->id);

            } else {
                // 返回错误信息
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }
    }


    /**
     * 支付订单
     * @return false|string
     */
    public
    function confirmAction()
    {
        // 逻辑
        // 如果是post请求
        if ($this->request->isPost()) {
            if ($rs = $this->member) {
                // 判断是否有传过来参数id，如果有就针对针对单个订单进行支付，否则就针对所有未支付的订单进行支付
                // 过滤
                $params = $this->dispatcher->getParams();
                if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('params-error'));
                }

                // id值
                $id = $params[0];

                // 因为逻辑涉及到操作多个表，所以务必使用事务处理，以保证完整性
                // 采用事务处理
                $this->db->begin();

                // 查找当前id的未支付的订单
                $order = TbShoporderCommon::findFirst(
                    "member_id = " . $rs['id'] . ' and id=' . $id
                );

                // 如果不存在就报错
                if (!$order) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('payment-failed'));
                }

                // 如果订单已支付或者已关闭
                if ($order->pay_time || $order->closed) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('shoporder-status-error'));
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
                        return $this->error($this->getValidateMessage('product', 'template', 'notexist'));
                    }
                    if ($model->number < $item['number']) {
                        // 回滚
                        $this->db->rollback();
                        return $this->error($this->getValidateMessage('out-of-stock'));
                    }
                }

                // 付款成功，开始执行数据库写入操作
                // 如果客户之前存入了地址，就从地址中选择一个插入
                if (isset($_POST['address_id'])) {
                    // 查找地址是否存在
                    $addressModel = TbMemberAddress::findFirst("member_id=" . $rs['id'] . " and id=" . $_POST['address_id']);
                    if (!$addressModel) {
                        // 回滚
                        $this->db->rollback();
                        // 取出错误信息
                        return $this->error($this->getValidateMessage('address-doesnot-exist'));
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
                        return $this->error($this->getValidateMessage('fill-out-required-fields'));
                    }
                    // 验证手机号
                    if (!preg_match("/^1[34578]\d{9}$/", $_POST['reciver_phone'])) {
                        // 回滚
                        $this->db->rollback();
                        return $this->error($this->getValidateMessage('mobile-invalid'));
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
                // 付款时间交给异步通知赋值
                // $order->pay_time = date("Y-m-d H:i:s");
                // 付款方式，如果不存在，则为wechat，也就是微信
                $payment_method = empty($_POST['payment_method']) ? 'wechat' : $_POST['payment_method'];
                $order->payment_method = $payment_method;
                // 订单支付方式
                // 失败则回滚
                if (!$order->save()) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($order);
                }

                // 支付成功减库存逻辑已经放在加入订单逻辑中了，所以这个逻辑暂时取消
                // 如果支付成功，则减库存，但是对tb_product_search减库存不太好，需要对原表进行操作，这里为了演示，就用tb_product_search表做测试好了
                // 分别减库存
                // foreach ($stock as $product) {
                //     $model = TbProductSearch::findFirstById($product['id']);
                //     // 做减法
                //     // 本来应该检测是否超卖的，但是上一步已经验证有库存，所以最终值不会小于0
                //     $model->number -= $product['number'];
                //     if (!$model->save()) {
                //         // 回滚
                //         $this->db->rollback();
                //         // 取出错误信息
                //         return $this->error($model);
                //     }
                // }

                // 提交事务
                $this->db->commit();

                // 写入数据库都已经完毕，下面开始走支付流程
                // 判断是支付宝还是微信，如果是微信
                if ($payment_method == 'wechat') {
                    // 调用微信支付

                } elseif ($payment_method == 'alipay') {
                    // 默认调用支付宝的网页支付，这个将会自动跳转到支付宝的付款页面
                    $this->alipayWeb($order->order_no, $order->final_price, '订单支付');
                } else {
                    // 其他的支付方法暂时不支持
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('params-error'));
                }
            } else {
                // 返回错误信息
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }
    }


    /**
     * 我的订单列表
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
            $orders_array[$k]['orderdetails'] = $order->shoporder->toArray();
            // 订单状态
            $orders_array[$k]['order_status'] = $this->getOrderStatus($order);
            // 是否显示截至时间
            $orders_array[$k]['is_show_expireTime'] = $this->is_show_expireTime($order);
            // 是否显示计算后的价格
            $orders_array[$k]['is_show_totalPrice'] = $this->is_show_totalPrice($order);
            // 是否显示去支付和取消订单按钮
            $orders_array[$k]['is_show_payAndCancleButtons'] = $this->is_show_payAndCancleButtons($order);
            // 是否显示退款按钮
            $orders_array[$k]['is_show_refundButton'] = $this->is_show_refundButton($order);
            // 是否显示订单已经过了截至时间
            $orders_array[$k]['is_show_overExpired'] = $this->is_show_overExpired($order);
            // 是否显示订单已经被用户主动取消了
            $orders_array[$k]['is_show_cancled'] = $this->is_show_cancled($order);

            // 子订单加入额外信息
            foreach ($orders_array[$k]['orderdetails'] as $key => $value) {
                // 封面图
                $orders_array[$k]['orderdetails'][$key]['picture'] = $this->file_prex . $value['picture'];
                // id
                $orders_array[$k]['orderdetails'][$key]['product_detail_id'] = $value['product_id'];
                // 如果是未付款或者订单已关闭，则实付价格为0
                if ($this->getOrderStatus($order) == $this->getValidateMessage('order-unpaid') || $this->getOrderStatus($order) == $this->getValidateMessage('order-closed')) {
                    $orders_array[$k]['orderdetails'][$key]['payment_amount'] = '0.00';
                } else {
                    $orders_array[$k]['orderdetails'][$key]['payment_amount'] = $value['total_price'];
                }
            }
        }

        // 创建分页对象，使用数组分页
        $paginator = new PaginatorArray(
            [
                "data" => $orders_array,
                "limit" => 5,
                "page" => $currentPage,
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
     * 支付宝网站付款接口
     * @param string $out_trade_no 订单号
     * @param string $total_amount 总金额，价格是元
     * @param string $subject 订单标题
     * @return mixed
     */
    public
    function alipayWeb($out_trade_no, $total_amount, $subject)
    {
        // 逻辑
        // 请求参数
        $order = [
            'out_trade_no' => $out_trade_no,
            'total_amount' => $total_amount,
            'subject' => $subject,
        ];
        // 支付
        $alipay = $this->alipay->web($order);
        // 返回
        return $alipay->send();
    }

    /**
     * 微信扫码支付
     * @param string $out_trade_no 订单号
     * @param string $body 订单标题
     * @param string $total_fee 总金额，价格是分
     * @return mixed
     */
    public
    function wechatpayScan($out_trade_no, $body, $total_fee)
    {
        // 逻辑
        // 请求参数
        $order = [
            'out_trade_no' => $out_trade_no,
            'body' => $body,
            'total_fee' => $total_fee,
        ];
        // 支付
        $result = $this->wechat_pay->scan($order);
        // 返回二维码
        return $result->code_url;
    }


    /**
     * @param string $out_trade_no 订单号
     * @param string $refund_amount 退款金额，单位为元
     * @return mixed
     */
    public
    function alipayRefund($out_trade_no, $refund_amount)
    {
        // 逻辑
        $order = [
            'out_trade_no' => $out_trade_no,
            'refund_amount' => $refund_amount,
        ];
        // 退款
        $result = $this->alipay->refund($order);
        // 返回
        return $result;
    }

    /**
     * 第三方异步通知接口，因为是自动配置并接受，所以只需要处理逻辑即可。
     * 这个部分需要重写，现在只是演示
     * @return array
     */
    public
    function notifyapiAction()
    {
        // 逻辑
        // result_code的值SUCCESS则退款成功，FAIL则为退款成功
        return ['result_code' => 'SUCCESS'];
    }

    /**
     * 生成唯一订单号
     * @return string
     */
    private
    function generate_trade_no()
    {
        // 逻辑
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
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
     * @return false|string
     */
    public
    function cancleAction()
    {
        // 逻辑
        // 先过滤
        if ($this->request->isPost()) {
            if ($rs = $this->member) {
                $params = $this->dispatcher->getParams();
                if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                    // 传递错误
                    return $this->renderError();
                }
                // 赋值
                $id = $params[0];

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
                    $expire_time = $order->expire_time;
                }

                // 取出每个订单下面具体商品信息
                $shoporders = $order->shoporder;

                // 开启事务处理，因为涉及到库存变化
                $this->db->begin();
                // 变更状态
                $data = [
                    'closed' => '1',
                    'expire_time' => $expire_time,
                ];
                if (!$order->save($data)) {
                    // 回滚
                    $this->db->rollback();
                    // 报错
                    return $this->error($this->getValidateMessage('order', 'db', 'save-failed'));
                }
                // 锁定库存还原
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
     * 订单退款
     * @return false|string
     */
    public
    function refundAction()
    {
        // 逻辑
        // 先过滤
        if ($this->request->isPost()) {
            // 是否登录
            if ($rs = $this->member) {
                $params = $this->dispatcher->getParams();
                if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                    // 传递错误
                    return $this->renderError();
                }
                // 赋值
                $id = $params[0];

                // 采用事务处理
                $this->db->begin();

                // 查找订单是否存在，订单要求为已付款未完成状态
                $order = TbShoporderCommon::findFirst("member_id=" . $rs['id'] . " and id=" . $id . " and order_status=2");
                if (!$order) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
                }

                // 取出每个订单下面具体商品信息
                $shoporders = $order->shoporder;

                // // 开始申请退款
                // $this->alipayRefund();
                //
                // // 变更状态，向第三方接口申请退款，这个最好用异步通知来做
                // $refund_result = $this->refundapiAction();
                // 如果退款成功，状态变为6-已退款
                if ($refund_result['result_code'] == 'SUCCESS') {
                    // 变更状态为已退款
                    $order_status = '6';
                    // 如果是已退款，还得还原库存，还原库存同样采用悲观锁处理
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
                } else {
                    // 否则变为退款中
                    $order_status = '5';
                }
                // 写入变更状态
                if (!$order->save(compact('order_status'))) {
                    // 回滚
                    $this->db->rollback();
                    // 报错
                    return $this->error($this->getValidateMessage('order', 'db', 'save-failed'));
                }

                // 提交事务
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
     * 更改未支付订单的截止时间
     * @return false|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|string
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
                "id = :id: AND order_status = 1",
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

}
