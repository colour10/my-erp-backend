<?php
namespace Asa\Erp;
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
