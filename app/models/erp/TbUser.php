<?php

namespace Asa\Erp;

/**
 * 用户表
 * Class TbUser
 * @package Asa\Erp
 */
class TbUser extends BaseModel
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
    public $password;

    /**
     *
     * @var string
     */
    public $real_name;

    /**
     *
     * @var integer
     */
    public $departmentid;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $groupid;

    /**
     *
     * @var integer
     */
    public $storeid;

    /**
     *
     * @var string
     */
    public $sex;

    /**
     *
     * @var string
     */
    public $section;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $mobilephone;

    /**
     *
     * @var string
     */
    public $e_mail;

    /**
     *
     * @var string
     */
    public $email_password;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $countryid;

    /**
     *
     * @var integer
     */
    public $departmentid2;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $contactor;

    /**
     *
     * @var string
     */
    public $leave_date;

    /**
     *
     * @var string
     */
    public $idno;

    /**
     *
     * @var string
     */
    public $education;

    /**
     *
     * @var string
     */
    public $collegemajor;

    /**
     *
     * @var string
     */
    public $degree;

    /**
     *
     * @var string
     */
    public $graduatedcollege;

    /**
     *
     * @var string
     */
    public $stateofmarriage;

    /**
     *
     * @var string
     */
    public $censusregistration;

    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var string
     */
    public $reason;

    /**
     *
     * @var string
     */
    public $contactorphone;

    /**
     *
     * @var string
     */
    public $costdisplay;

    /**
     *
     * @var string
     */
    public $wechat;

    /**
     *
     * @var string
     */
    public $openid;

    /**
     *
     * @var integer
     */
    public $saleportid;

    /**
     *
     * @var string
     */
    public $saleportids;

    /**
     *
     * @var integer
     */
    public $warehouseid;

    /**
     *
     * @var integer
     */
    public $priceid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_user');

        // 用户表-部门表，一对多反向
        $this->belongsTo(
            'departmentid',
            TbDepartment::class,
            'id',
            [
                'alias' => 'department',
            ]
        );

        // 用户表-用户权限表，一对多
        $this->hasMany(
            "id",
            TbUserPermission::class,
            "userid",
            [
                'alias' => 'userpermissions',
            ]
        );

        // 用户表-组表，一对多反向
        $this->belongsTo(
            'groupid',
            TbGroup::class,
            'id',
            [
                'alias' => 'group',
            ]
        );

        // 用户表-组表，一对多反向
        $this->belongsTo(
            'saleportid',
            TbSaleport::class,
            'id',
            [
                'alias' => 'saleport',
            ]
        );

        // 用户表-公司表，一对多反向
        $this->belongsTo(
            'companyid',
            TbCompany::class,
            'id',
            [
                'alias' => 'company',
            ]
        );
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
     *
     * @param $goods
     * @param string $saleport [description]
     * @return float [type]           [description]
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
     *
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

    /**
     * 获取当前用户下面的所有权限操作
     *
     * @return false|string
     */
    public function getActionList()
    {
        $id_array = Util::recordListColumn($this->userpermissions, "permissionid");

        return TbPermissionAction::findByIdString($id_array, "permissionid");
    }

    /**
     * 获取当前用户下面的所有权限
     *
     * @return false|string
     */
    public function getPermissionList()
    {
        $id_array = Util::recordListColumn($this->userpermissions, "permissionid");

        return TbPermission::findByIdString($id_array, "id");
    }
}
