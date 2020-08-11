<?php

namespace Asa\Erp;

/**
 * 生成订单号表
 * Class TbCode
 * @package Asa\Erp
 */
class TbCode extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $codetype;

    /**
     *
     * @var string
     */
    public $month;

    /**
     *
     * @var integer
     */
    public $codeindex;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_code');
    }

    /**
     * 生成订单号并最终返回
     *
     * @param int $companyid 公司id
     * @param string $codetype 订单类型
     * @param string $month 时间
     * @param int $length 长度
     * @return string
     * @throws \Exception
     */
    public static function getCode($companyid, $codetype, $month, $length = 4)
    {
        $object = TbCode::findFirst([
            sprintf("companyid=%d and codetype='%s' and month='%s'", $companyid, addslashes($codetype), addslashes($month)),
            "order" => "id desc",
        ]);

        if ($object == false) {
            $codeindex = 1;
        } else {
            $codeindex = $object->codeindex + 1;
        }

        $newobj = new TbCode();
        $newobj->companyid = $companyid;
        $newobj->codetype = $codetype;
        $newobj->month = $month;
        $newobj->codeindex = $codeindex;
        if ($newobj->create() != false) {
            return sprintf("%s%s%0{$length}d", $codetype, $month, $codeindex);
        } else {
            throw new \Exception("/1001/创建订单号失败/");
        }
    }
}
