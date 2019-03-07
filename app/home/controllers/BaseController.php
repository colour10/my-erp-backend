<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class BaseController extends Controller
{
    public function initialize()
    {
        //parent::initialize();

        //����ѡ��
        $this->view->setVar("system_language", $this->language);
    }

    /**
     * 返回正确的json信息
     * @return false|string
     */
    public function success()
    {
        return json_encode(['code' => '200', 'messages' => []]);
    }

    /**
     * 返回错误的json信息
     * @param array $messages
     * @return false|string
     */
    public function error($messages = [])
    {
        return json_encode(['code' => '200', 'messages' => $messages]);
    }

    /**
     * 格式化为目录树
     * @param $result 结果集
     * @param int $pid 上级id
     * @param int $level 上级等级
     * @return array
     */
    public function format_tree($result, $pid = 0, $level = 0)
    {
        // 初始化一个变量
        $tree = [];
        // 开始循环
        foreach ($result as $k => $v) {
            // 找到父级是0的
            if ($v['up_dp_id'] == $pid) {
                // 判断当前模型是否有子集
                $children = $this->format_tree($result, $v['id'], $level + 1);
                // 数据合并
                // 并判断是否有子集加不加children
                if (empty($children)) {
                    $tree[] = [
                        'id' => $v['id'],
                        'label' => $v['Name'],
                        'level' => $level,
                    ];
                } else {
                    $tree[] = [
                        'id' => $v['id'],
                        'label' => $v['Name'],
                        'level' => $level,
                        // 新增children
                        'children' => $children,
                    ];
                }
            }
        }
        // 返回
        return $tree;
    }

}
