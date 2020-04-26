<?php

use Asa\Erp\TbProductstockSummary;
use Phalcon\Cli\Task;

/**
 * 生成新的 productstock_summary 记录，只是把缺少的字段补齐而已
 *
 * Class CreateproductstocksummaryTask
 */
class CreateproductstocksummaryTask extends Task
{
    /**
     * 生成逻辑
     * @return false|string|void
     */
    public function mainAction()
    {
        // 逻辑
        // 启用事务处理
        $this->db->begin();

        // 开始查询
        // 统计每个商品，每个尺码的数量，需要分组两个字段
        $sql = "SELECT
                    p.wordcode,
                    p.brandid,
                    p.brandgroupid,
                    p.childbrand,
                    p.countries,
                    p.brandcolor,
                    p.series,
                    p.ulnarinch,
                    p.gender,
                    p.ageseason,
                    p.saletypeid,
                    p.producttypeid,
                    p.spring,
                    p.ageseason,
                    p.summer,
                    p.fall,
                    p.winter,
                    ps.companyid,
                    ps.warehouseid,
                    ps.productid,
                    ps.sizecontentid,
                    ps.defective_level,
                    ps.property,
                    ifnull(ps.number,0) as number,
                    ifnull(ps.reserve_number, 0) as reserve_number,
                    ifnull(ps.shipping_number, 0) as shipping_number,
                    ifnull(ps.sales_number, 0) as sales_number
                FROM
                    Asa\Erp\TbProductstock AS ps,
                    Asa\Erp\TbProduct AS p
                WHERE
                    ps.productid = p.id
                ";
        // 获取所有记录
        $productStocks = $this->modelsManager->executeQuery($sql)->toArray();
        // 开始无差别写入
        // 先清空查询表
        $this->db->execute('truncate table tb_productstock_summary');
        foreach ($productStocks as $productStock) {
            $model = new TbProductstockSummary();
            if (!$model->create($productStock)) {
                $this->db->rollback();
                return json_encode(['code' => '200', 'messages' => ['库存查询表新增失败']]) . PHP_EOL;
            }
        }

        // 提交
        $this->db->commit();

        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['SUCCESS']]) . PHP_EOL;
        exit();
    }
}
