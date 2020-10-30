<?php

namespace Asa\Erp;

/**
 * 用户表
 *
 * Class TbUser
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $login_name 登录名
 * @property string|null $password 密码
 * @property string|null $real_name 真实姓名
 * @property int|null $departmentid 部门id
 * @property int|null $companyid 公司id
 * @property int|null $groupid 组id
 * @property int|null $storeid 所属门店仓库id
 * @property string|null $sex 性别
 * @property string|null $section 部门2
 * @property string|null $date 出生年月
 * @property string|null $phone 电话
 * @property string|null $mobilephone 手机
 * @property string|null $e_mail 邮箱
 * @property string|null $email_password 邮箱密码，用于自动发送邮件
 * @property string|null $memo 备注
 * @property int|null $countryid 国家id
 * @property int|null $departmentid2 部门2 id
 * @property string|null $address 地址
 * @property string|null $contactor 备用联系人
 * @property string|null $leave_date 离职日期
 * @property string|null $idno 身份证号
 * @property string|null $education 学历
 * @property string|null $collegemajor 专业
 * @property string|null $degree 学位
 * @property string|null $graduatedcollege 毕业院校
 * @property string|null $stateofmarriage 婚/育状况
 * @property string|null $censusregistration 户籍所在地
 * @property string|null $status 0-在职，1-离职，2-其他
 * @property string|null $reason 离职原因
 * @property string|null $contactorphone 备用联系人手机号
 * @property string|null $costdisplay 显示成本
 * @property string|null $wechat 微信号
 * @property string|null $openid 微信openid
 * @property int|null $saleportid 默认销售端口
 * @property string|null $saleportids 销售端口
 * @property int|null $warehouseid 默认仓库
 * @property int|null $priceid 默认价格id
 * @property-read TbDepartment|null $department 部门
 * @property-read TbUserPermission|null $userpermissions 用户权限
 * @property-read TbGroup|null $group 组
 * @property-read TbSaleport|null $saleport 默认销售端口
 * @property-read TbCompany|null $company 公司
 * @property-read TbUserPrice|null $prices 价格
 * @property-read TbWarehouse|null $warehouses 仓库
 */
class TbUser extends BaseModel
{
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

        // 用户表-默认销售端口，一对多反向
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

        // 用户表-价格表，多对多
        $this->hasManyToMany(
            'id',
            TbUserPrice::class,
            'userid',
            'priceid',
            TbPrice::class,
            'id',
            [
                'alias' => 'prices',
            ]
        );

        // 用户表-仓库表，多对多
        $this->hasManyToMany(
            'id',
            TbWarehouseUser::class,
            'userid',
            'warehouseid',
            TbWarehouse::class,
            'id',
            [
                'alias' => 'warehouses',
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
