<?php

namespace Asa\Erp;

/**
 * 汇率表
 * Class TbExchangeRate
 * @package Asa\Erp
 */
class TbExchangeRate extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_exchange_rate');
    }

    /**
     * 货币汇率转化
     * @param $companyid
     * @param $from
     * @param $to
     * @param $number
     * @param string $datetime
     * @return array [type]         [description]
     * @throws \Exception
     */
    public static function convert($companyid, $from, $to, $number, $datetime = '')
    {
        $rate = self::getExchangeRate($companyid, $from, $to, $datetime);
        return [
            "number" => round($rate * $number, 2),
            "rate"   => $rate,
        ];
    }

    public function getRules()
    {
        return [
            'rate'          => $this->getValidatorFactory()->numericality('huilv'),
            'currency_from' => $this->getValidatorFactory()->presenceOf('huichuhuobi'),
            'currency_to'   => $this->getValidatorFactory()->presenceOf('huiruhuobi'),
        ];
    }

    public static function getExchangeRate($companyid, $from, $to, $datetime = '')
    {
        if ($datetime == '') {
            $datetime = date('Y-m-d H:i:s');
        }

        if ($from == $to) {
            return 1;
        }

        if (!preg_match("#^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$#", $datetime)) {
            throw new \Exception("/11050101/时间格式不合法/");
        }
        $exchange = static::findFirst(
            sprintf(
                "companyid=%d and currency_from=%d and currency_to=%d and begin_time<'%s' and (end_time>'%s' or end_time IS NULL)",
                $companyid,
                $from,
                $to,
                $datetime,
                $datetime
            )
        );

        if ($exchange == false) {
            throw new \Exception("/11050102/请先设置汇率({$from}=>{$to})。/");
        } else {
            return $exchange->rate;
        }
    }
}
