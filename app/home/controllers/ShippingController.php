<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\Sql;
use Asa\Erp\TbAgeseason;
use Asa\Erp\TbCode;
use Asa\Erp\TbCurrency;
use Asa\Erp\TbExchangeRate;
use Asa\Erp\TbOrderBrandDetail;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbShipping;
use Asa\Erp\TbShippingDetail;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbWarehouse;
use Exception;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

/**
 * 发货单主表 - 和入库单是 一对一关系
 * Class ShippingController
 * @package Multiple\Home\Controllers
 */
class ShippingController extends AdminController
{
    private $orderBy = 'id desc';

    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbShipping');
    }

    /**
     * 加入id降序
     */
    public function before_page()
    {
        $_POST['__orderby'] = $this->orderBy;
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    /**
     * 分页查询，需要把关联信息也查出来
     *
     * @throws Exception
     */
    public function listAction()
    {
        // 赋值
        $productid = $this->request->get('productid');

        // 查找=2或者=3的，都可以，只有=1状态是在途
        $result = TbShipping::find("companyid = {$this->companyid} and (status = " . TbShipping::STATUS_STORAGE . " or status = " . TbShipping::STATUS_AMORTIZED . ") order by " . $this->orderBy);
        // 找出关联部分
        $result_array = $result->toArray();

        // 遍历统计
        foreach ($result as $k => $item) {
            // 查找其中的 productid 符合要求的记录
            // 年份季节
            $ageseason_model = TbAgeseason::findFirstById($item->ageseason);
            $ageseason_name = $ageseason_model ? $ageseason_model->sessionmark . $ageseason_model->name : '';
            // 入库仓库
            $warehouse_model = TbWarehouse::findFirstById($item->warehouseid);
            $warehouse_name = $warehouse_model ? $warehouse_model->name : '';
            // 币种
            $currency_model = TbCurrency::findFirstById($item->currency);
            $currency_code = $currency_model ? $currency_model->code : '';

            $shippingDetailsObject = $item->shippingDetail;
            // 有数据再遍历
            if ($shippingDetailsObject) {
                $shippingDetails = $shippingDetailsObject->toArray();
                foreach ($shippingDetails as $key => $shippingDetail) {
                    if ($shippingDetail['productid'] != $productid) {
                        unset($shippingDetails[$key]);
                    }
                }
                // 处理完再汇总，如果为空，则不再统计了
                if (count($shippingDetails) == 0) {
                    unset($result_array[$k]);
                    continue;
                }

                // 记录下 $shippingDetails 的值
                error_log('ShippingController => listAction => $shippingDetails的值是：' . print_r($shippingDetails, true));

                // 如果数组不为0，则进行汇总
                // 成交价和数量分别汇总
                $sum = 0;
                $sum_price = 0;
                $sum_currency_price = 0;
                foreach ($shippingDetails as $key => $shippingDetail) {
                    // 汇总
                    // 数量
                    $sum += $shippingDetail['warehousingnumber'];
                    // 结算货币价格
                    $sum_price += $shippingDetail['warehousingnumber'] * $shippingDetail['price'] * $shippingDetail['discount'];
                    // 本位币价格
                    $rateInfo = $this->getRateInfo($shippingDetail['currencyid']);
                    $sum_currency_price = $sum_price * $rateInfo['rate'];
                }
                $shippingDetails['sum'] = round($sum, 2);
                // 当前货币【一般是欧元】总价格
                $shippingDetails['sum_price'] = round($sum_price, 2);
                // 兑换成本位货币的总价格
                $shippingDetails['sum_current_price'] = round($sum_currency_price, 2);
                // 尺码组id汇总
                $sizecontentids = array_column($shippingDetails, 'sizecontentid');
                $shippingDetails['sizecontentids'] = implode(',', $sizecontentids);
                // 尺码组名称汇总
                $names = [];
                foreach ($sizecontentids as $sizecontent_id) {
                    $names[] = TbSizecontent::findFirstById($sizecontent_id)->name;
                }
                $shippingDetails['sizecontentid_names'] = implode(',', $names);
                $result_array[$k]['shippingDetail'] = $shippingDetails;
            }

            // 添加新查询的3个字段
            $result_array[$k]['ageseason_name'] = $ageseason_name;
            $result_array[$k]['warehouse_name'] = $warehouse_name;
            $result_array[$k]['currency_code'] = $currency_code;
        }

        // 创建分页对象，使用数组分页
        // 分页
        $currentPage = $this->request->getPost("page", "int", 1);
        // 每页显示条数
        $pageSize = $this->request->getPost("pageSize", "int", 10);
        $paginator = new PaginatorArray(
            [
                "data"  => $result_array,
                "limit" => $pageSize,
                "page"  => $currentPage,
            ]
        );

        // 展示分页，并处理数据
        $pageObject = $paginator->getPaginate();
        $data = [];
        foreach ($pageObject->items as $row) {
            $data[] = $row;
        }
        // 赋值
        $pageinfo = [
            //"previous"      => $pageObject->previous,
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            //"next"          => $pageObject->next,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];
        // 返回
        echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
        exit();
    }

    /**
     * 取出汇率
     * @param int $currency 订单结算货币id
     * @param string $begin_time
     * @param string $end_time
     * @return array
     * @throws Exception
     */
    public function getRateInfo($currency, $begin_time = '', $end_time = '')
    {
        // 必须登录
        if (!$auth = $this->auth) {
            throw new Exception($this->di->get("staticReader")->label('model-delete-message'));
        }
        // 当前用户本位币
        $current_currency = $auth['company']->currencyid;
        // 基本sql语句
        $sql = "currency_from = :currency_from: and currency_to = :currency_to: and companyid = :companyid: and status = 0";
        $bind = [
            'currency_from' => $currency,
            'currency_to'   => $current_currency,
            'companyid'     => $this->companyid,
        ];
        // 判断是否为空
        if ($begin_time && $end_time) {
            $sql .= " and begin_time >= :begin_time: and end_time <= :end_time:";
            $bind['begin_time'] = $begin_time;
            $bind['end_time'] = $end_time;
        } elseif ($begin_time && !$end_time) {
            $sql .= " and begin_time >= :begin_time:";
            $bind['begin_time'] = $begin_time;
        } elseif (!$begin_time && $end_time) {
            $sql = " and end_time <= :end_time:";
            $bind['end_time'] = $end_time;
        } else {
            $sql .= "";
        }
        // 取出订单计算货币和本位币的汇率
        $model = TbExchangeRate::findFirst([
            'conditions' => $sql,
            'bind'       => $bind,
        ]);
        // 返回
        if ($model) {
            return $model->toArray();
        }
        return [];
    }

    /**
     * 获得查询条件
     *
     * @return string
     */
    public function getSearchCondition()
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

        $names = ['warehouseid', 'ageseason', 'supplierid', 'seasontype', 'bussinesstype', 'property', 'status'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = Sql::isInclude($name, $_POST[$name]);
            }
        }

        return implode(' and ', $where);
    }

    /**
     * 保存发货单
     *
     * @return false|string
     * @throws Exception
     */
    public function saveAction()
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
        error_log('ShippingController => saveAction => $submitData的值是：' . print_r($submitData, true));

        // 采用事务处理
        $this->db->begin();

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

                    $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] - $detail->number : $item['number'] - $detail->number;

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

                    $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] : $item['number'];
                }

                $detail_id_array[] = $detail->id;
            }

            //删除那些不在列表中的明细数据
            if (count($detail_id_array) > 0) {
                $deleteDetails = TbShippingDetail::find(
                    sprintf('shippingid=%d and id not in (%s)', $shipping->id, implode(",", $detail_id_array))
                );

                foreach ($deleteDetails as $detail) {
                    $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] - $detail->number : $detail->number * -1;
                    if ($detail->delete() == false) {
                        $this->db->rollback();
                        throw new Exception("/11010106/删除发货单明细失败/");
                    }
                }
            }

            //更新订单明细中的，brand_number 字段
            foreach ($change as $orderbranddetailid => $number) {
                $orderDetail = TbOrderBrandDetail::findFirstById($orderbranddetailid);
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
            $shipping = new TbShipping();
            // status = 1 代表 在途，这个是默认值
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
                $detail->orderbranddetailid = $item['orderbranddetailid'];
                $detail->orderbrandid = $item['orderbrandid'];
                $detail->shippingid = $shipping->id;
                if ($detail->create() == false) {
                    $this->db->rollback();
                    throw new Exception("/11010109/添加发货单明细失败/");
                }

                $change[$detail->orderbranddetailid] = isset($change[$detail->orderbranddetailid]) ? $change[$detail->orderbranddetailid] + $item['number'] : $item['number'];
            }

            // 更新订单明细中的，brand_number 字段，也就是每个品牌订单的发货数量
            foreach ($change as $orderbranddetailid => $number) {
                $orderDetail = TbOrderBrandDetail::findFirstById($orderbranddetailid);
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

        // 提交事务
        $this->db->commit();
        return $this->success($shipping->getDetail());
    }

    /**
     * 读取发货单
     */
    function loadAction()
    {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($shipping != false) {
            echo $this->success($shipping->getDetail());
        }
    }

    /**
     * 发货单删除
     *
     * @return false|string
     * @throws Exception
     */
    public function deleteAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST["id"], $this->companyid)
        );

        // 判断订单是否存在，检查是否入库(status = 2)
        if ($shipping != false) {
            if ($shipping->status == TbShipping::STATUS_STORAGE) {
                throw new Exception("/11010701/已经入库的发货单不能删除。/");
            }

            // 事务处理
            $this->db->begin();
            // 发货单明细
            $details = $shipping->shippingDetail;
            // 发货单明细遍历
            foreach ($details as $detail) {
                // 更新品牌订单明细中的发货数量
                if ($detail->orderbranddetailid > 0) {
                    // 查找对应的品牌订单明细记录
                    $orderbranddetail = TbOrderBrandDetail::findFirstById($detail->orderbranddetailid);
                    if ($orderbranddetail != false) {
                        $orderbranddetail->shipping_number = $orderbranddetail->shipping_number - $detail->number;
                        if ($orderbranddetail->update() === false) {
                            //返回失败信息
                            $this->db->rollback();
                            throw new Exception("/11010702/更新品牌订单明细失败。/");
                        }
                    } else {
                        throw new Exception("/11010703/客户订单明细不存在。/");
                    }
                }


                if ($detail->delete() == false) {
                    $this->db->rollback();
                    throw new Exception("/11010704/删除订单明细失败。/");
                }
            }

            if ($shipping->delete() == false) {
                $this->db->rollback();
                throw new Exception("/11010705/发货单删除失败。/");
            }

            $this->db->commit();

            return $this->success();
        } else {
            throw new Exception("/11010706/发货单不存在。/");
        }
    }

    /**
     * 确认发货单, 确认入库接口
     *
     * @return false|string
     * @throws Exception
     */
    public function confirmAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        // 记录下这个值，方便错误排查
        error_log('ShippingController => confirmAction => $submitData的值是：' . print_r($submitData, true));

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

            if (!$shipping) {
                throw new Exception("/110111/发货单不存在/");
            }
            $shipping->confirmstaff = $this->currentUser;
            $shipping->confirmtime = date('Y-m-d H:i:s');
            // 把状态改为2，也就是待入库
            $shipping->status = TbShipping::STATUS_STORAGE;

            // 判断是否成功
            if (!$shipping->save()) {
                $this->db->rollback();

                // 验证类错误给出提示
                return $this->error($shipping);
            }

            foreach ($submitData['list'] as $k => $item) {
                // 使用模型更新
                if ($item['id'] > 0) {
                    $detail = TbShippingDetail::findFirstById($item['id']);

                    if ($detail == false || $detail->shippingid != $shipping->id) {
                        $this->db->rollback();
                        throw new Exception("/110112/入库单详情错误/");
                    }
                } else {
                    $detail = new TbShippingDetail();
                    $detail->companyid = $this->companyid;
                    $detail->number = 0;
                    $detail->productid = $item['productid'];
                    $detail->sizecontentid = $item['sizecontentid'];
                    $detail->price = $item['price'];
                    $detail->currencyid = TbProduct::getInstance($item['productid'])->factorypricecurrency;
                    $detail->discount = $item['discount'];
                    $detail->createdate = date('Y-m-d H:i:s');
                    $detail->shippingid = $shipping->id;
                    $detail->orderid = 0;
                    $detail->orderdetailid = 0;
                    $detail->orderbrandid = 0;
                    $detail->orderbranddetailid = 0;
                }

                // 入库成功，填写入库数量
                $detail->warehousingnumber = $item['number'];

                if ($detail->save() == false) {
                    $this->db->rollback();
                    throw new Exception("/110113/入库单详情入库数量更新失败/");
                }
            }

            // 提交事务
            $this->db->commit();

            // 最终成功返回
            echo $this->success();
        }
    }

    /**
     * 取消确认
     * @return false|string [type] [description]
     * @throws Exception
     */
    public function cancelconfirmAction()
    {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if ($shipping == false) {
            throw new Exception("/110111/发货单不存在/");
        }

        $this->db->begin();

        // 取消确认需要把状态改成在途，然后添加入库时间和确认时间【有争议】
        $shipping->status = 1;
        $shipping->warehousingstaff = $this->currentUser;
        $shipping->warehousingtime = date('Y-m-d H:i:s');
        if ($shipping->save() == false) {
            throw new Exception("/101115/发货单取消入库失败。/");
        }

        foreach ($shipping->shippingDetail as $detail) {
            // 修改入库数量为0
            $detail->warehousingnumber = 0;
            // 如果订单不存在，就删除发货单明细
            if ($detail->orderid == 0) {
                if ($detail->delete() == false) {
                    $this->db->rollback();
                    throw new Exception("/101116/删除发货单明细失败。/");
                }
            } else {
                // 否则就直接更新入库数量
                if ($detail->save() == false) {
                    $this->db->rollback();
                    throw new Exception("/101116/发货单明细取消入库失败。/");
                }
            }
        }
        // 提交并返回
        $this->db->commit();
        return $this->success();
    }

    /**
     * 入库，修改库存并摊销费用 - 费用输齐，这个涉及到库存表的变动，需要通过 OMS
     *
     * @return false|string [type] [description]
     * @throws Exception
     */
    public function warehousingAction()
    {
        $this->db->begin();

        $shipping = $this->saveinfo();

        $total_number = 0;//总数量
        $total_amount = 0;//总金额
        $exchangerate = $shipping->exchangerate;

        // 汇率必须大于0，否则提示不合法
        if ($exchangerate <= 0) {
            throw new Exception('/11011209/汇率不合法。/');
        }

        //本币id
        $auth = $this->auth;
        if (isset($auth['company']) && isset($auth['company']->currencyid)) {
            $currencyid = $auth['company']->currencyid;
        } else {
            $this->db->rollback();
            throw new Exception("/11011203/没有设置本币，不能计算成本/");
        }

        //货币单位跟入库单保持一致
        $product_array = $shipping->getCostList();

        //计算每件商品摊销后的成本
        $prodctstocks = TbProductstock::sum([
            sprintf("productid in (%s)", implode(",", array_keys($product_array))),
            "column" => "number",
            "group"  => "productid",
        ]);

        $array = [];
        foreach ($product_array as $productid => $row) {
            $array[$productid] = [
                "amount" => $row['amount'] * $exchangerate,
                "number" => $row['number'],
            ];
        }

        foreach ($prodctstocks as $row) {
            $product = TbProduct::getInstance($row->productid);
            if ($product == false) {
                $this->db->rollback();
                throw new Exception("/11011205/商品信息不存在。/");
            }

            //当前库存的商品总价，全部转化成本币
            if (isset($array[$row->productid])) {
                $array[$row->productid]['amount'] += $product->cost * $row->sumatory;
                $array[$row->productid]['number'] += $row->sumatory;
            } else {
                $array[$row->productid] = [
                    "amount" => $product->cost * $row->sumatory,
                    "number" => $row->sumatory,
                ];
            }
        }

        foreach ($array as $productid => $row) {
            $product = TbProduct::getInstance($productid);

            if ($product && $row["number"] > 0) {
                // 入库之后，添加成本、成本货币单位、最后入库时间
                $product->cost = round($row['amount'] / $row["number"], 2);
                $product->costcurrency = $currencyid;
                $product->laststoragedate = date("Y-m-d H:i:s");
                if ($product->update() === false) {
                    $this->db->rollback();
                    throw new Exception("/11011206/更新商品成本失败/");
                }
            }
        }

        foreach ($shipping->shippingDetail as $detail) {
            //增加库存
            if ($detail->warehousingnumber > 0) {
                $productStock = $detail->getProductStock();
                $ret = $productStock->addStock($detail->warehousingnumber, TbProductstock::WAREHOSING, $detail->id);
                if ($ret === false) {
                    $this->db->rollback();
                    throw new Exception("/11011207/发货单入库更新库存失败。/");
                }

                $row = $product_array[$detail->productid];
                $detail->cost = round($row['amount'] / $row["number"], 2);
                $detail->costcurrency = $currencyid;
                if ($detail->update() === false) {
                    $this->db->rollback();
                    throw new Exception("/11011208/更新发货单明细失败。/");
                }
            }
        }

        // 添加入库人，入库时间, status=3代表分摊完毕
        $shipping->status = TbShipping::STATUS_AMORTIZED;
        $shipping->warehousingstaff = $this->userId;
        $shipping->warehousingtime = date('Y-m-d H:i:s');
        if ($shipping->save() == false) {
            throw new Exception("/11011202/发货单入库失败。/");
        }

        // 提交
        $this->db->commit();
        // 库存变动通知
        TbProductstock::sendStockChange();
        // 返回
        return $this->success();
    }

    /**
     * 取消入库
     * @return false|string [type] [description]
     * @throws Exception
     */
    public function cancelAction()
    {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if ($shipping == false) {
            throw new Exception("/11011301/发货单不存在/");
        }

        $this->db->begin();

        // 因为是要把 status=3 的状态进行还原，所以状态代码必须为3
        if ($shipping->status != TbShipping::STATUS_AMORTIZED) {
            throw new Exception("/11011302/发货单不存在/");
        }

        //本币id
        $auth = $this->auth;
        if (isset($auth['company']) && isset($auth['company']->currencyid)) {
            $currencyid = $auth['company']->currencyid;
        } else {
            $this->db->rollback();
            throw new Exception("/11011303/没有设置本币，不能计算成本/");
        }

        $costList = $shipping->getCostList();

        $prodctstocks = TbProductstock::sum([
            sprintf("productid in (%s)", implode(",", array_keys($costList))),
            "column" => "number",
            "group"  => "productid",
        ]);

        //修改商品信息的成本价
        foreach ($prodctstocks as $row) {
            $product = TbProduct::getInstance($row['productid']);

            if ($product->costcurrency > 0) {
                // 计算当前库存里的商品的总价格,本币
                $amount = $product->cost * $row->sumatory;

                // 开始计算，取消入库后的剩余库存商品的价格
                $info = $costList[$row->productid];

                // 如果库存商品数量跟要取消入库的商品数量相同，需要再看一下商品总价格是否相同
                // 如果相同，说明是第一次进该商品，取消入库后，商品的库存数量为零，成本价没有意义了。
                // 如果库存数量大于要取消的商品数量，则计算摊销费用，减库存即可
                // 如果库存数量小于要取消的商品数量，则不能取消
                if ($row->sumatory - $info['number'] === 0) {
                    // do nothing
                    continue;
                } else if ($row->sumatory - $info['number'] > 0) {
                    $product->cost = round(($amount - $info['amount'] * $shipping->exchangerate) / ($row->sumatory - $info['number']), 2);
                } else {
                    throw new Exception("/11011309/库存不足，不能取消/");
                }

                if ($product->update() === false) {
                    $this->db->rollback();
                    throw new Exception("/11011304/更新发货单明细失败。/");
                }
            } else {
                $this->db->rollback();
                throw new Exception("/11011305/数据错误。/");
            }
        }

        //检查库存是否足够取消。
        foreach ($shipping->shippingDetail as $detail) {
            //减掉库存
            if ($detail->warehousingnumber > 0) {
                $productStock = $detail->getProductStock();
                $ret = $productStock->reduceStock($detail->warehousingnumber, TbProductstock::WAREHOSING, $detail->id);
                if ($ret === false) {
                    throw new Exception("/11011306/库存不足，不能取消。/");
                }
            }

            $detail->cost = 0;
            $detail->costcurrency = 0;

            if ($detail->save() == false) {
                $this->db->rollback();
                throw new Exception("/11011307/发货单明细取消入库失败。/");
            }
        }

        // 库存状态修改为待入库
        $shipping->status = TbShipping::STATUS_STORAGE;
        if ($shipping->save() == false) {
            $this->db->rollback();
            throw new Exception("/11011308/发货单取消入库失败。/");
        }

        // 提交
        $this->db->commit();
        // 发送库存通知
        TbProductstock::sendStockChange();
        // 返回
        return $this->success();
    }

    /**
     * 返回入库单费用统计，分别统计按数量摊销费用总和和按金额摊销费用总和
     */
    /*function feesumAction() {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if($shipping==false) {
            throw new \Exception("/11011401/发货单不存在/");
        }

        $by_number = 0;
        $by_amount = 0;
        foreach ($shipping->shippingFee as $shippingFee) {
            if($shippingFee->feename->is_amortize==1) {
                $fee_amount = TbExchangeRate::convert($this->companyid, $shippingFee->currencyid, $shipping->currency, $shippingFee->amount);

                if($shippingFee->feename->amortize_type==1) {
                    // 按数量摊销
                    $by_number += $fee_amount['number'];
                }
                else {
                    // 按金额摊销
                    $by_amount += $fee_amount['number'];
                }
            }
        }

        return $this->success([
            'by_number' => $by_number,
            'by_amount' => $by_amount,
        ]);
    }*/

    /**
     * 保存入库单的基本信息
     * @return false|string [type] [description]
     * @throws Exception
     */
    public function saveinfoAction()
    {
        $this->saveinfo();
        return $this->success();
    }

    public function orderbrandlistAction()
    {
        $shipping = TbShipping::findFirstById($_POST['id']);
        if ($shipping != false && $shipping->companyid == $this->companyid) {
            return $this->success($shipping->getOrderbrandList());
        } else {
            throw new Exception("/11011601/发货单不存在/");
        }
    }

    /**
     * 更新发货单
     *
     * @return Model
     * @throws Exception
     */
    private function saveinfo()
    {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_POST['id'], $this->companyid)
        );

        if ($shipping == false) {
            throw new Exception("/11011501/发货单不存在/");
        }

        $shipping->supplierid = $_POST["supplierid"];
        $shipping->finalsupplierid = $_POST["finalsupplierid"];
        $shipping->ageseason = $_POST["ageseason"];
        $shipping->seasontype = $_POST["seasontype"];
        $shipping->property = $_POST["property"];
        $shipping->currency = $_POST["currency"];
        $shipping->bussinesstype = $_POST["bussinesstype"];
        $shipping->warehouseid = $_POST["warehouseid"];
        // $shipping->total = $_POST["total"];
        $shipping->exchangerate = $_POST["exchangerate"];
        $shipping->paydate = $_POST["paydate"];
        $shipping->apickingdate = $_POST["apickingdate"];
        $shipping->flightno = $_POST["flightno"];
        $shipping->flightdate = $_POST["flightdate"];
        $shipping->mblno = $_POST["mblno"];
        $shipping->hblno = $_POST["hblno"];
        $shipping->dispatchport = $_POST["dispatchport"];
        $shipping->deliveryport = $_POST["deliveryport"];
        $shipping->box_number = $_POST["box_number"];
        $shipping->weight = $_POST["weight"];
        $shipping->volume = $_POST["volume"];
        $shipping->chargedweight = $_POST["chargedweight"];
        $shipping->transcompany = $_POST["transcompany"];
        $shipping->invoiceno = $_POST["invoiceno"];
        $shipping->aarrivaldate = $_POST["aarrivaldate"];
        $shipping->buyerid = $_POST["buyerid"];
        $shipping->sellerid = $_POST["sellerid"];
        $shipping->transporttype = $_POST["transporttype"];
        $shipping->paytype = $_POST["paytype"];
        $shipping->estimatedate = $_POST["estimatedate"];

        if ($shipping->update() == false) {
            throw new Exception("/11011502/更新发货单基本信息失败。/");
        }

        return $shipping;
    }
}
