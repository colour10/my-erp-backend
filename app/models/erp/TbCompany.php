<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

/**
 * 公司表
 */
class TbCompany extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_company');

        // 公司-国家，一对多反向
        $this->belongsTo(
            'countryid',
            '\Asa\Erp\ZlCountry',
            'id',
            [
                'alias' => 'country',
            ]
        );
    }
    
    function getLanguageColumns() {
        return array("name");
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();
        
        $name = $this->getColumnName("name");        
        // name-公司名称不能为空或者重复
        $validator->add($name, new PresenceOf([
            'message' => 'The name is required',
            'cancelOnFail' => true,
        ]));
        $validator->add($name, new Uniqueness([
            'message' => 'The name field must be unique',
            'cancelOnFail' => true,
        ]));
        // countryid-所属国家ID
        $validator->add('countryid', new Regex(
            [
                "message" => "The countryid is invalid",
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // relateid-关联ID
        $validator->add('relateid', new Regex(
            [
                "message" => "The relateid is invalid",
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        
        // 过滤
        $validator->setFilters($name, 'trim');

        return $this->validate($validator);
    }
}
