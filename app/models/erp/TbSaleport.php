<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 销售端口表
 */
class TbSaleport extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_saleport');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbSaleportWarehouse",
            "saleportid",
            [
                'alias' => 'saleportWarehouses'
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
     * 获取当前销售端口对应的仓库
     * @return [type] [description]
     */
    function getWarehouseList() {
        $array = Util::recordListColumn($this->saleportWarehouses, 'warehouseid');

        return TbWarehouse::findByIdString($array, 'id');
    }

    /**
     *  获取该销售端口对应的所有库存
     * @return [type] [description]
     */
    function getProductstockList() {
        $array = Util::recordListColumn($this->saleportWarehouses, 'warehouseid');

        return TbProductstock::findByIdString($array, 'warehouseid');
    }

    /**
     *  获取该销售端口对应的所有商品库存
     * @return [type] [description]
     */
    function getProductList() {
        $array = Util::recordListColumn($this->saleportWarehouses, 'warehouseid');
        if(count($array)==0) {
            return $array;
        }

        return TbProductstock::sum([
            sprintf("warehouseid in (%s) and defective_level=0", implode(',', $array)),
            "group" => 'productid',
            "column" => 'number'
        ]);
    }
}
