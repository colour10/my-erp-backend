<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\Sql;
use Asa\Erp\TbCode;
use Asa\Erp\TbOrder;
use Asa\Erp\TbOrderBrand;
use Asa\Erp\TbOrderBrandDetail;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\TbSupplier;
use Asa\Erp\Util;
use Exception;
use Phalcon\Paginator\Adapter\Model;

/**
 * 品牌订单
 * Class OrderbrandController
 * @package Multiple\Home\Controllers
 */
class OrderbrandController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbOrderBrand');
    }

    function getSearchCondition()
    {
        $where = [
            sprintf("companyid=%d", $this->companyid),
        ];

        $names = ['orderno', 'memo'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && trim($_POST[$name]) != "") {
                $where[] = sprintf("%s like '%%%s%%'", $name, addslashes(strtoupper($_POST[$name])));
            }
        }

        $names = ['brandid', 'ageseason', 'supplierid', 'seasontype', 'bussinesstype', 'property'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = Sql::isInclude($name, $_POST[$name]);
            }
        }

        return implode(' and ', $where);
    }

    function addAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        $orderbrand_id_array = [];

        $this->db->begin();
        foreach ($submitData['suppliers'] as $supplier) {
            if ($supplier["orderbrandid"] > 0) {
                //更新
                $orderBrand = TbOrderBrand::findFirstById($supplier["orderbrandid"]);
                if ($orderBrand == false || $orderBrand->companyid != $this->companyid) {
                    throw new Exception("/110201/客户订单不存在。/");
                }

                $orderbrand_id_array[] = $orderBrand->id;

                $orderBrand->discount = $supplier['discount'];
                $orderBrand->foreignorderno = $supplier['foreignorderno'];
                $orderBrand->finalsupplierid = $supplier['finalsupplierid'];
                $orderBrand->memo = $supplier['memo'];
                $orderBrand->quantum = $supplier['quantum'];
                $orderBrand->taxrebate = $supplier['taxrebate'];
                $orderBrand->total_number = $supplier['total_number'];
                $orderBrand->total_price = $supplier['total_price'];
                $orderBrand->total_discount_price = $supplier['total_discount_price'];

                $orderBrand->currency = $submitData['form']['currency'];
                $orderBrand->bussinesstype = $submitData['form']['bussinesstype'];
                $orderBrand->ageseason = $submitData['form']['ageseason'];
                $orderBrand->seasontype = $submitData['form']['seasontype'];
                $orderBrand->currency = $submitData['form']['currency'];
                $orderBrand->brandid = $supplier['brandid'];
                if ($orderBrand->update() === false) {
                    //返回失败信息
                    $this->db->rollback();
                    return $this->error($orderBrand);
                }

                //更新明细数据
                $change = [];
                $detail_id_array = [];
                foreach ($submitData['list'] as $row) {
                    if ($row['supplierid'] == $supplier['supplierid']) {
                        if ($row["id"] > 0) {
                            $detail = TbOrderBrandDetail::findFirst($row['id']);
                            if ($detail == false) {
                                throw new Exception("/110203/客户订单明细数据不存在。/");
                            }

                            $change[$detail->orderdetailid] = isset($change[$detail->orderdetailid]) ? $change[$detail->orderdetailid] + $row['number'] - $detail->number : $row['number'] - $detail->number;
                            $detail->number = $row["number"];
                            $detail->discount = $row["discount"];
                            if ($detail->update() == false) {
                                $this->db->rollback();
                                return $this->error($detail);
                            }
                        } else {
                            //新增明细条目
                            $detail = new TbOrderBrandDetail();
                            $detail->orderbrandid = $orderBrand->id;
                            $detail->productid = $row["productid"];
                            $detail->sizecontentid = $row["sizecontentid"];
                            $detail->orderid = $row["orderid"];
                            $detail->orderdetailid = $row["orderdetailid"];
                            $detail->number = $row["number"];
                            $detail->discount = $row["discount"];
                            $detail->createdate = date("Y-m-d H:i:s");
                            $detail->companyid = $this->companyid;
                            $detail->factoryprice = $row["factoryprice"];
                            $detail->wordprice = isset($row["wordprice"]) ? $row["wordprice"] : 0;
                            $detail->currencyid = $row["currencyid"];
                            if ($detail->create() === false) {
                                //返回失败信息
                                $this->db->rollback();
                                return $this->error($detail);
                            }

                            $change[$detail->orderdetailid] = isset($change[$detail->orderdetailid]) ? $change[$detail->orderdetailid] + $row['number'] : $row['number'];
                        }

                        $detail_id_array[] = $detail->id;
                    }
                }

                //删除那些不在列表中的明细数据
                if (count($detail_id_array) > 0) {
                    $deleteDetails = TbOrderBrandDetail::find(
                        sprintf('orderbrandid=%d and id not in (%s)', $orderBrand->id, implode(",", $detail_id_array))
                    );

                    foreach ($deleteDetails as $detail) {
                        $change[$detail->orderdetailid] = isset($change[$detail->orderdetailid]) ? $change[$detail->orderdetailid] - $detail->number : $detail->number * -1;
                        if ($detail->delete() == false) {
                            $this->db->rollback();
                            throw new Exception("/110204/删除客户订单明细失败/");
                        }
                    }
                }


                //更新订单明细中的，brand_number 字段
                foreach ($change as $orderdetailid => $number) {
                    $orderDetail = TbOrderdetails::findFirstById($orderdetailid);
                    if ($orderDetail != false) {
                        $orderDetail->brand_number = $orderDetail->brand_number + $number;
                        if ($orderDetail->update() === false) {
                            //返回失败信息
                            $this->db->rollback();
                            return $this->error($orderDetail);
                        }
                    } else {
                        throw new Exception("/110202/客户订单明细不存在。/");
                    }
                }
            } else {
                //新增
                $orderBrand = new TbOrderBrand();
                $orderBrand->supplierid = $supplier['supplierid'];
                $orderBrand->discount = $supplier['discount'];
                $orderBrand->foreignorderno = $supplier['foreignorderno'];
                $orderBrand->finalsupplierid = $supplier['finalsupplierid'];
                $orderBrand->memo = $supplier['memo'];
                $orderBrand->quantum = $supplier['quantum'];
                $orderBrand->taxrebate = $supplier['taxrebate'];
                $orderBrand->total_number = $supplier['total_number'];
                $orderBrand->total_price = $supplier['total_price'];
                $orderBrand->total_discount_price = $supplier['total_discount_price'];

                $orderBrand->currency = $submitData['form']['currency'];
                $orderBrand->bussinesstype = $submitData['form']['bussinesstype'];
                $orderBrand->ageseason = $submitData['form']['ageseason'];
                $orderBrand->seasontype = $submitData['form']['seasontype'];
                $orderBrand->currency = $submitData['form']['currency'];
                $orderBrand->brandid = $supplier['brandid'];

                // 添加制单人及制单日期
                $orderBrand->makestaff = $this->currentUser;
                $orderBrand->maketime = date('Y-m-d H:i:s');
                $orderBrand->companyid = $this->companyid;
                $orderBrand->status = 1;
                $orderBrand->orderno = TbCode::getCode($this->companyid, "BB", date("y"));
                if ($orderBrand->create() === false) {
                    //返回失败信息
                    $this->db->rollback();
                    return $this->error($orderBrand);
                }

                $orderbrand_id_array[] = $orderBrand->id;

                foreach ($submitData['list'] as $row) {
                    if ($row['supplierid'] == $supplier['supplierid']) {
                        $detail = new TbOrderBrandDetail();
                        $detail->orderbrandid = $orderBrand->id;
                        $detail->productid = $row["productid"];
                        $detail->sizecontentid = $row["sizecontentid"];
                        $detail->orderid = $row["orderid"];
                        $detail->orderdetailid = $row["orderdetailid"];
                        $detail->number = $row["number"];
                        $detail->discount = $row["discount"];
                        $detail->createdate = date("Y-m-d H:i:s");
                        $detail->companyid = $this->companyid;
                        $detail->factoryprice = $row["factoryprice"];
                        $detail->wordprice = isset($row["wordprice"]) ? $row["wordprice"] : 0;
                        $detail->currencyid = $row["currencyid"];
                        if ($detail->create() === false) {
                            //返回失败信息
                            $this->db->rollback();
                            return $this->error($detail);
                        }

                        $orderDetail = TbOrderdetails::findFirstById($row["orderdetailid"]);
                        if ($orderDetail != false) {
                            $orderDetail->brand_number = $orderDetail->brand_number + $row["number"];
                            if ($orderDetail->update() === false) {
                                //返回失败信息
                                $this->db->rollback();
                                return $this->error($orderDetail);
                            }
                        } else {
                            throw new Exception("/110202/客户订单明细不存在。/");
                        }
                    }
                }
            }
        }

        // 检查相关的客户订单是否已经完成
        foreach ($orderBrand->getOrderList() as $order) {
            $order->checkToFinish();
        }

        // 提交事务
        $this->db->commit();

        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->success($orderbrand_id_array);
    }

    /*function saveAction() {
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
            $order->orderno = TbCode::getCode($this->companyid, "BB", date("y"));
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

        //

        // 提交事务
        $this->db->commit();

        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->success($order->toArray());
    }*/

    public function loadAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $orderbrands = TbOrderBrand::find(
            sprintf("id in (%s) and companyid=%d", addslashes($_POST["ids"]), $this->companyid)
        );

        $result = [
            "orderbrands" => $orderbrands->toArray(),//品牌订单信息
            "orders"      => [],//客户订单列表
            "details"     => [],//客户订单明细
            "suppliers"   => [],
            "list"        => [] //品牌订单明细
        ];

        $array = [];
        $supplierids = [];
        foreach ($orderbrands as $orderbrand) {
            foreach ($orderbrand->getDetailList() as $detail) {
                $result['list'][] = $detail->toArray();

                $array[$detail->orderid] = 1;
            }

            if ($orderbrand->supplierid > 0) {
                $supplierids[$orderbrand->supplierid] = 1;
            }
        }


        if (count($array) > 0) {
            $orders = TbOrder::find(
                sprintf("id in (%s)", implode(",", array_keys($array)))
            );

            $result['orders'] = $orders->toArray();
            foreach ($orders as $order) {
                foreach ($order->getDetailList() as $detail) {
                    $result['details'][] = $detail->toArray();
                }
            }
        }


        if (count($supplierids) > 0) {
            //print_r($supplierids);
            $suppliers = TbSupplier::find(
                sprintf("id in (%s)", implode(",", array_keys($supplierids)))
            );

            $result['suppliers'] = $suppliers->toArray();
        }

        echo $this->success($result);
    }

    /**
     * 确认品牌订单
     *
     * @return false|string
     * @throws Exception
     */
    function confirmAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception("/1001/参数错误/");
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

            // 如果品牌不存在
            if (!$orderbrand) {
                throw new Exception("/11020301/品牌订单不存在/");
            } else if ($orderbrand->status == TbOrderBrand::STATUS_TO_BE_DELIVERED) {
                // 如果订单状态是已经确认
                throw new Exception("/11020302/品牌订单已经确认过了，不能重复确认。/");
            }
            $orderbrand->confirmstaff = $this->currentUser;
            $orderbrand->confirmdate = date('Y-m-d');
            // 订单状态 - 已确认待发货(status = 2)
            $orderbrand->status = TbOrderBrand::STATUS_TO_BE_DELIVERED;

            // 判断是否成功
            if (!$orderbrand->save()) {
                $this->db->rollback();

                // 验证类错误给出提示
                return $this->error($orderbrand);
            }

            foreach ($submitData['list'] as $k => $item) {
                // 使用模型更新
                $detail = TbOrderBrandDetail::findFirstById($item["id"]);

                if ($detail != false && $detail->orderbrandid == $orderbrand->id) {
                    $detail->confirm_number = $item['number'];
                    // 订单状态 - 已确认代发货(status = 2)
                    $detail->status = TbOrderBrand::STATUS_TO_BE_DELIVERED;
                    if ($detail->update() == false) {
                        $this->db->rollback();
                        throw new Exception("/11020303/品牌订单确认数量更新失败/");
                    }
                } else {
                    $this->db->rollback();
                    throw new Exception("/11020304/品牌订单详情不存在/");
                }
            }

            // 提交事务
            $this->db->commit();

            // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
            echo $this->success($orderbrand->toArray());
        }
    }

    /**
     * 品牌订单查找，实际上只有前端只有 supplierid 和 ageseason 传递过来
     *
     * @return false|string
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
        // 品牌订单id
        if (isset($_POST['orderbrandid']) && $_POST['orderbrandid'] > 0) {
            $conditions[] = sprintf("id=%d", $_POST['orderbrandid']);
        }
        // 状态为待发货(status = 2)
        $conditions[] = "status=" . TbOrderBrand::STATUS_TO_BE_DELIVERED;

        $orders = TbOrderBrand::find(
            implode(' and ', $conditions)
        );

        $array = Util::recordListColumn($orders, 'id');
        if (count($array) > 0) {
            // 查找没有发完的订单，即发货数量小于确认数量
            $details = TbOrderBrandDetail::find(
                sprintf("orderbrandid in(%s) and shipping_number<confirm_number", implode(",", $array))
            );

            return $this->success(["orderbrands" => $orders->toArray(), "orderbranddetails" => $details->toArray()]);
        } else {
            return $this->success([]);
        }
    }

    public function deleteAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrderBrand::findFirst(
            sprintf("id=%d and companyid=%d", $_POST["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($order != false) {
            $this->db->begin();

            foreach ($order->orderbranddetail as $detail) {
                if ($detail->confirm_number > 0) {
                    //已经确认的订单明细不能删除
                    $this->db->rollback();
                    throw new Exception("/11020301/不能删除已经确认的品牌订单明细/");
                }

                if ($detail->delete() == false) {
                    $this->db->rollback();
                    throw new Exception("/11020302/删除品牌订单明细失败。/");
                }

                $orderDetail = TbOrderdetails::findFirstById($detail->orderdetailid);
                if ($orderDetail != false) {
                    $orderDetail->brand_number = $orderDetail->brand_number - $detail->number;
                    if ($orderDetail->update() === false) {
                        //返回失败信息
                        $this->db->rollback();
                        return $this->error($orderDetail);
                    }
                } else {
                    throw new Exception("/11020303/客户订单明细不存在。/");
                }
            }

            if ($order->delete() == false) {
                $this->db->rollback();
                throw new Exception("/11020304/删除品牌订单失败/");
            }

            $this->db->commit();

            return $this->success();
        } else {
            throw new Exception("/11020305/品牌订单不存在/");

        }
    }

    /*
     * 取消品牌订单的确认操作
     */
    public function cancelAction()
    {
        $order = TbOrderBrand::findFirst(
            sprintf("id=%d and companyid=%d", $_POST["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($order != false) {
            $this->db->begin();
            // 只是把状态改为1，也就是待确认
            $order->status = TbOrderBrand::STATUS_TO_BE_CONFIRMED;
            if ($order->update() == false) {
                $this->db->rollback();
                throw new Exception("/11020402/更新客户订单状态失败/");
            }
            // 遍历品牌订单明细
            foreach ($order->orderbranddetail as $detail) {
                if ($detail->shipping_number > 0) {
                    throw new Exception("/11020401/已经发货的订单不能取消确认。/");
                }

                // 订单确认数量改为0
                $detail->confirm_number = 0;
                // 状态改为1，也就是待确认
                $detail->status = TbOrderBrand::STATUS_TO_BE_CONFIRMED;

                // 判断是否更新成功
                if ($detail->update() == false) {
                    $this->db->rollback();
                    throw new Exception("/11020403/更新客户订单明细失败/");
                }
            }

            // 事务提交
            $this->db->commit();

            // 返回
            return $this->success();
        } else {
            throw new Exception("/11020404/品牌订单不存在/");
        }
    }

    /*public function detailAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $orderbrand = TbOrderBrand::findFirstById($_POST['id']);
        if($orderbrand!=false && $orderbrand->companyid==$this->companyid) {
            echo $this->success($orderbrand->toArray());
        }
        else {
            throw new \Exception("/11020501/品牌订单不存在/");
        }
    }*/

    /**
     * 前查 - 客户订单列表，具体走向为：客户订单 <- 品牌订单
     *
     * @return false|string
     * @throws Exception
     */
    function orderlistAction()
    {
        $orderbrand = TbOrderBrand::findFirstById($_POST['id']);
        if ($orderbrand != false && $orderbrand->companyid == $this->companyid) {
            return $this->success($orderbrand->getOrderList()->toArray());
        } else {
            throw new Exception("/11020601/品牌订单不存在/");
        }
    }

    /**
     * 后查 - 发货单列表；具体走向为：品牌订单 -> 发货单
     *
     * @return false|string
     * @throws Exception
     */
    function shippinglistAction()
    {
        $orderbrand = TbOrderBrand::findFirstById($_POST['id']);
        if ($orderbrand != false && $orderbrand->companyid == $this->companyid) {
            return $this->success($orderbrand->getShippingList());
        } else {
            throw new Exception("/11020601/品牌订单不存在/");
        }
    }

    /**
     * 分页查询，需要增加一个字段 款数 统计，所以重写了父类
     */
    public function pageAction()
    {
        $params = [$this->getSearchCondition()];
        $params["order"] = "id desc";

        $result = TbOrderBrand::find($params);

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new Model(
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
            $array = $row->toArray();
            // 每一个订单的总款数
            $wordcodeSum = $this->modelsManager->executeQuery(
                "SELECT obd.productid FROM \Asa\Erp\TbOrderBrandDetail as obd WHERE obd.orderbrandid=:orderbrandid: GROUP BY obd.productid",
                [
                    "orderbrandid" => $array['id'],
                ]
            );
            // 总款数
            $array['sum_worldcode'] = count($wordcodeSum);
            $data[] = $array;
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
}
