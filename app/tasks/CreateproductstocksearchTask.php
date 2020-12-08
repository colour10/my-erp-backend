<?php

use Asa\Erp\TbProductstockSearch;
use Phalcon\Cli\Task;

/**
 * 生成库存搜索表
 *
 * Class CreateProductStockSearchTask
 */
class CreateproductstocksearchTask extends Task
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
        // 因为companyid、productid、warehouseid、property、defective_level五个字段具有唯一索引，所以需要进行汇总
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
                    p.laststoragedate,
                    p.productmemoids,
                    ps.companyid,
                    ps.warehouseid,
                    ps.productid,
                    ps.sizecontentid,
                    ps.defective_level,
                    ps.property,
                    ifnull(ps.number,0) as number,
                    ifnull(ps.reserve_number, 0) as reserve_number,
                    ifnull(ps.shipping_number, 0) as shipping_number,
                    ifnull(ps.sales_number, 0) as sales_number,
                    group_concat(concat(ps.sizecontentid)) as sizecontentids,
                    group_concat(CONCAT_WS('-', ps.sizecontentid, number, reserve_number, shipping_number, sales_number)) as sizecontent_data
                FROM
                    Asa\Erp\TbProductstock AS ps,
                    Asa\Erp\TbProduct AS p
                WHERE
                    ps.productid = p.id
                GROUP BY
                    ps.companyid,
                    ps.warehouseid,
                    ps.productid,
                    ps.defective_level,
                    ps.property
                ";
        // 获取所有记录
        $productStocks = $this->modelsManager->executeQuery($sql)->toArray();
        // 开始无差别写入
        // 先清空查询表
        $this->db->execute('truncate table tb_productstock_search');
        foreach ($productStocks as $productStock) {
            // laststoragedate 时间格式，不可传空
            $productStock['laststoragedate'] = empty($productStock['laststoragedate']) ? null : $productStock['laststoragedate'];
            $model = new TbProductstockSearch();
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
