<?php

namespace Asa\Erp;

/**
 * 权限表
 *
 * Class TbPermission
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $pid 所属权限id，默认0为顶级权限
 * @property string $name 权限名称
 * @property string|null $memo_cn 中文描述
 * @property string|null $memo_en 英文描述
 * @property string|null $memo_hk 粤语描述
 * @property string|null $memo_fr 法语描述
 * @property string|null $memo_it 意大利语描述
 * @property string|null $memo_sp 西班牙语描述
 * @property string|null $memo_de 德语描述
 * @property bool $is_only_superadmin 是否为专属超级管理员权限，0-不是 1-是
 * @property int|null $display_index 排序
 */
class TbPermission extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission');
    }
}
