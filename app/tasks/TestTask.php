<?php
use GuzzleHttp\Client;
use Asa\Erp\TbProduct;

/**
 *
 * Class ReplaceTask
 */
class TestTask extends \Phalcon\CLI\Task
{
    /**
     * 生成逻辑
     * companyid、brandid、wordcode_3唯一
     */
    public function mainAction() {
        $client = new GuzzleHttp\Client();
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

        $param = [
            'Name' => product.getName(),
            'ShortDescription' => product.getName(),
            'Spu' => product.getGoodsCode(),
            'CategoryId' => product.oms_categoryid,
            'OldPrice' => 4
        ];
    }
}