<?php

namespace Asa\Erp;

use Gregwar\Image\Image;
use PHPExcel;

class Util
{
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
                        'children' => [],
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
                    'label' => str_repeat($str_repeat, $level) . $v['name'],
                    'memo' => $v['memo'],
                    'level' => $level,
                ];
                // 继续寻找
                $tree = array_merge($tree, self::format_tree_single_array($result, $v['id'], $level + 1));
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
        if (strpos($str, ',') !== false) {
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
    public static function cover_position($str, $length = 6)
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
    public static function recordListColumn($list, $column)
    {
        $array = [];
        foreach ($list as $key => $value) {
            $array[] = $value->$column;
        }
        return $array;
    }

    /**
     * 根据查询到的一个结果集，指定两列，生成哈希表
     */
    public static function recordToHashtable($list, $columnKey, $columnValue = '')
    {
        $array = [];
        foreach ($list as $key => $value) {
            $array[$value->$columnKey] = $columnValue == '' ? $value : $value->$columnValue;
        }
        return $array;
    }

    public static function getAuthResourse()
    {
        return [
            ["user", "modifypassword"],
            ["warehouseuser", "page"],
            ["user", "page"],
            ["product", "page"],
            ["group", "page"],
            ['group', 'getpermissions'],
            ["department", "single"],
            ["department", "departments"],
            ["brand", "page"],
            ["common", "list"],
            ["common", "loadname"],
            ["brandgroup", "page"],
            ["brandgroupchild", "page"],
            ["brandgroupchildproperty", "page"],
            ["ageseason", "page"],
            ["colortemplate", "page"],
            ["sizetop", "page"],
            ["sizecontent", "page"],
            ["ulnarinch", "page"],
            ["material", "page"],
            ["warehouse", "page"],
            ["country", "page"],
            ["saleport", "page"],
            ["supplier", "page"],
            ["order", "page"],
            ["order", "loadorder"],
            ["confirmorder", "loadorder"],
            ["confirmorder", "page"],
            ["warehousing", "page"],
            ["warehousing", "load"],
            ["requisition", "page"],
            ["requisition", "load"],
            ["requisition", "confirmout"],
            ["requisition", "confirmin"],
            ["productstock", "search"],
            ["permission", "tree"],
            ["user", "saleportlist"],
            ["sales", "page"],
            ["sales", "loadsale"],
            ["product", "getproperties"],
            ["product", "picture"],
            ["product", "getcolorgrouplist"],
            ["product", "codelist"],
            ["product", "search"],
            ['aliases', 'page'],
            ['series', 'page'],
            ['warehouse', 'userlist'],
            ['series2', 'page'],
            ['productmemo', 'page'],
            ['companyinvoice', 'page'],
            ['supplierbank', 'page'],
            ['supplierinvoice', 'page'],
            ['currency', 'page'],
            ['company', 'info'],
        ];
    }

    public static function getPublicResourse()
    {
        return [
            ["index", 'index'],
            ['login', 'login'],
            ["login", "logout"],
            ['login', 'checklogin'],
            ['common', 'systemlanguage'],
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
                ->save(dirname($filepath) . '/' . $pathinfo['basename'] . '_' . $resize . 'x' . $resize . '.' . $pathinfo['extension']);
        }
    }


    /**
     * 导入带图片格式的excel，即使是每一列含有多张图片也没有问题
     * @param $excelFilePath excel文件的绝对路径
     * @param $pictureSaveFolder 图片保存的文件夹，具体是指/public/upload下面的具体文件夹名称，比如product
     * @return array|bool
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public static function importExcel($excelFilePath, $pictureSaveFolder)
    {
        // 逻辑
        // 首先创建所需的文件夹
        $imgPath = APP_PATH . '/public/upload/' . $pictureSaveFolder;
        if (!file_exists($imgPath)) {
            mkdir($imgPath);
        }

        // 图片保存逻辑
        // 使用 PHPExcel_IOFactory 来鉴别文件应该使用哪一个读取类
        $inputFileType = \PHPExcel_IOFactory::identify($excelFilePath);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        // 载入文件
        $objPHPExcel = $objReader->load($excelFilePath);
        // 取出数据
        $datas = $objPHPExcel->getSheet(0);

        // 先处理图片
        $AllImages = $datas->getDrawingCollection();
        foreach ($AllImages as $drawing) {
            // xls和xlsx对于图片处理有着不同的逻辑，所以要进行分别处理
            // 如果是xls
            if ($drawing instanceof \PHPExcel_Worksheet_MemoryDrawing) {
                // 原始文件名
                $filename = $drawing->getIndexedFilename();

                // jpeg后缀名处理
                $imgName = substr($filename, 0, strrpos($filename, '.') - 1);
                $imgType = @end(explode(".", $filename));
                // 如果扩展名是jpeg，则修改为jpg
                if ($imgType == 'jpeg') {
                    $img = $imgName . '.jpg';
                } else {
                    $img = $imgName . '.' . $imgType;
                }

                // 把图片保存在服务器中
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                file_put_contents($imgPath . '/' . $img, $imageContents); //把文件保存到本地
                ob_end_clean();

                // 获取当前单元格位置，便于后续操作
                $XY = $drawing->getCoordinates();

                // 把图片的单元格的值设置为最终路径
                $cell = $datas->getCell($XY);
                $cell->setValue($pictureSaveFolder . '/' . $img);
            }

            // 如果是xlsx
            if ($drawing instanceof \PHPExcel_Worksheet_Drawing) {
                // 文件完整路径$filename
                // 类似于：zip:///data/www/xxx/bdac99339.xlsx#xl/media/image2.jpg
                $filename = $drawing->getPath();
                // 文件后缀
                $imgType = @end(explode(".", $filename));
                // 文件名部分
                $imgName = md5(time() . mt_rand(100, 999) . uniqid());
                // 如果扩展名是jpeg，则修改为jpg
                if ($imgType == 'jpeg') {
                    $img = $imgName . '.jpg';
                } else {
                    $img = $imgName . '.' . $imgType;
                }
                // 即将要复制到的文件路径
                copy($filename, $imgPath . '/' . $img);

                // 获取当前单元格位置，便于后续操作
                $XY = $drawing->getCoordinates();

                // 把图片的单元格的值设置为最终路径
                $cell = $datas->getCell($XY);
                $cell->setValue($pictureSaveFolder . '/' . $img);
            }
        }

        // 返回去掉首行excel标题的数组
        return self::unsetFirstArray($datas->toArray());
    }


    /**
     * 返回去掉首行，并且重新组合的数组
     * @param $array
     * @return array|bool
     */
    public static function unsetFirstArray($array)
    {
        // 逻辑
        // 如果是数组
        if (is_array($array)) {
            // 去掉第一行
            unset($array[0]);
            // 重新组装数组
            return array_values($array);
        } else {
            // 不是数组直接返回错误
            return false;
        }
    }

    /**
     * excel导出功能，带图片
     * @param array $title
     * @param array $data
     * @param string $fileName
     * @param string $savePath
     * @param bool $isDown
     * @return string
     * @throws \PHPExcel_Exception
     */
    public static function excelExport($title = [], $data = [], $fileName = '', $savePath = './', $isDown = true)
    {
        // 逻辑
        // 初始化
        $obj = new PHPExcel();

        // 横向单元格标识
        $cellName = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ'];

        // 设置sheet名称，默认为sheet1
        $obj->getActiveSheet()->setTitle('sheet1');

        // 设置默认对齐方式
        $obj->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $obj->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        // 设置纵向单元格标识
        $_row = 1;
        if ($title) {
            // 注释掉最上面一行合并单元格的内容，有需要再恢复
            // $_cnt = count($title);
            // // 合并单元格
            // $obj->getActiveSheet(0)->mergeCells('A'.$_row.':'.$cellName[$_cnt-1].$_row);
            // 设置合并后的单元格内容
            // $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, '数据导出：'.date('Y-m-d H:i:s'));
            // $_row++;
            $i = 0;
            // 设置列标题
            foreach ($title AS $v) {
                $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i] . $_row, $v);
                $i++;
            }
            $_row++;
        }

        // 填写数据
        if ($data) {
            $i = 0;
            foreach ($data as $_v) {
                $j = 0;
                foreach ($_v as $_cell) {
                    $obj->getActiveSheet()->setCellValue($cellName[$j] . ($i + $_row), $_cell);
                    // 设置自动换行
                    $obj->getActiveSheet()->getStyle($cellName[$j] . ($i + $_row))->getAlignment()->setWrapText(TRUE);
                    // 如果数据库含有图片，那么就把图片的地址改为插入图片
                    if (strpos($_cell, 'jpg') !== false || strpos($_cell, 'gif') !== false || strpos($_cell, 'png') !== false) {
                        // 首先修改图片列的单元格宽度和高度
                        // 宽度
                        $obj->getActiveSheet()->getColumnDimension($cellName[$j])->setWidth(16);
                        // 然后修改默认行高和第一行高
                        //设置默认行高
                        $obj->getActiveSheet()->getDefaultRowDimension()->setRowHeight(100);
                        //设置第一行高
                        $obj->getActiveSheet()->getRowDimension(1)->setRowHeight(20);

                        // 然后把图片列的内容清空
                        $obj->getActiveSheet()->setCellValue($cellName[$j] . ($i + $_row), '');
                        // 处理图片显示位置
                        $img = new \PHPExcel_Worksheet_Drawing();
                        $img->setPath(APP_PATH . '/public/upload/' . $_cell);//写入图片路径
                        $img->setHeight(80);//写入图片高度
                        $img->setWidth(80);//写入图片宽度
                        $img->setOffsetX(15);//写入图片在指定格中的X坐标值
                        $img->setOffsetY(15);//写入图片在指定格中的Y坐标值
                        $img->setRotation(1);//设置旋转角度
                        $img->setResizeProportional(false); //默认是按原图像缩放的，设置成false才可以。
                        $img->getShadow()->setVisible(true);//
                        $img->getShadow()->setDirection(50);//
                        $img->setCoordinates($cellName[$j] . ($i + $_row));//设置图片所在表格位置
                        $img->setWorksheet($obj->getActiveSheet());//把图片写到当前的表格中
                    }

                    $j++;
                }
                $i++;
            }
        }

        // 文件名处理
        if (!$fileName) {
            $fileName = uniqid(time(), true);
        }
        $objWrite = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');

        // 网页下载
        if ($isDown) {
            header('pragma:public');
            header("Content-Disposition:attachment;filename=$fileName.xls");
            $objWrite->save('php://output');
            exit;
        }

        // 转码，防止文件名乱码
        $_fileName = iconv("utf-8", "gb2312", $fileName);
        $_savePath = $savePath . $_fileName . '.xls';
        $objWrite->save($_savePath);

        // 返回文件名
        return $savePath . $fileName . '.xls';
    }

    /**
     * 判断数据是否为合法的json字符串
     * @param $data
     * @param bool $assoc
     * @return bool
     */
    public static function is_json($data, $assoc = false)
    {
        // 逻辑
        // 因为json_decode里面放的只要是非string类型就会报错，这个需要加个@强制屏蔽，否则将无法进行下面的验证
        $data = @json_decode($data, $assoc);
        if (($data && (is_object($data))) || (is_array($data) && !empty($data))) {
            return true;
        }
        return false;
    }


    /**
     * 针对配置文件的多维数组转成一维关联数组，每个键名之间默认用.分割
     * @param array $array 待处理的多维数组
     * @param string $key 原来的键值，需要做保留处理
     * @param string $separator 每个键名之间的分隔符，默认是.号
     * @return array
     */
    public static function multiarray_to_assocarray(array $array, $key = '', $separator = '|')
    {
        // 逻辑
        $return = [];
        // 遍历
        foreach ($array as $k => $item) {
            // 判断是否为空决定放不放分隔符
            $current_key = $key == '' ? $k : $key . $separator . $k;
            // 如果仍是数组，则执行自身
            if (is_array($item)) {
                // 把$k键值也要保留并且传递过去，采用相加合并数组，因为要保留数字键名，不可用array_merge
                $return += self::multiarray_to_assocarray($item, $current_key, $separator);
            } else {
                // 非数组则直接输出即可
                $return[$current_key] = $item;
            }
        }
        // 返回
        return $return;
    }

    /**
     * 多维数组转成一维简单数组
     * @param array $array 待处理的多维数组
     * @return array
     */
    public static function multiarray_to_simplearray(array $array)
    {
        // 逻辑
        $return = [];
        $assocarray = self::multiarray_to_assocarray($array);
        foreach ($assocarray as $k => $item) {
            $return[] = $k . '|' . $item;
        }
        return $return;
    }

}