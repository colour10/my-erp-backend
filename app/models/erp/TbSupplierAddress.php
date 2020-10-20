<?php

namespace Asa\Erp;

/**
 * 收货人信息
 *
 * Class TbSupplierAddress
 * @package Asa\Erp
 * @property int $id
 * @property string|null $name 收货人
 * @property string|null $address 收货地址
 * @property string|null $phone 电话
 * @property int|null $supplierid
 * @property string|null $zipcode 邮编
 * @property int|null $countryid 国家
 * @property string|null $province 省份
 * @property string|null $city 城市
 */
class TbSupplierAddress extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_address');
    }
}
