<?php
/*
 * php cli task
 */
use Asa\Erp\TbProduct;
use Asa\Erp\TbCompany;
use Asa\Erp\TbProductSearch;
use Asa\Erp\Util;

class CrontabTask extends \Phalcon\CLI\Task
{
    public function mainAction() {
        $db = $this->db;
        $update = 0;
        $insert = 0;

        $companyList = TbCompany::find();
        foreach($companyList as $company) {
            if($company->saleportid>0) {
                //获得公司的对应自营店铺的销售端口对象。然后查询这个销售端口的商品数据及库存数据
                $saleport = $company->shopSaleport;

                //库存商品的id及合计库存（多个仓库，多个尺码合计）
                $product_sum_list = $saleport->getProductList();

                $product_id_array = Util::recordListColumn($product_sum_list, 'productid');
                $products = TbProduct::findByIdString($product_id_array, 'id');
                //print_r($products->toArray());

                $hashmap = Util::recordToHashtable($product_sum_list, 'productid', 'sumatory');

                //查询已经存在的库存记录，这些需要更新
                $rows = TbProductSearch::find(
                    sprintf("companyid=%d and productid in(%s)", $company->id, implode(",", $product_id_array))
                );
                $exist_product_id_array = Util::recordListColumn($rows, 'productid');


                //print_r($hashmap);
                foreach($products as $product ){
                    if(in_array($product->id, $exist_product_id_array)) {
                        //更新
                        $sql = sprintf(
                            "UPDATE tb_product_search SET productname='%s', number=%d, sizetopid=%d, brandgroupid=%d, childbrand=%d, picture='%s', picture2='%s' WHERE companyid=%d and productid=%d",
                            addslashes($product->productname),
                            $hashmap[$product->id],
                            $product->sizetopid,
                            $product->brandgroupid,
                            $product->childbrand,
                            addslashes($product->picture),
                            addslashes($product->picture2),
                            $company->id,
                            $product->id
                        );
                        $db->execute($sql);
                    }
                    else {
                        //新增
                        $sql = sprintf(
                            "INSERT INTO tb_product_search SET productname='%s', number=%d, sizetopid=%d, brandgroupid=%d, childbrand=%d, picture='%s', picture2='%s', companyid=%d, productid=%d",
                            addslashes($product->productname),
                            $hashmap[$product->id],
                            $product->sizetopid,
                            $product->brandgroupid,
                            $product->childbrand,
                            addslashes($product->picture),
                            addslashes($product->picture2),
                            $company->id,
                            $product->id
                        );
                        $db->execute($sql);
                    }
                }

                //清除未在产品列表里的产品记录
                $sql = sprintf("DELETE FROM tb_product_search WHERE companyid=%d and productid not in(%s)", $company->id, implode(",", $product_id_array));
                $db->execute($sql);
            }
        }
        echo "同步完毕";
    }
}