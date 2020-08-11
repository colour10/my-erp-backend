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
        $totalAmount = self::sum([
            "column"     => "amount",
            "conditions" => sprintf("billid=%d", $this->billid),
        ]);

        if ($totalAmount == 0) {
            $this->bill->status = 1;
        } else {
            $this->bill->status = $this->bill->amount <= $totalAmount ? 3 : 2;
        }

        if ($this->bill->update() === false) {
            throw new \Exception('/11200101/对账单状态更新失败/');
        }
    }
}
