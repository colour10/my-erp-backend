<?php

use Asa\Erp\TbCompany;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductstockSearch;
use Asa\Erp\TbProductstockSummary;
use Asa\Erp\TbSizecontent;
use Phalcon\Cli\Task;


/**
 *
 * Class ReplaceTask
 */
class TestTask extends Task
{
    /**
     * 生成逻辑
     * companyid、brandid、wordcode_3唯一
     */
    public function mainAction()
    {
        $result = TbProductstockSummary::find(
            "companyid=1 and (property=1 or property=2 or property=3) and (defective_level=1) and (number>reserve_number or reserve_number>0 or shipping_number>0) and (laststoragedate between '2018-01-13 00:00:00' and '2020-05-20 00:00:00') and (number < 10)"
        );
        echo json_encode($result);
        exit;


        $companyid = 1;

        $this->pushCompanyStock($companyid);

        /*$client = new GuzzleHttp\Client();
        $res = $client->post("https://api.jingjing.shop/token", [
            'form_params' => [
                'grant_type' => 'password',
                'username' => 'testerp@erp.com',
                'password' => 'ERP!@1234erp',
            ]
        ]);
        echo $res->getBody();

        $option = [
            'VendorId' => 29,
            'WarehouseId' => 6,
        ];

        $product = TbProduct::findFirstById(271);

        $param = [
            'Name' => product.getName(),
            'ShortDescription' => product.getName(),
            'Spu' => product.getGoodsCode(),
            'CategoryId' => product.oms_categoryid,
            'OldPrice' => 4
        ];*/
    }

    private function pushCompanyStock($companyid)
    {
        $company = TbCompany::findFirstById($companyid);
        if ($company == false) {
            throw new \Exception("/21000101/公司不存在/");
        }

        if ($company->oms_warehouseids == '' || $company->oms_saleport <= 0) {
            throw new \Exception("/21000102/没有设置同步仓库或者销售端口/");
        }

        //合并计算多个仓库的库存
        $stocks = TbProductstockSearch::find([
            sprintf("warehouseid in (%s) and defective_level=1", $company->oms_warehouseids),
            "order" => "productid asc",
        ]);

        $result = [];
        foreach ($stocks as $row) {
            $datalist = $row->getDataList();
            foreach ($datalist as $line) {
                $key = $row->productid . ',' . $line['sizecontentid'];
                if (!isset($result[$key])) {
                    $result[$key] = 0;
                }

                $result[$key] += $line['number'] - $line['reserve_number'];
            }
        }

        //print_r($result);
        //获得所有的尺码信息
        $hashSizecontent = $this->getSizecontents();

        $json = [];
        foreach ($result as $key => $row) {
            $temp = explode(',', $key);
            $product = TbProduct::getInstance($temp[0]);
            if ($product == false) {
                continue;
            }

            $json[] = [
                "Sku" => $product->wordcode . '|' . $hashSizecontent[$temp[1]],
                "Num" => $row,
            ];
        }

        print_r($json);
        exit;

        $client = new GuzzleHttp\Client();
        $res = $client->post("http://10.10.10.4:3002/oms/stock/stockupdate", [
            'form_params' => ["params" => json_encode($json)],
        ]);
        echo $res->getBody();

    }

    private function getSizecontents()
    {
        $result = [];

        $list = TbSizecontent::find();
        foreach ($list as $row) {
            $result[$row->id] = $row->name;
        }

        return $result;
    }
}
