<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

/**
 * 仓库表
 * Class TbWarehouse
 * @package Asa\Erp
 */
class TbWarehouse extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $countryid;

    /**
     *
     * @var string
     */
    public $city;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $contact;

    /**
     *
     * @var string
     */
    public $toll;

    /**
     *
     * @var string
     */
    public $fax;

    /**
     *
     * @var string
     */
    public $mobile;

    /**
     *
     * @var string
     */
    public $othercontact;

    /**
     *
     * @var string
     */
    public $code;

    /**
     *
     * @var string
     */
    public $defaultstore;

    /**
     *
     * @var string
     */
    public $zipcode;

    /**
     *
     * @var string
     */
    public $is_real;

    /**
     *
     * @var integer
     */
    public $maxstock;

    /**
     *
     * @var integer
     */
    public $maxsku;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehouse');

        // 仓库表-仓库-用户关联表，一对多
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
