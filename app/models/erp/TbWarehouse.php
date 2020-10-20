<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

/**
 * 仓库表
 *
 * Class TbWarehouse
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $countryid 国家ID
 * @property string|null $city 城市名称
 * @property string|null $name 仓库名称
 * @property string|null $address 仓库地址
 * @property string|null $contact 联系人
 * @property string|null $toll
 * @property string|null $fax
 * @property string|null $mobile
 * @property string|null $othercontact
 * @property string|null $code
 * @property string|null $defaultstore
 * @property string|null $zipcode
 * @property string|null $is_real
 * @property int|null $maxstock
 * @property int|null $maxsku
 * @property int|null $companyid
 * @property-read TbWarehouseUser|null $users 用户列表
 * @property-read TbWarehouseUser|null $warehouseUser 用户列表
 * @property-read TbConfirmorder|null $confirmorder 发货单列表
 * @property-read TbProductstock|null $productstocks 库存列表
 */
class TbWarehouse extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehouse');

        // 仓库表-用户表，多对多
        $this->hasManyToMany(
            'id',
            TbWarehouseUser::class,
            'warehouseid',
            'userid',
            TbUser::class,
            'id',
            [
                'alias' => 'users',
            ]
        );

        // 仓库表-仓库用户关联表，一对多
        $this->hasMany(
            "id",
            TbWarehouseUser::class,
            "warehouseid",
            [
                'alias'      => 'warehouseUser',
                'foreignKey' => [
                    'message' => '#1003#',
                    'action'  => Relation::ACTION_RESTRICT,
                ],
            ]
        );

        // 仓库表-发货单主表，一对多
        $this->hasMany(
            "id",
            TbConfirmorder::class,
            "warehouseid",
            [
                'alias'      => 'confirmorder',
                'foreignKey' => [
                    'message' => '#1003#',
                    'action'  => Relation::ACTION_RESTRICT,
                ],
            ]
        );

        // 仓库表-库存表，一对多
        $this->hasMany(
            "id",
            TbProductstock::class,
            "warehouseid",
            [
                'alias' => 'productstocks',
            ]
        );
    }

    /**
     * 根据另外一个库存对象，查找本库的相同信息的库存对象，如果没有则创建一个数量为0的库存对象
     *
     * @param TbProductstock $productstock [description]
     * @return TbProductstock|Model [type]               [description]
     * @throws Exception
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
