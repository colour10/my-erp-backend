<?php

use Asa\Erp\TbProduct;
use Asa\Erp\TbProductLastmodify;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

/**
 * 生成产品、品牌、公司对应的最后生成记录
 * Class ReplaceTask
 */
class CreateproductlmTask extends \Phalcon\CLI\Task
{
    /**
     * 生成逻辑
     */
    public function mainAction()
    {
        // 逻辑
        // 使用原生sql查询
        $sql = "SELECT t.*
FROM (select * from temp_tb_product order by maketime desc limit 1000000000000000000) t
GROUP BY t.brandid,t.brandcolor,t.companyid";
        $product = new TbProduct();
        // 结果集
        $datas = new Resultset(null, $product, $product->getReadConnection()->query($sql));

        // 开启事务
        $this->db->begin();
        // 先清空表，防止冗余
        // 但是在插入之前，首先要清空原来的表，否则可能会产品重复数据
        $this->db->execute("truncate table tb_product_lastmodify");
        foreach ($datas->toArray() as $data) {
            $model = new TbProductLastmodify();
            $model->companyid = $data['companyid'];
            $model->brandid = $data['brandid'];
            $model->colorname = $data['colorname'];
            $model->brandcolor = $data['brandcolor'];
            $model->updated_at = $data['maketime'];
            if (!$model->save()) {
                $this->db->rollback();
                echo json_encode(['code' => '200', 'messages' => ['ERROR']]) . PHP_EOL;
            }
        }
        // 提交事务
        $this->db->commit();
        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['SUCCESS']]) . PHP_EOL;
    }
}