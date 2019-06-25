<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;
/**
 * 品牌系列，品牌相关数据
 */
class TbSeries extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_series');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "series",
            [
                'alias' => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/系列已经使用，不能删除/"
                ],
            ]
        );
    }
}
