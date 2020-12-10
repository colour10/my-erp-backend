<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 公司表
 *
 * Class TbCompany
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name 中文名称
 * @property int|null $countryid 国家id
 * @property string|null $memo 备注说明
 * @property int|null $randid 随机id，防止暴露真实的companyid
 * @property int|null $saleportid 商城的销售端口
 * @property int|null $currencyid 本币
 * @property string|null $language 默认语言
 * @property string|null $address 地址
 * @property string|null $phone 电话
 * @property string|null $zipcode 邮编
 * @property string|null $fax 传真
 * @property string|null $legal
 * @property string|null $website 网址
 * @property string|null $registeredcapital 注册资本
 * @property string|null $businesslicense 营业执照
 * @property string|null $heading
 * @property int|null $hkgcost 香港供货价
 * @property int|null $eurcost 欧洲供货价
 * @property int|null $chncost 国内供货价
 * @property int|null $bdacost 保税供货价
 * @property int|null $oms_saleport OMS的销售端口
 * @property string|null $oms_warehouseids OMS的可用仓库
 * @property-read TbCountry|null $country 国家
 * @property-read TbDepartment|null $departments 部门
 * @property-read TbProduct|null $products 商品
 * @property-read TbWarehouse|null $warehouses 仓库
 * @property-read TbMember|null $members 会员
 */
class TbCompany extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_company');

        // 公司-国家，一对多反向
        $this->belongsTo(
            'countryid',
            TbCountry::class,
            'id',
            [
                'alias' => 'country',
            ]
        );

        // 公司-部门，一对多
        $this->hasMany(
            "id",
            TbDepartment::class,
            "companyid",
            [
                'alias'      => 'departments',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "#1003#",
                ],
            ]
        );

        // 公司-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "companyid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('hasmany-foreign-message', 'product'),
                ],
            ]
        );

        // 公司-销售端口，一对多反向
        $this->belongsTo(
            'saleportid',
            TbSaleport::class,
            'id',
            [
                'alias' => 'shopSaleport',
            ]
        );

        // 另外一种情况：公司-销售端口，一对多
        $this->hasMany(
            'id',
            TbSaleport::class,
            'companyid',
            [
                'alias' => 'saleports',
            ]
        );

        // 公司-仓库表，一对多
        $this->hasMany(
            "id",
            TbWarehouse::class,
            "companyid",
            [
                'alias' => 'warehouses',
            ]
        );

        // 公司-用户表，一对多
        $this->hasMany(
            "id",
            TbUser::class,
            "companyid",
            [
                'alias' => 'users',
            ]
        );

        // 公司-客户列表，一对多
        $this->hasMany(
            "id",
            TbSupplier::class,
            "companyid",
            [
                'alias' => 'suppliers',
            ]
        );

        // 公司-会员，一对多
        $this->hasMany(
            "id",
            TbMember::class,
            "companyid",
            [
                'alias' => 'members',
            ]
        );
    }
}
