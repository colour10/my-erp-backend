<?php

namespace Multiple\Home\Controllers;

use Exception;

/**
 * 销售属性表
 * Class SaletypeController
 * @package Multiple\Home\Controllers
 */
class SaletypeController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSaleType');
    }

    /**
     * 添加前的验证，否则是默认的英文提示，用户体验不好
     */
    public function before_add()
    {
        if (!$this->request->get('colortemplateid')) {
            throw new Exception($this->getValidateMessage('colortemplateid', 'template', 'required'));
        }
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
