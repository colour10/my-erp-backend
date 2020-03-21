<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 仓库表
 */
class TbWarehouse extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehouse');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbWarehouseUser",
            "warehouseid",
            [
                'alias'      => 'warehouseUser',
                'foreignKey' => [
                    'message' => '#1003#',
                    'action'  => Relation::ACTION_RESTRICT,
                ],
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbConfirmorder",
            "warehouseid",
            [
                'alias'      => 'confirmorder',
                'foreignKey' => [
                    'message' => '#1003#',
                    'action'  => Relation::ACTION_RESTRICT,
                ],
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProductstock",
            "warehouseid",
            [
                'alias' => 'productstocks',
            ]
        );
    }

    /**
     * 根据另外一个库存对象，查找本库的相同信息的库存对象，如果没有则创建一个数量为0的库存对象
     * @param TbProductstock $productstock [description]
     * @return [type]               [description]
     */
    function getLocalStock($productstock)
    {
        $myproductstock = TbProductstock::findFirst(
            sprintf(
                "companyid=%d and warehouseid=%d and goodsid=%d",
                $productstock->companyid,
                $this->id,
                $productstock->goodsid
            )
        );

        if ($myproductstock != false) {
            return $myproductstock;
        } else {
            $data = [
                "productid"       => $productstock->productid,
                "goodsid"         => $productstock->goodsid,
                "warehouseid"     => $this->id,
                "sizecontentid"   => $productstock->sizecontentid,
                "property"        => $productstock->property,
                "defective_level" => $productstock->defective_level,
            ];
            return TbProductstock::initStock($data);
        }
    }
}
