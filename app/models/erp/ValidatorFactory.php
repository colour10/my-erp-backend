<?php

namespace Asa\Erp;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Regex;


class ValidatorFactory implements InjectionAwareInterface {
    private $di;
    function __construct() {
    }

    public function setDI($di) {
        $this->di = $di;
    }

    public function getDI() {
        return $this->di;
    }

    function presenceOf($fieldCode) {
        return new PresenceOf(array(
            'message' => sprintf($this->getTemplate('required'), $this->label($fieldCode))
        ));
    }

    function numericality($fieldCode) {
        return new Numericality(array(
            'message' => sprintf($this->getTemplate('numericality'), $this->label($fieldCode))
        ));
    }

    function presenceOfMultiple($fieldCode) {
        $languages = (array)$this->di->get("config")->languages;
        return new PresenceOfMultiple(array(
            'languages' => array_keys($languages),
            'message' => sprintf($this->getTemplate('required'), $this->label($fieldCode))
        ));
    }

    function tableid($fieldCode) {
        return new Regex(array(
           'pattern' => '/^[1-9]\d*$/',
           'message' => sprintf($this->getTemplate('invalid'), $this->label($fieldCode))
        ));
    }

    function year($fieldCode) {
        return new Regex(array(
           'pattern' => '#^[1-9]\d{3}$#',
           'message' => sprintf($this->getTemplate('invalid'), $this->label($fieldCode))
        ));
    }

    /**
     * 获得消息模板
     */
    private function getTemplate($name) {
        $templates = $this->label("template");
        return $templates[$name];
    }

    private function label($name) {
        return $this->di->get("staticReader")->label($name);
    }
}