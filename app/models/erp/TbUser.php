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
                'alias' => 'department'
            ]
        );

        // 用户表-组表，一对多反向
        $this->belongsTo(
            'groupid',
            '\Asa\Erp\TbGroup',
            'id',
            [
                'alias' => 'group'
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

        $this->belongsTo(
            'companyid',
            '\Asa\Erp\TbCompany',
            'id',
            [
                'alias' => 'company'
            ]
        );
    }

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'login_name' => [$factory->presenceOf('dengluming'), $factory->uniqueness('dengluming')],
            'password' => $factory->presenceOf('mima'),
            'e_mail' => $factory->email('email'),
            'departmentid' => $factory->tableid('bumen'),
            'groupid' => $factory->tableid('zu'),
            'companyid' => $factory->tableid('gongsi'),
            'countryid' => $factory->tableid('guojia')
        ];
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
