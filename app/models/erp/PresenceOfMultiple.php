<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

/**
 * 验证类
 * Class PresenceOfMultiple
 * @package Asa\Erp
 */
class PresenceOfMultiple extends Validator implements ValidatorInterface
{
    /**
     * 执行验证
     *
     * @param Validation $validator
     * @param string $attribute
     * @return boolean
     */
    public function validate(Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        $name = preg_replace("#_[a-z]{2}$#", "", $attribute);
        $languages = $this->getOption('languages');
        foreach ($languages as $lang) {
            $value = $validator->getValue("{$name}_{$lang}");
            $value = trim($value);
            if ($value != "") {
                return true;
            }
        }

        $message = $this->getOption('message');
        $validator->appendMessage(new Message($message));
        return false;
    }
}