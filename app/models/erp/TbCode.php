<?php
namespace Asa\Erp;

/**
 * 
 */
class TbCode extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_code');
    }

    public static function getCode($companyid, $codetype, $month, $length=4) {
        $object = TbCode::findFirst([
            sprintf("companyid=%d and codetype='%s' and month='%s'", $companyid, addslashes($codetype), addslashes($month)),
            "order" => "id desc"
        ]);

        if($object==false) {
            $codeindex = 1;
        }
        else {
            $codeindex = $object->codeindex +1;
        }

        $newobj = new TbCode();
        $newobj->companyid = $companyid;
        $newobj->codetype = $codetype;
        $newobj->month = $month;
        $newobj->codeindex = $codeindex;
        if($newobj->create()!=false) {
            return sprintf("%s%s%0{$length}d", $codetype, $month, $codeindex);
        }
        else {
            throw new \Exception("/1001/创建订单号失败/");
        }
    }
}
