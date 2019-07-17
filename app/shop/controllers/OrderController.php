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
use Endroid\QrCode\QrCode;
use Phalcon\Http\Response;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

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
        // 但是如果是超级管理员，是可以看到他公司的所有用户的订单的，这个毋庸置疑
        if ($rs = $this->member) {
            // 如果是超级管理员，能查看所有的订单
            if ($this->issuperadmin) {
                $sql = "id = " . $id;
            } else {
                if ($this->isadmin) {
                    // 如果是普通管理员，只能查看属于本公司的所有订单
                    $sql = "company_id = " . $this->currentCompany . " and id = " . $id;
                } else {
                    // 如果是普通用户，只能查看属于自己的订单
                    $sql = "member_id = " . $rs['id'] . ' and id=' . $id;
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
                $data['order_status'] = $order->getOrderStatus();
                // 是否允许付款
                $data['isAllowPaymentOrder'] = $order->isAllowPaymentOrder();

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
                // 如果总价格为0，则提示不能下单
                if ($final_price == 0) {
                    // 回滚
                    $this->db->rollback();
                    return $this->error($this->getValidateMessage('zero-not-allow-to-order'));
                }


                // 开始添加订单主表
                // 默认订单有效期为1个小时，但是如果用户不需要锁库存，那么就不添加订单有效期
                $now = time();
                $model_common = new TbShoporderCommon();
                $model_common->setTotalPrice($total_price);
                $model_common->setSendPrice($send_price);
                $model_common->setFinalPrice($final_price);
                $model_common->setCreateTime(date("Y-m-d H:i:s", $now));
                $model_common->setExpireTime(date("Y-m-d H:i:s", $now + 3600));
                $model_common->setMemberId($rs['id']);
                $model_common->setCompanyId($rs['companyid']);
                // 生成唯一订单号
                $generate_trade_no = TbShoporderCommon::getAvailableOrderNo();
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
                    $this->queue->put($model_common->getId(), [
                        // 任务优先级
                        'priority' => 250,
                        // 延迟时间，表示将job放入ready队列需要等待的秒数，10代表10秒
                        'delay' => 10,
                        // 运行时间，表示允许一个worker执行该job的秒数。这个时间将从一个worker 获取一个job开始计算
                        'ttr' => 3600,
                    ]);
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
                    return $this->error($this->getValidateMessage('order', 'template', 'notexist'));
                }

                // 如果订单已支付或者已关闭
                if ($order->getPayTime() || $order->getClosed()) {
                    // 回滚
                    $this->db->rollback();
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('shoporder-status-error'));
                }

                // 存在则付款
                // 但是在付款之前，要先检查是否还有库存，如果没有库存，则提示库存不足
                // 声明一个新数组来保存最终统计的变量
                // 付款时，如果判断付款人是不需要锁定库存的，那么就不需要检查库存
                $memberModel = $order->getMember();
                if ($memberModel && isset($memberModel->is_lockstock) && $memberModel->is_lockstock) {
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
                        $model = TbProductSearch::findFirst("id=" . $item['id']);
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
                    $order->setReciverName($addressModel->name);
                    $order->setReciverPhone($addressModel->tel);
                    // 身份证暂时不需要，注释掉
                    // $order->reciver_no = $address->idno;
                    $order->setReciverAddress($addressModel->address);
                } else {
                    // 否则就新建一个地址
                    // 但是要先验证数据合法性
                    // 不能为空
                    if (!isset($_POST['reciver_name']) || !isset($_POST['reciver_phone']) || !isset($_POST['reciver_address'])) {
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
                    $name = $_POST['reciver_name'];
                    $tel = $_POST['reciver_phone'];
                    $address = $_POST['reciver_address'];
                    $order->setReciverName($name);
                    $order->setReciverPhone($tel);
                    $order->setReciverAddress($address);
                    // 身份证暂时不需要，注释掉
                    // $order->reciver_no = $idno = $_POST['reciver_no'];
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
                $order->setPaymentMethod($payment_method);
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
                    // 请求参数
                    $order = [
                        // 订单编号，需保证在商户端不重复
                        'out_trade_no' => $order->getOrderNo(),
                        // 订单金额，单位分，支持小数点后两位
                        'total_fee' => $order->getFinalPrice() * 100,
                        // 订单标题
                        'body' => 'Wechat payment',
                    ];
                    // 支付
                    $result = $this->wechat_pay->scan($order);

                    // 把要转换的字符串作为 QrCode 的构造函数参数
                    $qrCode = new QrCode($result->code_url);

                    // 将生成的二维码图片数据以字符串形式输出，并带上相应的响应类型
                    $response = new Response();
                    $response->setStatusCode(200);
                    $response->setContentType($qrCode->getContentType());
                    $response->setContent($qrCode->writeString());
                    return $response;

                } else if ($payment_method == 'alipay') {
                    // 默认调用支付宝的网页支付，这个将会自动跳转到支付宝的付款页面
                    // 请求参数
                    $order = [
                        // 订单编号，需保证在商户端不重复
                        'out_trade_no' => $order->getOrderNo(),
                        // 订单金额，单位元，支持小数点后两位
                        'total_amount' => $order->getFinalPrice(),
                        // 订单标题
                        'subject' => 'Alipay payment',
                    ];
                    // 支付，这里要采用第三方授权支付。
                    // 先看看tbshoppayment是否存储了支付参数，如果没有则给出提示
                    // app_auth_token赋值
                    if (!$this->alipay_app_auth_token) {
                        // 返回卖家支付宝未授权，不能通过支付宝付款的错误信息
                        return $this->error($this->getValidateMessage('seller-alipay-not-authorized'));
                    }
                    $this->config['pay']['alipay']['app_auth_token'] = $this->alipay_app_auth_token;
                    // 开始支付
                    $alipay = $this->alipay->web($order);
                    // 返回
                    return $alipay->send();
                } else {
                    // 其他的支付方法暂时不支持
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('unknown_payment_method'));
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
                    // 取出错误信息
                    return $this->error($this->getValidateMessage('params-error'));
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
                    $expire_time = $order->getExpireTime();
                }

                // 取出每个订单下面具体商品信息
                $shoporders = $order->getShoporder();

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
     * @return false|Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|string
     */
    public
    function applyrefundAction()
    {
        // 逻辑
        // 判断订单是否存在
        if ($this->request->isPost() && $rs = $this->member) {
            // 取出订单
            $params = $this->dispatcher->getParams();
            if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('params-error'));
            }
            // 赋值
            $id = $params[0];

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
     * @return false|Response|\Phalcon\Http\ResponseInterface|string
     */
    private
    function _refundOrder(TbShoporderCommon $order)
    {
        // 逻辑
        ini_set('display_errors', 'Off');
        error_reporting(0);
        // 判断该订单的支付方式
        switch ($order->getPaymentMethod()) {
            // 微信支付
            case 'wechat':
                // 生成退款订单号
                $refundNo = TbShoporderCommon::getAvailableRefundNo();
                // 用try，cache捕捉错误
                try {
                    $this->wechat_pay->refund([
                        'out_trade_no' => $order->getOrderNo(), // 之前的订单流水号
                        'total_fee' => $order->getFinalPrice() * 100, //原订单金额，单位分
                        'refund_fee' => $order->getFinalPrice() * 100, // 要退款的订单金额，单位分
                        'out_refund_no' => $refundNo, // 退款订单号
                        // 微信支付的退款结果并不是实时返回的，而是通过退款回调来通知，因此这里需要配上退款回调接口地址
                        'notify_url' => $this->config['pay']['wechat']['notify_url'],
                    ]);
                } catch (\Exception $e) {
                    // 返回错误
                    return $this->getValidateMessage('refund_status_failed');
                }

                // 将订单状态改成退款中
                $order->save([
                    'refund_no' => $refundNo,
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
                        'out_trade_no' => $order->getOrderNo(), // 之前的订单流水号
                        'refund_amount' => $order->getFinalPrice(), // 退款金额，单位元
                        'out_request_no' => $refundNo, // 退款订单号
                    ]);
                } catch (\Exception $e) {
                    // 把失败的具体信息写入日志
                    // 但是如果这个订单已经退款，则需要返回给用户
                    $ret = $this->alipay->find(['out_trade_no' => $order->getOrderNo()]);
                    $arr = json_decode(json_encode($e), true);
                    // 如果订单状态有TRADE_CLOSED字样说明退款成功，写入数据库
                    if (isset($arr['trade_status']) && $arr['trade_status'] === 'TRADE_CLOSED') {
                        // 将订单的退款状态标记为退款成功并保存退款订单号
                        $order->save([
                            'refund_no' => $refundNo,
                            'refund_status' => TbShoporderCommon::REFUND_STATUS_SUCCESS,
                        ]);
                    }
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
                        'refund_no' => $refundNo,
                        'refund_status' => TbShoporderCommon::REFUND_STATUS_FAILED,
                        'extra' => $extra,
                    ]);
                } else {
                    // 将订单的退款状态标记为退款成功并保存退款订单号
                    $order->save([
                        'refund_no' => $refundNo,
                        'refund_status' => TbShoporderCommon::REFUND_STATUS_SUCCESS,
                    ]);
                }
                break;
            default:
                // 原则上不可能出现，这个只是为了代码健壮性
                // 回滚
                $this->db->rollback();
                // 取出错误信息
                return $this->getValidateMessage('unknown_refund_method');
                break;
        }

        // 如果没有返回，则最终确认成功
        return $this->success();
    }


    /**
     * 同意退款
     * @return false|\Phalcon\Mvc\View|string
     */
    public function refundagreeAction()
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member && $this->isadmin) {
            // 取出订单
            $params = $this->dispatcher->getParams();
            if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('params-error'));
            }
            // 赋值
            $id = $params[0];
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
            // 开始调用退款逻辑
            // 调用退款逻辑
            $result = $this->_refundOrder($order);
            // 如果是json，则退款成功，否则退款失败
            if (!Util::is_json($result)) {
                return $this->error($result);
            }

            // 开始执行还原库存操作
            // 用户锁库存才涉及到库存还原，否则直接无视即可。
            if (isset($member['is_lockstock']) && $member['is_lockstock']) {
                // 取出每个订单下面具体商品信息
                $shoporders = $order->getShoporder();
                // 如果是已退款，还得还原库存，还原库存同样采用悲观锁处理
                foreach ($shoporders as $shoporder) {
                    // 执行写入，为了安全，这里采用悲观锁进行处理
                    $productSearchModel = TbProductSearch::findFirst([
                        'conditions' => 'id=' . $shoporder->product_id,
                        'for_update' => true,
                    ]);
                    // 商品不存在报错
                    if (!$productSearchModel) {
                        return $this->error($this->getValidateMessage('product-doesnot-exist'));
                    }
                    // 开始还原
                    $productSearchModel->number += $shoporder->number;
                    if (!$productSearchModel->save()) {
                        return $this->error($this->getValidateMessage('order', 'db', 'save-failed'));
                    }
                }
            }

            // 如果到现在为止没有任何返回，则最终成功
            return $this->success();
        }
    }

    /**
     * 不同意退款
     * @return false|\Phalcon\Mvc\View|string
     */
    public function refunddisagreeAction()
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member && $this->isadmin) {
            // 取出订单
            $params = $this->dispatcher->getParams();
            if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('params-error'));
            }
            // 赋值
            $id = $params[0];
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
     * @return false|Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|string
     */
    public function shipAction()
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member && $this->isadmin) {
            // 取出订单
            $params = $this->dispatcher->getParams();
            if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('params-error'));
            }
            // 赋值
            $id = $params[0];
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
                'express_no' => $express_no,
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
     * @return false|Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|string
     */
    public function receiveAction()
    {
        // 逻辑
        // 要求必须是post请求，登录状态，而且必须是管理员才能访问
        if ($this->request->isPost() && $member = $this->member) {
            // 取出订单
            $params = $this->dispatcher->getParams();
            if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                // 取出错误信息
                return $this->error($this->getValidateMessage('params-error'));
            }
            // 赋值
            $id = $params[0];
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
