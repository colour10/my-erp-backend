<?php

namespace Asa\Erp;

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
            ]
        );

        // 用户表-用户权限表，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbUserPermission",
            "userid",
            [
                'alias' => 'userpermissions',
            ]
        );

        // 用户表-组表，一对多反向
        $this->belongsTo(
            'groupid',
            '\Asa\Erp\TbGroup',
            'id',
            [
                'alias' => 'group',
            ]
        );

        // 用户表-组表，一对多反向
        $this->belongsTo(
            'saleportid',
            '\Asa\Erp\TbSaleport',
            'id',
            [
                'alias' => 'saleport',
            ]
        );

        $this->belongsTo(
            'companyid',
            '\Asa\Erp\TbCompany',
            'id',
            [
                'alias' => 'company',
            ]
        );
    }

    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'login_name'   => [$factory->presenceOf('dengluming'), $factory->uniqueness('dengluming')],
            'password'     => $factory->presenceOf('mima'),
            'e_mail'       => $factory->email('email'),
            'departmentid' => $factory->tableid('bumen'),
            'groupid'      => $factory->tableid('zu'),
            'companyid'    => $factory->tableid('gongsi'),
            'countryid'    => $factory->tableid('guojia'),
        ];
    }

    /**
     * 获得用户对指定商品，指定销售端口的价格
     * @param  [type] $goods    [description]
     * @param string $saleport [description]
     * @return [type]           [description]
     */
    function getPrice($goods, $saleport)
    {
        return round($goods->price * $saleport->discount, 2);
    }

    function getDefaultSaleportid()
    {
        if ($this->saleport > 0) {
            return $this->saleport;
        } else {
            $saleport = TbSaleportUser::findFirst([
                sprintf("userid=%d", $this->id),
                "order" => "id asc",
            ]);

            if ($saleport != false) {
                return $saleport->saleportid;
            }

            return 0;
        }
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
        if (!self::findFirst("login_name='$pinyin'")) {
            return $pinyin;
        }
        // 否则循环
        do {
            $login_name = $pinyin . mt_rand(1000, 9999);
        } while (self::findFirst("login_name='" . $login_name . "'"));
        // 返回
        return $login_name;
    }
}
