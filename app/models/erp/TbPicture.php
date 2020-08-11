<?php

namespace Asa\Erp;

/**
 * 图片表
 */
class TbPicture extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $filename;

    /**
     *
     * @var integer
     */
    public $productid;

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
