<?php
namespace Asa\Erp;

class Util {    
    /**
     * 格式化为目录树
     * @param $result 结果集
     * @param int $pid 上级id
     * @param int $level 上级等级
     * @return array
     */
    public static function format_tree($result, $pid = 0, $level = 0)
    {
        // 初始化一个变量
        $tree = [];
        // 开始循环
        foreach ($result as $k => $v) {
            // 找到父级是0的
            if ($v['up_dp_id'] == $pid) {
                // 判断当前模型是否有子集
                $children = self::format_tree($result, $v['id'], $level + 1);
                // 数据合并
                // 并判断是否有子集加不加children
                if (empty($children)) {
                    $tree[] = [
                        'id' => $v['id'],
                        'label' => $v['name'],
                        'memo' => $v['memo'],
                        'level' => $level,
                        'children' =>[]
                    ];
                } else {
                    $tree[] = [
                        'id' => $v['id'],
                        'label' => $v['name'],
                        'memo' => $v['memo'],
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

    /**
     * 格式化为目录树-一维数组
     * @param $result 结果集
     * @param int $pid 上级id
     * @param int $level 上级等级
     * @return array
     */
    public static function format_tree_single_array($result, $pid = 0, $level = 0)
    {
        // 初始化变量
        $tree = [];
        $str_repeat = ' ';
        // 开始循环
        foreach ($result as $k => $v) {
            // 找到父级是0的
            if ($v['up_dp_id'] == $pid) {
                // 数据合并
                    $tree[] = [
                        'id' => $v['id'],
                        'label' => str_repeat($str_repeat, $level).$v['name'],
                        'memo' => $v['memo'],
                        'level' => $level,
                    ];
                    // 继续寻找
                    $tree = array_merge($tree, self::format_tree_single_array($result, $v['id'], $level+1));
                }
            }
        // 返回
        return $tree;
    }

    /**
     * 字符串转为数组
     * @param $str
     * @return array
     */
    public static function char_to_array($str)
    {
        // 逻辑
        // 如果有逗号，就分割
        if (strpos($str,',') !== false) {
            $arr = explode(',', $str);
        } else {
            $arr = [$str];
        }
        return $arr;
    }

    /**
     * 判断id类字段是否合法
     * @param $id
     * @return bool
     */
    public static function checkid($id)
    {
        // 判断id类字段是否合法
        $pattern = '/^[1-9]+\d*$/';
        if (preg_match($pattern, $id)) {
            return true;
        } else {
            return false;
        }
    }
}