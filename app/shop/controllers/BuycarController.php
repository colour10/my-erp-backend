<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbBuycar;
use Asa\Erp\TbColortemplate;
use Asa\Erp\TbCompany;
use Asa\Erp\TbMemberAddress;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbSizecontent;
use Asa\Erp\Util;

/**
 * 购物车操作类
 * Class BuycarController
 * @package Multiple\Shop\Controllers
 */
class BuycarController extends AdminController
{
    /**
     * 购物车首页
     */
    public function indexAction()
    {
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 开始调用购物车列表
        $lists = $this->getListsAction();
        // 传递参数
        if (count($lists['items']) > 0) {
            $this->view->setVars([
                'lists'     => $lists,
                'addresses' => TbMemberAddress::find("member_id=" . $member['id'])->toArray(),
            ]);
        } else {
            // 否则就直接转发到空购物车
            return $this->dispatcher->forward([
                'controller' => 'buycar',
                'action'     => 'index_null',
            ]);
        }
    }

    /**
     * 购物车为空
     */
    public function index_nullAction()
    {

    }

    /**
     * 订单列表
     * @return bool|false|string
     */
    function getListAction()
    {
        if ($rs = $this->member) {
            // 当前登录用户id
            $member_id = $rs['id'];
            // 当前登录用户的购物车模型
            $cars = TbBuycar::find('member_id=' . $member_id);

            if (!$cars->toArray()) {
                // 返回空数据
                return json_encode(['code' => '200', 'auth' => [], 'messages' => []]);
            }
            // 数据整合
            $cars_arr = [];
            $totalprice = 0;
            $totalnum = 0;
            foreach ($cars as $k => $car) {
                $car_arr = $car->toArray();
                $cars_arr['items'][$k]['id'] = $car->id;
                $cars_arr['items'][$k]['product_id'] = $car->product_id;
                $cars_arr['items'][$k]['product_name'] = $car->product_name;
                $cars_arr['items'][$k]['size_id'] = $car->size_id;
                $cars_arr['items'][$k]['color_id'] = $car->color_id;
                $cars_arr['items'][$k]['size_name'] = $car->size_name;
                $cars_arr['items'][$k]['color_name'] = $car->color_name;
                $cars_arr['items'][$k]['number'] = $car->number;
                $cars_arr['items'][$k]['price'] = $car->price;
                $cars_arr['items'][$k]['total_price'] = $car->total_price;
                $cars_arr['items'][$k]['product'] = $car->product->toArray();
                $cars_arr['items'][$k]['member'] = $car->member->toArray();
                $temp_product = $car->product->toArray();
                $temp_num = $car->number;
                // 价格采用高精度计算
                $totalprice = bcadd($totalprice, $car->total_price, 2);
                $totalnum += $temp_num;
            }
            // 默认运费为0
            $freightprice = 0;
            $cars_arr['total'] = [
                // 订单商品总价
                'totalprice'   => $totalprice,
                // 订单运费，默认为0
                'freightprice' => $freightprice,
                // 订单总数量
                'totalnum'     => $totalnum,
                // 订单总金额（合计金额+运费，采用高精度计算）
                'finalprice'   => bcadd($totalprice, $freightprice, 2),
            ];
            return json_encode(['code' => '200', 'auth' => $cars_arr, 'messages' => []]);
        } else {
            if ($rs = $this->session->get('buycar')) {
                return json_encode(['code' => '200', 'auth' => $rs, 'messages' => []]);
            } else {
                return false;
            }
        }
    }


    /**
     * 渲染用
     * @return array|bool|mixed|void
     */
    function getListsAction()
    {
        if ($rs = $this->member) {
            // 当前登录用户id
            $member_id = $rs['id'];
            // 当前登录用户的购物车模型
            $cars = TbBuycar::find('member_id=' . $member_id);

            if (!$cars->toArray()) {
                return false;
            }

            // 按照product_id和sizecontent_id取库存
            // 在取出库存之前，首先获取销售端口
            $company = TbCompany::findFirstById($rs['companyid']);
            $saleport = $company->shopSaleport;
            $array = Util::recordListColumn($saleport->saleportWarehouses, 'warehouseid');
            if (count($array) == 0) {
                return $array;
            }

            // 数据整合
            $cars_arr = [];
            $totalprice = 0;
            $totalnum = 0;
            foreach ($cars as $k => $car) {
                $car_arr = $car->toArray();
                $cars_arr['items'][$k]['id'] = $car->id;
                $cars_arr['items'][$k]['product_id'] = $car->product_id;
                $cars_arr['items'][$k]['product_name'] = $car->product_name;
                $cars_arr['items'][$k]['size_id'] = $car->size_id;
                $cars_arr['items'][$k]['color_id'] = $car->color_id;
                $cars_arr['items'][$k]['size_name'] = $car->size_name;
                $cars_arr['items'][$k]['color_name'] = $car->color_name;
                $cars_arr['items'][$k]['number'] = $car->number;

                // 取出product模型，一定是存在的
                $productModel = TbProductSearch::findFirstById($car->product_id);

                // 按照product_id和sizecontent_id尺码取出库存
                if ($car->size_id) {
                    $sizecontents = TbProductstock::sum([
                        sprintf("warehouseid in (%s) and defective_level=0 and productid = %s and sizecontentid = %s", implode(',', $array), $productModel->productid, $car->size_id),
                        "group"  => 'productid, sizecontentid',
                        "column" => 'number',
                    ]);
                    if (count($sizecontents) > 0) {
                        $sizecontents = $sizecontents->toArray();
                        $productstock = $sizecontents[0]['sumatory'];
                    } else {
                        $productstock = 0;
                    }
                } else {
                    $productstock = 0;
                }

                $cars_arr['items'][$k]['productstock'] = $productstock;
                $cars_arr['items'][$k]['price'] = $car->price;
                $cars_arr['items'][$k]['total_price'] = $car->total_price;
                $cars_arr['items'][$k]['product'] = $car->product->toArray();
                $cars_arr['items'][$k]['member'] = $car->member->toArray();
                $temp_product = $car->product->toArray();
                $temp_num = $car->number;
                // 采用高精度计算
                $totalprice = bcadd($totalprice, $car->total_price, 2);
                $totalnum += $temp_num;
            }
            // 默认运费为0
            $freightprice = 0;
            $cars_arr['total'] = [
                // 订单商品总价
                'totalprice'   => $totalprice,
                // 订单运费，默认为0
                'freightprice' => $freightprice,
                // 订单总数量
                'totalnum'     => $totalnum,
                // 订单总金额（合计金额+运费，采用高精度计算）
                'finalprice'   => bcadd($totalprice, $freightprice, 2),
            ];
            // 返回
            return $cars_arr;
        } else {
            if ($rs = $this->session->get('buycar')) {
                return $rs;
            } else {
                return false;
            }
        }
    }


    /**
     * 添加到购物车
     * @return array|false|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|string|void
     */
    public function addAction()
    {
        // 如果是post提交
        if ($this->request->isPost()) {
            // 是否登录
            if ($rs = $this->member) {
                // 取出post数据
                $post = $this->request->getPost();
                // 尺码留空的数据删除
                // 同时检测下单数量不能为负数
                foreach ($post['sizecontentids'] as $k => $v) {
                    if (empty($v)) {
                        unset($post['sizecontentids'][$k]);
                    } else {
                        if ($v < 1) {
                            return $this->error($this->getValidateMessage('params-error'));
                        }
                    }
                }


                // 如果数据为空，则提示不能提交
                if (count($post['sizecontentids']) == '0') {
                    return $this->error($this->getValidateMessage('order', 'template', 'required'));
                }


                // 产品模型，预保存处理
                // 如果不存在则报严重错误
                $productModel = TbProductSearch::findFirstById($post['product_id']);
                if (!$productModel) {
                    return $this->error($this->getValidateMessage('product', 'template', 'notexist'));
                }


                // 首先取出销售端口，查库存用
                // 在取出库存之前，首先获取销售端口
                $company = TbCompany::findFirstById($rs['companyid']);
                $saleport = $company->shopSaleport;
                $array = Util::recordListColumn($saleport->saleportWarehouses, 'warehouseid');
                if (count($array) == 0) {
                    return $array;
                }


                // 组装库存数据列表，采用悲观锁
                $sizecontents = TbProductstock::sum([
                    sprintf("warehouseid in (%s) and defective_level=0 and productid = %s", implode(',', $array), $productModel->productid),
                    "group"      => 'productid, sizecontentid',
                    "column"     => 'number',
                    "for_update" => true,
                ]);
                if ($sizecontents) {
                    $sizecontents = $sizecontents->toArray();
                }
                // 把库存的键值重新组装
                $return_sizecontents = [];
                foreach ($sizecontents as $k => $sizecontent) {
                    $return_sizecontents[$sizecontent['sizecontentid']] = $sizecontent;
                }


                // // 加入购物车不受库存限制，只有下单的时候才检查库存
                // // 查找库存是否充足，如果库存不足禁止加入购物车
                // foreach ($post['sizecontentids'] as $sizecontentid => $sizecontentnumber) {
                //     if ($sizecontentnumber > $return_sizecontents[$sizecontentid]['sumatory']) {
                //         return $this->error($this->getValidateMessage('out-of-stock'));
                //     }
                // }

                // 获取当前productid实际价格
                $realprice = $productModel->product->wordprice;


                // 因为是批量添加，所以需要循环检查，而且必须开启事务处理机制
                // 采用事务处理
                $this->db->begin();

                // 查找特定的购物车订单是否存在
                foreach ($post['sizecontentids'] as $sizecontentid => $sizecontentnumber) {
                    // 查找product_id和sizecontent_id
                    $cars = TbBuycar::findFirst([
                        "member_id = " . $rs['id'] . " and product_id = " . $post['product_id'] . " and size_id = " . $sizecontentid]);

                    // 设置当前语言字段
                    $name = $this->getlangfield('name');

                    // 如果无此商品，则把该商品添加到新购物车
                    if (!$cars) {
                        $model = new TbBuycar;
                        $model->product_id = $post['product_id'];
                        $model->product_name = $productModel->productname;
                        $model->price = $realprice;
                        $model->picture = $productModel->picture;
                        $model->picture2 = $productModel->picture2;
                        $model->number = Intval($sizecontentnumber);
                        $model->total_price = round($realprice * Intval($sizecontentnumber), 2);

                        // 写入color_id
                        $model->color_id = $productModel->color;
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

                        $model->color_name = $color_name;
                        $model->size_id = $sizecontentid;
                        $model->size_name = TbSizecontent::findFirstById($sizecontentid)->name;
                        $model->member_id = $rs['id'];
                        $res = $model->save();
                        if (!$res) {
                            // 回滚
                            $this->db->rollback();
                            return $this->error($model);
                        }
                        // 有则更新数量
                    } else {
                        $cars->number = $cars->number + Intval($sizecontentnumber);
                        $cars->total_price = sprintf($cars->total_price + sprintf("%.2f", $realprice * Intval($sizecontentnumber)));
                        $res = $cars->save();
                        if (!$res) {
                            // 回滚
                            $this->db->rollback();
                            return $this->error($cars);
                        }
                    }
                }

                // 提交事务
                $this->db->commit();

                // 返回提交成功
                return $this->success();
            } else {
                // 报错
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }
    }

    /**
     * 清空指定id的购物车
     * @return false|string
     */
    public function deletecarAction()
    {
        // 逻辑
        // 过滤
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

                // 判断购物车表是否有这个id
                $buycar = TbBuycar::findFirstById($id);
                if (!$buycar) {
                    return $this->error($this->getValidateMessage('buycar', 'template', 'notexist'));
                }
                // 开始删除
                if (!$buycar->delete()) {
                    return $this->error($this->getValidateMessage('buycar', 'db', 'delete-failed'));
                }
                // 成功返回
                return $this->success();
            } else {
                // 报错
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }
    }
}
