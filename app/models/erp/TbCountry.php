<?php

namespace Asa\Erp;

/**
 * 基础资料，国家及地区信息表
 *
 * @property int $id 主键id
 * @property string $code 编码
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $localcurrency 当地货币id
 * @property string|null $code_short 短编码
 * @property string|null $area_code 国家区号
 */
class TbCountry extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_country');
    }
}
