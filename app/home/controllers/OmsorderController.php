<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbOmsOrder;

/**
 * 来自 Oms 的订单信息表
 *
 * Class AliasesController
 * @package Multiple\Home\Controllers
 */
class OmsorderController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbOmsOrder');
    }

    /**
     * 分页之后的操作
     *
     * @param $datas
     * @return array
     */
    public function after_page($datas)
    {
        // 逻辑
        // 把几个数字的状态更换为 string 类型的，人类看得懂的
        foreach ($datas as $k => $data) {
            // 订单状态
            $datas[$k]['orderStatus'] = $this->getOrderStatus($data['orderStatus']);
            // 支付状态
            $datas[$k]['paymentStatus'] = $this->getPaymentStatus($data['paymentStatus']);
            // 是否拒绝发货
            $datas[$k]['isRefuseText'] = is_null($data['isRefuse']) ? '' : $this->getRefuseStatus($data['isRefuse']);
            // 是否拒绝快递
            $datas[$k]['isNoExpressText'] = is_null($data['isNoExpress']) ? '' : $this->getNoExpressStatus($data['isNoExpress']);
        }
        // 返回
        return $datas;
    }

    /**
     * 获取订单状态友好信息
     *
     * @param $status
     * @return string
     */
    public function getOrderStatus($status)
    {
        switch ($status) {
            case TbOmsOrder::STATUS_ORDER_PENDING:
                $info = $this->getValidateMessage('pending');
                break;
            case TbOmsOrder::STATUS_ORDER_PROCESSING:
                $info = $this->getValidateMessage('processing');
                break;
            case TbOmsOrder::STATUS_ORDER_FINISH:
                $info = $this->getValidateMessage('finish');
                break;
            case TbOmsOrder::STATUS_ORDER_CANCEL:
                $info = $this->getValidateMessage('cancel');
                break;
            default:
                $info = $this->getValidateMessage('pending');
        }
        // 返回
        return $info;
    }

    /**
     * 获取支付状态友好信息
     *
     * @param $status
     * @return string
     */
    public function getPaymentStatus($status)
    {
        switch ($status) {
            case TbOmsOrder::STATUS_PAYMENT_UNPAID:
                $info = $this->getValidateMessage('unpaid');
                break;
            case TbOmsOrder::STATUS_PAYMENT_PROCESSING:
                $info = $this->getValidateMessage('processing');
                break;
            case TbOmsOrder::STATUS_PAYMENT_PAID:
                $info = $this->getValidateMessage('paid');
                break;
            case TbOmsOrder::STATUS_PAYMENT_PARTPAID:
                $info = $this->getValidateMessage('partpaid');
                break;
            case TbOmsOrder::STATUS_PAYMENT_REFUND:
                $info = $this->getValidateMessage('refund');
                break;
            case TbOmsOrder::STATUS_PAYMENT_CANCEL:
                $info = $this->getValidateMessage('cancel');
                break;
            default:
                $info = $this->getValidateMessage('unpaid');
        }
        // 返回
        return $info;
    }

    /**
     * 是否拒绝发货
     *
     * @param $isRefuse
     * @return string
     */
    public function getRefuseStatus($isRefuse)
    {
        // 逻辑
        if ($isRefuse == TbOmsOrder::STATUS_DONOT_REFUSE) {
            $info = $this->getValidateMessage('normal-delivery');
        } else if ($isRefuse == TbOmsOrder::STATUS_DO_REFUSE) {
            $info = $this->getValidateMessage('refuse-delivery');
        } else {
            $info = '';
        }
        // 返回
        return $info;
    }

    /**
     * 是否需要快递
     *
     * @param $isNoExpress
     * @return string
     */
    public function getNoExpressStatus($isNoExpress)
    {
        // 逻辑
        if ($isNoExpress == TbOmsOrder::STATUS_EXPRESS_REQUIRED) {
            $info = $this->getValidateMessage('normal-delivery');
        } else if ($isNoExpress == TbOmsOrder::STATUS_NOEXPRESS) {
            $info = $this->getValidateMessage('self-delivery');
        } else {
            $info = '';
        }
        // 返回
        return $info;
    }
}
