<?php

namespace Asa\Erp;

/**
 * 子系列，品牌相关
 *
 * Class TbSeries2
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $seriesid 系列主键ID
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property string|null $code 中文代码名称
 */
class TbSeries2 extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_series2');
    }
}
