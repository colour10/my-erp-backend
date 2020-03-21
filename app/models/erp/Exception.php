<?php

namespace Asa\Erp;

/**
 * 异常类
 * Class Exception
 * @package Asa\Erp
 */
class Exception extends \Phalcon\Exception
{
    function __construct($message)
    {
        parent::__construct($message);
    }
}
