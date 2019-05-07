<?php
namespace Asa\Erp;
use Phalcon\Di\InjectionAwareInterface;

class StaticReader implements InjectionAwareInterface {
    private $di;
    function __construct() {
    }

    function get($source, $key) {
        $language = $this->getDI()->get("session")->get("language");

        if(isset($language['list'][$source])) {
            return $language['list'][$source][$key];
        }
        else {
            throw new Exception("/1001/数据源不存在{$source}/");
        }
    }

    function label($key) {
        $language = $this->getDI()->get("session")->get("language");

        if(isset($language[$key])) {
            return $language[$key];
        }
        else {
            throw new Exception("/1001/数据源不存在{$key}/");
        }
    }

    public function setDI($di) {
        $this->di = $di;
    }

    public function getDI() {
        return $this->di;
    }
}