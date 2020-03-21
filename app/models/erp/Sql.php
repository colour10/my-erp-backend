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
}