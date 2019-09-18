<?php
namespace Asa\Erp;

/**
 * 商品库存检索表
 */
class TbProductstockSearch extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_search');
    }

    function getDataList() {
        $result = [];
        $array = explode(';', $this->sizecontent_data);
        foreach($array as $row) {
            $temp = explode(',', $row);
            $result[] = [
                "sizecontentid" => $temp[0],
                "number" => $temp[1],
                "reserve_number" => $temp[2],
                "sales_number" => $temp[3],
            ];
        }

        return $result;
    }
}
