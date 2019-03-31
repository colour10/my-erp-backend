<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Email;

/**
 * 会员相关，会员表
 */
class TbMember extends BaseCompanyModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_member');
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // name-会员名称不能为空
        $validator->add('name', new PresenceOf([
            'message' => 'The name is required',
            'cancelOnFail' => true,
        ]));
        // e_mail-邮箱
        $validator->add('email', new Email([
            'message' => 'The email is invalid',
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // zipcode-邮编
        $validator->add('zipcode', new Regex(
            [
                "message" => "The zipcode is invalid",
                "pattern" => "/^\d+$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // qq-qq号码
        $validator->add('qq', new Regex(
            [
                "message" => "The qq is invalid",
                "pattern" => "/^[1-9][0-9]{4,9}$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // totalscore-历史积分
        $validator->add('totalscore', new Regex(
            [
                "message" => "The totalscore is invalid",
                "pattern" => "/^[0-9]+([.]{1}[0-9]+){0,1}$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // score-显存积分
        $validator->add('score', new Regex(
            [
                "message" => "The score is invalid",
                "pattern" => "/^[0-9]+([.]{1}[0-9]+){0,1}$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // memberlevelid-会员等级
        $validator->add('memberlevelid', new Regex(
            [
                "message" => "The memberlevelid is invalid",
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // membertype-会员类型 0-个人会员 1-公司会员
        $validator->add('membertype', new Regex(
            [
                "message" => "The membertype is invalid",
                "pattern" => "/^(0|1)$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // creatorid-建立人
        $validator->add('creatorid', new Regex(
            [
                "message" => "The creatorid is invalid",
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // sourceid-关联用户id
        $validator->add('sourceid', new Regex(
            [
                "message" => "The sourceid is invalid",
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // invitesum-推荐账户余额，可以输入整数或小数
        $validator->add('invitesum', new Regex(
            [
                "message" => "The invitesum is invalid",
                "pattern" => "/^[0-9]+([.]{1}[0-9]+){0,1}$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // invitetotal-推荐账户余额，可以输入整数或小数
        $validator->add('invitetotal', new Regex(
            [
                "message" => "The invitetotal is invalid",
                "pattern" => "/^[0-9]+([.]{1}[0-9]+){0,1}$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // 过滤
        $validator->setFilters('name', 'trim');

        return $this->validate($validator);
    }
}
