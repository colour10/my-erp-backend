<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbColorSystem;
use Exception;

/**
 * 色系管理模块
 * Class ColorController
 * @package Multiple\Home\Controllers
 */
class ColorsystemController extends ZadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbColorSystem');
    }

    /**
     * 添加名称不能重复
     */
    public function before_add()
    {
        // 名称
        if (TbColorSystem::findFirst([
            'conditions' => 'title = :title:',
            'bind' => [
                'title' => $this->request->getPost('title'),
            ],
        ])) {
            echo $this->error($this->di->get("staticReader")->label('sexi-unique'));
            exit();
        }
    }

    /**
     * 删除之前先判断，是否当前数据已经被颜色模板所使用，如果使用了，则不能删除
     *
     * @param $row
     * @return false|string
     * @throws Exception
     */
    public function before_delete($row)
    {
        if (count($row->colors)) {
            echo $this->error($this->di->get("staticReader")->label('sexi-cannot-deleted'));
            exit();
        }
    }
}
