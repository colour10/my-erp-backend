<?php

namespace Asa\Erp;

use Phalcon\Config\Adapter\Php;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;

/**
 * 语言配置
 * Class StaticReader
 * @package Asa\Erp
 */
class StaticReader implements InjectionAwareInterface
{
    private $di;

    function __construct()
    {
    }

    function get($source, $key)
    {
        $language = $this->getDI()->get("session")->get("language") ?? 'cn';
        $lang = new Php(APP_PATH . "/app/config/languages/{$language}.php");

        if (isset($language['list'][$source])) {
            return $language['list'][$source][$key];
        } else {
            throw new Exception("/1001/数据源不存在{$source}/");
        }
    }

    function label($key)
    {
        $language = $this->getDI()->get("session")->get("language") ?? 'cn';
        $lang = new Php(APP_PATH . "/app/config/languages/{$language}.php");
        if (isset($lang[$key])) {
            return $lang[$key];
        } else {
            throw new Exception("/1001/数据源不存在{$key}/");
        }
    }

    /**
     * @param DiInterface $di
     */
    public function setDI($di)
    {
        $this->di = $di;
    }

    public function getDI()
    {
        return $this->di;
    }
}
