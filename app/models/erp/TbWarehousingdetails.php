<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 入库单明细表
 */
class TbWarehousingdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehousingdetails');

        $this->belongsTo(
            'orderdetailsid',
            '\Asa\Erp\TbOrderdetails',
            'id',
            [
                'alias' => 'orderdetails'
            ]
        );

        $this->belongsTo(
            'confirmorderdetailsid',
            '\Asa\Erp\TbConfirmorderdetails',
            'id',
            [
                'alias' => 'confirmorderdetails'
            ]
        );

        $this->belongsTo(
            'warehousingid',
            '\Asa\Erp\TbWarehousing',
            'id',
            [
                'alias' => 'warehousing'
            ]
        );
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//            "age",
//            new Between(
//                [
//                    "minimum" => 18,
//                    "maximum" => 60,
//                    "message" => "年龄必须是18~60岁",
//                ]
//            )
//        );
//
//        $validator->add(
//            'name',
//            new Uniqueness(
//                [
//                    'message' => '姓名不能重复',
//                ]
//            )
//        );

        return $this->validate($validator);
    }

    public function getProductStock() {
        $orderdetails = $this->orderdetails;
        $confirmorderdetails = $this->confirmorderdetails;
        $confirmorder = $this->warehousing->confirmorder;

        $goods = TbGoods::findFirst(
            sprintf("companyid=%d and productid=%d and sizecontentid=%d and defective_level=0 and property=%d", $this->companyid, $orderdetails->productid, $orderdetails->sizecontentid, $confirmorder->property)
        );

        if($goods==false) {
            //创建一个新的
            $goods = new TbGoods();
            $goods->companyid = $this->companyid;
            $goods->productid = $orderdetails->productid;
            $goods->sizecontentid = $orderdetails->sizecontentid;
            $goods->property = $confirmorder->property;
            $goods->defective_level = 0;
            $goods->change_time = date("Y-m-d H:i:s");
            $goods->change_staff = $this->getDI()->get("currentUser");
            $goods->price = $confirmorderdetails->price; //这里需要乘以一个系数
            if($goods->create()===false) {
                throw new Exception("创建商品条目失败");
            }
        }

        $productstock = TbProductstock::findFirst(
            sprintf("companyid=%d and warehouseid=%d and goodsid=%d", $this->companyid, $confirmorder->warehouseid, $goods->id)
        );

        if($productstock==false) {
            //创建库存记录
            $productstock = TbProductstock::initStock([
                "goods" => $goods,
                "warehouseid" => $confirmorder->warehouseid
            ]);
        }
        return $productstock;        
    }

    public static function findByConformorderdetailIdString($idstring) {
        if(preg_match("#^\d+(,\d+)*$#", $idstring)) {
            return self::find(
                sprintf("confirmorderdetailsid in (%s)", $idstring)
            );
        }
        else {
            return [];
        }
    }
}
