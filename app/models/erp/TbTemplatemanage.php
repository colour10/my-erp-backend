<?php

namespace Asa\Erp;

/**
 * 基础资料，模板管理
 *
 * Class TbTemplatemanage
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $tempid 模版id
 * @property int|null $sortnum 排序
 */
class TbTemplatemanage extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_templatemanage');
    }
}
