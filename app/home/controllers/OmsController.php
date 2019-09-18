<?php
namespace Multiple\Home\Controllers;

use Asa\Erp\TbProductBase;
use GuzzleHttp\Client;


/**
 * 商品国际码库
 */
class OmsController extends BaseController {
    public function initialize() {
        parent::initialize();
    }

    function indexAction() {
    }

    function updateAction() {
        $client = new Client();
        $res = $client->post($this->config->omsproxy . "/oms/inventory/update", [
            'form_params' => ["params"=>$_POST['params']]
        ]);
        echo $res->getBody();
    }
}
