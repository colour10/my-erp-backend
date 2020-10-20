<?php

namespace Asa\Erp;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Endroid\QrCode\QrCode;
use Gregwar\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Multiple\Home\Controllers\OmsController;
use Multiple\Home\Controllers\ProductstockController;
use Phalcon\Di;
use Phalcon\Http\Response;
use Phalcon\Logger\Adapter\File;
use PHPExcel;
use PHPExcel_Cell;
use PHPExcel_Exception;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Exception;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_MemoryDrawing;
use PHPMailer\PHPMailer\PHPMailer;
use ZipArchive;

/**
 * 工具类
 *
 * Class Util
 * @package Asa\Erp
 */
class Util
{
    /**
     * 格式化为目录树
     *
     * @param array $result 结果集
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
                        'id'       => $v['id'],
                        'label'    => $v['name'],
                        'memo'     => $v['memo'],
                        'level'    => $level,
                        'pid'      => $pid,
                        'children' => [],
                    ];
                } else {
                    $tree[] = [
                        'id'       => $v['id'],
                        'label'    => $v['name'],
                        'memo'     => $v['memo'],
                        'level'    => $level,
                        'pid'      => $pid,
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
     *
     * @param array $result 结果集
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
                    'id'    => $v['id'],
                    'label' => str_repeat($str_repeat, $level) . $v['name'],
                    'memo'  => $v['memo'],
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
     *
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
     *
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
     *
     * @param string $str 字符串
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
     *
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
     *
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
     *
     * @param $list
     * @param $column
     * @return array
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
     *
     * @param $list
     * @param $columnKey
     * @param string $columnValue
     * @return array
     */
    public static function recordToHashtable($list, $columnKey, $columnValue = '')
    {
        $array = [];
        foreach ($list as $key => $value) {
            $array[$value->$columnKey] = $columnValue == '' ? $value : $value->$columnValue;
        }
        return $array;
    }

    /**
     * 定义登录用户拥有的权限。
     *
     * @return array [type] [description]
     */
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
            ['productbase', 'suggest'],
        ];
    }

    /**
     * 公共权限
     *
     * @return array
     */
    public static function getPublicResourse()
    {
        return [
            ["index", 'index'],
            ['login', 'login'],
            ["login", "logout"],
            ['login', 'checklogin'],
            ['common', 'systemlanguage'],
            ['common', 'setting'],

        ];
    }


    /**
     * 把图片转换成对应的分辨率，都是正方形格式的
     *
     * @param string $filepath 图片的绝对路径，比如：/www/wwwroot/www.jinxiaocun.com/erp/public/upload/product/model4.jpg
     * @param array $resizeArray 分辨率数组，例如[80, 200]，代表裁剪为两组分辨率，分别是80*80、200*200，路径保存在和原来的图片相同的目录下
     * @param string $type
     * @param int $quality
     * @throws \Exception
     */
    public static function convertPics(string $filepath, array $resizeArray, $type = 'jpg', $quality = 80)
    {
        // 逻辑
        // 首先获取图片的参数
        $pathInfo = pathinfo($filepath);
        foreach ($resizeArray as $resize) {
            // 开始处理
            Image::open($filepath)
                ->resize($resize, $resize)
                ->save(dirname($filepath) . '/' . $pathInfo['basename'] . '_' . $resize . 'x' . $resize . '.' . $type, $type, $quality);
        }
    }


    /**
     * 导入带图片格式的excel，即使是每一列含有多张图片也没有问题
     *
     * @param $excelFilePath -excel文件的绝对路径
     * @param $pictureSaveFolder -图片保存的文件夹，具体是指/public/upload下面的具体文件夹名称，比如product
     * @return array|bool
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
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
        $inputFileType = PHPExcel_IOFactory::identify($excelFilePath);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        // 载入文件
        $objPHPExcel = $objReader->load($excelFilePath);
        // 取出数据
        $datas = $objPHPExcel->getSheet(0);

        // 先处理图片
        $AllImages = $datas->getDrawingCollection();
        foreach ($AllImages as $drawing) {
            // xls和xlsx对于图片处理有着不同的逻辑，所以要进行分别处理
            // 如果是xls
            if ($drawing instanceof PHPExcel_Worksheet_MemoryDrawing) {
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

            // 如果是 xlsx
            if ($drawing instanceof PHPExcel_Worksheet_Drawing) {
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
     *
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
     *
     * @param array $title
     * @param array $data
     * @param string $fileName
     * @param string $savePath
     * @param bool $isDown
     * @return string
     * @throws PHPExcel_Exception
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
            foreach ($title as $v) {
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
                        $img = new PHPExcel_Worksheet_Drawing();
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
        $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel5');

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

    /**
     * 一维关联数组转成多维关联数组
     * @param array $array
     * @return array
     */
    public static function simplearray_to_multiarray(array $array)
    {
        $return = [];
        foreach ($array as $key => $item) {
            // 判断是否有|，如果有就切割
            if (strpos($item, '|') !== false) {
                // 开始遍历
                $rpos = strrpos($item, '|');
                $left = substr($item, 0, $rpos);
                $right = substr($item, $rpos + 1);
                // 分隔left
                $keys = explode('|', $left);
                $current_str = '';
                foreach ($keys as $j => $key) {
                    // 依次生成当前的元素
                    // 当前循环元素
                    $current_str .= '[' . "'$key'" . ']';
                }
                // 使用神器eval进行智能拼接
                eval("\$return $current_str = \$right;");
            } else {
                $return[$key] = $item;
            }
        }
        // 返回
        return $return;
    }

    /**
     * 文件批量打包导出，并通过浏览器下载
     * 前台参考演示模板路径：/app/shop/views/temp/exportfiles.phtml
     *
     * 调用方法：(仅供参考，因为考虑到有可能导出文件列表较多，所以用post传输)
     * if ($this->request->isPost()) {
     * // 获得文件列表
     * $json_files = $this->request->get('files');
     * // 开始导出
     * self::exportFiles($json_files);
     * }
     *
     * @param string $json_files 一个前台经过JSON.stringify处理过的json字符串，需要转成数组遍历
     */
    public static function exportFiles(string $json_files)
    {
        // 逻辑
        // 如果是json，则把传过来的json字符串转成数组
        if (self::is_json($json_files)) {
            $files = json_decode($json_files, true);
        }

        // 判断是否需要转成绝对路径，如果不是绝对路径，那么就进行转换
        if (strpos($json_files, APP_PATH) === false) {
            foreach ($files as $k => $file) {
                $files[$k] = APP_PATH . '/public/' . $file;
            }
        }

        // 定义一个压缩文件名
        $zipname = APP_PATH . "/public/tempExportFiles.zip";
        // 执行压缩逻辑
        $zip = new ZipArchive();
        $res = $zip->open($zipname, ZipArchive::CREATE);
        if ($res === TRUE) {
            foreach ($files as $file) {
                //这里直接用原文件的名字进行打包，也可以直接命名，需要注意如果文件名字一样会导致后面文件覆盖前面的文件，所以建议重新命名
                $new_filename = substr($file, strrpos($file, '/') + 1);
                $zip->addFile($file, $new_filename);
            }
            //关闭文件
            $zip->close();
            //这里是下载zip文件
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: Binary");

            header("Content-Length: " . filesize($zipname));
            header("Content-Disposition: attachment; filename=\"" . basename($zipname) . "\"");

            readfile($zipname);
            exit;
        }
    }

    public static function filterIds($ids)
    {
        $array = explode(",", $ids);

        $result = [];
        foreach ($array as $row) {
            $result[] = (int)$row;
        }
        return implode(",", $result);
    }

    /**
     * 求两个日期之间相差的天数
     * (针对1970年1月1日之后，求之前可以采用泰勒公式)
     * @param string $day1
     * @param string $day2
     * @return number
     */
    public static function diffBetweenTwoDays(string $day1, string $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

    /**
     * 获取当前数组最大值的键名
     * @param array $array
     * @return mixed
     */
    public static function getArrayMaxKey(array $array)
    {
        // 逻辑
        // 先取出最大值
        // 如果数组为空，那么就为null
        if (!$array) {
            return null;
        }
        $max = max($array);
        // 翻转数组，键名键值互换
        $flip = array_flip($array);
        // 最终返回
        return $flip[$max];
    }

    /**
     * 加密、解密字符串
     * ENCODE为加密，DECODE为解密
     *
     * @param string $string 待处理字符串
     * @param string $action 操作，ENCODE|DECODE
     * @return string
     * @global array $pwServer
     * @global string $db_hash
     */
    public static function strCode(string $string, $action = 'ENCODE')
    {
        $action != 'ENCODE' && $string = base64_decode($string);
        $code = '';
        $key = substr(md5($_SERVER['HTTP_USER_AGENT']), 8, 18);
        $keyLen = strlen($key);
        $strLen = strlen($string);
        for ($i = 0; $i < $strLen; $i++) {
            $k = $i % $keyLen;
            $code .= $string[$i] ^ $key[$k];
        }
        return ($action != 'DECODE' ? base64_encode($code) : $code);
    }


    /**
     * 功能函数 - 发送email
     *
     * @param string $toemail 要发送到的email地址, 多个使用一维数组即可;
     * @param string $subject email标题
     * @param string $body email主体内容
     * @return bool
     */
    public static function sendEmail(string $toemail, string $subject, string $body)
    {
        //示例化PHPMailer核心类
        //vendor模式
        $mail = new PHPMailer();
        //nameplace 模式;
        //$mail = new \LaneLead\PHPMailer\PHPMailer();
        //读取config配置文件
        $config = require APP_PATH . '/app/config/config.php';
        $email_config = $config['email_config'];

        //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 0;

        //使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
        //可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
        $mail->isSMTP();
        //加密方式 "ssl" or "tls"
        $mail->SMTPSecure = $email_config['secure']; //这里要注意, QQ发送邮件使用的ssl方式,如果不设置, 则会失败! 请认真查看下面的配置文件!!!
        //smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;
        //链接qq域名邮箱的服务器地址
        $mail->Host = $email_config['host'];
        //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
        $mail->Port = $email_config['port'];
        //smtp登录的账号 这里填入字符串格式的qq号即可
        $mail->Username = $email_config['username'];
        //smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
        $mail->Password = $email_config['psw'];
        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        $mail->From = $email_config['From'];
        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = $email_config['FromName'];

        //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
        $mail->CharSet = 'UTF-8';
        //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
        $mail->isHTML(true);
        //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
        // 添加收件人地址，可以多次使用来添加多个收件人
        if (is_array($toemail)) {
            foreach ($toemail as $to_email) {
                $mail->AddAddress($to_email);
            }
        } else {
            $mail->AddAddress($toemail);
        }
        //添加该邮件的主题
        $mail->Subject = $subject;
        //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
        $mail->Body = $body;
        //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
        //$mail->addAttachment('./d.jpg','mm.jpg');
        //同样该方法可以多次调用 上传多个附件
        //$mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
        //dump($mail);exit;

        //发送命令 返回布尔值
        //PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
        try {
            //简单的判断与提示信息
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 手动刷新阿里云cdn缓存
     *
     * @param string|array $path 文件列表，里面的链接必须是完整的路径（包含http://或者https://）
     * @return mixed
     * @throws ClientException
     */
    public static function refreshAliyunCdnCaches($path)
    {
        // 逻辑
        // 配置文件初始化
        $config = require APP_PATH . '/app/config/config.php';
        $alibabacloud = $config['alibabacloud'];
        $accessKeyId = $alibabacloud['accessKeyId'];
        $accessKeySecret = $alibabacloud['accessKeySecret'];

        // 参数列表
        // 文件列表必须有值
        if (empty($path)) {
            return false;
        }
        // path必须是文件或者数组格式
        if (!is_string($path) && !is_array($path)) {
            return false;
        }
        // 判断是文件夹还是文件，如果每个链接后面都有/则为目录，否则为文件
        if (is_array($path)) {
            $type = self::isFileOrDirectory($path[0]);
            // api中要求每个链接地址用"\n"或者"\r\n"分割
            $path = implode("\n", $path);
        } else {
            $type = self::isFileOrDirectory($path);
        }

        // 首先关闭错误提示
        self::closeDisplayErrors();

        // api
        AlibabaCloud::accessKeyClient($accessKeyId, $accessKeySecret)
            ->regionId('cn-hangzhou')// replace regionId as you need
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Cdn')
                // ->scheme('https') // https | http
                ->version('2018-05-10')
                ->action('RefreshObjectCaches')
                ->method('POST')
                ->options([
                    'query' => [
                        'ObjectPath' => $path,
                        'ObjectType' => $type,
                    ],
                ])
                ->request();
            if ($result = $result->toArray()) {
                return true;
            } else {
                return false;
            }
        } catch (ClientException $e) {
            return false;
        } catch (ServerException $e) {
            return false;
        }
    }

    /**
     * 判断一个网络路径是文件还是文件夹，如果最后一个字符是/，那么就是文件夹，否则就是文件
     * @param string|array $path 文件路径
     * @return string
     */
    public static function isFileOrDirectory($path)
    {
        // 逻辑
        if (substr($path, -1, 1) === '/') {
            return 'Directory';
        }
        // 否则返回 File
        return 'File';
    }

    /**
     * 递归创建文件夹
     * @param $dir
     * @return bool
     */
    public static function Directory($dir)
    {
        return is_dir($dir) or self::Directory(dirname($dir)) and mkdir($dir, 0777);
    }

    /**
     * 根据ID逗号分隔符查出对应的文字项，给出友好提示
     *
     * @param $model -模型字符串，比如TbProduct::class
     * @param $ids -id列表，每个id之间以逗号分隔
     * @param $displayFields -要显示的字段
     * @return array|string
     */
    public static function getCommasValues($model, $ids, array $displayFields = [])
    {
        // 逻辑
        // 如果$ids值为0或者空，那么就返回空
        if (empty($ids)) {
            return '';
        }
        // 首先把$ids按照逗号进行切割
        $ids_array = explode(',', $ids);
        // 保存最终的返回值
        $return = [];
        // 开始循环
        foreach ($ids_array as $id) {
            // 如果模型为空
            $modelResult = $model::findFirstById($id);
            if (!$modelResult) {
                // 跳出当前循环
                continue;
            }
            if (empty($displayFields)) {
                $return[] = $modelResult->toArray();
            } else {
                // 循环字段显示
                // 如果$displayFields有值，那么每次循环过后都保存到一个临时变量中
                $temp = '';
                foreach ($displayFields as $field) {
                    $temp .= $modelResult->$field;
                }
                // 赋值
                $return[] = $temp;
            }
        }
        // 根据传入的字段返回结果
        if (empty($displayFields)) {
            return $return;
        } else {
            return implode(',', $return);
        }
    }

    /**
     * 生成一个随机字符串
     *
     * @return string
     */
    public static
    function generate_trade_no()
    {
        // 逻辑
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    /**
     * 生成UUID
     * @param string $prefix 前缀
     * @return string UUID，//可以指定前缀
     */
    public static function create_uuid($prefix = "")
    {    //可以指定前缀
        $str = md5(uniqid(mt_rand(), true));
        $uuid = substr($str, 0, 8);
        $uuid .= substr($str, 8, 4);
        $uuid .= substr($str, 12, 4);
        $uuid .= substr($str, 16, 4);
        $uuid .= substr($str, 20, 12);
        return $prefix . $uuid;
    }

    /**
     * 关闭错误提示
     */
    public static function closeDisplayErrors()
    {
        // 逻辑
        ini_set('display_errors', 'Off');
        error_reporting(0);
    }


    /**
     * 生成二维码图片
     * @param string $content 二维码内容
     * @return Response
     */
    public static function createQrcode($content)
    {
        // 逻辑
        // 把要转换的字符串作为 QrCode 的构造函数参数
        $qrCode = new QrCode($content);

        // 将生成的二维码图片数据以字符串形式输出，并带上相应的响应类型
        $response = new Response();
        $response->setStatusCode(200);
        $response->setContentType($qrCode->getContentType());
        $response->setContent($qrCode->writeString());
        $response->send();
        return $response;
    }

    /**
     * 通知商品库存发生变化
     *
     * @param  [type] $productid   [description]
     * @return void [type]              [description]
     */
    public static function sendStockChange($productid)
    {
        $config = Di::getDefault()->get("config");

        // 写日志
        $filename = $config->app->log_path . sprintf("productstock_%s.log", date('Ymd'));
        if (file_exists($filename)) {
            touch($filename);
            chmod($filename, 0777);
        }
        $logger = new File($filename);

        // 通过 nodejs 同步库存
        $url = sprintf("%s/productstock/change/%d", $config->productstock_service->server, $productid);
        $response = file_get_contents($url);
        if ($response == '1') {
            $logger->info($productid . '');
        } else {
            $logger->error($productid . '');
        }

        // 向 oms 发送库存同步
        $productstockController = new ProductstockController();
        // 如果不为空，说明已经登录，那么就向 oms 发送库存更新
        $StockInOutDetail = $productstockController->getSizecontentsNumForOmsAction($productid);
        // 记录下库存情况
        error_log("\$StockInOutDetail = " . print_r($StockInOutDetail, true));
        // 开始发送
        if ($StockInOutDetail) {
            $omsController = new OmsController();
            $omsController->stockupdateAction($StockInOutDetail);
        }
    }

    /**
     * 判断一个远程文件是否存在
     * @param $url
     * @return bool
     */
    public static function isRemoteFileExist($url)
    {
        // 逻辑
        $curl = curl_init($url);
        // 不取回数据
        curl_setopt($curl, CURLOPT_NOBODY, true);
        // 发送请求
        $result = curl_exec($curl);
        $found = false;
        // 如果请求没有发送失败
        if ($result !== false) {
            // 再检查http响应码是否为200
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($statusCode == 200) {
                $found = true;
            }
        }
        curl_close($curl);
        // 返回结果
        return $found;
    }

    /**
     * 检测图片url是否存在，如果不存在则返回默认的图片
     * @param string $url 一个图片的url地址
     * @return string
     */
    public static function getCorrentImgUrl($url)
    {
        // 逻辑
        if (!self::isRemoteFileExist($url)) {
            return '/imgs/none.png';
        }
        // 否则就返回原网址
        return $url;
    }

    /**
     * 判断一个变量是否为正整数
     *
     * @param $val
     * @return bool
     */
    public static function isPositiveInteger($val)
    {
        if (preg_match("/^[1-9][0-9]*$/", $val)) {
            return true;
        }
        return false;
    }

    /**
     * 以$groupby字段作为分组条件，并把二维数组合并为一维数组
     *
     * @param array $datas 二维数组
     * @param string $groupby 分组字段
     * @param array $mustBeDisplayFields 所有需要展示的字段数组，这些都是共用的，保持原样即可
     * @param array $totalFields 需要累计做加法的字段数组
     * @param array $concatFields 需要合并的字段数组，默认返回值用逗号隔开，里面可以放一级数组和二级数组
     * @param array $specialConcatFields 需要做特殊合并处理的字段，里面包含名称以及拼接规则, name代表对外显示的新字段名称，fields代表所有需要拼接的字段， connector代表拼接之后的连接符 ['name' => 'specialConcat', 'fields' => ['field1', 'field2', 'field3'], 'connector' => ';']
     * @return array
     */
    public static function getGroupArray(array $datas, $groupby, array $mustBeDisplayFields = [], array $totalFields = [], array $concatFields = [], $specialConcatFields = [])
    {
        // 逻辑
        $return = [];
        // 一级数组组装数据
        foreach ($datas as $k => $data) {
            // 首先处理 $specialConcatFields 需要做特殊合并处理的字段
            $returnSpecialConcatFields = self::getSpecialConcatFields($data, $specialConcatFields);
            // 判断是否存在了数据
            if (!isset($return[$data[$groupby]])) {
                // 必显字段压入新数组
                foreach ($mustBeDisplayFields as $displayField) {
                    $return[$data[$groupby]][$displayField] = $data[$displayField];
                }
                // $specialConcatFields也进行填入
                foreach ($returnSpecialConcatFields as $field => $value) {
                    $return[$data[$groupby]][$field] = $value;
                }
            } else {
                // 数字类型进行累计
                foreach ($totalFields as $field) {
                    $return[$data[$groupby]][$field] += $data[$field];
                }
                // $specialConcatFields也进行填入
                foreach ($returnSpecialConcatFields as $field => $value) {
                    $return[$data[$groupby]][$field] .= ';' . $value;
                }
            }
            // 需要合并的字段如果存在了，那就直接用逗号连接起来
            foreach ($concatFields as $concatField) {
                // 需要判断是否存在这个concat字段，如果存在就汇总，并且不能为空
                if (!empty($data[$concatField])) {
                    if (isset($return[$data[$groupby]][$concatField])) {
                        if (strpos($return[$data[$groupby]][$concatField], $data[$concatField]) === false) {
                            $return[$data[$groupby]][$concatField] .= ',' . $data[$concatField];
                        }
                        // 统计里面的元素个数
                        $return[$data[$groupby]][$concatField . '_count'] = self::getCountByComma($return[$data[$groupby]][$concatField]);
                    }
                }
            }

            // 详情页，把相同的记录放在 details
            $return[$data[$groupby]]['details'][] = $data;
        }
        // 返回，key还原
        return array_values($return);
    }

    /**
     * 取出用逗号分隔的元素个数
     * @param string $str 待处理字符串
     * @return int
     */
    public static function getCountByComma($str)
    {
        // 逻辑
        $array = explode(',', $str);
        return count($array);
    }

    /**
     * 处理特殊拼接的字段列表
     *
     * @param array $data 原数据
     * @param array specialConcatFields 需要做特殊合并处理的字段，里面包含名称以及拼接规则, name代表对外显示的新字段名称，fields代表所有需要拼接的字段， connector代表拼接之后的连接符 ['name' => 'specialConcat', 'fields' => ['field1', 'field2', 'field3'], 'connector' => ',']
     * @return array
     */
    public static function getSpecialConcatFields(array $data, array $specialConcatFields)
    {
        // 逻辑
        $returnSpecialConcatFields = [];
        // 如果有特殊拼接的字段，那么也先放在这里处理
        foreach ($specialConcatFields as $specialConcatField) {
            // 遍历 $specialConcatField 中的 name、 fields、connector 字段, 如果缺少了，则报错
            if (!isset($specialConcatField['name']) || !isset($specialConcatField['fields']) || !isset($specialConcatField['connector'])) {
                return [];
            }
            // 存在则继续遍历
            foreach ($specialConcatField['fields'] as $f => $field) {
                if ($f == 0) {
                    // 第一个元素直接赋值
                    $returnSpecialConcatFields[$specialConcatField['name']] = $data[$field];
                } else {
                    // 其余的用连接
                    $returnSpecialConcatFields[$specialConcatField['name']] .= $specialConcatField['connector'] . $data[$field];
                }
            }
        }
        // 返回结果
        return $returnSpecialConcatFields;
    }

    /**
     * 去除多维数组中的重复值
     *
     * @param $arr
     * @return array
     */
    public static function arrayUniqueMulti($arr)
    {
        $t = array_map('serialize', $arr);//利用serialize()方法将数组转换为以字符串形式的一维数组
        $t = array_unique($t);//去掉重复值
        $new_arr = array_map('unserialize', $t);//然后将刚组建的一维数组转回为php值
        return $new_arr;
    }

    /**
     * 把一个二维数组按照里面的键值进行合并和分组，如果相同的字段+相同的值会自动保留一条
     *
     * @param array $datas 二维数组
     * @param string $key 分组后的 key 值
     * @param array $groupByFields 分组字段
     * @param array $sumGroupFields 需要累加的字段
     * @return array
     */
    public static function getArrayGroupResult(array $datas, string $key = '', array $groupByFields = [], array $sumGroupFields = [])
    {
        // 逻辑
        $return = [];
        // 遍历
        foreach ($datas as $k => $data) {
            if (!isset($return[$data[$key]])) {
                // 首先进行全部赋值
                $return[$data[$key]] = $data;
                // 如果分组统计字段存在，则按照分组字段进行汇总
                foreach ($groupByFields as $groupByField) {
                    $return[$data[$key]][$groupByField] = [$data[$groupByField]];
                }
                // 如果累加存在，则赋值
                foreach ($sumGroupFields as $groupField) {
                    $return[$data[$key]][$groupField] = $data[$groupField];
                }
            } else {
                // 如果分组统计字段存在，则按照分组字段进行汇总
                foreach ($groupByFields as $groupByField) {
                    $return[$data[$key]][$groupByField][] = $data[$groupByField];
                }
                // 如果累计存在，则进行累计
                foreach ($sumGroupFields as $groupField) {
                    $return[$data[$key]][$groupField] += $data[$groupField];
                }
            }
        }
        // 返回
        return $return;
    }

    /**
     * 导入不含图片的 excel 格式
     *
     * @param $excelFilePath -Excel路径
     * @return array|false
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    public static function importExcelWithoutPictures($excelFilePath)
    {
        // 逻辑
        // 使用 PHPExcel_IOFactory 来鉴别文件应该使用哪一个读取类
        $inputFileType = PHPExcel_IOFactory::identify($excelFilePath);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType); // 2003版本-Excel5; 2007版本-Excel2007
        $objPHPExcel = $objReader->load($excelFilePath);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();

        // 在导入时，启动行号为1，第1行为标题，第2行开始为数据
        // 如果没有数据
        if ($highestRow <= 1) {
            return false;
        }

        // 有数据继续进行
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
        $data_res = [];
        //注意下面以$row=2开始，在导入时，启动行号为1，第1行为标题，第2行开始为数据
        for ($row = 2; $row <= $highestRow; $row++) {
            $strs = [];
            //注意highestColumnIndex的列数索引从0开始
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $strs[$col] = trim($objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
            }
            array_push($data_res, $strs);
        }

        // unlink($excelFilePath);   //删除上传的文件
        // 返回，并删除空值
        $datas = json_decode(json_encode($data_res), true);
        foreach ($datas as $k => $data) {
            $datas[$k] = array_filter($data);
        }
        return array_filter($datas);
    }

    /**
     * 找出两个字符串之间的交集
     *
     * @param string $str1
     * @param string $str2
     * @return bool
     */
    public static function stringDiff(string $str1, string $str2)
    {
        // 逻辑
        // 初始化一个变量
        $result = false;
        for ($i = 0; $i < mb_strlen($str1); $i++) {
            // 当前外层元素
            $currentStr1 = mb_substr($str1, $i, 1);
            for ($j = 0; $j < mb_strlen($str2); $j++) {
                // 当前内层元素
                $currentStr2 = mb_substr($str2, $j, 1);
                // 如果相等，说明找到了
                if ($currentStr2 == $currentStr1) {
                    $result = true;
                    break;
                }
            }
        }
        // 返回
        return $result;
    }

    /**
     * 下载远程图片
     *
     * @param string $url
     * @return false|string
     */
    public static function downloadImage(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        $file = curl_exec($ch);
        curl_close($ch);

        // 取出文件名，使用默认的文件名，方便后续的判断
        $pathinfo = pathinfo($url);
        $filename = md5(uniqid(time() . mt_rand(1000, 9999))) . '.' . $pathinfo['extension'];
        // 取出文件大小
        $filesize = self::getRemoteFilesize($url);
        // 最终文件路径
        $filepath = APP_PATH . '/public/upload/product/' . $filename;
        // 如果文件存在，则不再重复下载，节省对方服务器资源
        if (is_file($filepath) && getimagesize($filepath)) {
            // 文件存在，说明之前也是下载成功了，这个时候就返回 文件名
            return $filename;
        }

        // 如果图片不存在，则继续往下执行
        $resource = @fopen($filepath, 'a');
        // 这里的$return返回写入文件的大小
        $return = fwrite($resource, $file);
        fclose($resource);

        // 如果$return和原始图片大小一致，那么则认为下载完毕，返回成功
        // 但是如果远程图片大小为0，或者图片不存在，也有可能网络超时，我们这里只判断大小大于0才算成功
        if ($return == $filesize && $filesize > 0) {
            return $filename;
        }

        // 否则就是下载失败，返回 false
        return false;
    }

    /**
     * 通过 curl 获取一个远程文件的大小(字节数)
     *
     * @param string $uri 远程文件地址
     * @param string $user
     * @param string $pw
     * @return bool|string
     */
    public static function getRemoteFilesize(string $uri, $user = '', $pw = '')
    {
        // start output buffering
        ob_start();
        // initialize curl with given uri
        $ch = curl_init($uri);
        // make sure we get the header
        curl_setopt($ch, CURLOPT_HEADER, 1);
        // make it a http HEAD request
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        // if auth is needed, do it here
        if (!empty($user) && !empty($pw)) {
            $headers = ['Authorization: Basic ' . base64_encode($user . ':' . $pw)];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $okay = curl_exec($ch);
        curl_close($ch);
        // get the output buffer
        $head = ob_get_contents();
        // clean the output buffer and return to previous
        // buffer settings
        ob_end_clean();

        // gets you the numeric value from the Content-Length
        // field in the http header
        $regex = '/Content-Length:\s([0-9].+?)\s/';
        $count = preg_match($regex, $head, $matches);

        // if there was a Content-Length field, its value
        // will now be in $matches[1]
        if (isset($matches[1])) {
            $size = $matches[1];
        } else {
            // 找不到，则为0
            $size = 0;
        }
        // $last=round($size/(1024*1024),3);
        // return $last.' MB';
        return $size;
    }

    /**
     * 制作正方形图片，同时保留原来的路径和图片名称
     *
     * @param string $src_file 图片路径
     * @param int $width 宽度
     * @param int $height 高度
     * @return false|void
     */
    public static function resizeImage(string $src_file, $width = 40, $height = 40)
    {
        // 逻辑
        // 取出图片的高度，如果图片不存在，则直接退出
        if (!$size = getimagesize($src_file)) {
            return false;
        }
        // 存在则继续
        // 修改指定图片的大小
        $img = ImageManagerStatic::make($src_file)->resize($width, $height);
        // 取出图片大小
        $filesize = ceil(filesize($src_file) / 1024);
        // 将处理后的图片重新保存到其他路径
        // 临时图片路径
        $pathinfo = pathinfo($src_file);
        $dst_file = $pathinfo['dirname'] . '/' . md5($pathinfo['filename'] . '_' . uniqid(time() . mt_rand(10000, 99999))) . '.' . $pathinfo['extension'];
        $img->save($dst_file, self::setQuality($filesize));
        // 返回新文件的路径，只保留 product/1.jpg 这样的格式
        $pathinfo = pathinfo($dst_file);
        $endPos = strrpos($pathinfo['dirname'], '/');
        return substr($dst_file, $endPos + 1);
    }

    /**
     * 设置图片压缩质量
     *
     * @param string $filesize 单位KB
     * @return float|int
     */
    public static function setQuality(string $filesize)
    {
        // 逻辑
        // 如果$filesize小于100K的话，无需压缩
        if ($filesize > 500) {
            $rate = 40;
        } else if ($filesize > 400) {
            $rate = 45;
        } else if ($filesize > 300) {
            $rate = 50;
        } else if ($filesize > 200) {
            $rate = 55;
        } else if ($filesize > 100) {
            $rate = 60;
        } else {
            $rate = 90;
        }
        // 返回
        return $rate;
    }

    /**
     * 获取远程图片的宽高和体积大小
     *
     * @param string $url 远程图片的链接
     * @param string $type 获取远程图片资源的方式, 默认为 curl 可选 fread
     * @param boolean $isGetFilesize 是否获取远程图片的体积大小, 默认false不获取, 设置为 true 时 $type 将强制为 fread
     * @return false|array
     */
    public static function myGetImageSize(string $url, $type = 'curl', $isGetFilesize = false)
    {
        // 定义一个空数组
        $result = [];
        // 若需要获取图片体积大小则默认使用 fread 方式
        $type = $isGetFilesize ? 'fread' : $type;
        if ($type == 'fread') {
            // 或者使用 socket 二进制方式读取, 需要获取图片体积大小最好使用此方法
            $handle = fopen($url, 'rb');
            if (!$handle) {
                return false;
            }
            // 只取头部固定长度168字节数据
            $dataBlock = fread($handle, 168);
        } else {
            // 据说 CURL 能缓存DNS 效率比 socket 高
            $ch = curl_init($url);
            // 超时设置
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            // 取前面 168 个字符 通过四张测试图读取宽高结果都没有问题,若获取不到数据可适当加大数值
            curl_setopt($ch, CURLOPT_RANGE, '0-167');
            // 跟踪301跳转
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            // 返回结果
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $dataBlock = curl_exec($ch);
            curl_close($ch);
            if (!$dataBlock) {
                return false;
            }
        }
        // 将读取的图片信息转化为图片路径并获取图片信息,经测试,这里的转化设置 jpeg 对获取png,gif的信息没有影响,无须分别设置
        // 有些图片虽然可以在浏览器查看但实际已被损坏可能无法解析信息
        //$size = getimagesize('data://image/jpeg;base64,' . base64_encode($dataBlock));
        $size = @getimagesize($url);

        if (empty($size)) {
            return false;
        }
        $result['width'] = $size[0];
        $result['height'] = $size[1];
        $result['img_type'] = $size['mime'];
        // 是否获取图片体积大小
        if ($isGetFilesize) {
            // 获取文件数据流信息
            $meta = stream_get_meta_data($handle);
            // nginx 的信息保存在 headers 里，apache 则直接在 wrapper_data
            $dataInfo = isset($meta['wrapper_data']['headers']) ? $meta['wrapper_data']['headers'] : $meta['wrapper_data'];
            foreach ($dataInfo as $va) {
                if (preg_match('/length/iU', $va)) {
                    $ts = explode(':', $va);
                    $result['size'] = trim(array_pop($ts));
                    break;
                }
            }
        }
        if ($type == 'fread') {
            fclose($handle);
        }
        // 返回
        return $result;
    }

    /**
     * 制作 800*800 图片，同时保留原来的路径和图片名称
     *
     * @param string $src_file 图片路径
     * @return void
     */
    public static function makeImage(string $src_file)
    {
        // 逻辑
        // 取出图片的高度，如果图片不存在，则直接退出
        if (!$size = getimagesize($src_file)) {
            return;
        }
        // 存在则继续
        $width = $size[0];
        $height = $size[1];
        // 如果宽度不是800，那么就先压缩到800px
        if ($width > 800) {
            $new_width = 800;
            $new_height = intval($height * 800 / $width);
            ImageManagerStatic::make($src_file)->resize($new_width, $new_height)->save($src_file);
        }
        // 设置1067*1067的透明画布
        $img = ImageManagerStatic::canvas($height, $height, '#ffffff');
        // 设置居中位置
        $width = intval(($height - 800) / 2);
        // 插入图片
        $img->insert($src_file, 'top-left', $width, 0);
        // 图片裁剪
        $img->resize(800, 800);
        // 取出图片大小
        $filesize = ceil(filesize($src_file) / 1024);
        // 处理图片
        // 临时图片路径
        $pathinfo = pathinfo($src_file);
        $dst_file = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_' . uniqid(time() . mt_rand(10000, 99999)) . '.' . $pathinfo['extension'];
        $img->save($dst_file, self::setQuality($filesize));
        // 删除原图片
        @unlink($src_file);
        // 同时把新文件修改回原来的名称
        @rename($dst_file, $src_file);
    }

    /**
     * 根据一个文件名的路径返回一个随机文件名
     *
     * @param $url
     * @return string
     */
    public static function getRandFileName($url)
    {
        // 逻辑
        $pathinfo = pathinfo($url);
        return md5(uniqid(time() . mt_rand(1000, 9999))) . '.' . $pathinfo['extension'];
    }

    /**
     * 自定义加解密函数
     *
     * @param $string
     * @param $operation
     * @param string $key
     * @return false|string|string[]
     * 加密：encrypt($str, 'E', $key);
     * 解密：encrypt($str, 'D', $key);
     */
    public static function encrypt($string, $operation, $key = '')
    {
        $key = md5($key);
        $key_length = strlen($key);
        $string = $operation == 'D' ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $randKey = $box = [];
        $result = '';
        for ($i = 0; $i <= 255; $i++) {
            $randKey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $randKey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'D') {
            if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
                return substr($result, 8);
            } else {
                return '';
            }
        } else {
            return str_replace('=', '', base64_encode($result));
        }
    }

}
