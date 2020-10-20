<?php

namespace Asa\Erp;

/**
 * 语言配置表
 *
 * Class TbLanguage
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $code 代号
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 */
class TbLanguage extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_language');
    }
}
