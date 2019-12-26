<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbColorSystem;
use Asa\Erp\TbColortemplate;

/**
 * 色系颜色管理模块
 *
 * @author zjl
 */
class ColorController extends CadminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbColortemplate');
    }

    /**
     * 获取所有色系和色系包含的颜色
     *
     * @auther zjl
     */
    public function getColorSystemAndColorAction()
    {
        $color_systems = TbColorSystem::find([
            'order' => "id asc"
        ]);

        $result = [];
        foreach ($color_systems as $cs) {
            $result[$cs->id]['id']    = (int)$cs->id;
            $result[$cs->id]['title'] = $cs->title;
            $result[$cs->id]['colors'] = [];
        }

        $colors = TbColortemplate::find("color_system_id > 0");
        foreach ($colors as $color) {
            if (isset($result[$color->color_system_id])) {
                $result[$color->color_system_id]['colors'][] = $color;
            }
        }
        return $this->success($result);
    }

    /**
     * 创建颜色
     *
     * @auther zjl
     */
    public function createColorAction()
    {
        $model = new TbColortemplate;

        $model->name_cn         = $this->request->getPost("name_cn");
        $model->name_en         = $this->request->getPost("name_en");
        $model->name_it         = $this->request->getPost("name_it");
        $model->code            = $this->request->getPost("code");
        $model->color_system_id = $this->request->getPost("color_system_id");

        $rs = $model->save();

        if ($rs) {
            return $this->success();
        } else {
            return $this->error('fail');
        }
    }

    public function updateColorAction()
    {
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            // 传递错误
            return $this->renderError();
        }
        // 赋值
        $id = $params[0];

        if (!$model = TbColortemplate::findFirst("id=$id")) {
            // 传递错误
            return $this->renderError('make-an-error', 'color-doesnot-exist');
        }

        $model->name_cn         = $this->request->getPost("name_cn");
        $model->name_en         = $this->request->getPost("name_en");
        $model->name_it         = $this->request->getPost("name_it");
        $model->code            = $this->request->getPost("code");
        $model->color_system_id = $this->request->getPost("color_system_id");

        $rs = $model->update();

        if ($rs) {
            return $this->success();
        } else {
            return $this->error('fail');
        }
    }

    public function deleteColorAction()
    {
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            // 传递错误
            return $this->renderError();
        }
        // 赋值
        $id = $params[0];

        if (!$model = TbColortemplate::findFirst("id=$id")) {
            // 传递错误
            return $this->renderError('make-an-error', 'color-doesnot-exist');
        }

        $rs = $model->delete(); 

        if ($rs) {
            return $this->success();
        } else {
            return $this->error($model);
        }
    }
}