<?php

namespace Asa\Erp;

/**
 * 附带ERP商城主表
 * Class TbShoporderCommon
 * @package Asa\Erp
 */
class TbShoporderCommon extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $order_no;

    /**
     *
     * @var integer
     */
    protected $member_id;

    /**
     *
     * @var string
     */
    protected $reciver_name;

    /**
     *
     * @var string
     */
    protected $reciver_phone;

    /**
     *
     * @var string
     */
    protected $reciver_address;

    /**
     *
     * @var string
     */
    protected $reciver_no;

    /**
     *
     * @var double
     */
    protected $total_price;

    /**
     *
     * @var double
     */
    protected $send_price;

    /**
     *
     * @var double
     */
    protected $final_price;

    /**
     *
     * @var string
     */
    protected $payment_method;

    /**
     *
     * @var string
     */
    protected $payment_no;

    /**
     *
     * @var string
     */
    protected $refund_status;

    /**
     *
     * @var string
     */
    protected $refund_no;

    /**
     *
     * @var integer
     */
    protected $closed;

    /**
     *
     * @var string
     */
    protected $ship_status;

    /**
     *
     * @var string
     */
    protected $ship_data;

    /**
     *
     * @var string
     */
    protected $create_time;

    /**
     *
     * @var string
     */
    protected $expire_time;

    /**
     *
     * @var string
     */
    protected $pay_time;

    /**
     *
     * @var string
     */
    protected $update_time;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field order_no
     *
     * @param string $order_no
     * @return $this
     */
    public function setOrderNo($order_no)
    {
        $this->order_no = $order_no;

        return $this;
    }

    /**
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field reciver_name
     *
     * @param string $reciver_name
     * @return $this
     */
    public function setReciverName($reciver_name)
    {
        $this->reciver_name = $reciver_name;

        return $this;
    }

    /**
     * Method to set the value of field reciver_phone
     *
     * @param string $reciver_phone
     * @return $this
     */
    public function setReciverPhone($reciver_phone)
    {
        $this->reciver_phone = $reciver_phone;

        return $this;
    }

    /**
     * Method to set the value of field reciver_address
     *
     * @param string $reciver_address
     * @return $this
     */
    public function setReciverAddress($reciver_address)
    {
        $this->reciver_address = $reciver_address;

        return $this;
    }

    /**
     * Method to set the value of field reciver_no
     *
     * @param string $reciver_no
     * @return $this
     */
    public function setReciverNo($reciver_no)
    {
        $this->reciver_no = $reciver_no;

        return $this;
    }

    /**
     * Method to set the value of field total_price
     *
     * @param double $total_price
     * @return $this
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;

        return $this;
    }

    /**
     * Method to set the value of field send_price
     *
     * @param double $send_price
     * @return $this
     */
    public function setSendPrice($send_price)
    {
        $this->send_price = $send_price;

        return $this;
    }

    /**
     * Method to set the value of field final_price
     *
     * @param double $final_price
     * @return $this
     */
    public function setFinalPrice($final_price)
    {
        $this->final_price = $final_price;

        return $this;
    }

    /**
     * Method to set the value of field payment_method
     *
     * @param string $payment_method
     * @return $this
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    /**
     * Method to set the value of field payment_no
     *
     * @param string $payment_no
     * @return $this
     */
    public function setPaymentNo($payment_no)
    {
        $this->payment_no = $payment_no;

        return $this;
    }

    /**
     * Method to set the value of field refund_status
     *
     * @param string $refund_status
     * @return $this
     */
    public function setRefundStatus($refund_status)
    {
        $this->refund_status = $refund_status;

        return $this;
    }

    /**
     * Method to set the value of field refund_no
     *
     * @param string $refund_no
     * @return $this
     */
    public function setRefundNo($refund_no)
    {
        $this->refund_no = $refund_no;

        return $this;
    }

    /**
     * Method to set the value of field closed
     *
     * @param integer $closed
     * @return $this
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Method to set the value of field ship_status
     *
     * @param string $ship_status
     * @return $this
     */
    public function setShipStatus($ship_status)
    {
        $this->ship_status = $ship_status;

        return $this;
    }

    /**
     * Method to set the value of field ship_data
     *
     * @param string $ship_data
     * @return $this
     */
    public function setShipData($ship_data)
    {
        $this->ship_data = $ship_data;

        return $this;
    }

    /**
     * Method to set the value of field create_time
     *
     * @param string $create_time
     * @return $this
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;

        return $this;
    }

    /**
     * Method to set the value of field expire_time
     *
     * @param string $expire_time
     * @return $this
     */
    public function setExpireTime($expire_time)
    {
        $this->expire_time = $expire_time;

        return $this;
    }

    /**
     * Method to set the value of field pay_time
     *
     * @param string $pay_time
     * @return $this
     */
    public function setPayTime($pay_time)
    {
        $this->pay_time = $pay_time;

        return $this;
    }

    /**
     * Method to set the value of field update_time
     *
     * @param string $update_time
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field order_no
     *
     * @return string
     */
    public function getOrderNo()
    {
        return $this->order_no;
    }

    /**
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field reciver_name
     *
     * @return string
     */
    public function getReciverName()
    {
        return $this->reciver_name;
    }

    /**
     * Returns the value of field reciver_phone
     *
     * @return string
     */
    public function getReciverPhone()
    {
        return $this->reciver_phone;
    }

    /**
     * Returns the value of field reciver_address
     *
     * @return string
     */
    public function getReciverAddress()
    {
        return $this->reciver_address;
    }

    /**
     * Returns the value of field reciver_no
     *
     * @return string
     */
    public function getReciverNo()
    {
        return $this->reciver_no;
    }

    /**
     * Returns the value of field total_price
     *
     * @return double
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * Returns the value of field send_price
     *
     * @return double
     */
    public function getSendPrice()
    {
        return $this->send_price;
    }

    /**
     * Returns the value of field final_price
     *
     * @return double
     */
    public function getFinalPrice()
    {
        return $this->final_price;
    }

    /**
     * Returns the value of field payment_method
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * Returns the value of field payment_no
     *
     * @return string
     */
    public function getPaymentNo()
    {
        return $this->payment_no;
    }

    /**
     * Returns the value of field refund_status
     *
     * @return string
     */
    public function getRefundStatus()
    {
        return $this->refund_status;
    }

    /**
     * Returns the value of field refund_no
     *
     * @return string
     */
    public function getRefundNo()
    {
        return $this->refund_no;
    }

    /**
     * Returns the value of field closed
     *
     * @return integer
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Returns the value of field ship_status
     *
     * @return string
     */
    public function getShipStatus()
    {
        return $this->ship_status;
    }

    /**
     * Returns the value of field ship_data
     *
     * @return string
     */
    public function getShipData()
    {
        return $this->ship_data;
    }

    /**
     * Returns the value of field create_time
     *
     * @return string
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Returns the value of field expire_time
     *
     * @return string
     */
    public function getExpireTime()
    {
        return $this->expire_time;
    }

    /**
     * Returns the value of field pay_time
     *
     * @return string
     */
    public function getPayTime()
    {
        return $this->pay_time;
    }

    /**
     * Returns the value of field update_time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shoporder_common');

        // 表关联
        // 与用户表关联，一对多反向
        $this->hasMany(
            "id",
            "\Asa\Erp\TbShoporder",
            "order_commonid",
            [
                'alias' => 'shoporder',
            ]
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tb_shoporder_common';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbShoporderCommon[]|TbShoporderCommon|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbShoporderCommon|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'order_no' => 'order_no',
            'member_id' => 'member_id',
            'reciver_name' => 'reciver_name',
            'reciver_phone' => 'reciver_phone',
            'reciver_address' => 'reciver_address',
            'reciver_no' => 'reciver_no',
            'total_price' => 'total_price',
            'send_price' => 'send_price',
            'final_price' => 'final_price',
            'payment_method' => 'payment_method',
            'payment_no' => 'payment_no',
            'refund_status' => 'refund_status',
            'refund_no' => 'refund_no',
            'closed' => 'closed',
            'ship_status' => 'ship_status',
            'ship_data' => 'ship_data',
            'create_time' => 'create_time',
            'expire_time' => 'expire_time',
            'pay_time' => 'pay_time',
            'update_time' => 'update_time',
        ];
    }

}