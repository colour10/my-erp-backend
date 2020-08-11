<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，材质表
 *
 * Class TbMaterial
 * @package Asa\Erp
 */
class TbMaterial extends BaseModel
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
    public $name_cn;

    /**
     *
     * @var string
     */
    public $name_en;

    /**
     *
     * @var string
     */
    public $name_hk;

    /**
     *
     * @var string
     */
    public $name_fr;

    /**
     *
     * @var string
     */
    public $name_it;

    /**
     *
     * @var string
     */
    public $name_sp;

    /**
     *
     * @var string
     */
    public $name_de;

    /**
     *
     * @var string
     */
    public $code;

    /**
     *
     * @var string
     */
    public $materialnoteids;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_material');

        // 材质-商品材质表，一对多
        $this->hasMany(
            "id",
            TbProductMaterial::class,
            "materialid",
            [
                'alias'      => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/材质已经使用，不能删除/",
                ],
            ]
        );
    }

    /**
     * 验证规则
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'name_cn' => $this->getValidatorFactory()->presenceOfMultiple('mingcheng')
            //'code' => $this->getValidatorFactory()->presenceOf('caizhidaima')
        ];
    }

    /**
     * 获取材质对应的材质备注
     */
    public function getMaterialnotes()
    {
        if ($this->materialnoteids) {
            $rows = TbMaterialnote::find([
                sprintf("id IN (%s)", $this->materialnoteids),
            ]);

            $lang = $this->getDI()->get("session")->get("language");
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row->{'content_' . $lang};
            }

            return implode(',', $array);
        } else {
            return '';
        }
    }
}
