<?php

namespace Multiple\Home\Controllers;

use GuzzleHttp\Client;


/**
 * 与 OMS 对接
 * Class OmsController
 * @package Multiple\Home\Controllers
 */
class OmsController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    function indexAction()
    {
    }

    function updateAction()
    {
        $client = new Client();
        $res = $client->post($this->config->omsproxy . "/oms/inventory/update", [
            'form_params' => ["params" => $_POST['params']],
        ]);
        echo $res->getBody();
    }
}
