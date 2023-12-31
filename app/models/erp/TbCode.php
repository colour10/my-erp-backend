<?php

namespace Asa\Erp;

/**
 * 生成订单号表
 *
 * Class TbCode
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $codetype 订单类型
 * @property string|null $month 时间种子
 * @property int|null $codeindex 标识，通过计算而来
 * @property int|null $companyid 公司id
 */
class TbCode extends BaseModel
{
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
