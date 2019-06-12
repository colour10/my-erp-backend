<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

class ExceptionPlugin
{
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        $message = $exception->getMessage();
        if(preg_match("#^Action '[a-z0-9]+' was not found on handler '[a-z0-9]+'$#", $message)) {
            header("location:/");
        }
        else {
            $result = array();
            $result["code"] = "200";
            $result["messages"] = [$message];
            echo json_encode($result);
        }
        

        exit;
    }
}