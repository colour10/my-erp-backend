<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

class ExceptionPlugin
{
    /**
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @param Exception $exception
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        $message = $exception->getMessage();
        $result = [];
        $result["code"] = "200";
        $result["messages"] = [$message];
        echo json_encode($result);
        exit;
    }
}