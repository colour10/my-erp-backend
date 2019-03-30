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
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'department'),
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
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'group'),
                ],
            ]
        );

        // 用户表-组表，一对多反向
        $this->belongsTo(
            'saleportid',
            '\Asa\Erp\TbSaleport',
            'id',
            [
                'alias' => 'saleport'
            ]
        );

        // 设置当前语言
        $this->setValidateLanguage($this->getLanguage()['lang']);
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
            'message' => $this->getValidateMessage('required', 'user-loginname'),
            'cancelOnFail' => true,
        ]));
        $validator->add('login_name', new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'user-loginname'),
            'cancelOnFail' => true,
        ]));
        // password-密码不能为空
        $validator->add('password', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'password'),
            'cancelOnFail' => true,
        ]));
        // e_mail-邮箱
        $validator->add('e_mail', new Email([
            'message' => $this->getValidateMessage('invalid', 'email'),
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // departmentid-部门ID，必须填写
        $validator->add('departmentid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'departmentid'),
            'cancelOnFail' => true,
        ]));
        // departmentid-部门ID，用于公司内部组织结构
        $validator->add('departmentid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'departmentid'),
            "pattern" => "/^[1-9]\d*$/",
            'cancelOnFail' => true,
        ]));
        // groupid-组ID，必须填写
        $validator->add('groupid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'groupid'),
            'cancelOnFail' => true,
        ]));
        // groupid-组ID，用于操作权限
        $validator->add('groupid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'groupid'),
            "pattern" => "/^[1-9]\d*$/",
            'cancelOnFail' => true,
        ]));
        // companyid-公司ID
        $validator->add('companyid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'companyid'),
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // storeid-所属门店仓库ID
        $validator->add('storeid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'storeid'),
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // countryid-国家ID
        $validator->add('countryid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'countryid'),
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // 个人状态
        $validator->add('status', new Regex([
            'message' => $this->getValidateMessage('invalid', 'user-status'),
            "pattern" => "/[0-2]+/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // 过滤
        $validator->setFilters('login_name', 'trim');

        return $this->validate($validator);
    }

    /**
     * 重写多语言版本配置读取函数
     * @param languages下面语言文件字段的名称 如template模块下面的uniqueness
     * @param 待验证字段的编号，显示为当前语言的友好性提示 $name
     * @return string
     */
    public function getValidateMessage($template, $name)
    {
        // 定义变量
        // 取出当前语言版本
        $language = $this->getDI()->get('language');
        // 拼接变量
        $template_name = $language->template[$template];
        $human_name = $language->$name;
        // 返回最终的友好提示信息
        return sprintf($template_name, $human_name);
    }

    /**
     * 获得用户对指定商品，指定销售端口的价格
     * @param  [type] $goods    [description]
     * @param  string $saleport [description]
     * @return [type]           [description]
     */
    function getPrice($goods, $saleport) {
        return round($goods->price * $saleport->discount,2);
    }

    function getDefaultSaleportid() {
        if($this->saleport>0) {
            return $this->saleport;
        }
        else {
            $saleport = TbSaleportUser::findFirst(array(
                sprintf("userid=%d", $this->id),
                "order" => "id asc"
            ));

            if( $saleport!=false) {
                return  $saleport->saleportid;
            }

            return 0;
        }
    }
}
