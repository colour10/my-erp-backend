<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbUserPrice;

/**
 * 用户价格表
 */
class UserpriceController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbUserPrice');
    }

    /**
     * 当前用户的价格表
     */
    public function currentlistAction()
    {
        // 必须存在userId
        if (!$userId = $this->request->getPost('userId')) {
            return $this->error($this->di->get("staticReader")->label('make-an-error'));
        }

        // 查找
        // 如果不存在，返回空
        if (!$prices = TbUserPrice::find([
            'conditions' => 'userid = :userId:',
            'bind'       => [
                'userId' => $userId,
            ],
        ])) {
            return $this->success();
        }

        // 有就继续
        // 存在则继续处理
        $prices_array = $prices->toArray();
        // 遍历
        foreach ($prices as $k => $price) {
            $prices_array[$k]['pricename'] = $price->price->name;
        }
        return $this->success($prices_array);
    }
}
