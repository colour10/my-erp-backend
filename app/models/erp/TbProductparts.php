<?php

namespace Asa\Erp;

/**
 * 附带配件
 *
 * Class TbProductparts
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $partscode 配件编码
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property string|null $packflag 是否限量版 0-否；1-是
 */
class TbProductparts extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productparts');
    }
}
