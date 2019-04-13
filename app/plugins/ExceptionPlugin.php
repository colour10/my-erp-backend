<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

class ExceptionPlugin
{
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        
        $result = array();
        $result["code"] = "200";
        $result["messages"] = [$exception->getMessage()];
        echo json_encode($result);

        exit;
    }
}