<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 分组表
 *
 * Class TbGroup
 * @package Asa\Erp
 */
class TbGroup extends BaseModel
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
    public $group_name;

    /**
     *
     * @var string
     */
    public $group_memo;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $is_super;

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
