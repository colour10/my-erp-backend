<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

class ExceptionPlugin
{
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception)
    {
        // Default error action
        $action = 'show503';

        // Handle 404 exceptions
        if ($exception instanceof DispatchException) {
            $action = 'show404';
        }

        $dispatcher->forward(
            [
                'controller' => 'index',
                'action'     => $action,
            ]
        );

        echo $exception->getMessage();exit;

        return false;
    }
}