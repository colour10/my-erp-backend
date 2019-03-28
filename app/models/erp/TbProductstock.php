<?php

namespace Asa\Erp;

use Phalcon\Di;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 库存表
 */
class TbProductstock extends BaseCommonModel
{
    const SALES = 1; //销售
    const REQUISITION_IN = 2; //调拨入库
    const REQUISITION_OUT = 3; //调拨出库
    const WAREHOSING = 4; //入库
    const DEFECTIVE = 5; //残次品入库


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
            '\Asa\Erp\ZlSizecontent',
            'id',
            [
                'alias' => 'sizecontent',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'sizecontent'),
                ],
            ]
        );

        // 库存-仓库表，一对多反向
        $this->belongsTo(
            'warehouseid',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'warehouse',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'warehouse'),
                ],
            ]
        );
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // productid-商品编号不能为空
        $validator->add('productid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'productid'),
            'cancelOnFail' => true,
        ]));

        // number-商品库存数量不能为空
        $validator->add('number', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'number'),
            'cancelOnFail' => true,
        ]));

        // number-商品库存数量不能为空
        $validator->add('number', new Regex([
            'message' => $this->getValidateMessage('invalid', 'number'),
            "pattern" => "/^[0-9]+$/",
            'cancelOnFail' => true,
        ]));

        // sizecontentid-尺码编号不能为空
        $validator->add('sizecontentid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontentid'),
            'cancelOnFail' => true,
        ]));

        // warehouseid-仓库编号不能为空
        $validator->add('warehouseid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'warehouseid'),
            'cancelOnFail' => true,
        ]));

        // 商品id，尺码id，仓库id建立唯一性索引
        $validator->add(['productid', 'sizecontentid', 'warehouseid'], new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'productstock-productid-sizecontentid-warehouseid'),
            'cancelOnFail' => true,
        ]));

        return $this->validate($validator);
    }

    /**
     * 重写多语言版本配置读取函数
     * @param languages下面语言文件字段的名称 如template模块下面的uniqueness
     * @param 待验证字段的编号，显示为当前语言的友好性提示 $name
     * @return string
     */
    public function getValidateMessage($template, $name)
    {
        // 定义变量
        // 取出当前语言版本
        $language = $this->getDI()->get('language');
        // 拼接变量
        $template_name = $language->template[$template];
        $human_name = $language->$name;
        // 返回最终的友好提示信息
        return sprintf($template_name, $human_name);
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
        if($number>0) {
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

        $column = ["productid","warehouseid","sizecontentid","property"];
        $productStock = new TbProductstock();

        //残次品标志
        if(isset($stock_info['is_defective'])) {
            $is_defective = (int) $stock_info['is_defective'];
            $productStock->is_defective = ($is_defective==1) ? 1:0;
        }
        else {
            $productStock->is_defective = 0;
        }

        foreach($column as $name) {
            $value = (int)$stock_info[$name];
            if($value>0) {
                $productStock->$name = $value;
            }
            else {
                $db->rollback("{$name} 非法。");
                return false;
            }
        }
        $productStock->companyid = $companyid;
        $productStock->create_stuff = $userid;
        $productStock->create_time = date("Y-m-d H:i:s");
        $productStock->change_stuff = $userid;
        $productStock->change_time = $productStock->create_time;
        $productStock->number = 0;
        if($productStock->create()==false) {
            $db->rollback();
            return false;
        }

        $db->commit();
        return $productStock;
    }
}
