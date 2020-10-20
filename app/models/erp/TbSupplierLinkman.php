<?php

namespace Asa\Erp;

/**
 * 供应商，联系人信息
 *
 * Class TbSupplierLinkman
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $supplierid 供货商id
 * @property string|null $name 姓名
 * @property string|null $phone 座机号
 * @property string|null $email 邮箱
 * @property bool|null $gender 性别
 * @property string|null $duty 职务
 * @property string|null $fax 传真
 * @property string|null $department 部门
 * @property string|null $address 地址
 * @property string|null $zipcode 邮编
 * @property string|null $mobile 手机号
 */
class TbSupplierLinkman extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_linkman');
    }
}
