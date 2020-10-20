<?php

namespace Asa\Erp;

/**
 * 会员相关，会员表
 */

/**
 * 会员表
 *
 * Class TbMember
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $login_name 登录名
 * @property string|null $name 会员名
 * @property string|null $password 密码
 * @property string|null $code 编码
 * @property bool|null $gender 0-female 1-male
 * @property string|null $birthday 生日
 * @property string|null $phoneno 电话
 * @property string|null $email 邮箱
 * @property string|null $address 地址
 * @property string|null $zipcode 邮编
 * @property string|null $qq QQ
 * @property string|null $wechat 微信
 * @property string|null $microblog 微博
 * @property int|null $totalscore 历史积分
 * @property int|null $score 现存积分
 * @property string|null $membercard 会员卡号
 * @property int|null $memberlevelid 会员等级
 * @property string|null $membertype 0-个人会员 1-公司会员
 * @property int|null $membercardid 会员卡号id
 * @property int|null $creatorid 建立人
 * @property int|null $sourceid 客户来源
 * @property string|null $idno 身份证号
 * @property string|null $taxno 税号
 * @property string|null $contactor 联系人
 * @property string|null $asawebno 爱莎商城注册编码
 * @property string|null $openid 微信OPENID
 * @property int|null $invitesum 推荐账户余额
 * @property int|null $invitetotal 推荐账户总额
 * @property int|null $invoteuser 推荐人
 * @property int|null $companyid 公司ID
 * @property bool|null $is_lockstock 是否锁库存
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 */
class TbMember extends BaseCompanyModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_member');
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
            'name'  => $factory->PresenceOf('niandaijijie'),
            'email' => $factory->email('email'),
        ];
    }


    /**
     * 创建唯一的会员名
     * @param string $pinyin 公司名拼音
     * @return mixed
     */
    public static function getAvailableNo($pinyin)
    {
        // 逻辑
        // 如果不存在，则直接返回$pinyin
        if (!self::findFirst("name='$pinyin'")) {
            return $pinyin;
        }
        // 否则循环
        do {
            $name = $pinyin . mt_rand(1000, 9999);
        } while (self::findFirst("name='" . $name . "'"));
        // 返回
        return $name;
    }
}
