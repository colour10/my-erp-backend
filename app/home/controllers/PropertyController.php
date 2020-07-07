<?php

namespace Multiple\Home\Controllers;

use Exception;

/**
 * 属性定义表
 * Class PropertyController
 * @package Multiple\Home\Controllers
 */
class PropertyController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProperty');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }

    /**
     * 添加前，先验证必要的字段是否填写完整
     *
     * @throws Exception
     */
    public function before_add()
    {
        if (!$this->request->get('name_cn') || !$this->request->get('name_en')) {
            throw new Exception($this->getValidateMessage('fill-out-required-fields'));
        }
    }
}
