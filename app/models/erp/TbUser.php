<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Email;
use Phalcon\Mvc\Model\Relation;

/**
 * 用户表
 */
class TbUser extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_user');

        // 用户表-部门表，一对多反向
        $this->belongsTo(
            'departmentid',
            '\Asa\Erp\TbDepartment',
            'id',
            [
                'alias' => 'department',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The departmentid does not exist on the TbDepartment model"
                ],
            ]
        );

        // 用户表-组表，一对多反向
        $this->belongsTo(
            'groupid',
            '\Asa\Erp\TbGroup',
            'id',
            [
                'alias' => 'group',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The groupid does not exist on the TbGroup model"
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

        // login_name-用户名不能为空或者重复
        $validator->add('login_name', new PresenceOf([
            'message' => 'The login_name is required',
            'cancelOnFail' => true,
        ]));
        $validator->add('login_name', new Uniqueness([
            'message' => 'The login_name field must be unique',
            'cancelOnFail' => true,
        ]));
        // password-密码不能为空
        $validator->add('password', new PresenceOf([
            'message' => 'The password is required',
            'cancelOnFail' => true,
        ]));
        // e_mail-邮箱
        $validator->add('e_mail', new Email([
            'message' => 'The email is invalid',
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // departmentid-部门ID，用于公司内部组织结构
        $validator->add('departmentid', new Regex([
            'message' => 'The departmentid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // groupid-组ID，用于操作权限
        $validator->add('groupid', new Regex([
            'message' => 'The groupid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // companyid-公司ID
        $validator->add('companyid', new Regex([
            'message' => 'The companyid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // storeid-所属门店仓库ID
        $validator->add('storeid', new Regex([
            'message' => 'The storeid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // countryid-国家ID
        $validator->add('countryid', new Regex([
            'message' => 'The countryid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // 个人状态
        $validator->add('status', new Regex([
            'message' => 'The status is invalid',
            "pattern" => "/[0-2]+/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // 过滤
        $validator->setFilters('login_name', 'trim');

        return $this->validate($validator);
    }
}
