<?php
namespace Asa\Erp;

use Gregwar\Image\Image;

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

    /**
     * 判断一个字符串是否为合法网址
     * @param $str
     * @return bool
     */
    public static function is_url($str)
    {
        // 逻辑
        if (filter_var($str, FILTER_VALIDATE_URL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 根据查询到的一个结果集，获取指定列，并生成数组
     */
    public static function recordListColumn($list, $column) {
        $array = [];
        foreach ($list as $key => $value) {
            $array[] = $value->$column;
        }
        return $array;
    }

    /**
     * 根据查询到的一个结果集，指定两列，生成哈希表
     */
    public static function recordToHashtable($list, $columnKey, $columnValue) {
        $array = [];
        foreach ($list as $key => $value) {
            $array[$value->$columnKey] = $value->$columnValue;
        }
        return $array;
    }

    public static function getAuthResourse() {
        return [           
            ["user","modifypassword"],
            ["warehouseuser","page"],
            ["user","page"],
            ["product","page"],
            ["group","page"],
            ['group','getpermissions'],
            ["department","single"],
            ["department","departments"],
            ["brand","page"],
            ["common","list"],
            ["common","loadname"],
            ["brandgroup","page"],
            ["brandgroupchild","page"],
            ["brandgroupchildproperty","page"],
            ["ageseason","page"],
            ["colortemplate","page"],
            ["sizetop","page"],
            ["sizecontent","page"],
            ["ulnarinch","page"],
            ["material","page"],
            ["warehouse","page"],
            ["country","page"],
            ["saleport","page"],
            ["supplier","page"],
            ["order","page"],
            ["order","loadorder"],
            ["confirmorder","loadorder"],
            ["confirmorder","page"],
            ["warehousing","page"],
            ["warehousing","load"],
            ["requisition","page"],
            ["requisition","load"],
            ["requisition","confirmout"],
            ["requisition","confirmin"],
            ["productstock","search"],
            ["permission","tree"],
            ["user","saleportlist"],
            ["sales","page"],
            ["sales","loadsale"],
            ["product","getproperties"],
            ["product","picture"],
            ["product","getcolorgrouplist"],
            ["product","codelist"],
            ["product","search"],
            ['aliases','page'],
            ['series','page'],
            ['warehouse','userlist'],
            ['series2','page'],
            ['productmemo', 'page'],
            ['companyinvoice', 'page'],
            ['company', 'info']
        ];
    }

    public static function getPublicResourse() {
        return [
            ["index", 'index'],
            ['login', 'login'],
            ["login","logout"],
            ['login', 'checklogin'],
            ['common', 'systemlanguage']
        ];
    }


    /**
     * 把图片转换成对应的分辨率，都是正方形格式的
     * @param $filepath 图片的绝对路径，比如：/www/wwwroot/www.jinxiaocun.com/erp/public/upload/product/model4.jpg
     * @param $resizeArray 分辨率数组，例如[80, 200]，代表裁剪为两组分辨率，分别是80*80、200*200，路径保存在和原来的图片相同的目录下
     * @throws \Exception
     */
    public static function convertPics($filepath, $resizeArray)
    {
        // 逻辑
        // 首先获取图片的参数
        $pathinfo = pathinfo($filepath);
        foreach ($resizeArray as $resize) {
            // 开始处理
            Image::open($filepath)
                ->resize($resize, $resize)
                ->save(dirname($filepath).'/'.$pathinfo['basename'].'_'.$resize.'x'.$resize.'.'.$pathinfo['extension']);
        }
    }
}