<?php

namespace Asa\Erp;

use Phalcon\Di;
use Phalcon\Mvc\Model;

/**
 * 库存表
 * Class TbProductstock
 * @package Asa\Erp
 */
class TbProductstock extends BaseCompanyModel
{
    const SALES                     = 1; //销售
    const REQUISITION_IN            = 2; //调拨入库
    const REQUISITION_OUT           = 3; //调拨出库
    const WAREHOSING                = 4; //入库
    const DEFECTIVE                 = 5; //残次品入库
    const REQUISITION_PRE_IN        = 6; //在途，入库
    const REQUISITION_PRE_IN_CANCEL = 7; //
    const REQUISITION_IN_EXECUTE    = 8;
    const REQUISITION               = 9;

    //库存变动的列表
    private static $changed_list = [];

    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock');

        // 库存-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product',
            ]
        );

        // 库存-尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            '\Asa\Erp\TbSizecontent',
            'id',
            [
                'alias' => 'sizecontent',
            ]
        );

        // 库存-仓库表，一对多反向
        $this->belongsTo(
            'warehouseid',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'warehouse',
            ]
        );

        $this->belongsTo(
            'goodsid',
            '\Asa\Erp\TbGoods',
            'id',
            [
                'alias' => 'goods',
            ]
        );
    }

    private static function addToChangeList($productid)
    {
        self::$changed_list[$productid] = 1;
    }

    /**
     * 发送库存变动
     */
    public static function sendStockChange()
    {
        foreach (self::$changed_list as $productid => $value) {
            // 循环发送，精确到颗粒 $productid
            Util::sendStockChange($productid);
        }

        self::$changed_list = [];
    }

    public function addProductstockLog($old_number, $number, $change_type, $relationid)
    {
        $log = new TbProductstockLog();
        $log->warehouseid = $this->warehouseid;
        $log->productstockid = $this->id;
        $log->number_before = $old_number;
        $log->number_after = $number;
        $log->change_type = $change_type;
        $log->change_time = date("Y-m-d H:i:s");
        $log->relationid = $relationid;
        $log->companyid = $this->companyid;
        $log->change_stuff = $this->getDI()->get('currentUser');
        return $log->create();
    }

    /**
     * 预入库，调拨单出库的时候调用，涉及到库存的变动
     *
     * @param int $number
     * @param string $change_type
     * @param int $relationid
     * @return TbProductstock|bool
     */
    function preAddStock($number, $change_type, $relationid)
    {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        $this->number = $this->number + $number;
        $this->shipping_number = $this->shipping_number + $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if ($this->update()) {
            //更新库存成功，记录操作日志
            if ($this->addProductstockLog($old_number, $this->number, $change_type, $relationid) === false) {
                $db->rollback();
                return false;
            }
        } else {
            $db->rollback();
            return false;
        }
        $db->commit();

        self::addToChangeList($this->productid);
        return $this;
    }

    /**
     * 预出库，锁定库存，涉及到库存的变动
     *
     * @param int $number
     * @param string $change_type
     * @param int $relationid
     * @return TbProductstock
     * @throws \Exception
     */
    function preReduceStock($number, $change_type, $relationid)
    {
        $db = $this->getDI()->get('db');

        $db->begin();
        $this->reserve_number = $this->reserve_number + $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if ($this->update()) {
            //更新库存成功，记录操作日志
            if ($this->addProductstockLog($this->number, $this->number, $change_type, $relationid) === false) {
                $db->rollback();
                throw new \Exception("/11090201/库存日志添加失败。/");
            }
        } else {
            $db->rollback();
            throw new \Exception("/11090202/锁定库存失败。/");
        }
        $db->commit();

        self::addToChangeList($this->productid);
        return $this;
    }

    /**
     * 预入库库存转入库库存，涉及到库存的变动
     *
     * @param int $number
     * @param string $change_type
     * @param int $relationid
     * @return TbProductstock|bool
     */
    function preAddStockExecute($number, $change_type, $relationid)
    {
        $db = $this->getDI()->get('db');

        $db->begin();
        $this->shipping_number = $this->shipping_number - $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if ($this->update()) {
            //更新库存成功，记录操作日志
            if ($this->addProductstockLog($this->number, $this->number, $change_type, $relationid) === false) {
                $db->rollback();
                return false;
            }
        } else {
            $db->rollback();
            return false;
        }
        $db->commit();

        self::addToChangeList($this->productid);
        return $this;
    }

    /**
     * 预出库库存出库，涉及到库存的变动
     *
     * @param int $number
     * @param string $change_type
     * @param int $relationid
     * @return TbProductstock
     * @throws \Exception
     */
    function preReduceStockExecute($number, $change_type, $relationid)
    {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        if ($number <= $this->reserve_number && $this->number >= $this->reserve_number) {
            $this->number = $this->number - $number;
            $this->reserve_number = $this->reserve_number - $number;
            if ($change_type === self::SALES) {
                $this->sales_number = $this->sales_number + $number;
            }

            $this->change_time = date("Y-m-d H:i:s");
            $this->change_stuff = $this->getDI()->get('currentUser');
            if ($this->update()) {
                //更新库存成功，记录操作日志
                if ($this->addProductstockLog($old_number, $this->number, $change_type, $relationid) === false) {
                    $db->rollback();
                    throw new \Exception("/11090301/库存日志添加失败。/");
                }
            } else {
                $db->rollback();
                throw new \Exception("/11090302/锁定库存转出库失败/");
            }
        } else {
            throw new \Exception("/11090303/库存不足{$number},{$this->number},{$this->reserve_number}/");
        }

        $db->commit();
        self::addToChangeList($this->productid);
        return $this;
    }

    /**
     * 预入库库存取消，涉及到库存的变动
     *
     * @param int $number
     * @param string $change_type
     * @param int $relationid
     * @return TbProductstock|bool
     */
    function preAddStockCancel($number, $change_type, $relationid)
    {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        $this->number = $this->number - $number;
        $this->shipping_number = $this->shipping_number - $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if ($this->update()) {
            // 更新库存成功，记录操作日志
            if ($this->addProductstockLog($old_number, $this->number, $change_type, $relationid) === false) {
                $db->rollback();
                return false;
            }
        } else {
            $db->rollback();
            return false;
        }
        $db->commit();
        self::addToChangeList($this->productid);
        return $this;
    }

    /**
     * 预出库库存取消，涉及到库存的变动
     *
     * @param int $number
     * @param string $change_type
     * @param int $relationid
     * @return TbProductstock
     * @throws \Exception
     */
    function preReduceStockCancel($number, $change_type, $relationid)
    {
        $db = $this->getDI()->get('db');

        $db->begin();
        $this->reserve_number = $this->reserve_number - $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if ($this->update()) {
            //更新库存成功，记录操作日志
            if ($this->addProductstockLog($this->number, $this->number, $change_type, $relationid) === false) {
                $db->rollback();
                throw new \Exception("/11090101/库存日志添加失败。/");
            }
        } else {
            $db->rollback();
            throw new \Exception("/11090102/取消库存锁定失败。/");
        }
        $db->commit();
        self::addToChangeList($this->productid);
        return $this;
    }

    /**
     * 增加库存，涉及到库存的变动
     *
     * @param $number
     * @param $change_type
     * @param $relationid
     * @return TbProductstock|bool
     */
    function addStock($number, $change_type, $relationid)
    {
        if ($number > 0) {
            return $this->changeStock($number, $change_type, $relationid);
        } else {
            return false;
        }
    }

    /**
     * 减少库存，涉及到库存的变动
     *
     * @param $number
     * @param $change_type
     * @param $relationid
     * @return TbProductstock|bool
     * @throws \Exception
     */
    function reduceStock($number, $change_type, $relationid)
    {
        if ($number > 0 && $number <= $this->number - $this->shipping_number) {
            return $this->changeStock(-1 * abs($number), $change_type, $relationid);
        } else {
            throw new \Exception("/11090501/库存不足/");
        }
    }

    /**
     * 更改库存
     * 值的注意的是，库存的数量都是直接从 number 字段开始运算，可见 number 就是保存的可以操作的数量
     *
     * @param int $number
     * @param string $change_type
     * @param int $relationid
     * @return TbProductstock|bool
     */
    private function changeStock($number, $change_type, $relationid)
    {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        if ($change_type === self::SALES && $number < 0) {
            $this->sales_number = $this->sales_number - $number;
        }
        $this->number = $this->number + $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if ($this->update()) {
            //更新库存成功，记录操作日志
            $log = new TbProductstockLog();
            $log->warehouseid = $this->warehouseid;
            $log->productstockid = $this->id;
            $log->number_before = $old_number;
            $log->number_after = $this->number;
            $log->change_type = $change_type;
            $log->change_time = date("Y-m-d H:i:s");
            $log->relationid = $relationid;
            $log->companyid = $this->companyid;
            $log->change_stuff = $this->getDI()->get('currentUser');
            if ($log->create() === false) {
                $db->rollback();
                return false;
            }
        } else {
            $db->rollback();
            return false;
        }
        $db->commit();
        self::addToChangeList($this->productid);
        return $this;
    }

    /**
     * 初始化库存
     * @param $stock_info
     * @return TbProductstock [type] [description]
     * @throws Exception
     */
    public static function initStock($stock_info)
    {
        $di = Di::getDefault();
        $db = $di->get('db');
        $userid = $di->get('currentUser');;
        $companyid = $di->get('currentCompany');

        $db->begin();

        $column = ["goodsid", "productid", "warehouseid", "sizecontentid", "property", "defective_level"];
        $productStock = new TbProductstock();
        $productStock->warehouseid = $stock_info['warehouseid'];
        if (isset($stock_info['goods'])) {
            $goods = $stock_info['goods'];
            $productStock->goodsid = $goods->id;
            $productStock->productid = $goods->productid;
            $productStock->sizecontentid = $goods->sizecontentid;
            $productStock->property = $goods->property;
            $productStock->defective_level = $goods->defective_level;
        } else {
            $productStock->goodsid = $stock_info['goodsid'];
            $productStock->productid = $stock_info['productid'];
            $productStock->sizecontentid = $stock_info['sizecontentid'];
            $productStock->property = $stock_info['property'];
            $productStock->defective_level = $stock_info['defective_level'];
        }
        $productStock->companyid = $companyid;
        $productStock->create_stuff = $userid;
        $productStock->create_time = date("Y-m-d H:i:s");
        $productStock->change_stuff = $userid;
        $productStock->change_time = $productStock->create_time;
        $productStock->number = 0;
        $productStock->reserve_number = 0;
        $productStock->shipping_number = 0;
        if ($productStock->create() == false) {
            $db->rollback();
            $productStock->debug();
            throw new Exception("/1001/不能创建初始库存/");
        }

        $db->commit();
        return $productStock;
    }

    function getAvailableNumber()
    {
        return $this->number - max($this->shipping_number, $this->reserve_number);
    }

    /**
     * 获取库存
     *
     * @param $productid
     * @param $sizecontentid
     * @param $warehouseid
     * @param int $property
     * @param int $defective_level
     * @return TbProductstock|Model
     * @throws Exception
     */
    public static function getProductStock($productid, $sizecontentid, $warehouseid, $property = 1, $defective_level = 1)
    {
        $di = \Phalcon\DI::getDefault();
        $companyid = $di->get("currentCompany");
        if ($companyid <= 0) {
            throw new \Exception("/11090401/数据错误。/");
        }

        $goods = TbGoods::findFirst(
            sprintf(
                "companyid=%d and productid=%d and sizecontentid=%d and defective_level=%d and property=%d",
                $companyid,
                $productid,
                $sizecontentid,
                $defective_level,
                $property
            )
        );

        if ($goods == false) {
            //创建一个新的
            $goods = new TbGoods();
            $goods->companyid = $companyid;
            $goods->productid = $productid;
            $goods->sizecontentid = $sizecontentid;
            $goods->property = $property;
            $goods->defective_level = $defective_level;
            $goods->change_time = date("Y-m-d H:i:s");
            $goods->change_staff = $di->get("currentUser");
            $goods->price = 0;
            if ($goods->create() === false) {
                throw new \Exception("/11090402/创建商品条目失败/");
            }
        }

        if ($warehouseid > 0) {
            $productstock = TbProductstock::findFirst(
                sprintf("companyid=%d and warehouseid=%d and goodsid=%d", $companyid, $warehouseid, $goods->id)
            );

            if ($productstock == false) {
                //创建库存记录
                $productstock = TbProductstock::initStock([
                    "goods"       => $goods,
                    "warehouseid" => $warehouseid,
                ]);
            }

            return $productstock;
        } else {
            throw new \Exception("/11090403/数据错误，仓库不能为空。/");
        }
    }
}
