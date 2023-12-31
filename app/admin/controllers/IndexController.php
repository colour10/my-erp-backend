<?php

namespace Multiple\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Demo\SysStudent;

class IndexController extends AdminController
{

    public function initialize()
    {
        $this->setModelName('Demo\\SysStudent');
    }

    function formAction()
    {
        try {
            $s = SysStudent::findFirst("id=3");
            echo $s->name;
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
