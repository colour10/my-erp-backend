<?php
namespace Asa\Erp;

/**
 * 基础资料，材质表
 */
class TbMaterial extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_material');
    }

    public function getRules() {
        return [
            'name_cn' => $this->getValidatorFactory()->presenceOfMultiple('mingcheng'),
            'code' => $this->getValidatorFactory()->presenceOf('caizhidaima') 
        ];
    }
}
