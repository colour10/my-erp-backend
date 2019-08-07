<?php

use Asa\Erp\TbProductstock;

/**
 *
 *
 */
class ProductstockTask extends \Phalcon\CLI\Task
{
    /**
     * 生成逻辑
     * companyid、brandid、wordcode_3唯一
     */
    public function mainAction()
    {
        \Asa\Erp\Util::sendStockChange(337,2);
    }

    function syncallAction() {
        $results = $this->db->fetchAll("select distinct productid from tb_productstock");

        foreach($results as $row) {
            print_r($row);
            \Asa\Erp\Util::sendStockChange($row['productid']);
        }
    }
}