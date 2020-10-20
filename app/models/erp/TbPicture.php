<?php

namespace Asa\Erp;

/**
 * 图片表
 *
 * Class TbPicture
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name 名称
 * @property string|null $filename 文件路径800*800
 * @property string|null $filename_40 文件路径40*40
 * @property string|null $filename_150 文件路径150*150
 * @property int|null $productid 商品id
 */
class TbPicture extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_picture');
    }

    /**
     * 验证规则
     *
     * @return array
     */
    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'filename'  => [$factory->presenceOf('wenjianming')],
            'productid' => [$factory->tableid('shangpin', false)],
        ];
    }
}
