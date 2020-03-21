<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 分组表
 */
class TbGroup extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_group');

        // 组-权限组关联，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbPermissionGroup",
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
            '\Asa\Erp\TbUser',
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
