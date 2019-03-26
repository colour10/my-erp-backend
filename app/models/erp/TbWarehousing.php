<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 入库单主表
 */
class TbWarehousing extends BaseCommonModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehousing');

        $this->hasOne(
            'confirmorderid',
            '\Asa\Erp\DdConfirmorder',
            'id',
            [
                'alias' => 'confirmorder'
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbWarehousingdetails",
            "warehousingid",
            [
                'alias' => 'warehousingdetails'
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

    /**
     * 增加入库单明细并修改库存
     * @param [type] $data [description]
     */
    function addDetail($data) {
        $detail = new TbWarehousingdetails();
        if ($detail->create($data)===false) {
            return false;
        }

        //修改库存
        $productStock = TbProductstock::findFirst(
            sprintf("companyid=%d and warehouseid=%d and productid=%d and sizecontentid=%d", $this->companyid, $this->warehouseid, $detail->productid, $detail->sizecontentid)
        );

        if($productStock!=false) {
            //这里可以加一个库存变动明细
            
            $productStock->number += $detail->number;
            if($productStock->save()==false) {
                return false;
            }
        }
        else {
            $productStock = new TbProductstock();
            $productStock->companyid = $this->companyid;
            $productStock->warehouseid = $this->warehouseid;
            $productStock->productid = $detail->productid;
            $productStock->sizecontentid = $detail->sizecontentid;
            $productStock->number = $detail->number;
            $productStock->storagetime = date("Y-m-d H:i:s");
            $productStock->storagestaff = $this->makestaff;
            if($productStock->create()==false) {
                return false;
            }
        }

        return true;
    }
}
