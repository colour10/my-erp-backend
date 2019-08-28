<?php

namespace Multiple\Shop\Exceptions;

/**
 * 系统内部错误异常处理
 * Class InternalException
 * @package Multiple\Shop\Exceptions
 */
class InternalException extends Exception
{
    /**
     * ajax重写逻辑
     * @return mixed|void
     */
    public function doAjax()
    {
        return $this->msgForUser;
    }

    /**
     * get请求错误
     * @return array
     */
    public function doGet()
    {
        return [$this->msgForUser, $this->message];
    }
}