<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbCode;
use Asa\Erp\TbOrder;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\TbProduct;
use Asa\Erp\Util;
use Exception;

/**
 * 订单主表-这个是简易版, 简化了若干流程，其中品牌订单没有了，直接由客户订单->入库单
 *
 * Class OrderController
 * @package Multiple\Home\Controllers
 */
class OrdersimpleController extends OrderController
{
    // 复写功能
    // 保存订单
    function saveorderAction()
    {
        // 逻辑
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception($this->getValidateMessage(1001));
        }

        // 如果参数正确，上面接收到的 params 的格式应该为如下格式，包含 form ，list两个字段，下面的实例 form 里面的 id 是空值，代表新增，如果不为空则是编辑
        //     {
        //         "form":{
        //             "bookingid":"10",
        //             "orderdate":"",
        //             "linkmanid":"5",
        //             "bussinesstype":"1",
        //             "supplierid":"",
        //             "finalsupplierid":"",
        //             "ageseason":"9",
        //             "seasontype":"",
        //             "bookingorderno":"",
        //             "makedate":"",
        //             "currency":"9",
        //             "discount":"1",
        //             "taxrebate":"1",
        //             "property":"1",
        //             "makestaff":"",
        //             "maketime":"",
        //             "memo":"",
        //             "orderno":"",
        //             "status":1,
        //             "id":"",
        //             "brandids":"",
        //             "genders":"",
        //             "total":"380.00"
        //         },
        //     "list":[
        //         {
        //             "productid":"337",
        //             "discount":"1",
        //             "sizecontentid":"128",
        //             "number":"1",
        //             "factoryprice":"190.00",
        //             "id":0
        //         },
        //         {
        //             "productid":"337",
        //             "discount":"1",
        //             "sizecontentid":"129",
        //             "number":"1",
        //             "factoryprice":"190.00",
        //             "id":0
        //         }
        //     ]
        // }

        // 然后将其转换成数组
        $submitData = json_decode($params, true);
        // 记录下这个变量
        error_log("OrdersimpleController => saveorderAction => \$submitData 收到的信息是：" . print_r($submitData, true));

        // 判断是否有订单号，分别进行
        $orderid = $submitData['form']['id'];
        // 分别赋值
        $form = $submitData['form'];
        // 制单日期，系统自动生成
        $form['maketime'] = date('Y-m-d H:i:s');
        $list = $submitData['list'];

        // 使用 try-catch
        try {
            // 采用事务处理
            $this->db->begin();

            // 如果存在订单号，则编辑
            if ($orderid) {
                // 查找订单模型
                $order = TbOrder::findFirst([
                    'conditions' => 'id = :id: AND companyid = :companyid:',
                    'bind'       => [
                        'id'        => $orderid,
                        'companyid' => $this->companyid,
                    ],
                ]);
                // 订单如果不存在，或者已完结，则报错
                if (!$order || $order->status != TbOrder::STATUS_UNFINISHED) {
                    throw new Exception($this->getValidateMessage('order-notexist-or-finish'));
                }
                // 然后按照 form 表单的内容进行更新
                if (!$order->update($form)) {
                    throw new Exception($this->getValidateMessage('order', 'db', 'save-failed'));
                }
            } else {
                // 如果找不到，则是新增
                $order = new TbOrder();
                // 然后添加必要的字段内容
                // 添加制单人
                $form['makestaff'] = $this->currentUser;
                // 制单日期
                $form['maketime'] = date('Y-m-d H:i:s');
                // 公司id
                $form['companyid'] = $this->companyid;
                // 订单号
                $form['orderno'] = TbCode::getCode($this->companyid, "CB", date("y"));
                // 然后按照 form 表单的内容进行新增
                if (!$order->create($form)) {
                    throw new Exception($this->getValidateMessage('order', 'db', 'add-failed'));
                }
            }

            // 接下来更新订单详情表的内容, 按照 list 中的内容
            // 记录详情 id 列表
            $detail_id_array = [];
            foreach ($list as $k => $item) {
                // 找到对应的详情模型
                $product = TbProduct::getInstance($item['productid']);
                $orderdetail = TbOrderdetails::findFirst([
                    'conditions' => 'companyid=:companyid: and orderid=:orderid: and productid=:productid: and sizecontentid=:sizecontentid:',
                    'bind'       => [
                        'companyid'     => $this->companyid,
                        'orderid'       => $order->id,
                        'productid'     => $item['productid'],
                        'sizecontentid' => $item['sizecontentid'],
                    ],
                ]);

                // 存在则编辑，不存在则新增
                if ($orderdetail != false) {
                    // 防止 product 模型有变动，所以再把公共属性重新录入一遍
                    // 币种
                    $item['currencyid'] = $product->factorypricecurrency;
                    // 国际零售价
                    $item['wordprice'] = $product->wordprice;
                    // 然后直接入库
                    if (!$orderdetail->update($item)) {
                        // 记录日志
                        error_log('OrdersimpleController => saveorderAction => \$orderdetail编辑失败了');
                        throw new Exception($this->getValidateMessage('orderdetail', 'db', 'save-failed'));
                    }
                    // 记录日志
                    error_log('OrdersimpleController => saveorderAction => \$orderdetail编辑成功了，id是' . $orderdetail->id);
                } else {
                    // 创建新条目
                    $orderdetail = new TbOrderdetails();
                    // 补充资料
                    $item['companyid'] = $this->companyid;
                    // 币种
                    $item['currencyid'] = $product->factorypricecurrency;
                    // 国际零售价
                    $item['wordprice'] = $product->wordprice;
                    $item['createdate'] = date("Y-m-d H:i:s");
                    $item['orderid'] = $order->id;
                    $item['orderbrandid'] = 0;
                    // 确认数量也在这里填入，不知道要不要摘出来，姑且先放在这里吧，有需要再改。
                    $item['confirm_number'] = $item['number'];
                    // 开始写入
                    if (!$orderdetail->create($item)) {
                        // 记录日志
                        error_log('OrdersimpleController => saveorderAction => \$orderdetail新建失败了');
                        throw new Exception($this->getValidateMessage('orderdetail', 'db', 'add-failed'));
                    }
                    // 记录日志
                    error_log('OrdersimpleController => saveorderAction => \$orderdetail新建成功了，id是' . $orderdetail->id);
                }
                // 记录id列表
                $detail_id_array[] = $orderdetail->id;
            }

            // 删除详情表中冗余的id，也就是求差集
            if (count($detail_id_array) > 0) {
                // 所有冗余的记录，使用 in 绑定用如下的写法，吐槽一下，phalcon 的文档真的很烂
                $details = TbOrderdetails::find([
                    'conditions' => 'orderid = :orderid: AND id not in ({ids:array})',
                    'bind'       => [
                        'orderid' => $order->id,
                        'ids'     => $detail_id_array,
                    ],
                ]);
                // 开始删除，因为是简化版，所以不涉及到品牌订单，可以直接删除
                foreach ($details as $detail) {
                    if (!$detail->delete()) {
                        throw new Exception($this->getValidateMessage('orderdetail', 'db', 'delete-failed'));
                    }
                }
            }

            // 提交事务
            $this->db->commit();

            // 返回成功
            return $this->success();

        } catch (Exception $e) {
            // 回滚
            $this->db->rollback();
            // 这里记录错误，详细的
            error_log("OrdersimpleController => saveorderAction 执行失败了，具体错误信息是：" . print_r($e->getMessage(), true));
            // 返回错误
            return $this->error($e->getMessage());
        }
    }

    /**
     * 订单搜索，之前品牌订单也有个搜索，这里也需要这样一个功能
     * 和之前的几乎一样，只是换了个表而已
     * 实际上只有前端只有 supplierid 和 ageseason 传递过来
     */
    function searchorderAction()
    {
        //首先检索出来确认订单id
        $conditions = [
            sprintf("companyid=%d", $this->companyid),
        ];
        // 供货商id
        if (isset($_POST['supplierid']) && $_POST['supplierid'] > 0) {
            $conditions[] = sprintf("supplierid=%d", $_POST['supplierid']);
        }
        // 年代季节id
        if (isset($_POST['ageseason']) && $_POST['ageseason'] > 0) {
            $conditions[] = sprintf("ageseason=%d", $_POST['ageseason']);
        }
        // 开始筛选订单表
        $orders = TbOrder::find(
            implode(' and ', $conditions)
        );

        $array = Util::recordListColumn($orders, 'id');
        if (count($array) > 0) {
            // 然后查找订单详情表
            // 查找没有发完的订单，即发货数量小于确认数量
            $details = TbOrderdetails::find(
                sprintf("orderid in(%s) and shipping_number < confirm_number", implode(",", $array))
            );
            // 返回数据
            return $this->success(["orders" => $orders->toArray(), "orderDetails" => $details->toArray()]);
        } else {
            return $this->success([]);
        }
    }


}
