<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbAgeseason;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbCurrency;
use Asa\Erp\TbDepartment;
use Asa\Erp\TbExchangeRate;
use Asa\Erp\TbGoods;
use Asa\Erp\TbMember;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbSaleport;
use Asa\Erp\TbSales;
use Asa\Erp\TbSalesdetails;
use Asa\Erp\TbSalesReceive;
use Asa\Erp\TbSeries;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbUser;
use Asa\Erp\TbWarehouse;
use Asa\Erp\TbWarehousing;
use Asa\Erp\TbWarehousingdetails;
use Asa\Erp\Util;

/**
 * 统计类
 * Class StatisticsController
 * @package Multiple\Shop\Controllers
 */
class StatisticsController extends AdminController
{
    // 欧元id
    protected static $eurid = false;

    /**
     * 验证是否登录，否则退出
     */
    public function initialize()
    {
        // 取出登录公司信息
        if (!$this->currentCompany) {
            // 取出错误信息
            $msg = $this->getValidateMessage('model-delete-message');
            echo $this->error($msg);
            exit;
        }
    }

    /**
     * 使用单例模式获取欧元ID
     * @return bool|int
     */
    public static function getEurInstance()
    {
        // 逻辑
        if (self::$eurid === false) {
            $currency = TbCurrency::findFirst("name_cn='欧元'");
            if ($currency) {
                self::$eurid = $currency->id;
            } else {
                self::$eurid = 0;
            }
        }
        // 返回
        return self::$eurid;
    }

    /**
     * 销售统计
     * 缺乏的功能如下：
     * 1、到货时间
     * 2、线下店铺、爱莎商城、跨境销售
     * 3、折扣率和毛利率
     * 4、饼图的比例依据【前端功能】
     * 测试：http://www.myshop.com/statistics/sales?start_salesdate=2019-02-30&ageseason=6
     * @return false|string|void
     */
    public function salesAction()
    {
        // 逻辑
        // 如果是post，则执行此逻辑
        if ($this->request->isPost()) {
            // 1、参数处理
            // 获取全部参数
            $params = $this->request->get();
            // 如果没有传入起始销售时间和终止销售时间，那么就默认为昨天一整天的数据
            $start_salesdate = $this->request->get('start_salesdate') ?: date('Y-m-d', time() - 86400);
            $end_salesdate = $this->request->get('end_salesdate') ?: date('Y-m-d', time() + 86400);
            // 保存rateby、groupby参数
            $rateby = $this->request->get('rateby') ?: '1';
            $groupby = $this->request->get('groupby') ?: '1';
            // 去掉无需直接搜索的参数
            $unsetVals = ['_url', 'start_salesdate', 'end_salesdate', 'rateby', 'groupby'];
            foreach ($unsetVals as $v) {
                unset($params[$v]);
            }

            // 2、数据查询
            // 使用构造器进行查询
            $builder = $this->modelsManager->createBuilder();
            // 指定操作表和字段
            // 多语言字段
            $name = $this->getlangfield('name');
            // 先定义国际码concat，这里要用到2次
            $concat_wordcode = 'concat(p.wordcode_1,p.wordcode_2,wordcode_3,wordcode_4)';
            $concat_sumprice = 'round(concat(g.price * sd.number * s.discount), 2)';
            // 主表为销售表tb_sales，简写为s
            $builder->from(['s' => TbSales::class])
                // 加入销售详情表tb_salesdetails，简写为sd
                ->join(TbSalesdetails::class, 'sd.salesid = s.id', 'sd')
                // 加入商品库存表tb_productstock，简写为ps
                ->join(TbProductstock::class, 'sd.productstockid = ps.id', 'ps')
                // 加入商品表tb_product，简写为p
                ->join(TbProduct::class, 'ps.productid = p.id', 'p')
                // 加入商品sku表tb_goods，简写为g
                ->join(TbGoods::class, 'ps.goodsid = g.id', 'g')
                // 加入用户表tb_user，简写为u
                ->join(TbUser::class, 's.salesstaff = u.id', 'u')
                // 再加入一个用户表tb_user，简写为u2
                ->join(TbUser::class, 's.makestaff = u2.id', 'u2')
                // 加入部门表tb_department，简写为dm
                ->join(TbDepartment::class, 'u.departmentid = dm.id', 'dm')
                // 加入品牌表tb_brand，简写为b
                ->join(TbBrand::class, 'p.brandid = b.id', 'b')
                // 加入品类表tb_brandgroup，简写为bg
                ->join(TbBrandgroup::class, 'p.brandgroupid = bg.id', 'bg')
                // 加入销售端口表tb_saleport，简写为sp
                ->join(TbSaleport::class, 's.saleportid = sp.id', 'sp')
                // 加入会员表tb_member，简写为m
                ->join(TbMember::class, 's.memberid = m.id', 'm')
                // 加入尺码表tb_sizecontent，简写为sc
                ->join(TbSizecontent::class, 'ps.sizecontentid = sc.id', 'sc')
                // 待检出的字段，务必保证这其中的所有字段都建立索引
                ->columns("
                    s.id as salesid, 
                    s.memberid, 
                    s.companyid,
                    m.name as membername,
                    s.salesstaff,
                    s.makestaff,
                    u.login_name as salesstaffname,
                    u2.login_name as makestaffname,
                    s.discount,
                    s.warehouseid,
                    s.saleportid,
                    sp.name as saleportname,
                    s.status,
                    s.makedate,
                    s.orderno,
                    s.ordercode,
                    s.expressno,
                    s.status,
                    sd.productstockid,
                    sd.number,
                    ps.goodsid,
                    ps.productid,
                    ps.sizecontentid,
                    sc.name as sizecontentname,
                    p.productname,
                    $concat_wordcode as wordcode,
                    $concat_sumprice as sum_realprice,
                    p.gender as genderid,
                    p.brandid,
                    b.$name as brandname,
                    p.brandgroupid,
                    p.series,
                    bg.$name as brandgroupname,
                    p.ageseason as ageseasonid,
                    p.picture,
                    g.price,
                    round(g.price * s.discount, 2) as realprice, 
                    u.departmentid,
                    dm.name as departmentname
            ");
            // 默认必须的查询条件
            $builder->where("s.status <> 2 and s.companyid = $this->currentCompany and s.makedate between :start_salesdate: and :end_salesdate:", [
                'start_salesdate' => $start_salesdate,
                'end_salesdate' => $end_salesdate,
            ]);

            // 3、搜索条件过滤
            // 开始拼接剩余的搜索条件
            foreach ($params as $field => $val) {
                // 如果不为空，就执行搜索
                if (!empty($val)) {
                    // 如果里面有concat字段，那么就进行特殊处理
                    if ($field == 'wordcode') {
                        $andWhereCondition = $concat_wordcode;
                    } else if ($field == 'ageseasonid') {
                        $andWhereCondition = 'p.ageseason';
                    } else if ($field == 'genderid') {
                        $andWhereCondition = 'p.gender';
                    } else {
                        $andWhereCondition = $field;
                    }
                    // 判断是否为多选，如果是多选则设定为orWhere
                    if (Util::is_json($val)) {
                        $array = json_decode($val, true);
                        // 内部应该是AND (`p`.`brandid` = 6 OR `p`.`brandid` = 7)，每个条件用OR隔开，外面用AND相连接
                        $where = [];
                        foreach ($array as $id) {
                            $where[] = "$field = $id";
                        }
                        // 然后每个用OR进行连接
                        $condition = implode(' OR ', $where);
                        // 重新拼接
                        $builder->andWhere($condition);
                    } else {
                        // 如果是单选则执行简单拼接
                        // 如果字段内容中含有，英文逗号，则进行like检查，要想让索引生效，需要把上面的检出字段都建立索引哦
                        if ($field == 'ageseasonid') {
                            $builder->andWhere("$andWhereCondition like :$field:", [
                                $field => '%' . trim($val) . '%',
                            ]);
                        } else {
                            $builder->andWhere("$andWhereCondition = :$field:", [
                                $field => trim($val),
                            ]);
                        }
                    }
                }
            }

            // 处理groupby，这里同样取消了入库时间
            // 变量预处理，前面加上表名，防止字段名重复
            switch ($groupby) {
                // 1-品牌
                case '1':
                    $groupbyStr = 'brandid';
                    $groupbyDesc = "brandname";
                    break;
                // 2-销售端口
                case '2':
                    $groupbyStr = 'saleportid';
                    $groupbyDesc = 'saleportname';
                    break;
                // 3-品类
                case '3':
                    $groupbyStr = 'brandgroupid';
                    $groupbyDesc = "brandgroupname";
                    break;
                // 4-部门
                case '4':
                    $groupbyStr = 'departmentid';
                    $groupbyDesc = 'departmentname';
                    break;
                // 5-会员
                case '5':
                    $groupbyStr = 'memberid';
                    $groupbyDesc = 'membername';
                    break;
                // 6-销售人
                case '6':
                    $groupbyStr = 'salesstaff';
                    $groupbyDesc = 'salesstaffname';
                    break;
                // 默认-品牌
                default:
                    $groupbyStr = 'brandid';
                    $groupbyDesc = "brandname";
            }

            // 获取查询对象
            $query = $builder->getQuery();
            // 查出结果
            $result = $query->execute()->toArray();


            // 4、汇总统计
            // 首先声明一个新数组用来保存最终的结果
            $return_array = [];
            $return_array['items'] = [];
            // 开始对结果进行预处理，计算出全部数量和金额
            // 汇总数量
            $total_number = array_sum(array_column($result, 'number'));
            // 汇总金额
            $total_realprice = array_sum(array_column($result, 'sum_realprice'));
            // 销售单回款模型
            $receives = $this->getSaleReceives();

            // 把销售单回款数据合并到销售单中
            $result = $this->getTwoArrayMergeByOneField($result, $receives, 'salesid');

            // 分组并添加每个组下面的元素列表
            foreach ($result as $k => $item) {
                // 销售单状态判定
                // 订单状态
                switch ($item['status']) {
                    case '0':
                        $status = '预售';
                        break;
                    case '1':
                        $status = '已售';
                        break;
                    case '2':
                        $status = '作废';
                        break;
                    default:
                        $status = '预售';
                }
                $item['status'] = $status;

                // 销售日期转换成纯日期Y-m-d格式
                $item['makedate'] = date('Y-m-d', strtotime($item['makedate']));

                // 年代季节增加具体名称
                $item['ageseasonname'] = $this->getCommasValues(TbAgeseason::class, $item['ageseasonid'], ['sessionmark', 'name']);

                // 系列增加具体名称
                $item['seriesname'] = $this->getCommasValues(TbSeries::class, $item['series'], [$name]);

                // 如果新数组中不存在，就新增
                if (!isset($return_array['items'][$item[$groupbyStr]])) {
                    $return_array['items'][$item[$groupbyStr]] = [
                        'id' => $item[$groupbyStr],
                        'name' => $item[$groupbyDesc],
                        'sum_number' => $item['number'],
                        'sum_realprice' => $item['sum_realprice'],
                    ];
                } else {
                    // 否则就累计，采用高精度计算
                    $return_array['items'][$item[$groupbyStr]]['sum_number'] += $item['number'];
                    $return_array['items'][$item[$groupbyStr]]['sum_realprice'] = bcadd($return_array['items'][$item[$groupbyStr]]['sum_realprice'], $item['sum_realprice'], 2);
                }
                // 添加点击之后的内页数据，直接放在新的details字段中即可。
                $return_array['items'][$item[$groupbyStr]]['details'][] = $item;
            }

            // 再把数量比例和金额比例添加到数组中
            foreach ($return_array['items'] as $k => $item) {
                $return_array['items'][$k]['rate_number'] = round($item['sum_number'] / $total_number * 100, 2) . "%";
                $return_array['items'][$k]['rate_price'] = round($item['sum_realprice'] / $total_realprice * 100, 2) . "%";
            }

            // 去掉数组的个性化下标，从0开始排
            $return_array['items'] = array_values($return_array['items']);

            // 补充total数组
            $return_array['total']['total_number'] = $total_number;
            $return_array['total']['total_realprice'] = $total_realprice;

            // 返回最终结果
            return $this->success($return_array);
        }
    }


    /**
     * 库销比统计-微调
     * 缺乏的功能如下：
     * 1、到货时间，因为tb_product表中缺少此字段
     * 测试地址：http://www.myshop.com/statistics/stocksalerate?start_salesdate=2019-01-01&start_salesdate=2019-04-02&groupby=2&orderby=2&orderbymethod=2
     * @return false|string|void
     */
    public function stocksalerateAction()
    {
        // 逻辑
        // 如果是post，则执行此逻辑
        if ($this->request->isPost()) {
            // 1、参数处理
            // 获取全部参数
            $params = $this->request->get();
            // 如果没有传入起始销售时间和终止销售时间，那么就默认为昨天一整天的数据
            $start_salesdate = $this->request->get('start_salesdate') ?: date('Y-m-d', time() - 86400);
            $end_salesdate = $this->request->get('end_salesdate') ?: date('Y-m-d', time() + 86400);
            // 入库日期
            $start_stockdate = $this->request->get('start_stockdate') ? date('Y-m-d', strtotime($params['start_stockdate']) - 86400) : date('Y-m-d', strtotime('0001-01-01 00:00:00'));
            $end_stockdate = $this->request->get('end_stockdate') ? date('Y-m-d', strtotime($params['end_stockdate']) + 86400) : date('Y-m-d', time() + 86400);
            // 保存rateby、groupby参数
            $orderbyStr = $this->request->get('orderby') ?: '1';
            $groupbyStr = $this->request->get('groupby') ?: '1';
            $orderby_method = $this->request->get('orderbymethod') ?: '1';
            // 去掉无需直接搜索的参数
            $unsetVals = ['_url', 'start_salesdate', 'end_salesdate', 'rateby', 'groupby'];
            foreach ($unsetVals as $v) {
                unset($params[$v]);
            }

            // 2、销售表根据搜索条件进行预处理
            // 需要过滤销售端口、成交价格、折扣率、仓库等
            $sales = $this->getSales($start_salesdate, $end_salesdate);
            // 集中处理条件过滤
            $where = $this->getArraySearchAttributes($params, ['saleportid'], [], ['realprice', 'discount'], ['warehouseid']);
            // 获取结果集
            $return_sales = $this->getArraySearchValues($sales, $where);
            // 按照productid进行汇总
            $return_group_sales = $this->getGroupArray($return_sales, 'productid', ['productid', 'productname', 'sellnumber', 'brandid', 'brandname', 'brandfilename', 'brandgroupid', 'brandgroupname', 'ageseasonid', 'ageseasonname', 'wordcode', 'sum_price', 'sum_realprice'], ['sellnumber', 'sum_price', 'sum_realprice']);

            // return $this->success($return_group_sales);

            // 3、入库表根据搜索条件进行预处理
            // 需要过滤品牌、品类、仓库、年代、性别、到货时间
            $warehousings = $this->getWarehousings($start_stockdate, $end_stockdate);
            // 集中处理条件过滤
            $where = $this->getArraySearchAttributes($params, ['ageseasonid'], ['genderid'], [], ['brandid', 'brandgroupid', 'warehouseid']);
            // 获取结果集
            $return_warehousings = $this->getArraySearchValues($warehousings, $where);
            // 按照productid进行汇总
            $return_group_warehousings = $this->getGroupArray($return_warehousings, 'productid', ['productid', 'productname', 'number', 'brandid', 'brandname', 'brandfilename', 'brandgroupid', 'brandgroupname', 'ageseasonid', 'ageseasonname', 'wordcode'], ['number']);

            // 4、销售表与入库表进行整合并汇总，因为上面已经按照productid汇总完了，并且$key的值也和productid一致，汇总的时候把相同$key的值进行合并。
            $return = $this->getTwoArrayMergeByKey($return_group_sales, $return_group_warehousings);
            // 再补充缺失的字段，如果没有number，则number=0；如果没有sellnumber，则sellnumber=0
            $return = $this->getTotalSaleAndStockNumbers($return);

            // 5、处理groupby
            // 变量预处理，前面加上表名，防止字段名重复
            switch ($groupbyStr) {
                // 1-商品
                case '1':
                    $groupby = 'productid';
                    break;
                // 2-品牌
                case '2':
                    $groupby = 'brandid';
                    break;
                // 默认-商品
                default:
                    $groupby = 'productid';
            }

            // 因为上面的逻辑默认是按照商品进行分组的，所以如果是选择了商品分组，那么无需处理
            if ($groupby == 'productid') {
                $return_array = $return;
            } else {
                // 否则就按照品牌进行处理
                $return_array = [];
                foreach ($return as $k => $item) {
                    // 如果新数组中不存在，就新增
                    // 除了新增数量和金额之外，还需要增加各自的百分比
                    if (!isset($return_array[$item[$groupby]])) {
                        $return_array[$item[$groupby]][$groupby] = $item[$groupby];
                        $return_array[$item[$groupby]]['sellnumber'] = $item['sellnumber'];
                        $return_array[$item[$groupby]]['number'] = $item['number'];
                        $return_array[$item[$groupby]]['brandname'] = $item['brandname'];
                        $return_array[$item[$groupby]]['brandfilename'] = $item['brandfilename'];
                    } else {
                        // 否则就累计
                        $return_array[$item[$groupby]]['sellnumber'] += $item['sellnumber'];
                        $return_array[$item[$groupby]]['number'] += $item['number'];
                    }
                }
                // 接着补充百分比
                foreach ($return_array as $k => $item) {
                    // 如果number不为0
                    if ($item['number'] == '0') {
                        $return_array[$k]['rate'] = 0;
                    } else {
                        $return_array[$k]['rate'] = round($item['sellnumber'] / $item['number'], 2);
                    }
                }
            }

            // 6、处理排序orderby
            // 默认是按照库销比
            switch ($orderbyStr) {
                // 1-库销比
                case '1':
                    $orderby = 'rate';
                    break;
                // 2-销售数量
                case '2':
                    $orderby = 'sellnumber';
                    break;
                // 默认-库销比
                default:
                    $orderby = 'rate';
            }

            // 7、处理排序字段orderbymethod
            // 升序还是降序
            switch ($orderby_method) {
                // 1-高到低【降序】
                case '1':
                    $orderbymethod = 'desc';
                    break;
                // 2-低到高【升序】
                case '2':
                    $orderbymethod = 'asc';
                    break;
                // 默认-高到低
                default:
                    $orderbymethod = 'desc';
            }


            // 排序逻辑
            // 取得列的列表
            foreach ($return_array as $key => $row) {
                $rate[$key] = $row['rate'];
                $sellnumber[$key] = $row['sellnumber'];
            }

            // 将数据根据 rate 降序排列，根据 sellnumber 升序排列
            // 把 $return_array 作为最后一个参数，以通用键排序
            // 根据参数进行二维数组排序
            if ($orderby == 'rate') {
                if ($orderbymethod == 'desc') {
                    array_multisort($rate, SORT_DESC, $sellnumber, SORT_ASC, $return_array);
                } else {
                    array_multisort($rate, SORT_ASC, $sellnumber, SORT_DESC, $return_array);
                }
            } else {
                if ($orderbymethod == 'desc') {
                    array_multisort($sellnumber, SORT_DESC, $rate, SORT_ASC, $return_array);
                } else {
                    array_multisort($sellnumber, SORT_ASC, $rate, SORT_DESC, $return_array);
                }
            }

            // 8、最终返回
            return $this->success($return_array);
        }
    }

    /**
     * 单季订货数量
     * 缺乏的功能如下：
     * 1、库销间隔天数
     * 2、入库成本
     * 3、销售成本
     * 4、入库成本/销售成本的库销比
     * 5、已售金额/入库成本的库销比
     * @return false|string
     */
    public function seasionorderAction()
    {
        // 逻辑
        // 1、变量初始化
        // 获取全部参数
        $params = $this->request->get();
        // 然后获取当月是第几季度
        $season = ceil((date('n')) / 3);
        // 接下来获取本季度时间范围
        $start_season = date('Y-m-d H:i:s', mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y')));
        $end_season = date('Y-m-d H:i:s', mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y')));

        // 2、获取入库结果集
        $warehousings = $this->getWarehousings($start_season, $end_season);
        // 年代、品牌、品类条件过滤
        $where = $this->getArraySearchAttributes($params, ['ageseasonid'], [], [], ['brandid', 'brandgroupid']);
        // 获取结果集
        $return_warehousings = $this->getArraySearchValues($warehousings, $where);
        // 按照productid进行汇总
        $return_group_warehousings = $this->getGroupArray($return_warehousings, 'productid', ['productid', 'productname', 'number', 'brandid', 'brandname', 'brandgroupid', 'brandgroupname', 'warehouseid', 'entrydate'], ['number']);

        // 3、获取销售结果集
        // 需要过滤销售端口、成交价格、折扣率、仓库等
        $sales = $this->getSales($start_season, $end_season);
        // 集中处理条件过滤
        $where = $this->getArraySearchAttributes($params, [], ['departmentid'], [], ['saleportid']);
        // 获取结果集
        $return_sales = $this->getArraySearchValues($sales, $where);
        // 按照productid进行汇总
        $return_group_sales = $this->getGroupArray($return_sales, 'productid', ['productid', 'productname', 'sellnumber', 'brandid', 'brandname', 'brandgroupid', 'brandgroupname', 'sum_price', 'sum_realprice', 'warehouseid'], ['sellnumber', 'sum_price', 'sum_realprice']);

        // 4、销售表与入库表进行整合并汇总，因为上面已经按照productid汇总完了，并且$key的值也和productid一致，汇总的时候把相同$key的值进行合并。
        $return_group_productid = $this->getTwoArrayMergeByKey($return_group_sales, $return_group_warehousings);
        // 再补充缺失的字段，如果没有number，则number=0；如果没有sellnumber，则sellnumber=0
        $return_group_productid = $this->getTotalSaleAndStockNumbers($return_group_productid);

        // 5、处理groupby
        $groupbyStr = $this->request->get('groupby') ?: '1';
        switch ($groupbyStr) {
            // 1-品牌
            case '1':
                $groupby = 'brandid';
                break;
            // 2-品类
            case '2':
                $groupby = 'brandgroupid';
                break;
            // 默认-商品
            default:
                $groupby = 'brandid';
        }

        // 6、保存最终分组变量
        $return = [];
        // 在外面统计总数量、总结算金额、库销比、
        $total_number = 0;
        $total_sellnumber = 0;
        $total_realprice = 0;
        $total_rate = 0;
        foreach ($return_group_productid as $k => $item) {
            // 如果新数组中不存在，就新增
            if (!isset($return['items'][$item[$groupby]])) {
                // 拼接当前分组的名字
                $groupbyname = substr($groupby, 0, strlen($groupby) - 2) . 'name';
                $groupbyvalue = $item[$groupbyname];
                $return['items'][$item[$groupby]] = [
                    $groupby => $item[$groupby],
                    $groupbyname => $groupbyvalue,
                    'sum_number' => $item['number'],
                    'sum_sellnumber' => $item['sellnumber'],
                    'sum_realprice' => $item['sum_realprice'],
                ];
            } else {
                // 否则就累计，价格用高精度进行累计
                $return['items'][$item[$groupby]]['sum_number'] += $item['number'];
                $return['items'][$item[$groupby]]['sum_sellnumber'] += $item['sellnumber'];
                $return['items'][$item[$groupby]]['sum_realprice'] = bcadd($return['items'][$item[$groupby]]['sum_realprice'], $item['sum_realprice'], 2);
            }
            // 处理完了之后，增加百分比
            $return['items'][$item[$groupby]]['rate'] = round($return['items'][$item[$groupby]]['sum_sellnumber'] / $return['items'][$item[$groupby]]['sum_number'], 2);
            // 计数器累计
            $total_number += $return['items'][$item[$groupby]]['sum_number'];
            $total_sellnumber += $return['items'][$item[$groupby]]['sum_sellnumber'];
            $total_realprice = bcadd($total_realprice, $return['items'][$item[$groupby]]['sum_realprice'], 2);
            $total_rate = round($total_sellnumber / $total_number, 2);
        }

        // 补充total数组
        $return['total'] = [
            'total_number' => $total_number,
            'total_sellnumber' => $total_sellnumber,
            'total_realprice' => $total_realprice,
            'total_rate' => $total_rate,
        ];

        // 7、最终返回
        return $this->success($return);
    }

    /**
     * 库存余额查询
     */
    public function stockbalanceAction()
    {
        // 逻辑
        // 取出登录公司信息
        // 赋值
        $companyid = $this->currentCompany;

        // 获取全部参数
        $params = $this->request->get();

        // 截止日期
        $end_stockdate = $this->request->get('end_stockdate');
        if (!$end_stockdate) {
            // 取出错误信息
            $msg = $this->getValidateMessage('date-required');
            return $this->error([$msg]);
        }
        $end_stockdate = date('Y-m-d', strtotime($end_stockdate) + 86400);

        // 库存模型，这个是主表，所有的查询条件都以这个为基准
        // 初始化TbProductstock查询条件
        $conditions = "defective_level = 0 and companyid = $companyid and create_time <= :end_stockdate:";
        $stocks = TbProductstock::find([
            $conditions,
            'bind' => [
                'end_stockdate' => $end_stockdate,
            ],
        ]);

        // 转成数组
        $stocks = $stocks->toArray();

        // 添加必须的字段和参数
        // 继续
        foreach ($stocks as $k => $stock) {
            // 商品模型
            $productModel = TbProduct::findFirstById($stock['productid']);
            // 添加属性
            $info = $productModel->toArray();
            unset($info['id']);
            // 重新赋值
            // 把stock的值也赋值进去
            foreach ($stock as $key => $value) {
                $info[$key] = $value;
            }
            $stocks[$k] = $info;
        }

        // 集中处理条件过滤
        $where = $this->getArraySearchAttributes($params, ['ageseasonid'], ['spring', 'summer', 'fall', 'winter'], [], ['property', 'brandid', 'warehouseid', 'brandgroupid', 'brandproperty']);
        // 获取结果集
        $return_stocks = $this->getArraySearchValues($stocks, $where);
        // 按照productid分组
        // 按照productid进行汇总
        $return_group_stocks = $this->getGroupArray($return_stocks, 'productid', ['productid', 'productname', 'brandid', 'brandname', 'brandgroupid', 'brandgroupname', 'sum_price', 'sum_realprice', 'warehouseid'], ['sellnumber', 'sum_price', 'sum_realprice']);
        // 返回
        return $this->success($return_group_stocks);
    }

    /**
     * 根据销售日期查出销售信息及其他关联信息
     * @param string $start_salesdate 起始销售日期
     * @param string $end_salesdate 截止销售日期
     * @return mixed
     */
    public function getSales($start_salesdate, $end_salesdate)
    {
        // 使用构造器进行查询
        $builder = $this->modelsManager->createBuilder();
        // 多语言字段
        $name = $this->getlangfield('name');
        // 主表为销售表sales，简写为s（销售日期必须填写，以这个为基准）
        $builder->from(['s' => TbSales::class])
            // 加入销售详情表tb_salesdetails，简写为sd
            ->join(TbSalesdetails::class, 'sd.salesid = s.id', 'sd')
            // 加入商品库存表tb_productstock，简写为ps
            ->join(TbProductstock::class, 'sd.productstockid = ps.id', 'ps')
            // 加入商品表tb_product，简写为p
            ->join(TbProduct::class, 'ps.productid = p.id', 'p')
            // 加入商品sku表tb_goods，简写为g
            ->join(TbGoods::class, 'ps.goodsid = g.id', 'g')
            // 加入品牌表tb_brand，简写为b
            ->join(TbBrand::class, 'p.brandid = b.id', 'b')
            // 加入品类表tb_brandgroup，简写为bg
            ->join(TbBrandgroup::class, 'p.brandgroupid = bg.id', 'bg')
            ->columns("
                    s.id as salesid,
                    s.status,
                    s.makedate,
                    s.companyid,
                    s.discount,
                    s.saleportid,
                    s.warehouseid,
                    sd.id as salesdetailsid,
                    sd.productstockid,
                    sd.number as sellnumber,
                    ps.goodsid,
                    ps.productid,
                    ps.sizecontentid,
                    p.productname,
                    p.picture as productpicture,
                    p.gender as genderid,
                    p.brandid,
                    concat(p.wordcode_1,p.wordcode_2,wordcode_3,wordcode_4) as wordcode,
                    b.$name as brandname,
                    b.filename as brandfilename,
                    p.brandgroupid,
                    bg.$name as brandgroupname,
                    p.ageseason as ageseasonid,
                    g.price,
                    (g.price * s.discount) as realprice,
                    (g.price * sd.number) as sum_price,
                    (g.price * s.discount * sd.number) as sum_realprice
            ");
        // 默认必须的查询条件
        $builder->where("s.status <> 2 and s.companyid = $this->currentCompany and s.makedate between :start_salesdate: and :end_salesdate:", [
            'start_salesdate' => $start_salesdate,
            'end_salesdate' => $end_salesdate,
        ]);
        // 获取查询对象
        $query = $builder->getQuery();
        // 查出结果
        $return = $query->execute()->toArray();
        // 把年代季节写入进去
        foreach ($return as $k => $v) {
            $return[$k]['ageseasonname'] = $this->getCommasValues(TbAgeseason::class, $v['ageseasonid'], ['sessionmark', 'name']);
        }
        // 返回
        return $return;
    }

    /**
     * 获取指定时间段的入库记录及所有相关信息
     * @param string $start_stockdate 起始日期
     * @param string $end_stockdate 截止日期
     * @return array
     */
    public function getWarehousings($start_stockdate = '', $end_stockdate = '')
    {
        // 逻辑
        // 开始查询入库表
        $stocks = TbWarehousing::find([
            "companyid = $this->currentCompany and entrydate between :start_stockdate: and :end_stockdate:",
            'bind' => [
                'start_stockdate' => $start_stockdate,
                'end_stockdate' => $end_stockdate,
            ],
        ]);
        // 取出订单id列表
        $ids = [];
        foreach ($stocks as $stock) {
            $ids[] = $stock->id;
        }
        $ids = implode(',', $ids);
        // 把入库详情表信息展示出来
        $stockdetails = TbWarehousingdetails::find(
            "warehousingid in ({$ids})"
        );
        // 继续
        $return = $stockdetails->toArray();
        $name = $this->getlangfield('name');
        foreach ($stockdetails as $k => $v) {
            // 临时变量
            $detail = $v->getProductStock()->toArray();
            // 然后取出名称、国际码、年代季节
            // 商品模型
            $productModel = TbProduct::findFirstById($detail['productid']);
            // 判断产品模型是否存在
            if ($productModel) {
                // 产品名称
                $detail['productname'] = $productModel->productname;
                // 产品图片
                $detail['productpicture'] = $productModel->picture;
                // 国际码
                $detail['wordcode'] = $productModel->wordcode_1 . $productModel->wordcode_2 . $productModel->wordcode_3 . $productModel->wordcode_4;
                // 品牌id
                $detail['brandid'] = $productModel->brandid;
                // 品牌名称
                $brand = TbBrand::findFirstById($detail['brandid']);
                if (!$brand) {
                    $detail['brandname'] = '';
                } else {
                    $detail['brandname'] = $brand->$name;
                }
                // 品牌图片
                $detail['brandfilename'] = $brand->filename;
                // 品类id
                $detail['brandgroupid'] = $productModel->brandgroupid;
                // 品类名称
                $brandgroup = TbBrandgroup::findFirstById($detail['brandgroupid']);
                if (!$brandgroup) {
                    $detail['brandgroupname'] = '';
                } else {
                    $detail['brandgroupname'] = $brandgroup->$name;
                }
            } else {
                // 产品名称
                $detail['productname'] = '';
                // 国际码
                $detail['wordcode'] = '';
                // 品牌id
                $detail['brandid'] = '';
                // 品牌名称
                $detail['brandname'] = '';
                // 品牌图片
                $detail['brandfilename'] = '';
                // 品类id
                $detail['brandgroupid'] = '';
                // 品类名称
                $detail['brandgroupname'] = '';
            }
            // 年代季节
            $detail['ageseasonid'] = $productModel->ageseason;
            // 年代季节名称
            $detail['ageseasonname'] = $this->getCommasValues(TbAgeseason::class, $detail['ageseasonid'], ['sessionmark', 'name']);
            // 入库日期
            $detail['entrydate'] = $v->warehousing->entrydate;
            // 删除没用的无需显示
            $unsets = ['create_time', 'create_stuff', 'change_time', 'change_stuff', 'defective_level', 'property'];
            foreach ($unsets as $unset) {
                unset($detail[$unset]);
            }
            // 重新赋值
            $return[$k] = $detail;
        }
        // 最终返回
        return $return;
    }

    /**
     * 获取截止某个时间节点的库存状况
     * @param string $end_stockdate 截止日期
     * @return string|array
     */
    public function getStocks($end_stockdate = '')
    {
        // 逻辑
        // 参数列表
        $params = $this->request->get();
        $end_stockdate = $this->request->get('end_stockdate');
        if (!$end_stockdate) {
            // 取出错误信息
            return $this->getValidateMessage('date-required');
        }
        // 取输入日期之后的那一天作为截止日
        $end_stockdate = date('Y-m-d', strtotime($end_stockdate) + 86400);
        // 继续做
    }

    /**
     * 获取数组查询最终条件
     * @param array $searchParams 参数数组
     * @param array $hasCommasParams 有逗号的一对多关系的数组列表，比如年代季节
     * @param array $singleParams 纯单选数组列表，比如性别
     * @param array $betweenParams 区间数组列表，比如价格范围或者折扣范围
     * @param array $multiParams 纯多选数组列表，比如品类，品牌
     * @return array
     */
    public function getArraySearchAttributes(array $searchParams, array $hasCommasParams = [], array $singleParams = [], array $betweenParams = [], array $multiParams = [])
    {
        // 声明一个变量用来保存查询的条件
        $where = [];

        // 处理$hasCommasParams 有逗号的一对多关系的数组列表
        if (count($hasCommasParams)) {
            foreach ($hasCommasParams as $commasParam) {
                if (isset($searchParams["$commasParam"]) && $temp = $searchParams["$commasParam"]) {
                    $where[] = '(' . "strpos(\$data['$commasParam'], '$temp') !== false" . ')';
                }
            }
        }

        // 处理$singleParams 纯单选数组列表
        if (count($singleParams)) {
            foreach ($singleParams as $singleParam) {
                if (isset($searchParams["$singleParam"]) && $temp = $searchParams["$singleParam"]) {
                    $where[] = '(' . "\$data['$singleParam'] == " . $temp . ')';
                }
            }
        }

        // 处理$betweenParams 区间数组列表
        if (count($betweenParams)) {
            foreach ($betweenParams as $betweenParam) {
                // 确定起始和结尾字段名称
                $start = isset($searchParams['start_' . $betweenParam]) ? $searchParams['start_' . $betweenParam] : '';
                $end = isset($searchParams['end_' . $betweenParam]) ? $searchParams['end_' . $betweenParam] : '';
                // 如果两个都为空，那么不处理
                // 分三种情况处理
                if (empty($start) && !empty($end)) {
                    $where[] = '(' . "\$data['$betweenParam'] <= {$end}" . ')';
                } else if (!empty($start) && empty($end)) {
                    $where[] = '(' . "\$data['$betweenParam'] >= {$start}" . ')';
                } else if (!empty($start) && !empty($end)) {
                    $where[] = '(' . "{$start} <=  \$data['$betweenParam'] && {$end} >= \$data['$betweenParam']" . ')';
                }
            }
        }

        // 处理$multiParams 纯多选数组列表
        if (count($multiParams)) {
            foreach ($multiParams as $multiParam) {
                if (isset($searchParams["$multiParam"]) && $temp = $searchParams["$multiParam"]) {
                    // 判断如果不是json格式就不赋值
                    if (Util::is_json($temp)) {
                        $temp_array = json_decode($temp, true);
                        $condition = [];
                        foreach ($temp_array as $id) {
                            $condition[] = "\$data['$multiParam'] == " . $id;
                        }
                        $where[] = '(' . implode(' || ', $condition) . ')';
                    }
                }
            }
        }

        // 生成数组查询字符串并最终返回
        return implode(' && ', $where);
    }

    /**
     * 获取最终查询的结果
     * @param array $datas 结果集
     * @param string $where 查询条件
     * @return array 返回数组结果
     */
    public function getArraySearchValues(array $datas, $where = "")
    {
        // 逻辑
        // 开始查找
        // 如果搜索条件为空，则原样输出
        if (!$where) {
            return $datas;
        } else {
            // 把结果保存在一个变量中
            $return = [];
            foreach ($datas as $k => $data) {
                // 使用php引擎自动解析
                if (eval("return $where;")) {
                    $return[] = $data;
                }
            }
            // 返回
            return $return;
        }
    }

    /**
     * 以$groupby字段作为分组条件，并把二维数组合并为一维数组
     * @param array $datas 二维数组
     * @param string $groupby 分组字段
     * @param array $mustBeDisplayFields 所有需要展示的字段数组
     * @param array $totalFields 需要累计做加法的字段数组
     * @param array $concatFields 需要合并的字段数组
     * @return array
     */
    public function getGroupArray(array $datas, $groupby, array $mustBeDisplayFields = [], array $totalFields = [], array $concatFields = [])
    {
        // 逻辑
        $return = [];
        foreach ($datas as $k => $data) {
            if (!isset($return[$data[$groupby]])) {
                // 必显字段压入新数组
                foreach ($mustBeDisplayFields as $displayField) {
                    $return[$data[$groupby]][$displayField] = $data[$displayField];
                }
            } else {
                // 数组类型进行累计，使用高精度计算
                foreach ($totalFields as $field) {
                    $return[$data[$groupby]][$field] = bcadd($return[$data[$groupby]][$field], $data[$field], 2);
                }
                // 需要合并的字段如果存在了，那就直接用逗号连接起来
                foreach ($concatFields as $concatField) {
                    if (!empty($data[$concatField])) {
                        $return[$data[$groupby]][$concatField] .= ',' . $data[$concatField];
                    }
                }
            }
        }
        // 返回
        return $return;
    }

    /**
     * 根据ID逗号分隔符查出对应的文字项，给出友好提示
     * @param string $model 模型字符串，比如TbProduct::class
     * @param string $ids id列表，每个id之间以逗号分隔
     * @param array $displayFields 要显示的字段
     * @return array|string
     */
    public function getCommasValues($model, $ids, array $displayFields = [])
    {
        // 逻辑
        // 如果$ids值为0或者空，那么就返回空
        if (empty($ids)) {
            return '';
        }
        // 首先把$ids按照逗号进行切割
        $ids_array = explode(',', $ids);
        // 保存最终的返回值
        $return = [];
        // 开始循环
        foreach ($ids_array as $id) {
            // 如果模型为空
            $modelResult = $model::findFirstById($id);
            if (!$modelResult) {
                // 跳出当前循环
                break;
            }
            if (empty($displayFields)) {
                $return[] = $modelResult->toArray();
            } else {
                // 循环字段显示
                // 如果$displayFields有值，那么每次循环过后都保存到一个临时变量中
                $temp = '';
                foreach ($displayFields as $field) {
                    $temp .= $modelResult->$field;
                }
                // 赋值
                $return[] = $temp;
            }
        }
        // 根据传入的字段返回结果
        if (empty($displayFields)) {
            return $return;
        } else {
            return implode(',', $return);
        }
    }

    /**
     * 把两个二维数组按照相同的键名进行合并
     * @param array $array1 一号数组
     * @param array $array2 二号数组
     * @return array 返回数组
     */
    public function getTwoArrayMergeByKey(array $array1, array $array2)
    {
        // 逻辑
        $return = [];
        // 先获得第一个数组
        foreach ($array1 as $k => $v) {
            $return[$k] = $v;
        }
        // 再比较第二个数组
        foreach ($array2 as $k => $v) {
            if (!isset($return[$k])) {
                // 不存在就添加
                $return[$k] = $v;
            } else {
                // 存在就合并
                $return[$k] = $return[$k] + $v;
            }
        }
        // 最终返回
        return $return;
    }


    /**
     * 把两个二维数组按照内部相同的键名进行合并
     * @param array $BigArray 大数组，大结果，这个大而全
     * @param array $SmallArray 小数组，小结果
     * @param string $fieldname 分组字段
     * @return array 返回数组
     */
    public function getTwoArrayMergeByOneField(array $BigArray, array $SmallArray, $fieldname)
    {
        // 逻辑
        // 首先去掉默认的key值，全部初始化
        $SmallArrayKeys = $this->getMultiArrayKeys($SmallArray);

        // 求出两个数组之间的差集
        $diff = $this->getMultiArrayDiff($BigArray, $SmallArray, $fieldname);

        // 定义一个初始变量来保存差集的数据，这个是要批量复制的
        $temp = [];
        foreach ($SmallArrayKeys as $key) {
            if ($key !== $fieldname) {
                $temp[$key] = '';
            }
        }
        // 把差集给第二个数组补齐
        foreach ($diff as $id) {
            $temp[$fieldname] = $id;
            $SmallArray[$id] = $temp;
        }

        // 开始合并数组
        foreach ($BigArray as $k => $v) {
            foreach ($SmallArray as $key => $value) {
                if ($value[$fieldname] == $v[$fieldname]) {
                    $BigArray[$k] = $v + $value;
                }
            }
        }

        // 最终返回
        return $BigArray;
    }


    /**
     * 获取一个二维数组的所有键名
     * @param array $array
     * @return array
     */
    public function getMultiArrayKeys(array $array)
    {
        // 逻辑
        $temp = array_values($array);
        if (count($temp) > 0) {
            return array_keys($temp[0]);
        } else {
            return [];
        }
    }

    /**
     * 根据某个字段取出二个二维数组的差集
     * @param array $firstArray 起始数组
     * @param array $secondArray 第二个数组
     * @param string $fieldname 字段名
     * @return array 返回数组
     */
    public function getMultiArrayDiff(array $firstArray, array $secondArray, $fieldname)
    {
        // 逻辑
        // 首先取出$firstArray的$fieldname列表
        $firstArrayFields = array_values(array_column($firstArray, $fieldname));
        $secondArrayFields = array_values(array_column($secondArray, $fieldname));
        return array_values(array_unique(array_diff($firstArrayFields, $secondArrayFields)));
    }

    /**
     * 获取销售表和库存表统计数
     * @param array $return 汇总数组
     * @return array 返回数组
     */
    public function getTotalSaleAndStockNumbers(array $return)
    {
        // 逻辑
        foreach ($return as $k => $v) {
            // 入库量
            if (!isset($v['number'])) {
                $return[$k]['number'] = 0;
                // 库销比为1
                $return[$k]['rate'] = 1;
            }
            // 销售量
            if (!isset($v['sellnumber'])) {
                $return[$k]['sellnumber'] = 0;
                // 销售金额为0
                $return[$k]['sum_realprice'] = 0;
                // 库销比为0
                $return[$k]['rate'] = 0;
            }
            // 剩下的则正常补充库销比
            if ($return[$k]['number'] > 0) {
                $return[$k]['rate'] = round($return[$k]['sellnumber'] / $return[$k]['number'], 2);
            }
        }
        // 返回
        return $return;
    }

    /**
     * 货币自动转换
     * @param $currencyid
     * @param $currencynumber
     * @return false|string
     */
    public function getChargedByEUR($currencyid, $currencynumber)
    {
        // 逻辑
        // 先取出欧元
        if ($id = self::getEurInstance()) {
            // 再去tb_exchange_rate找对应的货币转换比例，如果找得到
            // 如果传入的货币是欧元，那么就直接返回
            if ($currencyid == $id) {
                return $currencynumber;
            } else {
                // 如果不是欧元，再去找欧元/当前货币
                if ($result = TbExchangeRate::findFirst("currency_from=$id AND currency_to=$currencyid AND status=0")) {
                    return round($currencynumber / $result->rate, 2);
                } else if ($result = TbExchangeRate::findFirst("currency_from=$currencyid AND currency_to=$id AND status=0")) {
                    return round($result->rate * $currencynumber, 2);
                } else {
                    // 如果都没找到，就赋值为0
                    return 0;
                }
            }
        } else {
            // 如果不存在就定义为0
            return 0;
        }
    }

    /**
     * 查出收款信息列表
     * @return mixed
     */
    public function getSaleReceives()
    {
        // 逻辑
        // 使用构造器进行查询
        $builder = $this->modelsManager->createBuilder();
        // 字段列表
        $builder->from([TbSalesReceive::class])
            ->columns("
                salesid,
                currency,
                amount,
                companyid,
                maketime as receive_maketime,
                memo as receive_memo
            ");
        $builder->where("companyid = $this->currentCompany");
        // 获取查询对象
        $query = $builder->getQuery();
        // 查出结果
        $return = $query->execute()->toArray();
        // 开始按照欧元作为统一货币进行汇总
        foreach ($return as $k => $v) {
            // 货币汇总
            $return[$k]['receive_amount'] = $this->getChargedByEUR($v['currency'], $v['amount']);
            // 回款时间-如果是null就填空值
            $return[$k]['receive_maketime'] = !empty($return[$k]['receive_maketime']) ?: '';
            // 如果receive_amount不为0或者空，那么就说明已经回款了
            $return[$k]['receive_is_back'] = empty($return[$k]['receive_amount']) ? '否' : '是';
        }
        // 开始汇总
        $return_array = $this->getGroupArray($return, 'salesid', ['salesid', 'receive_amount', 'receive_memo', 'receive_maketime', 'receive_is_back'], ['receive_amount'], ['receive_memo']);
        // 返回
        return $return_array;
    }


    /**
     * 销售统计表导出excel
     * @throws \PHPExcel_Exception
     */
    public function salesExcelExportAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 转成数组
            $datas = json_decode($this->request->get('datas'), true);

            // 去掉details
            foreach ($datas['items'] as $k => $v) {
                unset($datas['items'][$k]['details']);
            }
            // 把total数组追加到列表末尾
            $datas['items'][] = [
                'id' => '合计',
                'name' => '',
                'sum_number' => $datas['total']['total_number'],
                'sum_realprice' => $datas['total']['total_realprice'],
                'rate_number' => '',
                'rate_price' => '',
            ];
            // 导出
            Util::excelExport(['主键ID', '名称', '总数量', '总金额', '件数占', '金额占'], $datas['items'], '导出统计表');
        }
    }

    /**
     * 销售统计表详情导出excel
     * @throws \PHPExcel_Exception
     */
    public function salesdetailsExcelExportAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 转成数组
            $datas = json_decode($this->request->get('datas-details'), true);

            // 去掉不需要的字段
            $deleteFields = ['salesid', 'memberid', 'companyid', 'salesstaff', 'makestaff', 'warehouseid', 'saleportid', 'productstockid', 'goodsid', 'productid', 'sizecontentid', 'genderid', 'brandid', 'brandgroupid', 'ageseasonid', 'departmentid', 'series'];
            foreach ($datas as $k => $v) {
                foreach ($deleteFields as $deleteField) {
                    unset($datas[$k][$deleteField]);
                }
            }

            // 导出
            Util::excelExport([
                '会员',
                '销售人',
                '制单人',
                '折扣',
                '销售端口',
                '销售单状态',
                '制单日期',
                '销售单号',
                '对账单号',
                '快递单号',
                '数量',
                '尺码',
                '商品名称',
                '国际码',
                '实付金额',
                '品牌名称',
                '品类名称',
                '商品图片',
                '单价',
                '折扣后单价',
                '部门',
                '回款金额',
                '回款备注',
                '回款日期',
                '是否回款',
                '年代季节',
                '系列',
            ],
                $datas,
                '导出统计详情表'
            );
        }
    }

    /**
     * 查询品牌列表
     * @return false|string
     */
    public function brandidlistAction()
    {
        // 逻辑
        $name = $this->getlangfield('name');
        // 转换成name字段显示
        $datas = TbBrand::find([
            'columns' => "id, $name as name",
        ]);
        // 返回数据
        return $this->success($datas->toArray());
    }

    /**
     * 查询销售端口列表
     * @return false|string
     */
    public function saleportidlistAction()
    {
        // 逻辑
        // 转换成name字段显示
        $datas = TbSaleport::find([
            'columns' => "id, name",
        ]);
        // 返回数据
        return $this->success($datas->toArray());
    }

    /**
     * 查询品类列表
     * @return false|string
     */
    public function brandgroupidlistAction()
    {
        // 逻辑
        // 转换成name字段显示
        $name = $this->getlangfield('name');
        // 转换成name字段显示
        $datas = TbBrandgroup::find([
            'columns' => "id, $name as name",
            'order' => 'displayindex desc',
        ]);
        // 返回数据
        return $this->success($datas->toArray());
    }

    /**
     * 查询部门列表
     * @return false|string
     */
    public function departmentidlistAction()
    {
        // 逻辑
        // 转换成name字段显示
        $datas = TbDepartment::find([
            'columns' => "id, name",
        ]);
        // 返回数据
        return $this->success($datas->toArray());
    }

    /**
     * 查询年代季节
     * @return false|string
     */
    public function ageseasonidlistAction()
    {
        // 逻辑
        // 转换成name字段显示
        $datas = TbAgeseason::find([
            'columns' => "id, concat(sessionmark, name) as name",
        ]);
        // 返回数据
        return $this->success($datas->toArray());
    }

    /**
     * 查询会员
     * @return false|string
     */
    public function memberidlistAction()
    {
        // 逻辑
        // 转换成name字段显示
        $datas = TbMember::find([
            'columns' => "id, name",
        ]);
        // 返回数据
        return $this->success($datas->toArray());
    }

    /**
     * 查询仓库
     * @return false|string
     */
    public function warehouseidlistAction()
    {
        // 逻辑
        // 转换成name字段显示
        $datas = TbWarehouse::find([
            "condition" => "id = " . $this->currentCompany,
            'columns' => "id, name",
        ]);
        // 返回数据
        return $this->success($datas->toArray());
    }

}


