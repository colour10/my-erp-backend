<?php

namespace Multiple\Home\Controllers;

/**
 * 基础资料，ASA颜色模板表
 * Class ColortemplateController
 * @package Multiple\Home\Controllers
 */
class ColortemplateController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbColortemplate');
    }

    function before_page()
    {
        $this->injectParam('__orderby', "code asc");
    }
}
