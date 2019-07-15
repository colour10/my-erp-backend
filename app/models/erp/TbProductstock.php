<?php

namespace Asa\Erp;

use Phalcon\Di;

/**
 * 库存表
 * ErrorCode 1109
 */
class TbProductstock extends BaseCompanyModel
{
    const SALES = 1; //销售
    const REQUISITION_IN = 2; //调拨入库
    const REQUISITION_OUT = 3; //调拨出库
    const WAREHOSING = 4; //入库
    const DEFECTIVE = 5; //残次品入库
    const REQUISITION_PRE_IN = 6; //在途，入库
    const REQUISITION_PRE_IN_CANCEL = 7; //
    const REQUISITION_IN_EXECUTE = 8;
    const REQUISITION = 9;


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
                'alias' => 'product'
            ]
        );

        // 库存-尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            '\Asa\Erp\TbSizecontent',
            'id',
            [
                'alias' => 'sizecontent'
            ]
        );

        // 库存-仓库表，一对多反向
        $this->belongsTo(
            'warehouseid',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'warehouse'
            ]
        );

        $this->belongsTo(
            'goodsid',
            '\Asa\Erp\TbGoods',
            'id',
            [
                'alias' => 'goods'
            ]
        );
    }

    public function addProductstockLog($old_number, $number, $change_type, $relationid) {
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
     * 预入库，调拨单出库的时候调用
     */
    function preAddStock($number, $change_type, $relationid) {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        $this->number = $this->number+$number;
        $this->shipping_number = $this->shipping_number + $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if($this->update()) {
            //更新库存成功，记录操作日志
            if($this->addProductstockLog($old_number, $this->number, $change_type, $relationid)===false) {
                $db->rollback();
                return false;
            }
        }
        else {
            $db->rollback();
            return false;
        }
        $db->commit();
        return $this;
    }

    /**
     * 预出库，锁定库存
     */
    function preReduceStock($number, $change_type, $relationid) {
        $db = $this->getDI()->get('db');

        $db->begin();
        $this->reserve_number = $this->reserve_number + $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if($this->update()) {
            //更新库存成功，记录操作日志
            if($this->addProductstockLog($this->number, $this->number, $change_type, $relationid)===false) {
                $db->rollback();
                throw new \Exception("/11090201/库存日志添加失败。/");
            }
        }
        else {
            $db->rollback();
            throw new \Exception("/11090202/锁定库存失败。/");
        }
        $db->commit();
        return $this;
    }

    /**
     * 预入库库存转入库库存
     */
    function preAddStockExecute($number, $change_type, $relationid) {
        $db = $this->getDI()->get('db');

        $db->begin();
        $this->shipping_number = $this->shipping_number - $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if($this->update()) {
            //更新库存成功，记录操作日志
            if($this->addProductstockLog($this->number, $this->number, $change_type, $relationid)===false) {
                $db->rollback();
                return false;
            }
        }
        else {
            $db->rollback();
            return false;
        }
        $db->commit();
        return $this;
    }

    /**
     * 预出库库存出库
     */
    function preReduceStockExecute($number, $change_type, $relationid) {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        if($number<=$this->reserve_number && $this->number>=$this->reserve_number) {
            $this->number = $this->number - $number;
            $this->reserve_number = $this->reserve_number - $number;
            $this->change_time = date("Y-m-d H:i:s");
            $this->change_stuff = $this->getDI()->get('currentUser');
            if($this->update()) {
                //更新库存成功，记录操作日志
                if($this->addProductstockLog($old_number, $this->number, $change_type, $relationid)===false) {
                    $db->rollback();
                    throw new \Exception("/11090301/库存日志添加失败。/");
                }
            }
            else {
                $db->rollback();
                throw new \Exception("/11090302/锁定库存转出库失败/");
            }
        }
        else {
            throw new \Exception("/11090303/库存不足/");
        }

        $db->commit();
        return $this;
    }

    /**
     * 预入库库存取消
     */
    function preAddStockCancel($number, $change_type, $relationid) {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        $this->number = $this->number-$number;
        $this->shipping_number = $this->shipping_number - $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if($this->update()) {
            //更新库存成功，记录操作日志
            if($this->addProductstockLog($old_number, $this->number, $change_type, $relationid)===false) {
                $db->rollback();
                return false;
            }
        }
        else {
            $db->rollback();
            return false;
        }
        $db->commit();
        return $this;
    }

    /**
     * 预出库库存取消
     */
    function preReduceStockCancel($number, $change_type, $relationid) {
        $db = $this->getDI()->get('db');

        $db->begin();
        $this->reserve_number = $this->reserve_number - $number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if($this->update()) {
            //更新库存成功，记录操作日志
            if($this->addProductstockLog($this->number, $this->number, $change_type, $relationid)===false) {
                $db->rollback();
                throw new \Exception("/11090101/库存日志添加失败。/");
            }
        }
        else {
            $db->rollback();
            throw new \Exception("/11090102/取消库存锁定失败。/");
        }
        $db->commit();
        return $this;
    }

    function addStock($number, $change_type, $relationid) {
        if($number>0) {
            return $this->changeStock($number, $change_type, $relationid);
        }
        else {
            return false;
        }
    }

    function reduceStock($number, $change_type, $relationid) {
        if($number>0 && $number<=$this->number-$this->shipping_number) {
            return $this->changeStock(-1*abs($number), $change_type, $relationid);
        }
        else {
            return false;
        }
    }

    /**
     * 更改库存
     */
    private function changeStock($number, $change_type, $relationid) {
        $db = $this->getDI()->get('db');

        $db->begin();
        $old_number = $this->number;

        $this->number = $this->number+$number;
        $this->change_time = date("Y-m-d H:i:s");
        $this->change_stuff = $this->getDI()->get('currentUser');
        if($this->update()) {
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
            if($log->create()===false) {
                $db->rollback();
                return false;
            }
        }
        else {
            $db->rollback();
            return false;
        }
        $db->commit();
        return $this;
    }

    /**
     * 初始化库存
     * @return [type] [description]
     */
    public static function initStock($stock_info) {
        $di = Di::getDefault();
        $db = $di->get('db');
        $userid = $di->get('currentUser');;
        $companyid = $di->get('currentCompany');

        $db->begin();

        $column = ["goodsid","productid","warehouseid","sizecontentid","property","defective_level"];
        $productStock = new TbProductstock();
        $productStock->warehouseid = $stock_info['warehouseid'];
        if(isset($stock_info['goods'])) {
            $goods = $stock_info['goods'];
            $productStock->goodsid = $goods->id;
            $productStock->productid = $goods->productid;
            $productStock->sizecontentid = $goods->sizecontentid;
            $productStock->property = $goods->property;
            $productStock->defective_level = $goods->defective_level;
        }
        else {
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
        if($productStock->create()==false) {
            $db->rollback();
            $productStock->debug();
            throw new Exception("/1001/不能创建初始库存/");
        }

        $db->commit();
        return $productStock;
    }

    function getAvailableNumber() {
        return $this->number-max($this->shipping_number, $this->reserve_number);
    }
}
