<?php
namespace Asa\Erp;

/**
 * 图片表
 */
class TbPicture extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_picture');
    }

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'filename' => [$factory->presenceOf('wenjianming')],
            'productid' => [$factory->tableid('shangpin', false)]
        ];
    }
}
