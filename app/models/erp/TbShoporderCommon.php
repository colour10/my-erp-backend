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
     * @var integer
     */
    protected $company_id;

    /**
     *
     * @var string
     */
    protected $address;

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
    protected $remark;

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
     *
     * @var string
     */
    protected $extra;

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
     * Method to set the value of field company_id
     *
     * @param integer $company_id
     * @return $this
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * Method to set the value of field address
     *
     * @param array $address
     * @return $this
     */
    public function setAddress(array $address)
    {
        $this->address = json_encode($address);

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
     * @param array $ship_data
     * @return $this
     */
    public function setShipData(array $ship_data)
    {
        $this->ship_data = json_encode($ship_data);
        return $this;
    }

    /**
     * Method to set the value of field remark
     *
     * @param string $remark
     * @return $this
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

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
     * Method to set the value of field extra
     *
     * @param array $extra 这里传递一个数组进去，因为保存在数据库里的是json
     * @return $this
     */
    public function setExtra(array $extra)
    {
        $this->extra = json_encode($extra);

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
     * Returns the value of field company_id
     *
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Returns the value of field address
     *
     * @return array
     */
    public function getAddress()
    {
        return json_decode($this->address, true);
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
     * @return array
     */
    public function getShipData()
    {
        // 返回数组
        return json_decode($this->ship_data, true);
    }

    /**
     * Returns the value of field remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
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
     * Returns the value of field extra
     *
     * @return array
     */
    public function getExtra()
    {
        // 返回数组
        return json_decode($this->extra, true);
    }

    // 退款和发货相关状态设定
    const REFUND_STATUS_PENDING    = 'pending';
    const REFUND_STATUS_APPLIED    = 'applied';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS    = 'success';
    const REFUND_STATUS_FAILED     = 'failed';

    const SHIP_STATUS_PENDING   = 'pending';
    const SHIP_STATUS_DELIVERED = 'delivered';
    const SHIP_STATUS_RECEIVED  = 'received';

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shoporder_common');

        // 表关联
        // 与订单详情表关联，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbShoporder",
            "order_commonid",
            [
                'alias' => 'shoporder',
            ]
        );

        // 表关联
        // 与会员表关联，一对多反向
        $this->belongsTo(
            "member_id",
            "\Asa\Erp\TbMember",
            "id",
            [
                'alias' => 'member',
            ]
        );

        // 表关联
        // 与公司表关联，一对多反向
        $this->belongsTo(
            "company_id",
            "\Asa\Erp\TbCompany",
            "id",
            [
                'alias' => 'company',
            ]
        );
    }

    /**
     * 取出订单详情
     * @return \Phalcon\Mvc\Model\Resultset|\Phalcon\Mvc\Phalcon\Mvc\Model
     */
    public function getShoporder()
    {
        return $this->shoporder;
    }

    /**
     * 取出下单人详情
     * @return \Phalcon\Mvc\Model\Resultset|\Phalcon\Mvc\Phalcon\Mvc\Model
     */
    public function getMember()
    {
        return $this->member;
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
            'id'             => 'id',
            'order_no'       => 'order_no',
            'member_id'      => 'member_id',
            'company_id'     => 'company_id',
            'address'        => 'address',
            'total_price'    => 'total_price',
            'send_price'     => 'send_price',
            'final_price'    => 'final_price',
            'payment_method' => 'payment_method',
            'payment_no'     => 'payment_no',
            'refund_status'  => 'refund_status',
            'refund_no'      => 'refund_no',
            'closed'         => 'closed',
            'ship_status'    => 'ship_status',
            'ship_data'      => 'ship_data',
            'remark'         => 'remark',
            'create_time'    => 'create_time',
            'expire_time'    => 'expire_time',
            'pay_time'       => 'pay_time',
            'update_time'    => 'update_time',
            'extra'          => 'extra',
        ];
    }

    /**
     * 获取可用的唯一订单号
     * @return string
     */
    public static function getAvailableOrderNo()
    {
        // 死循环获取
        do {
            // 生成唯一订单号
            $no = Util::generate_trade_no();
            // 为了避免重复我们在生成之后在数据库中查询看看是否已经存在相同的订单号
        } while (self::findFirst("order_no=" . $no));
        // 返回订单号
        return $no;
    }

    /**
     * 获取可用的唯一退款订单号
     * @return string
     */
    public static function getAvailableRefundNo()
    {
        // 死循环获取
        do {
            // 生成唯一订单号
            $no = Util::generate_trade_no();
            // 为了避免重复我们在生成之后在数据库中查询看看是否已经存在相同的退款订单号
        } while (self::findFirst("refund_no=" . $no));
        // 返回订单号
        return $no;
    }


    /**
     * 是否在订单列表中显示截至时间
     * @return bool
     */
    public function isShowExpiretime()
    {
        // 逻辑
        // 如果订单处于未支付状态，并且未关闭，则显示
        if (is_null($this->getPayTime()) && !$this->getClosed()) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示计算后的价格
     * @return bool
     */
    public
    function isShowTotalprice()
    {
        // 逻辑
        // 如果订单处于支付状态，则显示
        if ($this->getPayTime()) {
            return true;
        }
        return false;
    }


    /**
     * 判断该订单是否允许付款
     * @return bool
     */
    public function isAllowPaymentOrder()
    {
        // 逻辑
        // 订单被关闭，不允许付款；
        // 订单有付款时间，不允许付款
        if ($this->getClosed() || $this->getPayTime()) {
            return false;
        }
        return true;
    }

    /**
     * 是否在订单列表中显示去支付和取消订单按钮
     * @return bool
     */
    public
    function isShowPayAndCancledButtons()
    {
        // 逻辑
        // 如果订单处于未支付状态，并且没有过截至时间，而且订单没有关闭
        if (!$this->getClosed() && !$this->getPayTime() && $this->getExpireTime() > date('Y-m-d H:i:s')) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示退款按钮
     * @return bool
     */
    public
    function isShowRefundButton()
    {
        // 逻辑
        // 订单已经支付，退款状态是pending，订单不能关闭
        if ($this->getPayTime() && $this->getRefundStatus() === 'pending' && !$this->getClosed()) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示订单已经过了截至时间，已经失效
     * @return bool
     */
    public
    function isShowOverExpired()
    {
        // 逻辑
        // 如果订单没有支付，并且已经过了截止时间，截至时间不能为空
        if (!$this->getPayTime() && $this->getClosed() && $this->getExpireTime() && $this->getExpireTime() < date('Y-m-d H:i:s')) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示订单倒计时
     * @return bool
     */
    public
    function isShowRemainExactTime()
    {
        // 逻辑
        // 如果订单没有支付，截止时间有值，并且没有关闭，
        if (!$this->getPayTime() && !$this->getClosed() && $this->getExpireTime() && $this->getExpireTime() > date('Y-m-d H:i:s')) {
            return true;
        }
        return false;
    }

    /**
     * 是否在订单列表中显示订单已被用户取消的提示
     * @return bool
     */
    public
    function isShowCancled()
    {
        // 逻辑
        // 如果订单没有支付，并且已经过了截止时间，并且已经被关闭
        if ($this->getClosed() && !$this->getExpireTime() && !$this->getPayTime()) {
            return true;
        }
        return false;
    }

    /**
     * 是否显示退款状态
     * @return bool
     */
    public
    function isShowRefundStatus()
    {
        // 逻辑
        // 如果订单退款状态不是pending，则显示
        if ($this->getRefundStatus() !== TbShoporderCommon::REFUND_STATUS_PENDING) {
            return $this->getValidateMessage('refund_status_' . $this->getRefundStatus());
        }
        return false;
    }

    /**
     * 是否显示发货按钮
     * @return bool
     */
    public
    function isShowShipButton()
    {
        // 逻辑
        // 显示按钮的逻辑：已付款，未关闭、未发货
        if ($this->getPayTime() && $this->getShipStatus() === TbShoporderCommon::SHIP_STATUS_PENDING && !$this->getClosed()) {
            return true;
        }
        return false;
    }


    /**
     * 显示订单的完整状态
     * @return array
     */
    public
    function getOrderStatus()
    {
        // 逻辑
        $status = [];
        // 付款状态
        $status['pay_status'] = $this->getPayTime() ? $this->getValidateMessage('paid') : $this->getValidateMessage('not-paid');
        // 是否关闭
        $status['closed_status'] = $this->getClosed() ? $this->getValidateMessage('closed') : $this->getValidateMessage('not-closed');
        // 退款状态，分为pending、applied、processing、success、failed五种情况
        $status['refund_status'] = $this->getValidateMessage('refund_status_' . $this->getRefundStatus());
        // 物流状态
        $status['ship_status'] = $this->getValidateMessage('ship_status_' . $this->getShipStatus());
        // 返回
        return $status;
    }

    /**
     * 获取最新的订单状态，仅仅是单一形态
     * @return string
     */
    public function getSimpleOrderStatus()
    {
        // 逻辑
        // 是否关闭
        if ($this->getClosed()) {
            return $this->getValidateMessage('closed');
        }
        // 是否退款
        if ($this->getRefundNo()) {
            // 接着判断具体的退款状态
            switch ($this->getRefundStatus()) {
                case 'applied':
                    return $this->getValidateMessage('refund_status_applied');
                    break;
                case 'processing':
                    return $this->getValidateMessage('refund_status_processing');
                    break;
                case 'success':
                    return $this->getValidateMessage('refund_status_success');
                    break;
                case 'failed':
                    return $this->getValidateMessage('refund_status_failed');
                    break;
                default:
                    return $this->getValidateMessage('refund_status_applied');
                    break;
            }
        }
        // 是否支付
        if ($this->getPayTime()) {
            return $this->getValidateMessage('payment-success');
        }
        // 如果不符合以上任何情况，则订单未付款
        return $this->getValidateMessage('not-paid');
    }

    /**
     * 多语言版本配置读取函数
     * @param string $field_name 验证字段的提示名称，比如cn.php中上面的自定义变量名system_name
     * @param string $module_name 模块名称，比如cn.php中的template
     * @param string $module_rule 模块验证规则，比如cn.php中的template模块下面的uniqueness
     * @return string
     */
    public function getValidateMessage($field_name, $module_name = '', $module_rule = '')
    {
        // 逻辑
        // 定义变量
        // 取出当前语言版本
        $language = $this->getDI()->get('language');
        // 拼接变量
        // 判断是否需要取出模块部分来展示
        $human_name = $language->$field_name;
        if (!$module_name && !$module_rule) {
            return $human_name;
        }
        // 否则就展示模块和信息组合后的结果
        return sprintf($language->$module_name[$module_rule], $human_name);
    }

}