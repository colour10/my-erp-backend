<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 分组表
 *
 * Class TbGroup
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $group_name 名称
 * @property string|null $group_memo 备注
 * @property int|null $companyid 公司id
 * @property bool|null $is_super 是否超级管理员
 * @property-read TbPermissionGroup|null $permissionGroups 权限组
 * @property-read TbUser|null $users 用户
 */
class TbGroup extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_group');

        // 组-权限组关联，一对多
        $this->hasMany(
            "id",
            TbPermissionGroup::class,
            "groupid",
            [
                'alias'      => 'permissionGroups',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_CASCADE,
                ],
            ]
        );

        // 组-用户关联，一对多
        $this->hasMany(
            'id',
            TbUser::class,
            'groupid',
            [
                'alias'      => 'users',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/用户组使用中，不能删除/",
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
        $factory = $this->getValidatorFactory();
        return [
            'group_name' => $factory->presenceOf('zumingcheng'),
        ];
    }

    /**
     * 获取当前用户组下面的所有权限操作
     * @return false|string
     */
    public function getActionList()
    {
        $id_array = Util::recordListColumn($this->permissionGroups, "permissionid");

        return TbPermissionAction::findByIdString($id_array, "permissionid");
    }

    /**
     * 获取当前用户组下面的所有权限
     * @return false|string
     */
    public function getPermissionList()
    {
        $id_array = Util::recordListColumn($this->permissionGroups, "permissionid");

        return TbPermission::findByIdString($id_array, "id");
    }
}
