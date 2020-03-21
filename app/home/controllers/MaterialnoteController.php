<?php

namespace Multiple\Home\Controllers;

/**
 * 材质备注
 * Class MaterialnoteController
 * @package Multiple\Home\Controllers
 */
class MaterialnoteController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbMaterialnote');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
