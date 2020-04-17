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

    /**
     * 从 cn.php 当中的 list 字段取出 key 下面对应的的 value值
     *
     * @param $source
     * @param $key
     * @return mixed
     * @throws Exception
     */
    function get($source, $key)
    {
        $language = $this->getDI()->get("session")->get("language") ?? 'cn';
        $lang = new Php(APP_PATH . "/app/config/languages/{$language}.php");
        if (isset($lang['list'][$source])) {
            return $lang['list'][$source][$key];
        } else {
            throw new Exception("/1001/数据源不存在{$source}/");
        }
    }

    /**
     * 取出直属的一级 key 值
     *
     * @param $key
     * @return string
     * @throws Exception
     */
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
