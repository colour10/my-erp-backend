<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，材质表
 */
class TbMaterial extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_material');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProductMaterial",
            "materialid",
            [
                'alias' => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/材质已经使用，不能删除/"
                ],
            ]
        );
    }

    public function getRules() {
        return [
            'name_cn' => $this->getValidatorFactory()->presenceOfMultiple('mingcheng')
            //'code' => $this->getValidatorFactory()->presenceOf('caizhidaima') 
        ];
    }
}
