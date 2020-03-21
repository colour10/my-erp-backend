<?php

namespace Asa\Erp;

/**
 * 对账单回款表
 * Class TbBillConfirm
 * @package Asa\Erp
 */
class TbBillConfirm extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_bill_confirm');

        $this->belongsTo(
            'billid',
            '\Asa\Erp\TbBill',
            'id',
            [
                'alias' => 'bill',
            ]
        );
    }

    function create($data = NULL, $whiteList = NULL)
    {
        $result = parent::create($data, $whiteList);

        $this->updateBillStatus();

        return $result;
    }

    function update($data = NULL, $whiteList = NULL)
    {
        $result = parent::update($data, $whiteList);

        $this->updateBillStatus();

        return $result;
    }

    function delete()
    {
        $result = parent::delete();

        $this->updateBillStatus();

        return $result;
    }

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
