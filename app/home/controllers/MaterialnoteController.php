<?php

namespace Multiple\Home\Controllers;

use Exception;

/**
 * 材质备注
 *
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

    /**
     * 添加前，先验证必要的字段是否填写完整
     *
     * @throws Exception
     */
    public function before_add()
    {
        if (!$this->request->get('brandgroupids') || !$this->request->get('content_cn') || !$this->request->get('content_en')) {
            throw new Exception($this->getValidateMessage('fill-out-required-fields'));
        }
    }
}
