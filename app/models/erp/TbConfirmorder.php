<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

/**
 * 发货单主表
 * Class TbConfirmorder
 * @package Asa\Erp
 */
class TbConfirmorder extends BaseModel
{
    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $companyid;

    /**
     *
     * @var integer
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $orderno;

    /**
     *
     * @var integer
     */
    protected $supplierid;

    /**
     *
     * @var string
     */
    protected $makedate;

    /**
     *
     * @var integer
     */
    protected $makestaff;

    /**
     *
     * @var integer
     */
    protected $currency;

    /**
     *
     * @var double
     */
    protected $total;

    /**
     *
     * @var integer
     */
    protected $isstatus;

    /**
     *
     * @var string
     */
    protected $memo;

    /**
     *
     * @var integer
     */
    protected $brandid;

    /**
     *
     * @var integer
     */
    protected $ageseasonid;

    /**
     *
     * @var integer
     */
    protected $seasontype;

    /**
     *
     * @var integer
     */
    protected $auditstaff;

    /**
     *
     * @var string
     */
    protected $auditdate;

    /**
     *
     * @var double
     */
    protected $exchangerate;

    /**
     *
     * @var integer
     */
    protected $finalsupplierid;

    /**
     *
     * @var string
     */
    protected $flightno;

    /**
     *
     * @var string
     */
    protected $flightdate;

    /**
     *
     * @var string
     */
    protected $arrivaldate;

    /**
     *
     * @var string
     */
    protected $mblno;

    /**
     *
     * @var string
     */
    protected $hblno;

    /**
     *
     * @var string
     */
    protected $dispatchport;

    /**
     *
     * @var string
     */
    protected $deliveryport;

    /**
     *
     * @var integer
     */
    protected $transcompany;

    /**
     *
     * @var integer
     */
    protected $isexamination;

    /**
     *
     * @var string
     */
    protected $examinationresult;

    /**
     *
     * @var string
     */
    protected $clearancedate;

    /**
     *
     * @var string
     */
    protected $pickingdate;

    /**
     *
     * @var string
     */
    protected $motortransportpool;

    /**
     *
     * @var integer
     */
    protected $warehouseid;

    /**
     *
     * @var integer
     */
    protected $box_number;

    /**
     *
     * @var double
     */
    protected $weight;

    /**
     *
     * @var double
     */
    protected $volume;

    /**
     *
     * @var string
     */
    protected $issjyh;

    /**
     *
     * @var integer
     */
    protected $sellerid;

    /**
     *
     * @var string
     */
    protected $sjyhresult;

    /**
     *
     * @var integer
     */
    protected $buyerid;

    /**
     *
     * @var integer
     */
    protected $transporttype;

    /**
     *
     * @var integer
     */
    protected $paytype;

    /**
     *
     * @var integer
     */
    protected $property;

    /**
     *
     * @var string
     */
    protected $payoutpercentage;

    /**
     *
     * @var string
     */
    protected $pickingaddress;

    /**
     *
     * @var double
     */
    protected $chargedweight;

    /**
     *
     * @var string
     */
    protected $paydate;

    /**
     *
     * @var string
     */
    protected $apickingdate;

    /**
     *
     * @var string
     */
    protected $aarrivaldate;

    /**
     *
     * @var string
     */
    protected $invoiceno;

    /**
     *
     * @var integer
     */
    protected $dd_company;

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
