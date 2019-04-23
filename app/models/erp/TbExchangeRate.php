<?php
namespace Asa\Erp;

/**
 * 汇率表
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
     * @param  [type] $from   [description]
     * @param  [type] $to     [description]
     * @param  [type] $number [description]
     * @return [type]         [description]
     */
    public static function convert($companyid, $from, $to, $number, $datetime='') {
        if($datetime=='') {
            $datetime = date('Y-m-d H:i:s');
        }

        if($from==$to) {
            return $number;
        }

        if(!preg_match("#^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$#",$datetime)) {
            throw new \Exception("/1001/时间格式不合法/");
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

        if($exchange==false) {
            return false;
        }
        else {
            return $exchange->rate*$number;
        }
    }

    public function getRules() {
        return [
            'rate' => $this->getValidatorFactory()->numericality('huilv'),
            'currency_from' => $this->getValidatorFactory()->presenceOf('huichuhuobi'),
            'currency_to' => $this->getValidatorFactory()->presenceOf('huiruhuobi')
        ];
    }
}
