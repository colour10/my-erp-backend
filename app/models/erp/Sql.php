<?php

namespace Asa\Erp;

/**
 * SQL 处理
 * Class Sql
 * @package Asa\Erp
 */
class Sql
{
    public static function isInclude($name, $ids)
    {
        $array = explode(",", $ids);

        $result = [];
        foreach ($array as $id) {
            $result[] = sprintf("%s=%d", addslashes($name), $id);
        }

        return "(" . implode(" or ", $result) . ")";
    }

    //字段是多选
    public static function isMatch($name, $ids)
    {
        $array = explode(",", $ids);

        $filterName = addslashes($name);
        $result = [];
        foreach ($array as $id) {
            $result[] = sprintf("%s=%d or %s like '%d,%%' or %s like '%%,%d,%%' or %s like '%%,%s'", $filterName, $id, $filterName, $id, $filterName, $id, $filterName, $id);
        }

        return "(" . implode(" or ", $result) . ")";
    }


    /**
     * 范围选择，liuzongyang 2020/4/27 17:21
     *
     * @param string $name 字段名称
     * @param string|array $start 起始范围，字符串或数组，如果是数组，那么这个变量包含了start和end [0]是start，[1]是end
     * @param string $end 截止范围
     * @return string
     */
    public static function betweenAnd($name, $start = "", $end = "")
    {
        // 定义一个变量来保存
        $result = [];
        if (!empty($start)) {
            if (is_array($start)) {
                // 如果是数组，就直接用 $start 进行拆分
                $result[] = "$name between '$start[0]' and '$start[1]'";
            } else {
                // 否则就是字符串
                if (!empty($end)) {
                    $result[] = "$name between '$start' and '$end'";
                } else {
                    $result[] = "$name > '$start'";
                }
            }
        } else {
            // 如果 start 为空，那么
            // 如果 end 为空，那么
            if (!empty($end)) {
                $result[] = "$name < '$end'";
            } else {
                $result[] = "1 = 1";
            }
        }
        // 返回
        return "(" . implode(" or ", $result) . ")";
    }
}
