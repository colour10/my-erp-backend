<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;

/**
 * 权限-组模型
 */
class TbPermissionGroup extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_group');

        // 表关联
        // 与组表关联，一对多反向
        $this->belongsTo(
            "groupid",
            "\Asa\Erp\TbGroup",
            "id",
            [
                'alias' => 'group',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The groupid does not exist on the group model"
                ],
            ]
        );

        // 与权限表关联，一对多反向
        $this->belongsTo(
            "permissionid",
            "\Asa\Erp\TbPermission",
            "id",
            [
                'alias' => 'permission',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The permissionid does not exist on the permission model"
                ],
            ]
        );

        // 与权限模型关联，一对多
        $this->hasMany(
            'permissionid',
            '\Asa\Erp\TbPermissionModule',
            'permissionid',
            [
                'alias' => 'modules',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The permissiongroup cannot be deleted because other modules are using it"
                ],
            ]
        );
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // groupid-组id不能为空
        $validator->add('groupid', new PresenceOf([
            'message' => 'The groupid is required',
            'cancelOnFail' => true,
        ]));
        // permissionid-权限id不能为空
        $validator->add('permissionid', new PresenceOf([
            'message' => 'The permissionid is required',
            'cancelOnFail' => true,
        ]));
        // companyid-公司id不能为空
        $validator->add('companyid', new PresenceOf([
            'message' => 'The permissionid is required',
            'cancelOnFail' => true,
        ]));

        return $this->validate($validator);
    }
}
