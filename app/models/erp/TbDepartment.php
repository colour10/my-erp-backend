<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Email;

/**
 * 部门表
 */
class TbDepartment extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_department');

        // 部门-公司表，一对多反向
        $this->belongsTo(
            'companyid',
            '\Asa\Erp\TbCompany',
            'id',
            [
                'alias' => 'company',
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

        // name-部门名不能为空
        $validator->add('name', new PresenceOf([
            'message' => 'The name is required',
            'cancelOnFail' => true,
        ]));
        // companyid-公司ID
        $validator->add('companyid', new Regex([
            'message' => 'The companyid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            'cancelOnFail' => true,
        ]));
        // priceid-销售价格id
        $validator->add('priceid', new Regex([
            'message' => 'The priceid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // spotid-销售端口id
        $validator->add('spotid', new Regex([
            'message' => 'The spotid is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // up_dp_id-上级部门id
        $validator->add('up_dp_id', new Regex([
            'message' => 'The up_dp_id is invalid',
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // 过滤
        $validator->setFilters('name', 'trim');

        return $this->validate($validator);
    }
}
