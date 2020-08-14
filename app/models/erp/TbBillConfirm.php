<?php

namespace Asa\Erp;

/**
 * 对账单回款表
 * Class TbBillConfirm
 * @package Asa\Erp
 */
class TbBillConfirm extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $billid;

    /**
     *
     * @var double
     */
    public $amount;

    /**
     *
     * @var string
     */
    public $createtime;

    /**
     *
     * @var integer
     */
    public $createstaff;

    /**
     *
     * @var string
     */
    public $bankaccount;

    /**
     *
     * @var string
     */
    public $invoice;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var string
     */
    public $enterdate;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_bill_confirm');

        $this->belongsTo(
            'billid',
            TbBill::class,
            'id',
            [
                'alias' => 'bill',
            ]
        );
    }

    /**
     * 增
     *
     * @param null $data
     * @param null $whiteList
     * @return bool
     * @throws \Exception
     */
    function create($data = NULL, $whiteList = NULL)
    {
        $result = parent::create($data, $whiteList);

        $this->updateBillStatus();

        return $result;
    }

    /**
     * 改
     *
     * @param null $data
     * @param null $whiteList
     * @return bool
     * @throws \Exception
     */
    function update($data = NULL, $whiteList = NULL)
    {
        $result = parent::update($data, $whiteList);

        $this->updateBillStatus();

        return $result;
    }

    /**
     * 删
     *
     * @return bool
     * @throws \Exception
     */
    function delete()
    {
        $result = parent::delete();

        $this->updateBillStatus();

        return $result;
    }

    /**
     * 更新订单状态
     *
     * @throws \Exception
     */
    private function updateBillStatus()
    {
        // 查找 bill_confirm表中当前 billid 的累计回款值
        $totalAmount = self::sum([
            "column"     => "amount",
            "conditions" => sprintf("billid=%d", $this->billid),
        ]);

        // 判断回款状态
        if ($totalAmount == 0) {
            // 如果金额为0，说明未回款
            $this->bill->status = TbBill::STATUS_NOT_PAYMENT;
        } else {
            // 如果回款金额 >= 对账单金额，说明回款完毕；否则是部分回款
            $this->bill->status = $this->bill->amount <= $totalAmount ? TbBill::STATUS_ALL_PAYMENT : TbBill::STATUS_PART_PAYMENT;
        }

        // 下面这句话只是为了让程序更加健壮
        if ($this->bill->update() === false) {
            throw new \Exception('/11200101/对账单状态更新失败/');
        }
    }
}
