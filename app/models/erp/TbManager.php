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

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'name' => $factory->PresenceOf('niandaijijie'),
            'email' => $factory->email('email')
        ];
    }
}
