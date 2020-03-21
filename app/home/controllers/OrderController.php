<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\Sql;
use Asa\Erp\TbCode;
use Asa\Erp\TbOrder;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\TbProduct;
use Asa\Erp\Util;
use Exception;

/**
 * 订单主表
 * Class OrderController
 * @package Multiple\Home\Controllers
 */
class OrderController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function pageAction()
    {
        $params = [$this->getSearchCondition()];
        $params["order"] = "id desc";

        $result = TbOrder::find($params);

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
        foreach ($pageObject->items as $row) {
            $data[] = $row->toArray();
        }

        $pageinfo = [
            //"previous"      => $pageObject->previous,
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            //"next"          => $pageObject->next,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];
        echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
    }

    function getSearchCondition()
    {
        $where = [
            sprintf("companyid=%d", $this->companyid),
        ];

        if (isset($_POST["keyword"]) && trim($_POST["keyword"]) != "") {
            $where[] = sprintf("orderno like '%%%s%%'", addslashes(strtoupper($_POST["keyword"])));
        }

        $names = ['bookingid', 'ageseason', 'supplierid', 'seasontype', 'bussinesstype', 'property'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = Sql::isInclude($name, $_POST[$name]);
            }
        }

        $names = ['brandids'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = Sql::isMatch($name, $_POST[$name]);
            }
        }

        return implode(' and ', $where);
    }


    /**
     * 订单保存
     */
    public function saveorderAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception("/1001/参数错误/");
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
            $order = TbOrder::findFirst(
                sprintf("id=%d and companyid=%d", $orderid, $this->companyid)
            );
            if (!$order || $order->status != 1) {
                throw new Exception("/1001/订单不存在/");
            }

            $order->bookingid = $form['bookingid'];
            $order->linkmanid = $form['linkmanid'];
            $order->bussinesstype = $form['bussinesstype'];
            $order->supplierid = $form['supplierid'];
            $order->finalsupplierid = $form['finalsupplierid'];
            $order->ageseason = $form['ageseason'];
            $order->seasontype = $form['seasontype'];
            $order->bookingorderno = $form['bookingorderno'];
            $order->makedate = $form['makedate'];
            $order->currency = $form['currency'];
            $order->discount = $form['discount'];
            $order->taxrebate = $form['taxrebate'];
            $order->property = $form['property'];
            $order->memo = $form['memo'];
            $order->orderdate = $form['orderdate'];
            $order->status = $form['status'];
            $order->total = $form['total'];
            $order->genders = $form['genders'];
            $order->brandids = $form['brandids'];

            // 判断是否成功
            if (!$order->save()) {
                $this->db->rollback();
                // 验证类错误给出提示
                return $this->error($order);
            }
        } else {
            // 没有订单号就新增
            $order = new TbOrder();
            $order->bookingid = $form['bookingid'];
            $order->linkmanid = $form['linkmanid'];
            $order->bussinesstype = $form['bussinesstype'];
            $order->supplierid = $form['supplierid'];
            $order->finalsupplierid = $form['finalsupplierid'];
            $order->ageseason = $form['ageseason'];
            $order->seasontype = $form['seasontype'];
            $order->bookingorderno = $form['bookingorderno'];
            $order->makedate = $form['makedate'];
            $order->currency = $form['currency'];
            $order->discount = $form['discount'];
            $order->taxrebate = $form['taxrebate'];
            $order->property = $form['property'];
            $order->memo = $form['memo'];
            $order->orderdate = $form['orderdate'];
            $order->status = 1;
            $order->total = $form['total'];
            $order->genders = $form['genders'];
            $order->brandids = $form['brandids'];

            // 添加制单人及制单日期
            $order->makestaff = $this->currentUser;
            $order->maketime = date('Y-m-d H:i:s');
            $order->companyid = $this->companyid;
            // 生成订单号

            $order->orderno = TbCode::getCode($this->companyid, "CB", date("y"));
            if ($order->create() === false) {
                //返回失败信息
                $this->db->rollback();
                return $this->error($order);
            }
        }

        // 开始写入订单详情表
        // 需要引入订单详情表模型
        // $this->addOrderDetail();
        // 然后新增订单详情
        // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
        $detail_id_array = [];
        foreach ($submitData['list'] as $k => $item) {
            // 使用模型更新
            //
            $product = TbProduct::getInstance($item['productid']);

            $detail = TbOrderdetails::findFirst(
                sprintf("companyid=%d and orderid=%d and productid=%d and sizecontentid=%d", $this->companyid, $order->id, $item['productid'], $item['sizecontentid'])
            );
            if ($detail != false) {
                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->factoryprice = $item['factoryprice'];
                $detail->currencyid = $product->factorypricecurrency;
                $detail->wordprice = $product->wordprice;
                if ($detail->update() == false) {
                    $this->db->rollback();
                    throw new Exception("/1002/更新订单明细失败/");
                }
            } else {

                $detail = new TbOrderdetails();
                $detail->productid = $item['productid'];
                $detail->sizecontentid = $item['sizecontentid'];
                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->companyid = $this->companyid;
                $detail->factoryprice = $item['factoryprice'];
                $detail->currencyid = $product->factorypricecurrency;
                $detail->wordprice = $product->wordprice;
                $detail->createdate = date("Y-m-d H:i:s");
                $detail->orderid = $order->id;
                $detail->orderbrandid = 0;
                if ($detail->create() == false) {
                    $this->db->rollback();
                    throw new Exception("/1002/添加订单明细失败/");
                }
            }

            $detail_id_array[] = $detail->id;
        }

        //清除不存在的详情id
        if (count($detail_id_array) > 0) {
            $details = TbOrderdetails::find(
                sprintf("orderid=%d and id not in(%s)", $order->id, implode(",", $detail_id_array))
            );
        } else {
            $details = TbOrderdetails::find(
                sprintf("orderid=%d", $order->id)
            );
        }

        foreach ($details as $detail) {
            if ($detail->orderbrandid > 0) {
                //已经确认过的订单明细不能删除
                $this->db->rollback();
                throw new Exception("/1001/不能删除已经加入外部订单的订单明细/");
            }
            $detail->delete();
        }

        // 提交事务
        $this->db->commit();
        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->success($order->getOrderDetail());
    }

    /**
     * 读取订单信息，必须传一个id参数，代表订单编号
     * @return false|string
     */
    public function loadorderAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrder::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($order != false) {
            echo $this->success($order->getOrderDetail());
        }
    }

    /**
     * 订单删除
     * @return false|string
     * @throws Exception
     */
    public function deleteAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrder::findFirst(
            sprintf("id=%d and companyid=%d", $_POST["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($order != false) {
            $this->db->begin();
            $orderdetails = $order->orderdetails;
            foreach ($orderdetails as $detail) {
                if ($detail->brand_number > 0) {
                    //已经加入外部订单的订单明细不能删除
                    $this->db->rollback();
                    throw new Exception("/11110301/不能删除已经加入外部订单的订单明细/");
                }

                if ($detail->delete() == false) {
                    $this->db->rollback();
                    throw new Exception("/11110302/删除订单明细失败。/");
                }
            }

            if ($order->delete() == false) {
                $this->db->rollback();
                throw new Exception("/11110303/订单不能删除/");
            }

            $this->db->commit();

            return $this->success();
        } else {
            throw new Exception("/11110304/订单不存在/");
        }
    }

    /**
     * 订单完结
     * @return void [type] [description]
     * @throws Exception
     */
    public function finishAction()
    {
        $orderid = (int)$_POST['id'];
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrder::findFirstById($orderid);
        if ($order != false && $order->companyid == $this->companyid) {
            $order->finish();
            $this->success();
        } else {
            throw new Exception("/11110101/订单不存在/");
        }
    }

    /**
     *
     */
    function searchdetailAction()
    {
        $details = TbOrderdetails::find(
            sprintf("companyid=%d and orderbrandid=0", $this->companyid)
        );

        return $this->success($details->toArray());
    }

    /**
     * 品牌订单导入订单的时候调用
     * @return false|string [type] [description]
     */
    function importAction()
    {
        $conditions = [
            sprintf("companyid=%d", $this->companyid),
        ];

        if (isset($_POST['ageseasonid']) && $_POST['ageseasonid'] > 0) {
            $conditions[] = sprintf("ageseason=%d", $_POST['ageseasonid']);
        }

        if (isset($_POST['bookingid']) && $_POST['bookingid'] != "") {
            $conditions[] = sprintf("bookingid in (%s)", $_POST['bookingid']);
        }

        if (isset($_POST['brandid']) && $_POST['brandid'] > 0) {
            $conditions[] = sprintf("(brandids='%d' or brandids like '%%,%s%%' or brandids like '%%%s,%%')", $_POST['brandid'], $_POST['brandid'], $_POST['brandid']);
        }

        if (isset($_POST['orderid']) && $_POST['orderid'] > 0) {
            $conditions[] = sprintf("id = %d", $_POST['orderid']);
        }

        $conditions[] = "status=1";

        $orders = TbOrder::find(
            implode(" and ", $conditions)
        );

        //查询订单明细
        $array = Util::recordListColumn($orders, "id");
        if (count($array) > 0) {
            $rows = TbOrderdetails::find([
                sprintf("orderid in (%s)", implode(",", $array)),
                "order" => "productid, orderid",
            ]);

            $details = [];
            foreach ($rows as $detail) {
                $details[] = $detail->toArray();
            }
        } else {
            $details = [];
        }
        return $this->success(["orders" => $orders->toArray(), "details" => $details]);
    }

    /**
     * 订单列表
     * @return false|string
     * @throws Exception
     */
    function orderbrandlistAction()
    {
        $order = TbOrder::findFirstById($_POST['id']);
        if ($order != false && $order->companyid == $this->companyid) {
            return $this->success($order->getOrderbrandList());
        } else {
            throw new Exception("/11110201/订单不存在/");
        }
    }
}