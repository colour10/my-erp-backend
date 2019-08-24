<?php

namespace Multiple\Shop\Exceptions;

/**
 * 用户输入参数错误抛出的异常
 * Class InvalidRequestException
 * @package Multiple\Shop\Exceptions
 */
class InvalidRequestException extends Exception
{
    /**
     * ajax重写逻辑
     * @return mixed|void
     */
    public function doAjax()
    {
        return $this->message;
    }

    /**
     * get请求错误
     * @return array
     */
    public function doGet()
    {
        return [$this->message, $this->message];
    }
}