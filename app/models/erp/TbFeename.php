<?php

namespace Asa\Erp;

/**
 * 费用名称
 *
 * Class TbFeename
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $is_amortize 是否摊销
 * @property int|null $amortize_type 摊销方式：1=按数量摊销；2=按金额摊销
 * @property int|null $displayindex 排序
 */
class TbFeename extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_feename');
    }
}
