<?php

namespace Asa\Erp;

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

    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name' => $factory->PresenceOf('niandaijijie'),
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
