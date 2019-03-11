<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class BaseController extends Controller
{
    protected $default_language;
    public function initialize()
    {
        //parent::initialize();

        //����ѡ��
        $this->view->setVar("system_language", $this->language);
        $this->view->setVar("__sytem_time", time());
        
        $this->default_language = $this->config->language;
        $this->view->setVar("__default_language", $this->config->language);
        $this->view->setVar("__config", $this->config);
    }

    /**
     * 返回正确的json信息
     * @return false|string
     */
    public function success()
    {
        return json_encode(['code' => '200', 'messages' => []]);
    }

    /**
     * 返回错误的json信息
     * @param array $messages
     * @return false|string
     */
    public function error($messages = [])
    {
        return json_encode(['code' => '200', 'messages' => $messages]);
    }
}
