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
        $str_repeat = '　 ';
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

    /**
     * 字符串位数补全
     * @param $str 字符串
     * @param int $length 处理后的位数，默认是6位
     * @return bool|string
     */
    public static function cover_position($str, $length=6)
    {
        // 逻辑
        $len = strlen($str);
        if ($len > $length) {
            $str = substr($str, 0, $length);
        } else if ($len < $length) {
            // 如果小于$length，就进行补位
            $diff = $length - $len;
            $str = str_repeat('0', $diff) . $str;
        }
        // 返回
        return $str;
    }


    /**
     * 把货币改成简写
     * @param $currency
     * @return string
     */
    public static function change_currency($currency)
    {
        // 逻辑
        if ($currency == 'USD') {
            $new_currency = '$';
        } else if ($currency == 'CAD') {
            $new_currency = 'CAD';
        } else if ($currency == 'EUR') {
            $new_currency = '€';
        } else if ($currency == 'HKD') {
            $new_currency = 'HK$';
        } else if ($currency == 'GBP') {
            $new_currency = '￡';
        } else if ($currency == 'JPY') {
            $new_currency = 'J￥';
        } else {
            $new_currency = '￥';
        }
        // 返回
        return $new_currency;
    }
}