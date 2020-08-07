<?php

namespace Asa\Erp;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Validation\Validator\Digit;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 验证类
 *
 * Class ValidatorFactory
 * @package Asa\Erp
 */
class ValidatorFactory implements InjectionAwareInterface
{
    private $di;

    function __construct()
    {
    }

    public function setDI($di)
    {
        $this->di = $di;
    }

    public function getDI()
    {
        return $this->di;
    }

    public function presenceOf($fieldCode)
    {
        return new PresenceOf([
            'message' => sprintf($this->getTemplate('required'), $this->label($fieldCode)),
        ]);
    }

    function numericality($fieldCode, $allowEmpty = true)
    {
        return new Numericality([
            "allowEmpty" => $allowEmpty,
            'message'    => sprintf($this->getTemplate('numericality'), $this->label($fieldCode)),
        ]);
    }

    public function presenceOfMultiple($fieldCode)
    {
        $languages = (array)$this->di->get("config")->languages;
        return new PresenceOfMultiple([
            'languages' => array_keys($languages),
            'message'   => sprintf($this->getTemplate('required'), $this->label($fieldCode)),
        ]);
    }

    public function tableid($fieldCode, $allowEmpty = true)
    {
        return new Regex([
            "allowEmpty" => $allowEmpty,
            'pattern'    => '/^[1-9]\d*$/',
            'message'    => sprintf($this->getTemplate('invalid'), $this->label($fieldCode)),
        ]);
    }

    public function year($fieldCode, $allowEmpty = true)
    {
        return new Regex([
            "allowEmpty" => $allowEmpty,
            'pattern'    => '#^[1-9]\d{3}$#',
            'message'    => sprintf($this->getTemplate('invalid'), $this->label($fieldCode)),
        ]);
    }

    public function digit($fieldCode, $allowEmpty = true)
    {
        return new Digit([
            "allowEmpty" => $allowEmpty,
            'message'    => sprintf($this->getTemplate('digit'), $this->label($fieldCode)),
        ]);
    }

    public function uniqueness($fieldCode, $allowEmpty = true)
    {
        return new Uniqueness([
            "allowEmpty" => $allowEmpty,
            'message'    => sprintf($this->getTemplate('uniqueness'), $this->label($fieldCode)),
        ]);
    }

    public function email($fieldCode, $allowEmpty = true)
    {
        return new Email([
            "allowEmpty" => $allowEmpty,
            'message'    => sprintf($this->getTemplate('invalid'), $this->label($fieldCode)),
        ]);
    }

    /**
     * 获得消息模板
     * @param string $name
     * @return mixed
     */
    private function getTemplate($name)
    {
        $templates = $this->label("template");
        return $templates[$name];
    }

    private function label($name)
    {
        return $this->di->get("staticReader")->label($name);
    }
}
