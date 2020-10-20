<?php

namespace Asa\Erp;

/**
 * 关系单位信息，供货商表
 *
 * Class TbSupplier
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $suppliername 名称
 * @property string|null $englishname 英文名称
 * @property string|null $address 地址
 * @property string|null $phone 电话
 * @property string|null $zipcode 邮编
 * @property string|null $email 邮箱
 * @property string|null $countrycity 城市
 * @property string|null $suppliercode 编码
 * @property string|null $fax 传真
 * @property string|null $suppliertype 0-供货商 1-报关行 2-供应商 3-承运人 4-客户 5-品牌商
 * @property string|null $memo 备注
 * @property string|null $nickname 昵称
 * @property string|null $website 公司网址
 * @property null $createtime 生成时间
 * @property int|null $companyid 公司id
 * @property string|null $mobile 手机号
 * @property string|null $linkman 联系人
 * @property int|null $customtype 客户类型
 * @property string|null $englishaddress 英文地址
 */
class TbSupplier extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier');
    }
}
