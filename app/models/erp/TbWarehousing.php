<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 入库单主表
 */
class TbWarehousing extends BaseCompanyModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehousing');

        $this->belongsTo(
            'confirmorderid',
            '\Asa\Erp\TbConfirmorder',
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
                'alias' => 'warehousingdetails',
                'foreignKey' => array(
                    'message' => '#1003#',
                    'action' => Relation::ACTION_RESTRICT
                )   
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
        $productStock = $detail->getProductStock();
        return $productStock->addStock($detail->number, TbProductstock::WAREHOSING, $detail->id);
    }
}
