<?php

namespace Asa\Erp;

/**
 * 会员相关，会员表
 */
class TbMember extends BaseCompanyModel
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
    public $login_name;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $code;

    /**
     *
     * @var integer
     */
    public $gender;

    /**
     *
     * @var string
     */
    public $birthday;

    /**
     *
     * @var string
     */
    public $phoneno;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $zipcode;

    /**
     *
     * @var string
     */
    public $qq;

    /**
     *
     * @var string
     */
    public $wechat;

    /**
     *
     * @var string
     */
    public $microblog;

    /**
     *
     * @var integer
     */
    public $totalscore;

    /**
     *
     * @var integer
     */
    public $score;

    /**
     *
     * @var string
     */
    public $membercard;

    /**
     *
     * @var integer
     */
    public $memberlevelid;

    /**
     *
     * @var string
     */
    public $membertype;

    /**
     *
     * @var integer
     */
    public $membercardid;

    /**
     *
     * @var integer
     */
    public $creatorid;

    /**
     *
     * @var integer
     */
    public $sourceid;

    /**
     *
     * @var string
     */
    public $idno;

    /**
     *
     * @var string
     */
    public $taxno;

    /**
     *
     * @var string
     */
    public $contactor;

    /**
     *
     * @var string
     */
    public $asawebno;

    /**
     *
     * @var string
     */
    public $openid;

    /**
     *
     * @var integer
     */
    public $invitesum;

    /**
     *
     * @var integer
     */
    public $invitetotal;

    /**
     *
     * @var integer
     */
    public $invoteuser;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $is_lockstock;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

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
