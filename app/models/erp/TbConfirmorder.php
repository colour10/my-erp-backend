<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

/**
 * 发货单主表
 *
 * Class TbConfirmorder
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $companyid 公司id
 * @property bool|null $status 状态:1-未提交审核；2-待审核；3-审核完成,4-作废
 * @property string|null $orderno 发货单号
 * @property int|null $supplierid 供货商id
 * @property null $makedate 制单日期
 * @property int|null $makestaff 制单人
 * @property int|null $currency 货币类型
 * @property float|null $total 总金额
 * @property bool|null $isstatus 0-在途未入库，1-已入库，2-已备货未发出
 * @property string|null $memo 备注
 * @property int|null $brandid 品牌id
 * @property int|null $ageseasonid 年份季节id
 * @property bool|null $seasontype 0-pre ,1-main ,2-fashion show
 * @property int|null $auditstaff 审核人
 * @property null $auditdate 审核日期
 * @property float|null $exchangerate
 * @property int|null $finalsupplierid 供货单位id
 * @property string|null $flightno 航班号
 * @property string|null $flightdate
 * @property string|null $arrivaldate
 * @property string|null $mblno 主单号
 * @property string|null $hblno 子单号
 * @property string|null $dispatchport
 * @property string|null $deliveryport
 * @property int|null $transcompany
 * @property bool|null $isexamination
 * @property string|null $examinationresult
 * @property null $clearancedate
 * @property null $pickingdate
 * @property string|null $motortransportpool
 * @property int|null $warehouseid
 * @property int|null $box_number 箱数
 * @property float|null $weight 重量
 * @property float|null $volume 体积
 * @property string|null $issjyh
 * @property int|null $sellerid
 * @property string|null $sjyhresult
 * @property int|null $buyerid
 * @property bool|null $transporttype 0-by air 1-快递 2-中转
 * @property bool|null $paytype 0- t/t
 * @property bool|null $property 0-自采 1-代销
 * @property string|null $payoutpercentage 属性
 * @property string|null $pickingaddress
 * @property float|null $chargedweight 计费重量
 * @property string|null $paydate
 * @property string|null $apickingdate 安排提货时间
 * @property string|null $aarrivaldate 到库时间
 * @property string|null $invoiceno
 * @property int|null $dd_company
 * @property-read TbConfirmorderdetails|null $confirmorderdetails 订单详情
 */
class TbConfirmorder extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_confirmorder');

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            TbConfirmorderdetails::class,
            "confirmorderid",
            [
                'alias'      => 'confirmorderdetails',
                'foreignKey' => [
                    'message' => '#1003#',
                    'action'  => Relation::ACTION_RESTRICT,
                ],
            ]
        );
    }

    /**
     * 添加一条明细数据
     * @param [type] $form 表单数据
     * @return TbConfirmorderdetails|bool
     */
    public function addDetail($form)
    {
        $row = new TbConfirmorderdetails();
        if ($row->create($form)) {
            return $row;
        } else {

            return false;
        }
    }

    /**
     * 更新明细数据
     * @param  [type] $form 表单数据
     * @return bool|Model [type]       [description]
     */
    public function updateDetail($form)
    {
        $row = TbConfirmorderdetails::findFirst(
            sprintf("id=%d", $form['id'])
        );

        if ($row != false && $row->companyid == $form['companyid']) {
            if ($row->update($form)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 获取订单明细
     */
    function getOrderDetail()
    {
        // 循环添加数据
        $list = [];
        foreach ($this->confirmorderdetails as $k => $row) {
            $list[] = $row->toArray();
        }

        return [
            'form' => $this->toArray(),
            'list' => $this->confirmorderdetails->toArray(),
        ];
    }
}
