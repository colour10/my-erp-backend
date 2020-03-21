<?php

use Asa\Erp\Util;
use Phalcon\Cli\Task;

/**
 *
 *
 */
class ProductstockTask extends Task
{
    /**
     * 生成逻辑
     * companyid、brandid、wordcode_3唯一
     */
    public function mainAction()
    {
        Util::sendStockChange(337, 2);
    }

    function syncallAction()
    {
        $results = $this->db->fetchAll("select distinct productid from tb_productstock");

        foreach ($results as $row) {
            print_r($row);
            Util::sendStockChange($row['productid']);
        }
    }
}