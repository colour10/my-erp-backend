<?php

namespace Multiple\Home\Controllers;

/**
 * 语言配置表
 * Class LanguageController
 * @package Multiple\Home\Controllers
 */
class LanguageController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbLanguage');
    }
}
