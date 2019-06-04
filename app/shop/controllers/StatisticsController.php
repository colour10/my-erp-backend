<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbAgeseason;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbCompany;
use Asa\Erp\TbDepartment;
use Asa\Erp\TbGoods;
use Asa\Erp\TbMember;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbSaleport;
use Asa\Erp\TbSales;
use Asa\Erp\TbSalesdetails;
use Asa\Erp\TbSalesReceive;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbWarehouse;
use Asa\Erp\TbWarehousing;
use Asa\Erp\TbWarehousingdetails;
use Asa\Erp\Util;
use Asa\Models\Temp\TempTbAliases;
use Asa\Models\Temp\TempTbBrand;
use Asa\Models\Temp\TempTbBrandgroupchild;
use Asa\Models\Temp\TempTbBrandgroupchildProperty2;
use Asa\Models\Temp\TempTbPicture;
use Asa\Models\Temp\TempTbSeries;
use Asa\Models\Temp\TempTbSeries2;
use Asa\Models\Temp\TempTbSizecontent;
use PHPExcel;
use Asa\Erp\TbUser;
use Asa\Erp\TbProduct;
use Asa\Erp\TbShoporderCommon;
use Phalcon\Acl\Role;
use Gregwar\Image\Image;
use ReflectionClass;
use ReflectionMethod;
use Asa\Erp\TbLanguage;
use ZipArchive;
use Faker\Factory;

class TestController extends AdminController
{
    /**
     * 测试登录方法
     * 测试url：http://www.myshop.com/test/login?login_name=Tom&password=123456
     */
    public function loginAction()
    {
        // 采用post接收
        if ($this->request->isPost()) {
            // 接收变量
            $username = $this->request->get('login_name');
            $password = $this->request->get('password');

            // 验证合法性
            if (!$username || !$password) {
                return $this->error(['用户名或密码不能为空']);
            }

            // 查找记录
            $rs = TbMember::findFirst([
                "login_name = :username: and password = :password:",
                'bind' => [
                    'username' => $username,
                    'password' => md5($password),
                ],
            ]);

            // 分别返回
            if ($rs) {
                $this->session->set('member', $rs->toArray());
                return json_encode(['code' => '200', 'auth' => $this->session->get('member'), 'messages' => []]);
            } else {
                return $this->error(['登录失败，用户名或密码错误！']);
            }
        }
    }

    /**
     * 判断是否登录，并拿到当前用户模型
     * @return false|string
     */
    public function isloginAction()
    {
        return json_encode($this->islogin['companyid']);
        // 逻辑
        // 如果post或者ajax请求，那么就返回json字符串
        return json_encode($this->session->get('member'));
    }

    /**
     * 判断公司是否绑定了当前域名
     */
    public function checkhostAction()
    {
        // 逻辑
        $params = $this->dispatcher->getParams();
        if (!$params) {
            exit('params error');
        }
        // 赋值
        $host = $params[0];
        // 开始去数据库查找
        $result = TbCompany::findFirst("host = '$host'");
        // 返回
        if ($result) {
            return json_encode($result);
        } else {
            return false;
        }
    }

    /**
     * 404页面
     * @return string
     */
    public function error404Action()
    {
        // 逻辑
        return '404 NOT FOUND';
    }

    /**
     * 检查域名是否进行了绑定，并取出公司名称，作为网站主标题名称
     */
    public function gethostAction()
    {
        // 开始去数据库查找，但是不能是主shop域名，这个域名将永远能被访问
        $host = $_SERVER['HTTP_HOST'];

        echo $host;
        echo $this->host;
        exit;
    }

    /**
     * 测试更新
     * @return false|string
     */
    public function subAction()
    {
        $array = [
            ['id' => '6', 'number' => '1'],
            ['id' => '7', 'number' => '1'],
        ];
        foreach ($array as $item) {
            $model = TbProductSearch::findFirstById($item['id']);
            $model->number -= $item['number'];
            if (!$model->save()) {
                return $this->error(['更新失败']);
            }
        }
        return $this->success();
    }

    /**
     * 替换自增字段为int形式的id
     * @return false|string
     */
    public function replaceAction()
    {
        // 逻辑
        // 采用事务处理
        $this->db->begin();

        // 首先生成所有品牌表的countryid
        $brands = TempTbBrand::find();
        // 遍历替换品牌表的countryid
        foreach ($brands as $brand) {
            // 写入countryid，如果不存在记做NULL
            $country = $brand->country;
            if (!$country) {
                $countryid = NULL;
            } else {
                $countryid = $country->id;
            }
            // 写入countryid
            $data = [
                'countryid' => $countryid,
            ];
            if (!$brand->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return $this->error($brand);
            }
        }

        // 接着生成所有别名表的brandid
        $aliases = TempTbAliases::find();
        // 遍历替换别名表的brandid
        foreach ($aliases as $alias) {
            // 写入brandid，如果不存在记做NULL
            $brand = $alias->brand;
            if (!$brand) {
                $brandid = NULL;
            } else {
                $brandid = $brand->id;
            }
            // 写入brandid
            $data = [
                'brandid' => $brandid,
            ];
            if (!$alias->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return $this->error($alias);
            }
        }

        // 接着生成所有尺码明细表的topid
        $sizecontents = TempTbSizecontent::find();
        // 遍历替换尺码明细表的topid
        foreach ($sizecontents as $sizecontent) {
            // 写入topid，如果不存在记做NULL
            $sizetop = $sizecontent->sizetop;
            if (!$sizetop) {
                $topid = NULL;
            } else {
                $topid = $sizetop->id;
            }
            $data = [
                'topid' => $topid,
            ];
            if (!$sizecontent->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return $this->error($sizecontent);
            }
        }

        // 给系列表添加品牌id-brandid
        $series = TempTbSeries::find();
        // 遍历替换系列表的brandid
        foreach ($series as $serie) {
            // 写入brandid，如果不存在记做NULL
            $brand = $serie->brand;
            if (!$brand) {
                $brandid = NULL;
            } else {
                $brandid = $brand->id;
            }
            $data = [
                'brandid' => $brandid,
            ];
            if (!$serie->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return $this->error($serie);
            }
        }

        // 给子系列表添加系列表id-seriesid
        $serie2s = TempTbSeries2::find();
        // 遍历替换系列表的seriesid
        foreach ($serie2s as $serie2) {
            // 写入seriesid，如果不存在记做NULL
            $serie = $serie2->serie;
            if (!$serie) {
                $seriesid = NULL;
            } else {
                $seriesid = $serie->id;
            }
            $data = [
                'seriesid' => $seriesid,
            ];
            if (!$serie2->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return $this->error($serie2);
            }
        }

        // 给子品类表添加所属品类id-brandgroupid
        $brandgroupchildren = TempTbBrandgroupchild::find();
        // 遍历替换子品类表的brandgroupid
        foreach ($brandgroupchildren as $brandgroupchild) {
            // 写入brandgroupid，如果不存在记做NULL
            $brandgroup = $brandgroupchild->brandgroup;
            if (!$brandgroup) {
                $brandgroupid = NULL;
            } else {
                $brandgroupid = $brandgroup->id;
            }
            $data = [
                'brandgroupid' => $brandgroupid,
            ];
            if (!$brandgroupchild->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return $this->error($brandgroupchild);
            }
        }

        // 生成新的尺码规格子表
        $results = TempTbBrandgroupchild::find();
        $results_arr = $results->toArray();
        foreach ($results as $k => $result) {
            $results_arr[$k]['brandgroupchildpropertys'] = $result->brandgroupchildpropertys->toArray();
            // 加工内部数据
            foreach ($results_arr[$k]['brandgroupchildpropertys'] as $key => $value) {
                $results_arr[$k]['brandgroupchildpropertys'][$key]['brandgroupchildid'] = $result->id;
                $results_arr[$k]['brandgroupchildpropertys'][$key]['oldbrandgroupchildid'] = $result->oldid;
            }
        }
        // 把新的对应关系写入到一张全新的表中
        // 但是在插入之前，首先要清空原来的表，否则可能会产品重复数据
        $this->db->execute("truncate table temp_tb_brandgroupchild_property2");
        // 新表需要有oldtempid字段
        foreach ($results_arr as $item) {
            if (count($item['brandgroupchildpropertys']) > 0) {
                // 继续遍历
                foreach ($item['brandgroupchildpropertys'] as $property) {
                    // 开始执行插入前的准备
                    $model = new TempTbBrandgroupchildProperty2();
                    $name_cn = $property['name_cn'];
                    $displayindex = $property['displayindex'];
                    $brandgroupchildid = $property['brandgroupchildid'];
                    $oldbrandgroupchildid = $property['oldbrandgroupchildid'];
                    $oldtempid = $item['oldtempid'];
                    if (!$model->save(compact('name_cn', 'displayindex', 'brandgroupchildid', 'oldbrandgroupchildid', 'oldtempid'))) {
                        // 回滚
                        $this->db->rollback();
                        // 报错
                        return $this->error($model);
                    }
                }
            }
        }

        // 提交事务
        $this->db->commit();
        // 返回成功
        return json_encode(['code' => '200', 'messages' => ['操作成功']]);
    }

    /**
     * 替换品牌的id名称
     */
    public function renamepicAction()
    {
        // 逻辑
        // 遍历文件
        $dir = APP_PATH . '/public/upload/brandlogo';
        // 所有文件列表
        $files = $this->my_dir($dir);
        // 所有品牌列表
        $brands = TempTbBrand::find();
        // return json_encode($a);
        // 把所有的文件名都换成数字形式的id
        foreach ($files as $file) {
            // 切割为文件名和扩展名
            $pathinfo_file = pathinfo($file);
            // 去结果集中查找是否有这个文件名
            foreach ($brands as $brand) {
                // 如果找到了就换名
                if ($brand->oldid == $pathinfo_file['filename']) {
                    if (!rename($dir . '/' . $file, $dir . '/' . $brand->id . '.' . $pathinfo_file['extension'])) {
                        return $this->error(['重命名文件失败']);
                    }
                }
            }
        }
        // 替换成功
        return $this->success();
    }

    /**
     * PHP遍历一个文件夹下所有文件和子文件夹的函数
     * @param $dir 目录路径
     * @return array 返回一个数组
     */
    public function my_dir($dir)
    {
        $files = [];
        if (@$handle = opendir($dir)) { //注意这里要加一个@，不然会有warning错误提示：）
            while (($file = readdir($handle)) !== false) {
                if ($file != ".." && $file != ".") { //排除根目录；
                    if (is_dir($dir . "/" . $file)) { //如果是子文件夹，就进行递归
                        $files[$file] = $this->my_dir($dir . "/" . $file);
                    } else { //不然就将文件的名字存入数组；
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
            return $files;
        }
    }

    /**
     * 不用第三个变量，交换两个变量的值
     */
    public function changevarAction()
    {
        // 逻辑
        $a = 1;
        $b = 2;
        echo '原来的值分别为：' . "\$a=" . $a . "，\$b=" . $b;
        list($b, $a) = [$a, $b];
        echo '交换后的值分别为：' . "\$a=" . $a . "，\$b=" . $b;
    }

    /**
     * 测试excel导出
     * @param array $title
     * @param array $data
     * @param string $fileName
     * @param string $savePath
     * @param bool $isDown
     * @return string
     * @throws \PHPExcel_Exception
     */
    public function exportAction($title = [], $data = [], $fileName = '', $savePath = './', $isDown = true)
    {
        // 逻辑
        $this->view->disable();

        // 初始化
        $obj = new PHPExcel();

        //横向单元格标识
        $cellName = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ'];

        //设置sheet名称
        $obj->getActiveSheet(0)->setTitle('sheet1');

        //设置默认对齐方式
        $obj->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $obj->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //设置纵向单元格标识
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
                    $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + $_row), $_cell);

                    // 如果数据库含有图片，那么就把图片的地址改为插入图片
                    if (strpos($_cell, 'jpg') !== false || strpos($_cell, 'gif') !== false || strpos($_cell, 'png') !== false) {
                        // 首先修改图片列的单元格宽度和高度
                        // 宽度
                        $obj->getActiveSheet(0)->getColumnDimension($cellName[$j])->setWidth(16);
                        // 然后修改默认行高和第一行高
                        //设置默认行高
                        $obj->getActiveSheet()->getDefaultRowDimension()->setRowHeight(100);
                        //设置第一行高
                        $obj->getActiveSheet()->getRowDimension(1)->setRowHeight(20);

                        // 然后把图片列的内容清空
                        $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + $_row), '');

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

        // 转码
        $_fileName = iconv("utf-8", "gb2312", $fileName);
        $_savePath = $savePath . $_fileName . '.xls';
        $objWrite->save($_savePath);
        return $savePath . $fileName . '.xls';
    }

    /**
     * 测试导出Excel
     * @throws \PHPExcel_Exception
     */
    public function testexportAction()
    {
        // 逻辑
        $data = TempTbPicture::find([
            'columns' => 'id, name, filename1, filename2, productid',
        ])->toArray();


        // 加工数据
        // 查出名字替换原来的productid
        foreach ($data as $k => $item) {
            $product = TbProduct::findFirstById($item['productid']);
            if ($product) {
                $data[$k]['productid'] = $product->productname;
            } else {
                $data[$k]['productid'] = '';
            }
        }

        // 导出
        Util::excelExport(['主键ID', '图片名称', '主图', '附图', '产品名称'], $data, '导出图片表');
    }


    /**
     * 测试上传文件
     */
    public function uploadAction()
    {
        if ($this->request->isPost()) {
            if ($this->request->hasFiles()) {

                // // 这里只取一个文件
                // $uploadFile = $this->request->getUploadedFiles()[0];
                //
                // echo '<pre>';
                // print_r($uploadFile);
                // echo '</pre>';
                //
                // $this->view->disable();

                foreach ($this->request->getUploadedFiles() as $file) {
                    echo "上传文件名：" . $file->getName() . "<br />";
                    echo "临时文件路径：" . $file->getTempName() . "<br />";
                    echo "文件大小：" . $file->getSize() . "<br />";
                    echo "文件类型：" . $file->getType() . "<br />";
                    echo "错误代码：" . $file->getError() . "<br />";
                    echo "上传表控件名：" . $file->getKey() . "<br />";
                    echo "文件后綴" . $file->getExtension() . "<br />";

                    $relative_path = $this->config->upload_dir . "/";
                    $realname = md5(time()) . '.' . $file->getExtension();

                    $image_url = $relative_path . $realname;
                    if (!$file->moveTo($image_url)) {
                        echo '移动文件出错';
                    }
                }
            } else {
                echo '没有上传任何文件';
            }
            // 禁止渲染模板
            $this->view->disable();
        }
    }


    //创建一个读取excel数据，可用于入库
    public function readExcel($path)
    {
        // 引用PHPexcel类
        // 设置为Excel5代表支持2003或以下版本，Excel2007代表2007版
        $type = 'Excel5';
        $xlsReader = \PHPExcel_IOFactory::createReader($type);
        $Sheets = $xlsReader->load($path);
        //开始读取上传到服务器中的Excel文件，返回一个二维数组
        $dataArray = $Sheets->getSheet(0)->toArray();
        return $dataArray;
    }


    /**
     * 导入excel带图片的
     */
    public function importAction()
    {
        // 逻辑
        // 创建所需的文件夹
        $excelFilePath = APP_PATH . '/public/upload/list.xls';
        $pictureSaveFolder = 'temp';
        $imgPath = APP_PATH . '/public/upload/' . $pictureSaveFolder . '/';
        if (!file_exists($imgPath)) {
            mkdir($imgPath);
        }

        // 图片保存逻辑
        // 加载2003格式的
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        // 载入文件
        $objPHPExcel = $objReader->load($excelFilePath);
        // 取出数据
        $datas = $objPHPExcel->getSheet(0);
        $datas_array = $datas->toArray();
        // 去掉第一行
        unset($datas_array[0]);
        // 重新组装数组
        $datas_array = array_values($datas_array);
        // 定义单元格的格式
        $pattern = '/[A-Za-z]+/';

        // 循环遍历，保存其中的图片
        foreach ($datas->getDrawingCollection() as $k => $drawing) {
            // 得到单元数据 比如D2单元
            $codata = $drawing->getCoordinates();
            // 取出位置D
            preg_match($pattern, $codata, $match);
            $current_position = $this->getnumberAction()[$match[0]];
            // echo $current_position; //输出单元格所在的位置
            // echo $codata.'</br>'; //输出图片所在位置

            $filename = $drawing->getIndexedFilename(); //文件名
            $imgName = substr($filename, 0, strrpos($filename, '.') - 1);
            $imgType = @end(explode(".", $filename));
            // 如果扩展名是jpeg，则修改为jpg
            if ($imgType == 'jpeg') {
                $img = $imgName . '.jpg';
            } else {
                $img = $imgName . '.' . $imgType;
            }

            // 把图片地址保存在新数组中，有几个图片就传入几个地址
            $datas_array[$k][$current_position] = $pictureSaveFolder . '/' . $img;

            // 把图片保存在服务器中
            ob_start();
            call_user_func(
                $drawing->getRenderingFunction(),
                $drawing->getImageResource()
            );
            $imageContents = ob_get_contents();
            file_put_contents($imgPath . $img, $imageContents); //把文件保存到本地
            ob_end_clean();
        }

        // 开始写入数据库
        foreach ($datas_array as $data) {
            $model = new TempTbPicture();
            $model->excel_id = $data[0];
            $model->name = $data[1];
            $model->productid = $data[2];
            $model->filename1 = $data[3];
            if (!$model->save()) {
                return $this->error($model);
            }
        }
        // 最终成功
        return $this->success();
    }


    /**
     * 导入excel带图片的，其中一个单元格可能带有多个图片
     */
    public function import2Action()
    {
        // 逻辑
        // 创建所需的文件夹
        $excelFilePath = APP_PATH . '/public/upload/list2.xls';
        $pictureSaveFolder = 'temp';
        $imgPath = APP_PATH . '/public/upload/' . $pictureSaveFolder . '/';
        if (!file_exists($imgPath)) {
            mkdir($imgPath);
        }

        // 图片保存逻辑
        // 加载2003格式的
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        // 载入文件
        $objPHPExcel = $objReader->load($excelFilePath);
        // 取出数据
        $datas = $objPHPExcel->getSheet(0);

        // 先处理图片
        $AllImages = $datas->getDrawingCollection();
        foreach ($AllImages as $drawing) {
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
                file_put_contents($imgPath . $img, $imageContents); //把文件保存到本地
                ob_end_clean();

                // 获取当前单元格位置，便于后续操作
                $XY = $drawing->getCoordinates();

                // 把图片的单元格的值设置为最终路径
                $cell = $datas->getCell($XY);
                $cell->setValue($pictureSaveFolder . '/' . $img);
            }
        }

        // 返回格式化后的数据
        return $this->unsetfirstarray($datas->toArray());
    }


    /**
     * 把读出来的excel数据写入到数据库
     * 函数仅供参考，如果不需要验证数据的完整性，那么可以删除下面验证的部分
     * @return false|string
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function savetodbAction()
    {
        // 获取数据
        $arrayData = Util::importExcel(APP_PATH . '/public/upload/list.xls', 'temp');

        // 启用事务处理
        $this->db->begin();
        // 开始写入数据库
        foreach ($arrayData as $data) {
            // 如果数据不完整，那么拒绝写入，并报错
            foreach ($data as $item) {
                if (empty($item)) {
                    // 回滚
                    $this->db->rollback();
                    return $this->error(['数据不完整，请补充完整后再重新导入']);
                }
            }
            $model = new TempTbPicture();
            $model->excel_id = $data[0];
            $model->name = $data[1];
            // 把id转成名称
            $product = TbProduct::findFirst([
                "productname = :productname:",
                'bind' => [
                    'productname' => $data[2],
                ],
            ]);
            if ($product) {
                $model->productid = $product->id;
            } else {
                $model->productid = '';
            }
            $model->filename1 = $data[3];
            $model->filename2 = $data[4];
            if (!$model->save()) {
                // 回滚
                $this->db->rollback();
                return $this->error($model);
            }
        }
        // 提交事务
        $this->db->commit();
        // 返回结果
        return $this->success();
    }


    /**
     * 返回去掉首行，并且重新组合的数组
     * @param $array
     * @return array|bool
     */
    public function unsetfirstarray($array)
    {
        // 逻辑
        // 去掉第一行
        unset($array[0]);
        // 重新组装数组
        return array_values($array);
    }


    /**
     * 测试密码
     */
    public function testbcryptAction()
    {
        // 使用bcrypt储存密码
        $password = $this->security->hash('123456');
        if ($this->security->checkHash('123456', $password)) {
            echo '密码正确';
        } else {
            echo '密码不正确';
        }
    }

    /**
     * 测试findBy函数
     */
    public function testfindAction()
    {
        // 逻辑
        $result = TbUser::findFirstByLoginName('admin');
        // 返回
        return json_encode($result);
    }

    public function test1Action()
    {
        $a = '4*8-(9-8)/2+4*67';
        return eval("echo $a;");
    }


    public function test3Action()
    {
        // 逻辑
        $company = TbCompany::findFirst();
        return $this->success($company->shopSaleport);
    }

    public function test4Action()
    {
        // 逻辑
        $saleport = TbSaleport::findFirstById(1);
        $array = Util::recordListColumn($saleport->saleportWarehouses, 'warehouseid');
        if (count($array) == 0) {
            return $array;
        }

        $sum = TbProductstock::sum([
            sprintf("warehouseid in (%s) and defective_level=0 and productid = 1 and sizecontentid = 3", implode(',', $array)),
            "group" => 'productid,sizecontentid',
            "column" => 'number',
        ]);
        echo '<pre>';
        print_r($sum->toArray());
        echo '</pre>';
        exit;

        return $this->success($sum);
    }

    public function test5Action()
    {
        // 逻辑
        return $this->success($this->buycar);
    }

    public function test6Action()
    {
        // 产品库存模型
        $model = TbProductSearch::findFirstById('6');
        // 做减法
        // 本来应该检测是否超卖的，但是上一步已经验证有库存，所以最终值不会小于0
        $model->number -= 1;
        if (!$model->save()) {
            return $this->error($model);
        } else {
            return $this->success();
        }
    }

    /**
     * 测试tb_product_search导入数据
     */
    public function insertdataAction()
    {
        $db = $this->db;
        $update = 0;
        $insert = 0;

        $companyList = TbCompany::find();
        foreach ($companyList as $company) {
            if ($company->saleportid > 0) {
                //获得公司的对应自营店铺的销售端口对象。然后查询这个销售端口的商品数据及库存数据
                $saleport = $company->shopSaleport;

                //库存商品的id及合计库存（多个仓库，多个尺码合计）
                $product_sum_list = $saleport->getProductList();

                return json_encode($product_sum_list);
                // [
                //     {
                //         productid: "1",
                //         sumatory: "23",
                //     },
                //     {
                //         productid: "2",
                //         sumatory: "8",
                //     }
                // ]

                $product_id_array = Util::recordListColumn($product_sum_list, 'productid');
                $products = TbProduct::findByIdString($product_id_array, 'id');
                //print_r($products->toArray());

                // return json_encode($product_id_array);
                // [
                //     "1",
                //     "2"
                // ]

                $hashmap = Util::recordToHashtable($product_sum_list, 'productid', 'sumatory');

                // return json_encode($hashmap);
                // {
                //     1: "23",
                //     2: "8"
                // }

                //查询已经存在的库存记录，这些需要更新
                $rows = TbProductSearch::find(
                    sprintf("companyid=%d and productid in(%s)", $company->id, implode(",", $product_id_array))
                );
                $exist_product_id_array = Util::recordListColumn($rows, 'productid');

                // return json_encode($rows);
                // [
                //     {
                //         id: "7",
                //         productname: "BOUTIQUE MOSCHINO 女士黄色长袖T恤衫",
                //         productid: "1",
                //         sizetopid: "1",
                //         brandgroupid: "5",
                //         childbrand: "15",
                //         number: "23",
                //         picture: "product/d237442d5a8662c9a997666a652d5693.jpg",
                //         picture2: "product/0820505ecba45bc993739ba4152aeecf.jpg",
                //         color: "1",
                //         color_group: null,
                //         price: "1.50",
                //         realprice: "1.20",
                //         companyid: "1"
                //     },
                //     {
                //         id: "6",
                //         productname: "PRADA 黑色斜跨包",
                //         productid: "2",
                //         sizetopid: "2",
                //         brandgroupid: "2",
                //         childbrand: "16",
                //         number: "8",
                //         picture: "product/91a791ff46592e73f3b37a5e293a0033.jpg",
                //         picture2: "product/ae8deb1ae3139a6e603475441d75680f.jpg",
                //         color: "1,2",
                //         color_group: null,
                //         price: "1.80",
                //         realprice: "1.50",
                //         companyid: "1"
                //     }
                // ]


                // return json_encode($exist_product_id_array);
                // [
                //     "1",
                //     "2"
                // ]


                //print_r($hashmap);
                foreach ($products as $product) {
                    if (in_array($product->id, $exist_product_id_array)) {
                        //更新
                        $sql = sprintf(
                            "UPDATE tb_product_search SET productname='%s', number=%d, sizetopid=%d, brandgroupid=%d, childbrand=%d, picture='%s', picture2='%s' WHERE companyid=%d and productid=%d",
                            addslashes($product->productname),
                            $hashmap[$product->id],
                            $product->sizetopid,
                            $product->brandgroupid,
                            $product->childbrand,
                            addslashes($product->picture),
                            addslashes($product->picture2),
                            $company->id,
                            $product->id
                        );
                        $db->execute($sql);
                    } else {
                        //新增
                        $sql = sprintf(
                            "INSERT INTO tb_product_search SET productname='%s', number=%d, sizetopid=%d, brandgroupid=%d, childbrand=%d, picture='%s', picture2='%s', companyid=%d, productid=%d",
                            addslashes($product->productname),
                            $hashmap[$product->id],
                            $product->sizetopid,
                            $product->brandgroupid,
                            $product->childbrand,
                            addslashes($product->picture),
                            addslashes($product->picture2),
                            $company->id,
                            $product->id
                        );
                        $db->execute($sql);
                    }
                }

                //清除未在产品列表里的产品记录
                $sql = sprintf("DELETE FROM tb_product_search WHERE companyid=%d and productid not in(%s)", $company->id, implode(",", $product_id_array));
                $db->execute($sql);
            }
        }
        echo "同步完毕";
    }

    /**
     * 测试更新sql
     * @return false|string
     */
    public function testsqlAction()
    {
        $rs = $this->session->get('member');
        $id = 64;
        $order = TbShoporderCommon::findFirst("member_id=" . $rs['id'] . " and id=" . $id . " and order_status=2");
        // 取出每个订单下面具体商品信息
        $shoporders = $order->shoporder;
        foreach ($shoporders as $shoporder) {
            $sql = "UPDATE tb_product_search SET number = number + " . $shoporder->number . " WHERE id=" . $shoporder->product_id;
            if (!$this->db->execute($sql)) {
                // 回滚
                return $this->error(['执行失败']);
            } else {
                return $this->success();
            }
        }
    }

    /**
     * 自动转换图片
     */
    public function conversionpicAction()
    {
        // 逻辑
        $picture = APP_PATH . '/public/upload/product/model4.jpg';
        $pathinfo = pathinfo($picture);

        // echo dirname($picture).'/'.$pathinfo['basename'].'_40x40.'.$pathinfo['extension'];
        // exit;

        // print_r(pathinfo($picture));
        // Array
        // (
        //     [dirname] => /www/wwwroot/www.jinxiaocun.com/erp/public/upload/product
        //     [basename] => model4.jpg
        //     [extension] => jpg
        //     [filename] => model4
        // )

        // 开始处理
        Image::open($picture)
            ->resize(100, 100)
            ->save(dirname($picture) . '/' . $pathinfo['basename'] . '_40x40.' . $pathinfo['extension']);
        // 返回成功
        return $this->success();
    }

    /**
     * 测试静态方法
     */
    public function utilpicsAction()
    {
        // 逻辑
        Util::convertPics(APP_PATH . '/public/upload/product/d237442d5a8662c9a997666a652d5693.jpg', ['20', '40', '60', '80']);
        return $this->success();
    }

    /**
     * 测试反射
     */
    public function testreflectionAction()
    {
        // 逻辑
        // 使用try-catch捕捉
        try {
            $data = [
                'name' => 'lisi' . mt_rand(1000, 9999) . '.png',
                'filename' => md5('123456'),
            ];
            $reflection = new ReflectionClass('Asa\Erp\TbPicture');
            // 创建一个新的类实例
            $model = $reflection->newInstance();
            // 获取模型元数据
            $metaData = $model->getModelsMetaData();
            // 获取字段名
            $attributes = $metaData->getAttributes($model);
            // 开始更新
            foreach ($attributes as $attribute) {
                if (isset($data[$attribute])) {
                    $model->$attribute = $data[$attribute];
                }
            }
            // 更新
            if (!$model->save()) {
                return $this->error($model);
            } else {
                return $this->success();
            }
        } catch (\ReflectionException $e) {
            return $this->error($e->getMessage());
        }

    }


    /**
     * 销售统计功能
     * 还差到货时间、底部的三个线下店铺、爱莎商城、跨境销售字段位置还未找到
     * @return false|string
     */
    public function salesstatisticsAction()
    {
        // 逻辑
        // 取出登录公司信息
        if (!$this->currentCompany) {
            // 取出错误信息
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
        }

        // 赋值
        $companyid = $this->currentCompany;

        // 首先把符合条件的所有数据查出来，把大类信息找出来
        // 如果没有传入起始销售时间和终止销售时间，那么就默认为昨天一整天的数据
        $start_salesdate = $this->request->get('start_salesdate');
        $end_salesdate = $this->request->get('end_salesdate');
        // 如果都没有填写，那么就默认为昨天一整天的数据
        if (!$start_salesdate && !$end_salesdate) {
            // 昨日
            $start_salesdate = date('Y-m-d', time() - 86400);
            // 今日
            $end_salesdate = date('Y-m-d');
        } else {
            // 如果起始时间为空，则取无穷小的时间
            if (!$start_salesdate) {
                $start_salesdate = date('Y-m-d', strtotime('0001-01-01 00:00:00'));
            }
            // 如果截止时间为空，那么就设置为明天的00:00:00
            if (!$end_salesdate) {
                $end_salesdate = date('Y-m-d', time() + 86400);
            }
        }

        // 开始查找数据，使用销售日期进行查询
        $sales = TbSales::find(
            "status != 2 and companyid = $companyid and salesdate between '" . $start_salesdate . "' and '" . $end_salesdate . "'"
        );

        // 判断是否为空
        if (!count($sales)) {
            return $this->success();
        }

        // 如果不为空，那么继续往下执行
        // 取出订单id列表
        $salesid = [];
        foreach ($sales as $sale) {
            $salesid[] = $sale->id;
        }
        $salesid = implode(',', $salesid);

        // 把详情表信息展示出来
        $salesdetails = TbSalesdetails::find(
            "salesid in ({$salesid})"
        );
        $salesdetails_array = $salesdetails->toArray();

        // 把所需要的信息都填写进去
        // 多语言字段
        $fieldname = $this->getlangfield('name');
        $fieldcontent = $this->getlangfield('content');
        // 暂时不修改模型关系了，怕引起不必要的麻烦
        // 加工为一个大数据
        foreach ($salesdetails as $k => $detail) {
            // 库存模型
            $productstock = TbProductstock::findFirstById($detail->productstockid);
            // 主销售表模型
            $sale = TbSales::findFirstById($detail->salesid);
            // 判断库存模型是否存在
            // 库存模型影响品牌id和品类id
            if ($productstock) {
                // 产品模型
                $product = TbProduct::findFirstById($productstock->productid);
                // 尺码模型
                $sizecontent = TbSizecontent::findFirstById($productstock->sizecontentid);
                // 原始货物模型，获取价格用
                $defaultgood = TbGoods::findFirstById($productstock->goodsid);
                if ($defaultgood) {
                    $price = $defaultgood->price;
                } else {
                    $price = 0;
                }
                // 判断产品模型是否存在
                if ($product) {
                    // 品牌id
                    $brandid = $product->brandid;
                    // 品类id
                    $brandgroupid = $product->brandgroupid;
                    // 国际码
                    $wordcard = $product->wordcode_1 . $product->wordcode_2 . $product->wordcode_3 . $product->wordcode_4;
                    // 年代季节，还要判断是否为空
                    if ($product->season) {
                        $ageseasons = explode(',', $product->season);
                        // 本土化语言保存
                        $ageseasonsname = [];
                        foreach ($ageseasons as $ageseason) {
                            $ageseasonModel = TbAgeseason::findFirstById($ageseason);
                            if ($ageseasonModel) {
                                $ageseasonsname[] = $ageseasonModel->sessionmark . $ageseasonModel->name;
                            } else {
                                $ageseasonsname[] = '';
                            }
                        }
                        $ageseasonsname = implode(',', $ageseasonsname);
                    } else {
                        $ageseasons = [];
                        $ageseasonsname = '';
                    }
                    // 产品图片
                    $picture = $product->picture;
                    // 产品名称
                    $productname = $product->productname;
                    // 性别
                    $gender = $product->gender;
                } else {
                    // 品牌id
                    $brandid = '';
                    // 品类id
                    $brandgroupid = '';
                    // 国际码
                    $wordcard = '';
                    // 年代季节
                    $ageseasons = [];
                    // 年代季节本土化
                    $ageseasonsname = '';
                    // 产品图片
                    $picture = '';
                    // 产品名称
                    $productname = '';
                    // 性别
                    $gender = '';
                }
                // 判断尺码模型是否存在
                if ($sizecontent) {
                    $sizecontentname = $sizecontent->$fieldcontent;
                } else {
                    $sizecontentname = '';
                }
            } else {
                // 品牌id
                $brandid = '';
                // 品类id
                $brandgroupid = '';
                // 国际码
                $wordcard = '';
                // 年代季节
                $ageseasons = [];
                // 年代季节本土化
                $ageseasonsname = '';
                // 产品图片
                $picture = '';
                // 产品名称
                $productname = '';
                // 尺码名称
                $sizecontentname = '';
                // 性别
                $gender = '';
                // 原始价格
                $price = 0;
            }

            // 原始价格，替换掉默认的本字段price值，如果逻辑修改好了可以直接引用
            $salesdetails_array[$k]['price'] = $price;
            // 原始总成交价格
            $salesdetails_array[$k]['dealprice'] = $price * ($detail->number) * ($sale->discount);

            // 销售主表相关参数
            // 销售人id
            $salestaff = $sale->salesstaff;
            // 销售人模型，影响departmentid
            $salestaff_user = TbUser::findFirstById($sale->salesstaff);
            if ($salestaff_user) {
                // 部门模型
                $department = $salestaff_user->department;
                if ($department) {
                    $departmentid = $department->id;
                } else {
                    $departmentid = '';
                }
            } else {
                $departmentid = '';
            }

            // 会员id
            $salesdetails_array[$k]['memberid'] = $sale->memberid;
            // 会员名称
            $member = TbMember::findFirstById($sale->memberid);
            if (!$member) {
                $salesdetails_array[$k]['membername'] = '';
            } else {
                $salesdetails_array[$k]['membername'] = $member->name;
            }
            // 销售人id
            $salesdetails_array[$k]['salesstaff'] = $salestaff;
            // 销售人姓名
            $salesdetails_array[$k]['salesstaffname'] = $salestaff_user->login_name;
            // 销售日期
            $salesdetails_array[$k]['salesdate'] = date('Y-m-d', strtotime($sale->salesdate));
            // 折扣
            $salesdetails_array[$k]['discount'] = $sale->discount;
            // 销售端口id
            $salesdetails_array[$k]['saleportid'] = $sale->saleportid;
            // 销售端口名称
            $saleport = TbSaleport::findFirstById($sale->saleportid);
            if (!$saleport) {
                $salesdetails_array[$k]['saleportname'] = '';
            } else {
                $salesdetails_array[$k]['saleportname'] = $saleport->name;
            }
            // 对账单号
            $salesdetails_array[$k]['ordercode'] = $sale->ordercode;
            // 销售仓库id
            $salesdetails_array[$k]['warehouseid'] = $sale->warehouseid;
            if ($sale->warehouseid) {
                $warehouse = TbWarehouse::findFirstById($sale->warehouseid);
                if ($warehouse) {
                    $warehousename = $warehouse->name;
                } else {
                    $warehousename = '';
                }
            } else {
                $warehousename = '';
            }
            // 销售仓库名称
            $salesdetails_array[$k]['warehousename'] = $warehousename;
            // 快递单号
            $salesdetails_array[$k]['expressno'] = $sale->expressno;
            // 付款类型
            switch ($sale->expresspaidtype) {
                case '0':
                    $expresspaidtype = '预付';
                    break;
                case '1':
                    $expresspaidtype = '到付';
                    break;
                case '2':
                    $expresspaidtype = '第三方付费';
                    break;
                case '3':
                    $expresspaidtype = '储值卡';
                    break;
                case '4':
                    $expresspaidtype = '转账';
                    break;
                case '5':
                    $expresspaidtype = '协议结算';
                    break;
                default:
                    $expresspaidtype = '预付';
            }
            $salesdetails_array[$k]['expresspaidtype'] = $expresspaidtype;
            // 付款金额
            $salesdetails_array[$k]['expressfee'] = $sale->expressfee;
            // 订单状态
            switch ($sale->status) {
                case '0':
                    $status = '预售';
                    break;
                case '1':
                    $status = '已售';
                    break;
                case '2':
                    $status = '作废';
                    break;
                default:
                    $status = '预售';
            }
            $salesdetails_array[$k]['status'] = $status;
            // 收货地址
            $salesdetails_array[$k]['address'] = $sale->address;
            // 外部订单号
            $salesdetails_array[$k]['externalno'] = $sale->externalno;
            // 提货类型
            switch ($sale->pickingtype) {
                case '0':
                    $pickingtype = '自提';
                    break;
                case '1':
                    $pickingtype = '快递';
                    break;
                case '2':
                    $pickingtype = '门店直发';
                    break;
                default:
                    $pickingtype = '自提';
            }
            $salesdetails_array[$k]['pickingtype'] = $pickingtype;
            // 制单人
            $makestaffModel = TbUser::findFirstById($sale->makestaff);
            if ($makestaffModel) {
                $salesdetails_array[$k]['makestaffname'] = $makestaffModel->login_name;
            } else {
                $salesdetails_array[$k]['makestaffname'] = '';
            }
            // 制单日期
            $salesdetails_array[$k]['makedate'] = date('Y-m-d', strtotime($sale->makedate));


            // 品牌相关参数
            // 品牌id
            $salesdetails_array[$k]['brandid'] = $brandid;
            // 品牌名称
            $brand = TbBrand::findFirstById($brandid);
            $name = $this->getlangfield('name');
            if (!$brand) {
                $salesdetails_array[$k]['brandname'] = '';
            } else {
                $salesdetails_array[$k]['brandname'] = $brand->$name;
            }

            // 品类相关参数
            // 品类id
            $salesdetails_array[$k]['brandgroupid'] = $brandgroupid;
            // 品类名称
            $brandgroup = TbBrandgroup::findFirstById($brandgroupid);
            if (!$brandgroup) {
                $salesdetails_array[$k]['brandgroupname'] = '';
            } else {
                $salesdetails_array[$k]['brandgroupname'] = $brandgroup->$name;
            }

            // 部门相关参数
            // 部门id
            $salesdetails_array[$k]['departmentid'] = $departmentid;
            // 部门名称
            $department = TbDepartment::findFirstById($departmentid);
            if (!$department) {
                $salesdetails_array[$k]['departmentname'] = '';
            } else {
                $salesdetails_array[$k]['departmentname'] = $department->name;
            }

            // 产品相关参数
            // 产品名称
            $salesdetails_array[$k]['productname'] = $productname;
            // 产品国际码
            $salesdetails_array[$k]['wordcode'] = $wordcard;
            // 年代季节
            $salesdetails_array[$k]['ageseasons'] = $ageseasons;
            // 年代季节本土化
            $salesdetails_array[$k]['ageseasonsname'] = $ageseasonsname;
            // 产品图片
            $salesdetails_array[$k]['picture'] = $picture;
            // 尺码名称
            $salesdetails_array[$k]['sizecontentname'] = $sizecontentname;
            // 性别
            switch ($gender) {
                case '0':
                    $gendername = '女士';
                    break;
                case '1':
                    $gendername = '男士';
                    break;
                case '2':
                    $gendername = '中性';
                    break;
                default:
                    $gendername = '中性';
            }
            $salesdetails_array[$k]['gender'] = $gender;
            // 性别名称
            $salesdetails_array[$k]['gendername'] = $gendername;


            // 销售单回款相关参数
            // 因为是一对多的关系，所以取回款的总和
            $salesreceive = TbSalesReceive::sum([
                    'conditions' => 'salesid = ' . $detail->salesid,
                    'group' => 'salesid',
                    'column' => 'amount',
                ]
            );
            // 销售单回款赋值
            // 我们规定，如果是有多条记录，那么就取最后的一条当做收款确认人、收款确认时间、收款日期、收款状态、收款类型，因为这个时间节点最新
            if (count($salesreceive) > 0) {
                // 实际上只有一个有效数据，我们取出第一个元素即可
                $salesreceive = $salesreceive->toArray();
                $salesdetails_array[$k]['salesreceive'] = $salesreceive[0];
                $salesreceiveDetail = TbSalesReceive::findFirst([
                    'salesid = ' . $detail->salesid,
                    'order' => 'maketime desc',
                ]);
                // 开始赋值
                if ($salesreceiveDetail) {
                    $salesdetails_array[$k]['salesreceive']['maketime'] = $salesreceiveDetail->maketime;
                    $salesdetails_array[$k]['salesreceive']['confirmstaff'] = $salesreceiveDetail->confirmstaff;
                    $salesdetails_array[$k]['salesreceive']['confirmtime'] = $salesreceiveDetail->confirmtime;
                    $salesdetails_array[$k]['salesreceive']['paymentdate'] = $salesreceiveDetail->paymentdate;
                    // 收款状态
                    switch ($salesreceiveDetail->status) {
                        case '0':
                            $statusname = '未收到';
                            break;
                        case '1':
                            $statusname = '已收到';
                            break;
                        default:
                            $statusname = '未收到';
                    }
                    // 收款类型
                    switch ($salesreceiveDetail->payment_type) {
                        case '0':
                            $payment_type_name = '定金';
                            break;
                        case '1':
                            $payment_type_name = '货款';
                            break;
                        default:
                            $payment_type_name = '定金';
                    }
                    $salesdetails_array[$k]['salesreceive']['status'] = $salesreceiveDetail->status;
                    $salesdetails_array[$k]['salesreceive']['statusname'] = $statusname;
                    $salesdetails_array[$k]['salesreceive']['payment_type'] = $salesreceiveDetail->payment_type;
                    $salesdetails_array[$k]['salesreceive']['payment_type_name'] = $payment_type_name;
                    $salesdetails_array[$k]['salesreceive']['memo'] = $salesreceiveDetail->memo;
                }
            } else {
                $salesdetails_array[$k]['salesreceive'] = [];
            }
        }

        // 声明一个变量用来保存查询的条件
        // 下面的不是sql的查询语言，是数组专用的，需要特别处理一下
        $where = [];
        // 1、品牌【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandid = $this->request->get('brandid', 'string');
        // 验证品牌合法性
        if ($brandid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandid)) {
                $brandid_array = json_decode($brandid, true);
                $condition = [];
                foreach ($brandid_array as $id) {
                    $condition[] = "\$item['brandid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 2、品类【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandgroupid = $this->request->get('brandgroupid', 'string');
        // 验证品类合法性
        if ($brandgroupid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandgroupid)) {
                $brandgroupid_array = json_decode($brandgroupid, true);
                $condition = [];
                foreach ($brandgroupid_array as $id) {
                    $condition[] = "\$item['brandgroupid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 3、年代，因为是一对多，非一对一，要用数组in查询【单选】
        $ageseasonid = $this->request->get('ageseasonid', 'int');
        if ($ageseasonid) {
            $where[] = '(' . "in_array($ageseasonid, \$item['ageseasons'])" . ')';
        }

        // 4、国际码【单选】
        $wordcode = $this->request->get('wordcode', 'string');
        if ($wordcode) {
            $where[] = '(' . "\$item['wordcode'] == '$wordcode'" . ')';
        }
        // 5、会员【单选】
        $memberid = $this->request->get('memberid', 'int');
        if ($memberid) {
            $where[] = '(' . "\$item['memberid'] == " . $memberid . ')';
        }

        // 6、销售端口【多选】
        $saleportid = $this->request->get('saleportid', 'string');
        // 验证销售端口合法性
        if ($saleportid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($saleportid)) {
                $saleportid_array = json_decode($saleportid, true);
                $condition = [];
                foreach ($saleportid_array as $id) {
                    $condition[] = "\$item['saleportid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 7、部门【单选】
        $departmentid = $this->request->get('departmentid', 'int');
        if ($departmentid) {
            $where[] = '(' . "\$item['departmentid'] == " . $departmentid . ')';
        }
        // 8、产品性别风格【单选】
        $gender = $this->request->get('gender', 'int');
        if (preg_match('/[012]+/', $gender)) {
            $where[] = '(' . "\$item['gender'] == " . $gender . ')';
        }
        // 9、到货时间【待完善】
        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);

        // 开始从大数组中检索，并保存到$query_array中
        $query_array = [];
        foreach ($salesdetails_array as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $query_array[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $query_array[] = $item;
                }
            }
        }

        // 根据请求的参数来决定分组依据
        // 按品牌
        $method = $this->request->get('method');
        switch ($method) {
            // 1-品牌
            case '1':
                $groupby = 'brandid';
                break;
            // 2-销售端口
            case '2':
                $groupby = 'saleportid';
                break;
            // 3-品类
            case '3':
                $groupby = 'brandgroupid';
                break;
            // 4-部门
            case '4':
                $groupby = 'departmentid';
                break;
            // 5-会员
            case '5':
                $groupby = 'memberid';
                break;
            // 6-销售人
            case '6':
                $groupby = 'salesstaff';
                break;
            // 默认-品牌
            default:
                $groupby = 'brandid';
        }

        // 开始处理分组统计
        // 针对新数组进行统计
        // 首先声明一个新数组用来保存最终的结果
        $return_array = [];
        // 在外面统计总数量和总结算金额
        $total_number = 0;
        $total_dealprice = 0;
        foreach ($query_array as $k => $item) {
            // 如果新数组中不存在，就新增
            // 除了新增数量和金额之外，还需要增加各自的百分比
            if (!isset($return_array['items'][$item[$groupby]])) {
                $return_array['items'][$item[$groupby]][$groupby] = $item[$groupby];
                $return_array['items'][$item[$groupby]]['sum_number'] = $item['number'];
                $return_array['items'][$item[$groupby]]['sum_dealprice'] = $item['dealprice'];
            } else {
                // 否则就累计
                $return_array['items'][$item[$groupby]]['sum_number'] += $item['number'];
                $return_array['items'][$item[$groupby]]['sum_dealprice'] += $item['dealprice'];
            }
            // 添加点击之后的内页数据，直接放在新的details字段中即可。
            $return_array['items'][$item[$groupby]]['details'][] = $item;
            // 计数器累计
            $total_number += $return_array['items'][$item[$groupby]]['sum_number'];
            $total_dealprice += $return_array['items'][$item[$groupby]]['sum_dealprice'];
        }

        // 再把总数量和总金额添加到数组中
        foreach ($return_array['items'] as $k => $item) {
            $return_array['items'][$k]['total_number'] = $total_number;
            $return_array['items'][$k]['rate_number'] = round($item['sum_number'] / $total_number * 100, 2) . "%";
            $return_array['items'][$k]['total_dealprice'] = $total_dealprice;
            $return_array['items'][$k]['rate_dealprice'] = round($item['sum_dealprice'] / $total_dealprice * 100, 2) . "%";
        }

        // 补充total数组
        $return_array['total']['total_number'] = $total_number;
        $return_array['total']['total_dealprice'] = $total_dealprice;

        // 返回结果，开始实施分页
        return $this->success($return_array);
    }

    /**
     * 库销比统计-微调
     * 还差到货时间没有加入，因为tb_product表中缺少此字段
     * 测试地址：http://www.myshop.com/test/stocksalestatistics?start_salesdate=2019-03-30&end_salesdate=2019-04-01&start_stockdate=2019-03-30&end_stockdate=2019-04-01
     * @return false|string
     */
    public function stocksalestatisticsAction()
    {
        // 逻辑
        // 取出登录公司信息
        if (!$this->currentCompany) {
            // 取出错误信息
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
        }

        // 赋值
        $companyid = $this->currentCompany;

        // 搜索框变量初始化
        // 销售日期开始时间【非空值】
        $start_salesdate = $this->request->get('start_salesdate');
        // 销售日期截止时间【非空值】，同时日期需要取到下一天的0点
        $end_salesdate = $this->request->get('end_salesdate');
        $end_salesdate = date('Y-m-d', strtotime($end_salesdate) + 86400);
        // 入库日期开始时间
        $start_stockdate = $this->request->get('start_stockdate');
        // 入库日期截止时间
        $end_stockdate = $this->request->get('end_stockdate');

        // 销售日期开始时间和截止时间不能为空
        if (!$start_salesdate || !$end_salesdate) {
            $msg = $this->getValidateMessage('salesdate-required');
            return $this->error([$msg]);
        }

        // 开始查找stock表
        // 初始化TbProductstock查询条件
        $conditions = "companyid = $companyid and entrydate between :start_stockdate: and :end_stockdate:";
        // 确定边界
        // 如果起始入库日期为空，则取一个极限小的时间
        if (!$start_stockdate) {
            $start_stockdate = date('Y-m-d', strtotime('0001-01-01 00:00:00'));
        }
        // 如果截止时间为空，那么就设置为明天的00:00:00
        if (!$end_stockdate) {
            $end_stockdate = date('Y-m-d', time() + 86400);
        } else {
            // 否则就设置为明天
            $end_stockdate = date('Y-m-d', strtotime($end_stockdate) + 86400);
        }

        // 库存模型，这个是主表，所有的查询条件都以这个为基准
        $stocks = TbWarehousing::find([
            $conditions,
            'bind' => [
                'start_stockdate' => $start_stockdate,
                'end_stockdate' => $end_stockdate,
            ],
        ]);

        // return $this->success($stocks);

        // 判断库存是否为空，如果为空，则结果最终为空
        if (count($stocks) == '0') {
            return $this->success();
        }

        // 如果不为空，那么继续往下执行
        // 取出订单id列表
        $ids = [];
        foreach ($stocks as $stock) {
            $ids[] = $stock->id;
        }
        $ids = implode(',', $ids);

        // 把入库详情表信息展示出来
        $stockdetails = TbWarehousingdetails::find(
            "warehousingid in ({$ids})"
        );

        // 继续
        $return_stocks = $stockdetails->toArray();
        foreach ($stockdetails as $k => $v) {
            // 仓库id
            $warehouseid = $v->warehousing->warehouseid;
            // 获得goodsid
            $detail = $v->getProductStock();
            // 然后取出名称、国际码、年代季节
            // 商品模型
            $productModel = TbProduct::findFirstById($detail->productid);
            // 判断产品模型是否存在
            if ($productModel) {
                // 品牌id
                $brandid = $productModel->brandid;
                // 品牌名称
                $brand = TbBrand::findFirstById($brandid);
                $name = $this->getlangfield('name');
                if (!$brand) {
                    $brandname = '';
                } else {
                    $brandname = $brand->$name;
                }
                // 品牌图片
                $brandfilename = $brand->filename;
                // 品类id
                $brandgroupid = $productModel->brandgroupid;
            } else {
                // 品牌id
                $brandid = '';
                // 品牌名称
                $brandname = '';
                // 品牌图片
                $brandfilename = '';
                // 品类id
                $brandgroupid = '';
            }

            // 年代季节，还要判断是否为空
            if ($productModel->season) {
                // ageseasonid
                $ageseasons = explode(',', $productModel->season);
                // 本土化语言保存
                $ageseasonsname = [];
                foreach ($ageseasons as $ageseason) {
                    $ageseasonModel = TbAgeseason::findFirstById($ageseason);
                    if ($ageseasonModel) {
                        $ageseasonsname[] = $ageseasonModel->sessionmark . $ageseasonModel->name;
                    } else {
                        $ageseasonsname[] = '';
                    }
                }
                $ageseasonsname = implode(',', $ageseasonsname);
            } else {
                $ageseasons = [];
                $ageseasonsname = '';
            }

            // 添加属性
            $return_stocks[$k] = [
                // 'v' => $v,
                // 'detail' => $detail,
                'goodsid' => $detail->goodsid,
                'productid' => $detail->productid,
                'property' => $detail->property,
                'number' => $v->number,
                'warehouseid' => $warehouseid,
                'sizecontentid' => $detail->sizecontentid,
                'gender' => $productModel->gender,
                'brandgroupid' => $brandgroupid,
                'brandid' => $brandid,
                'brandname' => $brandname,
                'brandfilename' => $brandfilename,
                'ageseasons' => $ageseasons,
                'ageseasonsname' => $ageseasonsname,
                'productname' => $productModel->productname,
                'wordcode' => $productModel->wordcode_1 . $productModel->wordcode_2 . $productModel->wordcode_3 . $productModel->wordcode_4,
            ];
        }

        // return $this->success($return_stocks);

        // 开始查找搜索的字段
        // 声明一个变量用来保存查询的条件
        // 下面的不是sql的查询语言，是数组专用的，需要特别处理一下
        $where = [];
        // 1、品牌【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandid = $this->request->get('brandid', 'string');
        // 验证品牌合法性
        if ($brandid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandid)) {
                $brandid_array = json_decode($brandid, true);
                $condition = [];
                foreach ($brandid_array as $id) {
                    $condition[] = "\$item['brandid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 2、品类【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandgroupid = $this->request->get('brandgroupid', 'string');
        // 验证品类合法性
        if ($brandgroupid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandgroupid)) {
                $brandgroupid_array = json_decode($brandgroupid, true);
                $condition = [];
                foreach ($brandgroupid_array as $id) {
                    $condition[] = "\$item['brandgroupid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 4、仓库【多选】
        $warehouseid = $this->request->get('warehouseid', 'string');
        // 验证仓库合法性
        if ($warehouseid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($warehouseid)) {
                $warehouseid_array = json_decode($warehouseid, true);
                $condition = [];
                foreach ($warehouseid_array as $id) {
                    $condition[] = "\$item['warehouseid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 5、年代，因为是一对多，非一对一，要用数组in查询【单选】
        $ageseasonid = $this->request->get('ageseasonid', 'int');
        if ($ageseasonid) {
            $where[] = '(' . "in_array($ageseasonid, \$item['ageseasons'])" . ')';
        }

        // 6、性别【单选】
        $gender = $this->request->get('gender', 'int');
        if (preg_match('/[012]+/', $gender)) {
            $where[] = '(' . "\$item['gender'] == " . $gender . ')';
        }

        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);

        // 开始从$stocks中检索，并保存到$return_stocks中
        $return_query_stocks = [];
        foreach ($return_stocks as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $return_query_stocks[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $return_query_stocks[] = $item;
                }
            }
        }

        // return $this->success($return_query_stocks);


        // 按照productid统计入库数量
        $return_stocks = [];
        foreach ($return_query_stocks as $k => $stock) {
            if (!isset($return_stocks[$stock['productid']])) {
                $return_stocks[$stock['productid']] = [
                    'productid' => $stock['productid'],
                    'number' => $stock['number'],
                    'sizecontentid' => $stock['sizecontentid'],
                    'gender' => $stock['brandgroupid'],
                    'brandgroupid' => $stock['brandgroupid'],
                    'brandid' => $stock['brandid'],
                    'brandname' => $stock['brandname'],
                    'brandfilename' => $stock['brandfilename'],
                    'ageseasons' => $stock['ageseasons'],
                    'ageseasonsname' => $stock['ageseasonsname'],
                    'productname' => $stock['productname'],
                    'wordcode' => $stock['wordcode'],
                    'warehouseid' => [$stock['warehouseid']],
                    // 每个仓库库存分别累计
                    'warehouseid-details' => [
                        $stock['warehouseid'] => $stock['number'],
                    ],
                ];
            } else {
                // 库存累计
                $return_stocks[$stock['productid']]['number'] += $stock['number'];
                // 仓库是多对多关系，需要整合
                // 不存在，才新增，否则就分仓库累计
                if (!in_array($stock['warehouseid'], $return_stocks[$stock['productid']]['warehouseid'])) {
                    $return_stocks[$stock['productid']]['warehouseid'][] = $stock['warehouseid'];
                }
                // 分仓库统计库存数量
                if (array_key_exists($stock['warehouseid'], $return_stocks[$stock['productid']]['warehouseid-details'])) {
                    $return_stocks[$stock['productid']]['warehouseid-details'][$stock['warehouseid']] += $stock['number'];
                } else {
                    $return_stocks[$stock['productid']]['warehouseid-details'][$stock['warehouseid']] = $stock['number'];
                }
            }
        }

        // return $this->success($return_stocks);
        // 2: {
        //     productid: "2",
        //     number: 5,
        //     sizecontentid: "11",
        //     gender: "6",
        //     brandgroupid: "6",
        //     brandid: "4",
        //     brandname: "阿迪达斯&拉夫西蒙",
        //     brandfilename: "",
        //     ageseasons: [ ],
        //     ageseasonsname: "",
        //     productname: "女士黄色长袖T恤衫59925703",
        //     wordcode: "111aaafff",
        //     warehouseid: [
        //                 "2"
        //             ],
        //     warehouseid-details: {
        //         2: 5
        //     }
        // }


        // 开始统计销售相关
        // 然后根据条件查询销售主表和销售详情表
        $conditions = "status != 2 and companyid = $companyid and salesdate between :start_salesdate: and :end_salesdate:";
        $sales = TbSales::find([
            $conditions,
            'bind' => [
                'start_salesdate' => $start_salesdate,
                'end_salesdate' => $end_salesdate,
            ],
        ]);

        // 组装数据
        // 临时变量
        $temp_sales_arr = $sales->toArray();
        foreach ($sales as $k => $sale) {
            $salesdetails = $sale->salesdetails;
            if ($salesdetails) {
                $temp_arr = $salesdetails->toArray();
                // 把$salesdetails添加销售端口、折扣率
                foreach ($temp_arr as $key => $detail) {
                    $temp_arr[$key]['discount'] = $sale->discount;
                    $temp_arr[$key]['saleportid'] = $sale->saleportid;
                }
                $temp_sales_arr[$k]['saledetails'] = $temp_arr;
            } else {
                $temp_sales_arr[$k]['saledetails'] = [];
            }
        }

        // 然后把符合条件的saledetails放进新的$saledetails_arr数组中
        $saledetails_arr = [];
        foreach ($temp_sales_arr as $item) {
            foreach ($item['saledetails'] as $saledetail) {
                if (!isset($saledetails_arr[$saledetail['id']])) {
                    // 库存模型
                    $productstock = TbProductstock::findFirstById($saledetail['productstockid']);
                    // goods模型
                    $good = TbGoods::findFirstById($productstock->goodsid);
                    // 新增数据项
                    // 商品id
                    $saledetail['productid'] = $productstock->productid;
                    // 单品价格
                    $saledetail['true_price'] = $good->price;
                    // 总价格
                    $saledetail['true_dealprice'] = $good->price * $saledetail['number'] * $saledetail['discount'];
                    // 未折扣前的价格
                    $saledetail['no_discount_price'] = $good->price * $saledetail['number'];
                    // 数据整合
                    $saledetails_arr[$saledetail['id']] = $saledetail;
                }
            }
        }

        // return $this->success($saledetails_arr);

        // 开始分条件判断
        $where = [];
        // 3、销售端口【多选】
        $saleportid = $this->request->get('saleportid', 'string');
        // 验证销售端口合法性
        if ($saleportid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($saleportid)) {
                $saleportid_array = json_decode($saleportid, true);
                $condition = [];
                foreach ($saleportid_array as $id) {
                    $condition[] = "\$item['saleportid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }


        // 7、成交价格【区间】
        $start_dealprice = $this->request->get('start_dealprice');
        $end_dealprice = $this->request->get('end_dealprice');
        // 如果两个都为空，那么不处理
        // 分三种情况处理
        if (empty($start_dealprice) && !empty($end_dealprice)) {
            $where[] = '(' . "\$item['true_dealprice'] <= {$end_dealprice}" . ')';
        } else if (!empty($start_dealprice) && empty($end_dealprice)) {
            $where[] = '(' . "\$item['true_dealprice'] >= {$start_dealprice}" . ')';
        } else if (!empty($start_dealprice) && !empty($end_dealprice)) {
            $where[] = '(' . "{$start_dealprice} <=  \$item['true_dealprice'] && {$end_dealprice} >= \$item['true_dealprice']" . ')';
        }

        // 8、折扣率【区间】
        $start_discount = $this->request->get('start_discount');
        $end_discount = $this->request->get('end_discount');
        // 如果两个都为空，那么不处理
        // 分三种情况处理
        if (empty($start_discount) && !empty($end_discount)) {
            $where[] = '(' . "\$item['true_discount'] <= {$end_discount}" . ')';
        } else if (!empty($start_discount) && empty($end_discount)) {
            $where[] = '(' . "\$item['true_discount'] >= {$start_discount}" . ')';
        } else if (!empty($start_discount) && !empty($end_discount)) {
            $where[] = '(' . "{$start_discount} <=  \$item['true_discount'] && {$end_discount} >= \$item['true_discount']" . ')';
        }

        // 9、到货时间,保存在tb_product当中的一个字段，Entrymonth，现在表中没有这个字段，先搁置

        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);

        // 开始从大数组中检索，并保存到$query_array中
        $query_sale_array = [];
        foreach ($saledetails_arr as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $query_sale_array[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $query_sale_array[] = $item;
                }
            }
        }

        // return $this->success($query_sale_array);

        // 然后进行汇总统计
        $return_saledetails = [];
        foreach ($query_sale_array as $saledetail) {
            // 如果不存在，则新插入
            if (!isset($return_saledetails[$saledetail['productid']])) {
                $return_saledetails[$saledetail['productid']] = [
                    'productid' => $saledetail['productid'],
                    'sellnumber' => $saledetail['number'],
                    'true_dealprice' => $saledetail['true_dealprice'],
                    'no_discount_price' => $saledetail['no_discount_price'],
                    'saleportid' => [$saledetail['saleportid']],
                    // 销售端口订单数量汇总
                    'saleportid-details' => [
                        $saledetail['saleportid'] => $saledetail['number'],
                    ],
                    'discount' => [$saledetail['discount']],
                    // 折扣比例订单数量汇总
                    'discount-details' => [
                        $saledetail['discount'] => $saledetail['number'],
                    ],
                ];
            } else {
                // 否则，则累计
                // 订单数量累计
                $return_saledetails[$saledetail['productid']]['sellnumber'] += $saledetail['number'];
                // 订单金额累计
                $return_saledetails[$saledetail['productid']]['true_dealprice'] += $saledetail['true_dealprice'];
                // 折扣前总金额累计
                $return_saledetails[$saledetail['productid']]['no_discount_price'] += $saledetail['no_discount_price'];
                // 折扣合并为数组
                // 首先查找有没有重复记录，如果添加重复了就不需要再次添加了
                if (!in_array($saledetail['saleportid'], $return_saledetails[$saledetail['productid']]['saleportid'])) {
                    $return_saledetails[$saledetail['productid']]['saleportid'][] = $saledetail['saleportid'];
                }
                // 销售端口合并为数组
                if (!in_array($saledetail['discount'], $return_saledetails[$saledetail['productid']]['discount'])) {
                    $return_saledetails[$saledetail['productid']]['discount'][] = $saledetail['discount'];
                }
                // 分销售端口统计销售数量
                if (array_key_exists($saledetail['saleportid'], $return_saledetails[$saledetail['productid']]['saleportid-details'])) {
                    $return_saledetails[$saledetail['productid']]['saleportid-details'][$saledetail['saleportid']] += $saledetail['number'];
                } else {
                    $return_saledetails[$saledetail['productid']]['saleportid-details'][$saledetail['saleportid']] = $saledetail['number'];
                }
                // 分折扣比例统计销售数量
                if (array_key_exists($saledetail['discount'], $return_saledetails[$saledetail['productid']]['discount-details'])) {
                    $return_saledetails[$saledetail['productid']]['discount-details'][$saledetail['discount']] += $saledetail['number'];
                } else {
                    $return_saledetails[$saledetail['productid']]['discount-details'][$saledetail['discount']] = $saledetail['number'];
                }
            }
        }

        // return $this->success($return_saledetails);
        // 1: {
        //     productid: "1",
        //     sellnumber: "1",
        //     true_dealprice: 1430,
        //     no_discount_price: 1100,
        //     saleportid: [
        //         "3"
        //     ],
        //     saleportid-details: {
        //         3: "1"
        //     },
        //     discount: [
        //         "1.30"
        //     ],
        //     discount-details: {
        //         1.30: "1"
        //     }
        // },
        // 2: {
        //         productid: "2",
        //         sellnumber: "2",
        //         true_dealprice: 18200,
        //         no_discount_price: 14000,
        //         saleportid: [
        //             "3"
        //         ],
        //         saleportid-details: {
        //             3: "2"
        //         },
        //         discount: [
        //             "1.30"
        //         ],
        //         discount-details: {
        //             1.30: "2"
        //         }
        //     }
        // }


        // 把$return_saledetails按照productstock_id压进入库表
        // 加工为一个大数据
        $return = [];
        foreach ($return_saledetails as $key => $saledetail) {
            foreach ($return_stocks as $k => $stock) {
                if (!isset($return[$stock['productid']])) {
                    $return[$stock['productid']] = $stock;
                }
            }

            // 如果上面的子循环完毕之后number为空，那么补位为0
            if (!isset($return[$saledetail['productid']])) {
                // 入库为0
                $saledetail['number'] = '0';
                // 补充$stock相关字段
                $return[$saledetail['productid']] = $saledetail;
                // 产品相关字段
                $productModel = TbProduct::findFirstById($saledetail['productid']);
                // 判断产品模型是否存在
                if ($productModel) {
                    // 品牌id
                    $brandid = $productModel->brandid;
                    // 品牌名称
                    $brand = TbBrand::findFirstById($brandid);
                    $name = $this->getlangfield('name');
                    if (!$brand) {
                        $brandname = '';
                    } else {
                        $brandname = $brand->$name;
                    }
                    // 品牌图片
                    $brandfilename = $brand->filename;
                    // 品类id
                    $brandgroupid = $productModel->brandgroupid;
                } else {
                    // 品牌id
                    $brandid = '';
                    // 品牌名称
                    $brandname = '';
                    // 品牌图片
                    $brandfilename = '';
                    // 品类id
                    $brandgroupid = '';
                }
                // 商品名称
                $return[$saledetail['productid']]['productname'] = $productModel->productname;
                // 国际码
                $return[$saledetail['productid']]['wordcode'] = $productModel->wordcode_1 . $productModel->wordcode_2 . $productModel->wordcode_3 . $productModel->wordcode_4;
                // 年代季节，还要判断是否为空
                if ($productModel->season) {
                    // ageseasonid
                    $ageseasons = explode(',', $productModel->season);
                    // 本土化语言保存
                    $ageseasonsname = [];
                    foreach ($ageseasons as $ageseason) {
                        $ageseasonModel = TbAgeseason::findFirstById($ageseason);
                        if ($ageseasonModel) {
                            $ageseasonsname[] = $ageseasonModel->sessionmark . $ageseasonModel->name;
                        } else {
                            $ageseasonsname[] = '';
                        }
                    }
                    $ageseasonsname = implode(',', $ageseasonsname);
                } else {
                    $ageseasons = [];
                    $ageseasonsname = '';
                }
                // 年代季节本土化
                $return[$saledetail['productid']]['ageseasons'] = $ageseasons;
                $return[$saledetail['productid']]['ageseasonsname'] = $ageseasonsname;

                // 品牌相关参数
                // 品牌id
                $return[$saledetail['productid']]['brandid'] = $brandid;
                // 品牌名称
                $return[$saledetail['productid']]['brandname'] = $brandname;
                // 品牌图片
                $return[$saledetail['productid']]['brandfilename'] = $brandfilename;

                // 品类相关参数
                // 品类id
                $return[$saledetail['productid']]['brandgroupid'] = $brandgroupid;

                // 性别参数
                // 性别
                $return[$saledetail['productid']]['gender'] = $productModel->gender;
            } else {
                // 补充其余的字段
                // 库销比
                // 检测库存是否为0，如果是0，则结果为0
                $return[$saledetail['productid']]['sellnumber'] = $saledetail['sellnumber'];
                $return[$saledetail['productid']]['true_dealprice'] = $saledetail['true_dealprice'];
                $return[$saledetail['productid']]['no_discount_price'] = $saledetail['no_discount_price'];
                $return[$saledetail['productid']]['saleportid'] = $saledetail['saleportid'];
                $return[$saledetail['productid']]['saleportid-details'] = $saledetail['saleportid-details'];
                $return[$saledetail['productid']]['discount'] = $saledetail['discount'];
                $return[$saledetail['productid']]['discount-details'] = $saledetail['discount-details'];
            }
            // 补充库销比
            if ($return[$saledetail['productid']]['sellnumber'] == '0' || $return[$saledetail['productid']]['number'] == '0') {
                $return[$saledetail['productid']]['rate'] = 0;
            } else {
                $return[$saledetail['productid']]['rate'] = round($return[$saledetail['productid']]['sellnumber'] / $return[$saledetail['productid']]['number'], 2);
            }
        }


        // 根据请求的参数来决定分组依据
        // 默认是按照商品，上面的逻辑都是这样的
        $groupby_method = $this->request->get('groupby');
        switch ($groupby_method) {
            // 1-商品
            case '1':
                $groupby = 'productid';
                break;
            // 2-品牌
            case '2':
                $groupby = 'brandid';
                break;
            // 默认-商品
            default:
                $groupby = 'productid';
        }

        // 因为上面的逻辑默认是按照商品进行分组的，所以如果是选择了商品分组，那么无需处理
        if ($groupby == 'productid') {
            $return_array = $return;
        } else {
            // 否则就按照品牌进行处理
            $return_array = [];
            foreach ($return as $k => $item) {
                // 如果新数组中不存在，就新增
                // 除了新增数量和金额之外，还需要增加各自的百分比
                if (!isset($return_array[$item[$groupby]])) {
                    $return_array[$item[$groupby]][$groupby] = $item[$groupby];
                    $return_array[$item[$groupby]]['sellnumber'] = $item['sellnumber'];
                    $return_array[$item[$groupby]]['number'] = $item['number'];
                    $return_array[$item[$groupby]]['brandname'] = $item['brandname'];
                    $return_array[$item[$groupby]]['brandfilename'] = $item['brandfilename'];
                } else {
                    // 否则就累计
                    $return_array[$item[$groupby]]['sellnumber'] += $item['sellnumber'];
                    $return_array[$item[$groupby]]['number'] += $item['number'];
                }
            }


            // 接着补充百分比
            foreach ($return_array as $k => $item) {
                // 如果number不为0
                if ($item['number'] == '0') {
                    $return_array[$k]['rate'] = 0;
                } else {
                    $return_array[$k]['rate'] = round($item['sellnumber'] / $item['number'], 2);
                }
            }
        }


        // 处理排序
        // 默认是按照库销比
        $orderby_field = $this->request->get('orderby');
        switch ($orderby_field) {
            // 1-库销比
            case '1':
                $orderby = 'rate';
                break;
            // 2-销售数量
            case '2':
                $orderby = 'sellnumber';
                break;
            // 默认-库销比
            default:
                $orderby = 'rate';
        }

        // 升序还是降序
        $orderby_method = $this->request->get('orderbymethod');
        switch ($orderby_method) {
            // 1-高到低【降序】
            case '1':
                $orderbymethod = 'desc';
                break;
            // 2-低到高【升序】
            case '2':
                $orderbymethod = 'asc';
                break;
            // 默认-高到低
            default:
                $orderbymethod = 'desc';
        }


        // 排序逻辑
        // 取得列的列表
        foreach ($return_array as $key => $row) {
            $rate[$key] = $row['rate'];
            $sellnumber[$key] = $row['sellnumber'];
        }

        // 将数据根据 rate 降序排列，根据 sellnumber 升序排列
        // 把 $return_array 作为最后一个参数，以通用键排序
        // 根据参数进行二维数组排序
        if ($orderby == 'rate') {
            if ($orderbymethod == 'desc') {
                array_multisort($rate, SORT_DESC, $sellnumber, SORT_ASC, $return_array);
            } else {
                array_multisort($rate, SORT_ASC, $sellnumber, SORT_DESC, $return_array);
            }
        } else {
            if ($orderbymethod == 'desc') {
                array_multisort($sellnumber, SORT_DESC, $rate, SORT_ASC, $return_array);
            } else {
                array_multisort($sellnumber, SORT_ASC, $rate, SORT_DESC, $return_array);
            }
        }

        // 最终返回
        return $this->success($return_array);
    }

    /**
     * 库销比统计-原始备份
     * 还差到货时间没有加入，因为tb_product表中缺少此字段
     * 测试地址：http://www.myshop.com/test/stocksalestatistics?start_salesdate=2019-03-30&end_salesdate=2019-04-01&start_stockdate=2019-03-30&end_stockdate=2019-04-01
     * @return false|string
     */
    public function stocksalestatistics3Action()
    {
        // 逻辑
        // 取出登录公司信息
        if (!$this->currentCompany) {
            // 取出错误信息
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
        }

        // 赋值
        $companyid = $this->currentCompany;

        // 搜索框变量初始化
        // 销售日期开始时间【非空值】
        $start_salesdate = $this->request->get('start_salesdate');
        // 销售日期截止时间【非空值】，同时日期需要取到下一天的0点
        $end_salesdate = $this->request->get('end_salesdate');
        $end_salesdate = date('Y-m-d', strtotime($end_salesdate) + 86400);
        // 入库日期开始时间
        $start_stockdate = $this->request->get('start_stockdate');
        // 入库日期截止时间
        $end_stockdate = $this->request->get('end_stockdate');

        // 销售日期开始时间和截止时间不能为空
        if (!$start_salesdate || !$end_salesdate) {
            $msg = $this->getValidateMessage('salesdate-required');
            return $this->error([$msg]);
        }

        // 开始查找stock表
        // 初始化TbProductstock查询条件
        $conditions = "defective_level = 0 and companyid = $companyid and create_time between :start_stockdate: and :end_stockdate:";
        // 确定边界
        // 如果起始入库日期为空，则取一个极限小的时间
        if (!$start_stockdate) {
            $start_stockdate = date('Y-m-d', strtotime('0001-01-01 00:00:00'));
        }
        // 如果截止时间为空，那么就设置为明天的00:00:00
        if (!$end_stockdate) {
            $end_stockdate = date('Y-m-d', time() + 86400);
        }

        // 库存模型，这个是主表，所有的查询条件都以这个为基准
        $stocks = TbProductstock::find([
            $conditions,
            'bind' => [
                'start_stockdate' => $start_stockdate,
                'end_stockdate' => $end_stockdate,
            ],
        ]);

        // 判断库存是否为空，如果为空，则结果最终为空
        if (count($stocks) == '0') {
            return $this->success();
        }
        // 转成数组
        $stocks = $stocks->toArray();

        // 按照productid统计入库数量
        $return_stocks = [];
        foreach ($stocks as $k => $stock) {
            if (!isset($return_stocks[$stock['productid']])) {
                $return_stocks[$stock['productid']] = [
                    'productid' => $stock['productid'],
                    'number' => $stock['number'],
                    'warehouseid' => [$stock['warehouseid']],
                    // 每个仓库库存分别累计
                    'warehouseid-details' => [
                        $stock['warehouseid'] => $stock['number'],
                    ],
                ];
            } else {
                // 库存累计
                $return_stocks[$stock['productid']]['number'] += $stock['number'];
                // 仓库是多对多关系，需要整合
                // 不存在，才新增，否则就分仓库累计
                if (!in_array($stock['warehouseid'], $return_stocks[$stock['productid']]['warehouseid'])) {
                    $return_stocks[$stock['productid']]['warehouseid'][] = $stock['warehouseid'];
                }
                // 分仓库统计库存数量
                if (array_key_exists($stock['warehouseid'], $return_stocks[$stock['productid']]['warehouseid-details'])) {
                    $return_stocks[$stock['productid']]['warehouseid-details'][$stock['warehouseid']] += $stock['number'];
                } else {
                    $return_stocks[$stock['productid']]['warehouseid-details'][$stock['warehouseid']] = $stock['number'];
                }
            }
        }

        // 然后根据条件查询销售主表和销售详情表
        $conditions = "status != 2 and companyid = $companyid and salesdate between :start_salesdate: and :end_salesdate:";
        $sales = TbSales::find([
            $conditions,
            'bind' => [
                'start_salesdate' => $start_salesdate,
                'end_salesdate' => $end_salesdate,
            ],
        ]);

        // 组装数据
        // 临时变量
        $temp_sales_arr = $sales->toArray();
        foreach ($sales as $k => $sale) {
            $salesdetails = $sale->salesdetails;
            if ($salesdetails) {
                $temp_arr = $salesdetails->toArray();
                // 把$salesdetails添加销售端口、折扣率
                foreach ($temp_arr as $key => $detail) {
                    $temp_arr[$key]['discount'] = $sale->discount;
                    $temp_arr[$key]['saleportid'] = $sale->saleportid;
                }
                $temp_sales_arr[$k]['saledetails'] = $temp_arr;
            } else {
                $temp_sales_arr[$k]['saledetails'] = [];
            }
        }

        // 然后把符合条件的saledetails放进新的$saledetails_arr数组中
        $saledetails_arr = [];
        foreach ($temp_sales_arr as $item) {
            foreach ($item['saledetails'] as $saledetail) {
                if (!isset($saledetails_arr[$saledetail['id']])) {
                    // 库存模型
                    $productstock = TbProductstock::findFirstById($saledetail['productstockid']);
                    // goods模型
                    $good = TbGoods::findFirstById($productstock->goodsid);
                    // 新增数据项
                    // 商品id
                    $saledetail['productid'] = $productstock->productid;
                    // 单品价格
                    $saledetail['true_price'] = $good->price;
                    // 总价格
                    $saledetail['true_dealprice'] = $good->price * $saledetail['number'] * $saledetail['discount'];
                    // 未折扣前的价格
                    $saledetail['no_discount_price'] = $good->price * $saledetail['number'];
                    // 数据整合
                    $saledetails_arr[$saledetail['id']] = $saledetail;
                }
            }
        }

        // 然后进行汇总统计
        $return_saledetails = [];
        foreach ($saledetails_arr as $saledetail) {
            // 如果不存在，则新插入
            if (!isset($return_saledetails[$saledetail['productid']])) {
                $return_saledetails[$saledetail['productid']] = [
                    'productid' => $saledetail['productid'],
                    'sellnumber' => $saledetail['number'],
                    'true_dealprice' => $saledetail['true_dealprice'],
                    'no_discount_price' => $saledetail['no_discount_price'],
                    'saleportid' => [$saledetail['saleportid']],
                    // 销售端口订单数量汇总
                    'saleportid-details' => [
                        $saledetail['saleportid'] => $saledetail['number'],
                    ],
                    'discount' => [$saledetail['discount']],
                    // 折扣比例订单数量汇总
                    'discount-details' => [
                        $saledetail['discount'] => $saledetail['number'],
                    ],
                ];
            } else {
                // 否则，则累计
                // 订单数量累计
                $return_saledetails[$saledetail['productid']]['sellnumber'] += $saledetail['number'];
                // 订单金额累计
                $return_saledetails[$saledetail['productid']]['true_dealprice'] += $saledetail['true_dealprice'];
                // 折扣前总金额累计
                $return_saledetails[$saledetail['productid']]['no_discount_price'] += $saledetail['no_discount_price'];
                // 折扣合并为数组
                // 首先查找有没有重复记录，如果添加重复了就不需要再次添加了
                if (!in_array($saledetail['saleportid'], $return_saledetails[$saledetail['productid']]['saleportid'])) {
                    $return_saledetails[$saledetail['productid']]['saleportid'][] = $saledetail['saleportid'];
                }
                // 销售端口合并为数组
                if (!in_array($saledetail['discount'], $return_saledetails[$saledetail['productid']]['discount'])) {
                    $return_saledetails[$saledetail['productid']]['discount'][] = $saledetail['discount'];
                }
                // 分销售端口统计销售数量
                if (array_key_exists($saledetail['saleportid'], $return_saledetails[$saledetail['productid']]['saleportid-details'])) {
                    $return_saledetails[$saledetail['productid']]['saleportid-details'][$saledetail['saleportid']] += $saledetail['number'];
                } else {
                    $return_saledetails[$saledetail['productid']]['saleportid-details'][$saledetail['saleportid']] = $saledetail['number'];
                }
                // 分折扣比例统计销售数量
                if (array_key_exists($saledetail['discount'], $return_saledetails[$saledetail['productid']]['discount-details'])) {
                    $return_saledetails[$saledetail['productid']]['discount-details'][$saledetail['discount']] += $saledetail['number'];
                } else {
                    $return_saledetails[$saledetail['productid']]['discount-details'][$saledetail['discount']] = $saledetail['number'];
                }
            }
        }

        // 把$return_saledetails按照productstock_id压进库存表
        // 加工为一个大数据
        foreach ($return_stocks as $k => $stock) {
            foreach ($return_saledetails as $saledetail) {
                if ($saledetail['productid'] == $stock['productid']) {
                    $saledetail['number'] = $stock['number'];
                    $return_stocks[$k] = $saledetail;
                }
            }

            // 如果上面的子循环完毕之后$stock的数据还是缺少sell_number，那么就补位为0，实现类似于left join的效果，此外，折扣率、销售端口、折扣前价格、折扣率也补位为空
            if (!isset($return_stocks[$k]['sellnumber'])) {
                $return_stocks[$k]['sellnumber'] = 0;
                $return_stocks[$k]['true_dealprice'] = 0;
                $return_stocks[$k]['no_discount_price'] = 0;
                $return_stocks[$k]['true_discount'] = 0;
                $return_stocks[$k]['saleportid'] = [];
                $return_stocks[$k]['discount'] = [];
            } else {
                // 计算出最终折扣率
                $return_stocks[$k]['true_discount'] = round($return_stocks[$k]['true_dealprice'] / $return_stocks[$k]['no_discount_price'], 2);
            }

            // 然后取出名称、国际码、年代季节
            // 商品模型
            $productModel = TbProduct::findFirstById($stock['productid']);
            // 判断产品模型是否存在
            if ($productModel) {
                // 品牌id
                $brandid = $productModel->brandid;
                // 品牌名称
                $brand = TbBrand::findFirstById($brandid);
                $name = $this->getlangfield('name');
                if (!$brand) {
                    $brandname = '';
                } else {
                    $brandname = $brand->$name;
                }
                // 品牌图片
                $brandfilename = $brand->filename;
                // 品类id
                $brandgroupid = $productModel->brandgroupid;
            } else {
                // 品牌id
                $brandid = '';
                // 品牌名称
                $brandname = '';
                // 品牌图片
                $brandfilename = '';
                // 品类id
                $brandgroupid = '';
            }
            // 商品名称
            $return_stocks[$k]['productname'] = $productModel->productname;
            // 国际码
            $return_stocks[$k]['wordcode'] = $productModel->wordcode_1 . $productModel->wordcode_2 . $productModel->wordcode_3 . $productModel->wordcode_4;
            // 年代季节，还要判断是否为空
            if ($productModel->season) {
                // ageseasonid
                $ageseasons = explode(',', $productModel->season);
                // 本土化语言保存
                $ageseasonsname = [];
                foreach ($ageseasons as $ageseason) {
                    $ageseasonModel = TbAgeseason::findFirstById($ageseason);
                    if ($ageseasonModel) {
                        $ageseasonsname[] = $ageseasonModel->sessionmark . $ageseasonModel->name;
                    } else {
                        $ageseasonsname[] = '';
                    }
                }
                $ageseasonsname = implode(',', $ageseasonsname);
            } else {
                $ageseasons = [];
                $ageseasonsname = '';
            }
            // 年代季节本土化
            $return_stocks[$k]['ageseasons'] = $ageseasons;
            $return_stocks[$k]['ageseasonsname'] = $ageseasonsname;
            // 库销比
            // 检测库存是否为0，如果是0，则结果为0
            if ($return_stocks[$k]['sellnumber'] == '0') {
                $return_stocks[$k]['rate'] = 0;
            } else {
                $return_stocks[$k]['rate'] = round($return_stocks[$k]['sellnumber'] / $return_stocks[$k]['number'], 2);
            }

            // 品牌相关参数
            // 品牌id
            $return_stocks[$k]['brandid'] = $brandid;
            // 品牌名称
            $return_stocks[$k]['brandname'] = $brandname;
            // 品牌图片
            $return_stocks[$k]['brandfilename'] = $brandfilename;

            // 品类相关参数
            // 品类id
            $return_stocks[$k]['brandgroupid'] = $brandgroupid;

            // 性别参数
            // 性别
            $return_stocks[$k]['gender'] = $productModel->gender;
        }

        // 声明一个变量用来保存查询的条件
        // 下面的不是sql的查询语言，是数组专用的，需要特别处理一下
        $where = [];
        // 1、品牌【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandid = $this->request->get('brandid', 'string');
        // 验证品牌合法性
        if ($brandid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandid)) {
                $brandid_array = json_decode($brandid, true);
                $condition = [];
                foreach ($brandid_array as $id) {
                    $condition[] = "\$item['brandid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 2、品类【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandgroupid = $this->request->get('brandgroupid', 'string');
        // 验证品类合法性
        if ($brandgroupid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandgroupid)) {
                $brandgroupid_array = json_decode($brandgroupid, true);
                $condition = [];
                foreach ($brandgroupid_array as $id) {
                    $condition[] = "\$item['brandgroupid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 3、销售端口【多选】
        $saleportid = $this->request->get('saleportid', 'string');
        // 验证销售端口合法性
        if ($saleportid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($saleportid)) {
                $saleportid_array = json_decode($saleportid, true);
                $condition = [];
                foreach ($saleportid_array as $id) {
                    $condition[] = "\$item['saleportid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 4、仓库【多选】
        $warehouseid = $this->request->get('warehouseid', 'string');
        // 验证仓库合法性
        if ($warehouseid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($warehouseid)) {
                $warehouseid_array = json_decode($warehouseid, true);
                $condition = [];
                foreach ($warehouseid_array as $id) {
                    $condition[] = '(' . "in_array($id, \$item['warehouseid'])" . ')';
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 5、年代，因为是一对多，非一对一，要用数组in查询【单选】
        $ageseasonid = $this->request->get('ageseasonid', 'int');
        if ($ageseasonid) {
            $where[] = '(' . "in_array($ageseasonid, \$item['ageseasons'])" . ')';
        }

        // 6、性别【单选】
        $gender = $this->request->get('gender', 'int');
        if (preg_match('/[012]+/', $gender)) {
            $where[] = '(' . "\$item['gender'] == " . $gender . ')';
        }

        // 7、成交价格【区间】
        $start_dealprice = $this->request->get('start_dealprice');
        $end_dealprice = $this->request->get('end_dealprice');
        // 如果两个都为空，那么不处理
        // 分三种情况处理
        if (empty($start_dealprice) && !empty($end_dealprice)) {
            $where[] = '(' . "\$item['true_dealprice'] <= {$end_dealprice}" . ')';
        } else if (!empty($start_dealprice) && empty($end_dealprice)) {
            $where[] = '(' . "\$item['true_dealprice'] >= {$start_dealprice}" . ')';
        } else if (!empty($start_dealprice) && !empty($end_dealprice)) {
            $where[] = '(' . "{$start_dealprice} <=  \$item['true_dealprice'] && {$end_dealprice} >= \$item['true_dealprice']" . ')';
        }

        // 8、折扣率【区间】
        $start_discount = $this->request->get('start_discount');
        $end_discount = $this->request->get('end_discount');
        // 如果两个都为空，那么不处理
        // 分三种情况处理
        if (empty($start_discount) && !empty($end_discount)) {
            $where[] = '(' . "\$item['true_discount'] <= {$end_discount}" . ')';
        } else if (!empty($start_discount) && empty($end_discount)) {
            $where[] = '(' . "\$item['true_discount'] >= {$start_discount}" . ')';
        } else if (!empty($start_discount) && !empty($end_discount)) {
            $where[] = '(' . "{$start_discount} <=  \$item['true_discount'] && {$end_discount} >= \$item['true_discount']" . ')';
        }

        // 9、到货时间,保存在tb_product当中的一个字段，Entrymonth，现在表中没有这个字段，先搁置

        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);

        // return $this->success($where_translate);

        // 开始从大数组中检索，并保存到$query_array中
        $query_array = [];
        foreach ($return_stocks as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $query_array[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $query_array[] = $item;
                }
            }
        }

        // 根据请求的参数来决定分组依据
        // 默认是按照商品，上面的逻辑都是这样的
        $groupby_method = $this->request->get('groupby');
        switch ($groupby_method) {
            // 1-商品
            case '1':
                $groupby = 'productid';
                break;
            // 2-品牌
            case '2':
                $groupby = 'brandid';
                break;
            // 默认-商品
            default:
                $groupby = 'productid';
        }

        // 因为上面的逻辑默认是按照商品进行分组的，所以如果是选择了商品分组，那么无需处理
        if ($groupby == 'productid') {
            $return_array = $query_array;
        } else {
            // 否则就按照品牌进行处理
            $return_array = [];
            foreach ($query_array as $k => $item) {
                // 如果新数组中不存在，就新增
                // 除了新增数量和金额之外，还需要增加各自的百分比
                if (!isset($return_array[$item[$groupby]])) {
                    $return_array[$item[$groupby]][$groupby] = $item[$groupby];
                    $return_array[$item[$groupby]]['sellnumber'] = $item['sellnumber'];
                    $return_array[$item[$groupby]]['number'] = $item['number'];
                    $return_array[$item[$groupby]]['brandname'] = $item['brandname'];
                    $return_array[$item[$groupby]]['brandfilename'] = $item['brandfilename'];
                } else {
                    // 否则就累计
                    $return_array[$item[$groupby]]['sellnumber'] += $item['sellnumber'];
                    $return_array[$item[$groupby]]['number'] += $item['number'];
                }
            }

            // 接着补充百分比
            foreach ($return_array as $k => $item) {
                // 如果number不为0
                if ($item['number'] == '0') {
                    $return_array[$k]['rate'] = 0;
                } else {
                    $return_array[$k]['rate'] = round($item['sellnumber'] / $item['number'], 2);
                }
            }
        }

        // 处理排序
        // 默认是按照库销比
        $orderby_field = $this->request->get('orderby');
        switch ($orderby_field) {
            // 1-库销比
            case '1':
                $orderby = 'rate';
                break;
            // 2-销售数量
            case '2':
                $orderby = 'sellnumber';
                break;
            // 默认-库销比
            default:
                $orderby = 'rate';
        }

        // 升序还是降序
        $orderby_method = $this->request->get('orderbymethod');
        switch ($orderby_method) {
            // 1-高到低【降序】
            case '1':
                $orderbymethod = 'desc';
                break;
            // 2-低到高【升序】
            case '2':
                $orderbymethod = 'asc';
                break;
            // 默认-高到低
            default:
                $orderbymethod = 'desc';
        }

        // 排序逻辑
        // 取得列的列表
        foreach ($return_array as $key => $row) {
            $rate[$key] = $row['rate'];
            $sellnumber[$key] = $row['sellnumber'];
        }

        // 将数据根据 rate 降序排列，根据 sellnumber 升序排列
        // 把 $return_array 作为最后一个参数，以通用键排序
        // 根据参数进行二维数组排序
        if ($orderby == 'rate') {
            if ($orderbymethod == 'desc') {
                array_multisort($rate, SORT_DESC, $sellnumber, SORT_ASC, $return_array);
            } else {
                array_multisort($rate, SORT_ASC, $sellnumber, SORT_DESC, $return_array);
            }
        } else {
            if ($orderbymethod == 'desc') {
                array_multisort($sellnumber, SORT_DESC, $rate, SORT_ASC, $return_array);
            } else {
                array_multisort($sellnumber, SORT_ASC, $rate, SORT_DESC, $return_array);
            }
        }

        // 最终返回
        return $this->success($return_array);
    }

    /**
     * 单季订货数量
     * 还差入库成本、销售成本、入库成本/销售成本的库销比、已售金额/入库成本的库销比没有加入进去
     * @return false|string
     */
    public function quarterlyorderAction()
    {
        // 取出登录公司信息
        if (!$this->currentCompany) {
            // 取出错误信息
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
        }
        // 赋值
        $companyid = $this->currentCompany;
        // 然后获取当月是第几季度
        $season = ceil((date('n')) / 3);
        // 接下来获取本季度时间范围
        $start_season = date('Y-m-d H:i:s', mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y')));
        $end_season = date('Y-m-d H:i:s', mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y')));

        // 搜索项变量预处理
        // 入库销售间隔天数
        $intervaldays = $this->request->get('intervaldays', 'int');
        // 年代
        $ageseasonid = $this->request->get('ageseasonid');
        // 品牌
        $brandid = $this->request->get('brandid');
        // 销售端口
        $saleportid = $this->request->get('saleportid');
        // 品类
        $brandgroupid = $this->request->get('brandgroupid');
        // 部门
        $departmentid = $this->request->get('departmentid', 'int');
        // 分组依据
        $groupid = $this->request->get('groupid');

        // 开始查找
        // 处理库存表
        // 库存模型，这个是主表，所有的查询条件都以这个为基准，因为不是用户输入的，所以无需动态参数绑定
        $stocks = TbWarehousing::find([
            "companyid = $companyid and entrydate between :start_stockdate: and :end_stockdate:",
            'bind' => [
                'start_stockdate' => $start_season,
                'end_stockdate' => $end_season,
            ],
        ]);

        // 判断入库记录是否为空
        if (count($stocks) == '0') {
            return $this->success();
        }

        // 如果不为空，那么继续往下执行
        // 取出订单id列表
        $ids = [];
        foreach ($stocks as $stock) {
            $ids[] = $stock->id;
        }
        $ids = implode(',', $ids);

        // 把入库详情表信息展示出来
        $stockdetails = TbWarehousingdetails::find(
            "warehousingid in ({$ids})"
        );

        // 继续
        $return_stocks = $stockdetails->toArray();
        foreach ($stockdetails as $k => $v) {
            // 获得goodsid
            $detail = $v->getProductStock();
            // 仓库id
            $warehousing = $v->warehousing;
            $warehouseid = $warehousing->warehouseid;
            // 入库时间
            $entrydate = $warehousing->entrydate;
            // 然后给库存表添加年代、品牌、品类等信息
            // 商品模型
            $productModel = TbProduct::findFirstById($detail->productid);
            // 判断产品模型是否存在
            if ($productModel) {
                // 品牌信息
                // 品牌id
                $current_brandid = $productModel->brandid;
                // 品牌名称
                $brand = TbBrand::findFirstById($current_brandid);
                $name = $this->getlangfield('name');
                if (!$brand) {
                    $current_brandname = '';
                } else {
                    $current_brandname = $brand->$name;
                }
                // 品类信息
                // 品类id
                $current_brandgroupid = $productModel->brandgroupid;
                // 品类名称
                $brandgroup = TbBrandgroup::findFirstById($current_brandgroupid);
                if (!$brandgroup) {
                    $current_brandgroupname = '';
                } else {
                    $current_brandgroupname = $brandgroup->$name;
                }
                // 年代信息
                // 年代季节，还要判断是否为空
                if ($productModel->season) {
                    // ageseasonid
                    $ageseasons = explode(',', $productModel->season);
                    // 本土化语言保存
                    $ageseasonsname = [];
                    foreach ($ageseasons as $ageseason) {
                        $ageseasonModel = TbAgeseason::findFirstById($ageseason);
                        if ($ageseasonModel) {
                            $ageseasonsname[] = $ageseasonModel->sessionmark . $ageseasonModel->name;
                        } else {
                            $ageseasonsname[] = '';
                        }
                    }
                    $ageseasonsname = implode(',', $ageseasonsname);
                } else {
                    $ageseasons = [];
                    $ageseasonsname = '';
                }
            } else {
                // 品牌id
                $current_brandid = '';
                // 品牌名称
                $current_brandname = '';
                // 品类id
                $current_brandgroupid = '';
                // 品类名称
                $current_brandgroupname = '';
                // 年代id
                $ageseasons = '';
                // 年代名称
                $ageseasonsname = '';
            }
            // 赋值
            $return_stocks[$k] = [
                'goodsid' => $detail->goodsid,
                'warehouseid' => $warehouseid,
                'productid' => $detail->productid,
                'number' => $v->number,
                'brandgroupid' => $current_brandgroupid,
                'brandgroupname' => $current_brandgroupname,
                'brandid' => $current_brandid,
                'brandname' => $current_brandname,
                'ageseasons' => $ageseasons,
                'ageseasonsname' => $ageseasonsname,
                'entrydate' => $entrydate,
            ];
        }

        // return $this->success($stocks);

        // 年代、品牌、品类在库存表完成搜索逻辑
        // 声明一个变量用来保存查询的条件
        // 下面的不是sql的查询语言，是数组专用的，需要特别处理一下
        $where = [];
        // 1、年代，因为是一对多，非一对一，要用数组in查询【单选】
        if ($ageseasonid) {
            $where[] = '(' . "in_array($ageseasonid, \$item['ageseasons'])" . ')';
        }
        // 2、品牌【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        // 验证品牌合法性
        if ($brandid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandid)) {
                $brandid_array = json_decode($brandid, true);
                $condition = [];
                foreach ($brandid_array as $id) {
                    $condition[] = "\$item['brandid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }
        // 3、品类【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        // 验证品类合法性
        if ($brandgroupid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandgroupid)) {
                $brandgroupid_array = json_decode($brandgroupid, true);
                $condition = [];
                foreach ($brandgroupid_array as $id) {
                    $condition[] = "\$item['brandgroupid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);

        // 开始从大数组中检索，并保存到$query_array中，至此库存表搜索逻辑处理完毕
        $query_stock_array = [];
        foreach ($return_stocks as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $query_stock_array[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $query_stock_array[] = $item;
                }
            }
        }


        // return $this->success($query_stock_array);


        // 然后根据条件查询销售主表和销售详情表
        $sales = TbSales::find(
            "status != 2 and companyid = $companyid and salesdate between '" . $start_season . "' and '" . $end_season . "'"
        );

        // 组装数据
        // 临时变量
        $temp_sales_arr = $sales->toArray();
        foreach ($sales as $k => $sale) {
            $salesdetails = $sale->salesdetails;
            if ($salesdetails) {
                $temp_arr = $salesdetails->toArray();
                // 把$salesdetails添加销售端口、折扣率、销售人、销售仓库、销售时间
                foreach ($temp_arr as $key => $detail) {
                    $temp_arr[$key]['discount'] = $sale->discount;
                    $temp_arr[$key]['saleportid'] = $sale->saleportid;
                    // 销售人
                    $temp_arr[$key]['salesstaff'] = $sale->salesstaff;
                    // 部门
                    $userModel = TbUser::findFirstById($sale->salesstaff);
                    if ($userModel) {
                        $current_departmentid = $userModel->departmentid;
                    } else {
                        $current_departmentid = '';
                    }
                    $temp_arr[$key]['departmentid'] = $current_departmentid;
                    // 销售仓库
                    $temp_arr[$key]['warehouseid'] = $sale->warehouseid;
                    // 销售时间
                    $temp_arr[$key]['salesdate'] = $sale->salesdate;
                }
                $temp_sales_arr[$k]['saledetails'] = $temp_arr;
            } else {
                $temp_sales_arr[$k]['saledetails'] = [];
            }
        }

        // 然后把符合条件的saledetails放进新的$saledetails_arr数组中
        $saledetails_arr = [];
        foreach ($temp_sales_arr as $item) {
            foreach ($item['saledetails'] as $saledetail) {
                if (!isset($saledetails_arr[$saledetail['id']])) {
                    // 库存模型
                    $productstock = TbProductstock::findFirstById($saledetail['productstockid']);
                    // goods模型
                    $good = TbGoods::findFirstById($productstock->goodsid);
                    // 新增数据项
                    // 商品id
                    $saledetail['productid'] = $productstock->productid;
                    // 单品价格
                    $saledetail['true_price'] = $good->price;
                    // 总价格
                    $saledetail['true_dealprice'] = $good->price * $saledetail['number'] * $saledetail['discount'];
                    // 未折扣前的价格
                    $saledetail['no_discount_price'] = $good->price * $saledetail['number'];
                    // 数据整合
                    $saledetails_arr[$saledetail['id']] = $saledetail;
                }
            }
        }

        // 声明一个变量用来保存查询的条件
        // 下面的不是sql的查询语言，是数组专用的，需要特别处理一下
        $where = [];
        // 1、销售端口
        // 验证销售端口合法性
        if ($saleportid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($saleportid)) {
                $saleportid_array = json_decode($saleportid, true);
                $condition = [];
                foreach ($saleportid_array as $id) {
                    $condition[] = "\$item['saleportid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }
        // 2、部门【单选】
        if ($departmentid) {
            $where[] = '(' . "\$item['departmentid'] == " . $departmentid . ')';
        }

        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);

        // 开始从大数组中检索，并保存到$query_array中，至此销售表搜索逻辑处理完毕
        $query_sale_array = [];
        foreach ($saledetails_arr as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $query_sale_array[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $query_sale_array[] = $item;
                }
            }
        }

        // 统计销售表中，根据productid统计出各自的销售总数以及订购金额
        $temp_sales = [];
        foreach ($query_sale_array as $k => $sale) {
            if (!isset($temp_sales[$sale['productid']])) {
                $temp_sales[$sale['productid']]['productid'] = $sale['productid'];
                // 销售数量
                $temp_sales[$sale['productid']]['number'] = $sale['number'];
                // 付款总金额
                $temp_sales[$sale['productid']]['true_dealprice'] = $sale['true_dealprice'];
            } else {
                $temp_sales[$sale['productid']]['number'] += $sale['number'];
                $temp_sales[$sale['productid']]['true_dealprice'] += $sale['true_dealprice'];
            }
        }
        // 再把库存每个productid的库存总数和订购金额写入到原来的$sale中
        foreach ($query_sale_array as $k => $sale) {
            if ($sale['productid'] == $temp_sales[$sale['productid']]['productid']) {
                $query_sale_array[$k]['sum_sellnumber'] = $temp_sales[$sale['productid']]['number'];
                $query_sale_array[$k]['sum_true_dealprice'] = $temp_sales[$sale['productid']]['true_dealprice'];
            }
        }

        // return $this->success($query_stock_array);

        // 开始处理库存表和销售表的整合逻辑
        // 根据productid、warehouseid来统计数量
        $query_return = [];
        foreach ($query_stock_array as $i => $stock) {
            foreach ($query_sale_array as $j => $sale) {
                // 如果productid、warehouseid两组数据都吻合，说明出库成功
                if ($sale['productid'] == $stock['productid'] && $sale['warehouseid'] == $stock['warehouseid']) {
                    // 用数据库innerJoin的形式拼接数据
                    $query_return[] = [
                        'productid' => $sale['productid'],
                        'warehouseid' => $sale['warehouseid'],
                        // 库存数量
                        'number' => $stock['number'],
                        // 当前productid总库存
                        'sum_number' => $stock['number'],
                        // 当前productid销售数量
                        'sellnumber' => $sale['number'],
                        // 当前productid总销售数量
                        'sum_sellnumber' => $sale['sum_sellnumber'],
                        // 当前productid总销售金额
                        'sum_true_dealprice' => $sale['sum_true_dealprice'],
                        // 入库日期
                        'create_time' => $stock['entrydate'],
                        // 销售日期
                        'salesdate' => $sale['salesdate'],
                        // 库销间隔天数
                        'intervaldays' => floor(Util::diffBetweenTwoDays($stock['entrydate'], $sale['salesdate'])),
                        // 品牌id
                        'brandid' => $stock['brandid'],
                        // 品牌名称
                        'brandname' => $stock['brandname'],
                        // 品类id
                        'brandgroupid' => $stock['brandgroupid'],
                        // 品类名称
                        'brandgroupname' => $stock['brandgroupname'],
                    ];
                }
            }
        }

        // return $this->success($query_return);

        // 整理完毕，开始处理最后的入销间隔天数
        $where = [];
        if ($intervaldays) {
            $where[] = '(' . "\$item['intervaldays'] == " . $intervaldays . ')';
        }
        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);
        // 循环得出最终结果
        $last_simple_query_return = [];
        foreach ($query_return as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $last_simple_query_return[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $last_simple_query_return[] = $item;
                }
            }
        }

        // 最后按照productid进行分组
        $groupby_productid_array = [];
        foreach ($last_simple_query_return as $k => $item) {
            if (!isset($groupby_productid_array[$item['productid']])) {
                $groupby_productid_array[$item['productid']] = [
                    'productid' => $item['productid'],
                    'sum_number' => $item['sum_number'],
                    'sum_sellnumber' => $item['sum_sellnumber'],
                    'sum_true_dealprice' => $item['sum_true_dealprice'],
                    'brandid' => $item['brandid'],
                    'brandname' => $item['brandname'],
                    'brandgroupid' => $item['brandgroupid'],
                    'brandgroupname' => $item['brandgroupname'],
                ];
            }
        }

        // 所有的常规类搜索模块处理完毕，下面开始处理分组
        // 确定分组ID
        switch ($groupid) {
            // 1-商品
            case '1':
                $groupby = 'brandid';
                break;
            // 2-品牌
            case '2':
                $groupby = 'brandgroupid';
                break;
            // 默认-商品
            default:
                $groupby = 'brandid';
        }
        // 保存最终分组变量
        $return = [];
        // 在外面统计总数量、总结算金额、库销比、
        $total_number = 0;
        $total_sellnumber = 0;
        $total_true_dealprice = 0;
        $total_rate = 0;
        foreach ($groupby_productid_array as $k => $item) {
            // 如果新数组中不存在，就新增
            if (!isset($return['items'][$item[$groupby]])) {
                // 拼接当前分组的名字
                $groupbyname = substr($groupby, 0, strlen($groupby) - 2) . 'name';
                $groupbyvalue = $item[$groupbyname];
                $return['items'][$item[$groupby]] = [
                    $groupby => $item[$groupby],
                    $groupbyname => $groupbyvalue,
                    'sum_number' => $item['sum_number'],
                    'sum_sellnumber' => $item['sum_sellnumber'],
                    'sum_true_dealprice' => $item['sum_true_dealprice'],
                ];
            } else {
                // 否则就累计
                $return['items'][$item[$groupby]]['sum_number'] += $item['sum_number'];
                $return['items'][$item[$groupby]]['sum_sellnumber'] += $item['sum_sellnumber'];
                $return['items'][$item[$groupby]]['sum_true_dealprice'] += $item['sum_true_dealprice'];
            }
            // 处理完了之后，增加百分比
            $return['items'][$item[$groupby]]['rate'] = $return['items'][$item[$groupby]]['sum_sellnumber'] / $return['items'][$item[$groupby]]['sum_number'];
            // 计数器累计
            $total_number += $return['items'][$item[$groupby]]['sum_number'];
            $total_sellnumber += $return['items'][$item[$groupby]]['sum_sellnumber'];
            $total_true_dealprice += $return['items'][$item[$groupby]]['sum_true_dealprice'];
            $total_rate = round($total_sellnumber / $total_number, 2);
        }

        // 补充total数组
        $return['total'] = [
            'total_number' => $total_number,
            'total_sellnumber' => $total_sellnumber,
            'total_true_dealprice' => $total_true_dealprice,
            'total_rate' => $total_rate,
        ];

        // 还差入库成本、销售成本、入库成本/销售成本的库销比、已售金额/入库成本的库销比没有加入进去
        // 最终返回
        return $this->success($return);
    }

    /**
     * 库存余额查询
     */
    public function stockbalanceAction()
    {
        // 逻辑
        // 取出登录公司信息
        if (!$this->currentCompany) {
            // 取出错误信息
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
        }

        // 赋值
        $companyid = $this->currentCompany;

        // 截止日期
        $end_stockdate = $this->request->get('end_stockdate');
        if (!$end_stockdate) {
            // 取出错误信息
            $msg = $this->getValidateMessage('date-required');
            return $this->error([$msg]);
        }
        $end_stockdate = date('Y-m-d', strtotime($end_stockdate) + 86400);

        // 库存模型，这个是主表，所有的查询条件都以这个为基准
        // 初始化TbProductstock查询条件
        $conditions = "defective_level = 0 and companyid = $companyid and create_time <= :end_stockdate:";
        $stocks = TbProductstock::find([
            $conditions,
            'bind' => [
                'end_stockdate' => $end_stockdate,
            ],
        ]);

        // 转成数组
        $stocks = $stocks->toArray();

        // 添加必须的字段和参数
        // 继续
        foreach ($stocks as $k => $stock) {
            // 商品模型
            $productModel = TbProduct::findFirstById($stock['productid']);
            // 添加属性
            $info = $productModel->toArray();
            unset($info['id']);
            // 重新赋值
            // 把stock的值也赋值进去
            foreach ($stock as $key => $value) {
                $info[$key] = $value;
            }
            $stocks[$k] = $info;
        }

        // 其他参数
        // 开始查找搜索的字段
        // 声明一个变量用来保存查询的条件
        // 下面的不是sql的查询语言，是数组专用的，需要特别处理一下
        $where = [];
        // 到货时间【起始和结束】

        // 价格名称，等待tb_product_price完善

        // 性别
        $gender = $this->request->get('gender', 'string');
        // 验证性别合法性
        if ($gender) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($gender)) {
                $genderid_array = json_decode($gender, true);
                $condition = [];
                foreach ($genderid_array as $id) {
                    $condition[] = "\$item['gender'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 商品属性【多选】，在tb_goods中，自营还是代销
        $property = $this->request->get('property', 'int');
        // 验证品牌合法性
        if ($property) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($property)) {
                $property_array = json_decode($property, true);
                $condition = [];
                foreach ($property_array as $id) {
                    $condition[] = "\$item['brandid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 品牌【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandid = $this->request->get('brandid', 'string');
        // 验证品牌合法性
        if ($brandid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandid)) {
                $brandid_array = json_decode($brandid, true);
                $condition = [];
                foreach ($brandid_array as $id) {
                    $condition[] = "\$item['brandid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 仓库【多选】
        $warehouseid = $this->request->get('warehouseid', 'string');
        // 验证仓库合法性
        if ($warehouseid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($warehouseid)) {
                $warehouseid_array = json_decode($warehouseid, true);
                $condition = [];
                foreach ($warehouseid_array as $id) {
                    $condition[] = "\$item['warehouseid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 品类【多选】
        // 特别说明：多选逻辑需要循环，并用or连接起来
        $brandgroupid = $this->request->get('brandgroupid', 'string');
        // 验证品类合法性
        if ($brandgroupid) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandgroupid)) {
                $brandgroupid_array = json_decode($brandgroupid, true);
                $condition = [];
                foreach ($brandgroupid_array as $id) {
                    $condition[] = "\$item['brandgroupid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 年代季节【多选】
        $ageseasons = $this->request->get('ageseasons', 'string');
        // 验证合法性
        if ($ageseasons) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($ageseasons)) {
                $ageseasons_array = json_decode($ageseasons, true);
                $condition = [];
                foreach ($ageseasons_array as $id) {
                    $condition[] = "\$item['ageseasonid'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 季节
        // 春季
        $spring = $this->request->get('spring');
        if ($spring) {
            $where[] = '(' . "\$item['spring'] > 0" . ')';
        }
        // 夏季
        $summer = $this->request->get('summer');
        if ($summer) {
            $where[] = '(' . "\$item['summer'] > 0" . ')';
        }
        // 秋季
        $fall = $this->request->get('fall');
        if ($fall) {
            $where[] = '(' . "\$item['fall'] > 0" . ')';
        }
        // 冬季
        $winter = $this->request->get('winter');
        if ($winter) {
            $where[] = '(' . "\$item['winter'] > 0" . ')';
        }

        // 品类子集【多选】
        $brandproperty = $this->request->get('brandproperty', 'string');
        // 验证品类子集合法性
        if ($brandproperty) {
            // 判断如果不是json格式就不赋值
            if (Util::is_json($brandproperty)) {
                $brandproperty_array = json_decode($brandproperty, true);
                $condition = [];
                foreach ($brandproperty as $id) {
                    $condition[] = "\$item['brandproperty'] == " . $id;
                }
                $where[] = '(' . implode(' || ', $condition) . ')';
            }
        }

        // 生成数组查询字符串
        $where_translate = implode(' && ', $where);

        // 开始从$stocks中检索，并保存到$return_query_stocks中
        $return_query_stocks = [];
        foreach ($stocks as $k => $item) {
            // 如果没有指定搜索条件，那么就全部输出
            if (!$where_translate) {
                $return_query_stocks[] = $item;
            } else {
                // where条件的语句需要通过php引擎解释出来，所以要使用eval函数
                if (eval("return $where_translate;")) {
                    $return_query_stocks[] = $item;
                }
            }
        }

        // 最后按照productid进行分组，点击之后是依照国际码排列的
        $return_stocks = [];
        foreach ($return_query_stocks as $k => $item) {
            if (!isset($return_stocks[$item['productid']])) {
                $return_stocks[$item['productid']] = [
                    'productid' => $item['productid'],
                    'stock_number' => $item['number'],
                    'sell_true_dealprice' => $item['true_dealprice'],
                ];
            } else {
                $return_stocks[$item['productid']]['stock_number'] += $item['number'];
                $return_stocks[$item['productid']]['sell_true_dealprice'] += $item['true_dealprice'];
            }
        }

        // return $this->success($return_query_stocks);

        // 初始化TbSales查询条件
        $conditions = "status != 2 and companyid = $companyid and salesdate <= :end_stockdate:";
        $sales = TbSales::find([
            $conditions,
            'bind' => [
                'end_stockdate' => $end_stockdate,
            ],
        ]);

        // 取出订单id列表
        $ids = [];
        foreach ($sales as $sale) {
            $ids[] = $sale->id;
        }
        $ids = implode(',', $ids);

        // 把销售详情表信息展示出来
        $saledetails = TbSalesdetails::find(
            "salesid in ({$ids})"
        );

        // 补充数据
        $saledetails_array = [];
        foreach ($saledetails as $k => $saledetail) {
            $sale = $saledetail->tbsales;
            $saledetail_arr = $saledetail->toArray();
            foreach ($sale as $key => $value) {
                if ($key != 'id') {
                    $saledetail_arr[$key] = $value;
                }
            }
            // 库存模型
            $productstock = TbProductstock::findFirstById($saledetail->productstockid);
            // goods模型
            $good = TbGoods::findFirstById($productstock->goodsid);
            // 新增数据项
            // 商品id
            $saledetail_arr['productid'] = $productstock->productid;
            // 单品价格
            $saledetail_arr['true_price'] = $good->price;
            // 总价格
            $saledetail_arr['true_dealprice'] = $good->price * $saledetail->number * $sale->discount;
            // 未折扣前的价格
            $saledetail_arr['no_discount_price'] = $good->price * $saledetail->number;
            // 数据整合
            $saledetails_array[$k] = $saledetail_arr;
        }

        // return $this->success($saledetails_array);

        // 最后按照productid进行分组
        $return_sales = [];
        foreach ($saledetails_array as $k => $item) {
            if (!isset($return_sales[$item['productid']])) {
                $return_sales[$item['productid']] = [
                    'productid' => $item['productid'],
                    'sell_number' => $item['number'],
                    'sell_true_dealprice' => $item['true_dealprice'],
                ];
            } else {
                $return_sales[$item['productid']]['sell_number'] += $item['number'];
                $return_sales[$item['productid']]['sell_true_dealprice'] += $item['true_dealprice'];
            }
        }

        // return $this->success($return_sales);
        // 1: {
        //     productid: "1",
        //     sell_number: 16,
        //     sell_true_dealprice: 100310
        //     },
        // 2: {
        //     productid: "2",
        //     sell_number: "1",
        //     sell_true_dealprice: 900
        // }

        // 入库数量统计
        // 库存模型，这个是主表，所有的查询条件都以这个为基准
        // 初始化TbProductstock查询条件
        $conditions = "companyid = $companyid and entrydate <= :end_stockdate:";
        $warehousings = TbWarehousing::find([
            $conditions,
            'bind' => [
                'end_stockdate' => $end_stockdate,
            ],
        ]);

        // 取出入库id列表
        $ids = [];
        foreach ($warehousings as $warehousing) {
            $ids[] = $warehousing->id;
        }
        $ids = implode(',', $ids);

        // 把入库详情表信息展示出来
        $warehousingdetails = TbWarehousingdetails::find(
            "warehousingid in ({$ids})"
        );
        // 填充信息
        $warehousingdetails_array = $warehousingdetails->toArray();
        foreach ($warehousingdetails as $k => $v) {
            // 获得goodsid
            $detail = $v->getProductStock();
            $v = $v->toArray();
            foreach ($detail as $key => $value) {
                if ($key != 'id') {
                    $v[$key] = $value;
                }
            }
            $warehousingdetails_array[$k] = $v;
        }
        // 按照productid整合
        $return_warehousings = [];
        foreach ($warehousingdetails_array as $k => $item) {
            if (!isset($return_warehousings[$item['productid']])) {
                $return_warehousings[$item['productid']] = [
                    'productid' => $item['productid'],
                    'entry_number' => $item['number'],
                ];
            } else {
                $return_warehousings[$item['productid']]['entry_number'] += $item['number'];
            }
        }
        // 1: {
        //     productid: "1",
        //     sum_number: 8
        // },
        // 2: {
        //     productid: "2",
        //     sum_number: 18
        // }

        // 开始按照productid整合

        return $this->success($return_warehousings);
    }

    /**
     * 获取自定义的header数据
     */
    public function get_all_headers()
    {
        // 忽略获取的header数据
        $ignore = ['host', 'accept', 'content-length', 'content-type', 'connection', 'accept-encoding'];

        $headers = [];

        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                $key = str_replace('_', ' ', $key);
                $key = str_replace(' ', '-', $key);
                $key = strtolower($key);

                if (!in_array($key, $ignore)) {
                    $headers[$key] = $value;
                }
            }
        }
        return $headers;
    }

    public function test2Action()
    {
        $result = [1, 2, 3, 4, 5];
        $a = '2.5';
        $b = '4.6';
        $return = [];
        foreach ($result as $v) {
            if ($a <= $v && $b >= $v) {
                $return[] = $v;
            }
        }
        return $this->success($return);

        $result = TbProductstock::sum([
            'group' => 'productid',
            'column' => 'number',
        ]);

        return $this->success($result);


        // $salesreceiveDetail = TbSalesReceive::findFirst([
        //     'salesid = 57',
        //     'order' => 'maketime desc',
        // ]);
        // return $this->success($salesreceiveDetail);

        // $salesreceive = TbSalesReceive::sum([
        //         'conditions' => 'salesid = 57',
        //         'group' => 'salesid',
        //         'column' => 'salesid',
        //     ]
        // );
        // if ($salesreceive) {
        //     return $this->success($salesreceive);
        // } else {
        //     return $this->success();
        // }


        // 销售单回款相关参数
        // $salesreceive = TbSalesReceive::find([
        //     "id = :id:",
        //     'bind' => [
        //         'id' => '1'
        //     ]
        // ]);
        // return $this->success($salesreceive);


        // $stock = [
        //     '6' => [
        //         'id' => '6',
        //         'number' => '1',
        //     ]
        // ];
        // foreach ($stock as $product) {
        //     // 库存模型
        //     $model = TbProductSearch::findFirstById($product['id']);
        //     // 做减法
        //     // 本来应该检测是否超卖的，但是上一步已经验证有库存，所以最终值不会小于0
        //     $model->number -= $product['number'];
        //     if (!$model->save()) {
        //         // 取出错误信息
        //         return $this->error($model);
        //     }
        // }
        // // 返回成功
        // return $this->success();
    }

    /**
     * 智能解析快递地址
     * api文档：https://open.kuaidihelp.com/api/1020
     */
    public function addressAction()
    {
        $host = "https://kop.kuaidihelp.com/api";
        $method = "POST";
        $headers = [];
        // 根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type" . ":" . "application/x-www-form-urlencoded; charset=UTF-8");
        $querys = "";
        $bodys = [
            "app_id" => '103033',
            "method" => 'cloud.address.resolve',
            "sign" => "bdf3b5f50865ac813cbdfd6c9b572b79",
            "ts" => time(),
            "data" => '{
                "text":"浙江省绍兴市诸暨市浣东街道西子公寓北区电话：13905857430  衣服  食物 ",
                "multimode":false
            }',
        ];
        $bodys = http_build_query($bodys);
        $url = $host;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        var_dump(curl_exec($curl));
    }


    /**
     * 从配置文件保存到数据库
     * @return false|string
     */
    public function profiletodbAction()
    {
        // 逻辑
        // 启用事务处理
        $this->db->begin();
        $languages = ['cn', 'en', 'hk', 'fr', 'it', 'sp', 'de'];
        // 遍历文件
        foreach ($languages as $language) {
            // 语言字段
            $name = 'name_' . $language;
            // 检查文件是否存在
            $language_file = APP_PATH . "/app/config/languages/{$language}.php";
            if (!file_exists($language_file)) {
                continue;
            }
            // 取出特定的语言文件
            $system_language = new \Phalcon\Config\Adapter\Php($language_file);
            // 转成数组
            $system_language_array = $system_language->toArray();
            // 处理数据，并转换成一维数组
            $return = Util::multiarray_to_assocarray($system_language_array);
            // 查看是否已经提交了
            foreach ($return as $k => $item) {
                // 键名、键值分别赋值
                list($key, $value) = [$k, $item];
                // 如果数据库存在此条记录，则无需新增
                if (!$model = TbLanguage::findFirst("code='" . $key . "'")) {
                    // 开始新增
                    $tblanguage = new TbLanguage();
                    $tblanguage->code = $key;
                    $tblanguage->$name = $value;
                    if (!$tblanguage->create()) {
                        $this->db->rollback();
                        // 报错
                        return json_encode(['code' => '200', 'messages' => ['ERROR']]);
                    }
                } else {
                    // 如果找到了，但是当前的记录为null，并且当配置文件不为空， 那么就覆盖
                    if (empty($model->$name) && !empty($value)) {
                        $model->$name = $value;
                        if (!$model->save()) {
                            $this->db->rollback();
                            // 报错
                            return json_encode(['code' => '200', 'messages' => ['ERROR']]);
                        }
                    }
                }
            }
        }
        // 提交
        $this->db->commit();
        // 返回成功
        return $this->success();
    }

    /**
     * 从数据库生成配置文件
     */
    public function dbtoprofileAction()
    {
        // 逻辑
        // 取出所有语言配置
        $datas = TbLanguage::find();
        // 当前语言配置文件内容
        $profiles = [];
        $languages = ['cn', 'en', 'hk', 'fr', 'it', 'sp', 'de'];
        // 遍历文件
        foreach ($languages as $language) {
            // 语言字段
            $name = 'name_' . $language;
            // 检查文件是否存在
            $language_file = APP_PATH . "/app/config/languages/{$language}.php";
            // // 备份文件
            // $backup_file = APP_PATH . "/app/config/languages/backup/{$language}." . date('Y-m-d-H-i-s') . ".php";
            // // 如果文件存在，则备份
            // if (file_exists($language_file)) {
            //     rename($language_file, $backup_file);
            // }

            // 组装配置内容
            foreach ($datas as $k => $data) {
                $profiles[$data->code] = $data->$name;
            }

            // 数据转换
            $simpleLanguages = Util::multiarray_to_simplearray($profiles);
            $return = Util::simplearray_to_multiarray($simpleLanguages);

            // 执行写入
            // 缓存
            $text = "<?php\nreturn " . var_export($return, true) . ';';
            if (false !== fopen($language_file, 'w+')) {
                if (!file_put_contents($language_file, $text)) {
                    // 报错
                    echo json_encode(['code' => '200', 'messages' => ['ERROR']]);
                }
            }
        }
        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['SUCCESS']]);
    }

    public function test8Action()
    {
        $file = APP_PATH . "/app/config/languages/{$language}.php";
        $array = ['color' => ['blue', 'red', 'green'], 'size' => ['small', 'medium', 'large']];
        // 缓存
        $text = "<?php\nreturn " . var_export($array, true) . ';';
        if (false !== fopen($file, 'w+')) {
            file_put_contents($file, $text);
        } else {
            echo '创建失败';
        }
    }


    /**
     * 图片批量导出
     */
    public function picexportAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 获得文件列表
            $json_files = $this->request->get('files');
            // 开始导出
            Util::exportFiles($json_files);
        }
    }

    /**
     * 文件批量导出测试
     * @return false|string
     */
    public function test10Action()
    {
        //这里需要注意该目录是否存在，并且有创建的权限
        $zipname = APP_PATH . "/public/" . date('Y-m-d-H-i-s') . ".zip";
        //这是要打包的文件地址数组
        $files = [APP_PATH . "/upload/product/91a791ff46592e73f3b37a5e293a0033.jpg", APP_PATH . "/public/upload/product/0820505ecba45bc993739ba4152aeecf.jpg", APP_PATH . "/public/upload/product/ae8deb1ae3139a6e603475441d75680f.jpg", APP_PATH . "/public/upload/product/d237442d5a8662c9a997666a652d5693.jpg", APP_PATH . "/public/upload/product/model4.jpg"];

        return $this->success($files);

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

    public function fsockopenAction($url = "http://www.myshop.com/test/log")
    {
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $port = $port ? $port : 80;
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query) $path .= '?' . $query;
        if ($scheme == 'https') {
            $host = 'ssl://' . $host;
        }

        $fp = fsockopen($host, $port, $error_code, $error_msg, 1);
        if (!$fp) {
            echo "$error_msg ($error_code)";
            return false;
        }
        stream_set_blocking($fp, 0);//非阻塞模式
        $header = "GET $url HTTP/1.1\r\n";
        $header .= "Host: $host\r\n";
        $header .= "Connection: Close\r\n\r\n";//长连接关闭
        fwrite($fp, $header);

        fclose($fp);
    }

    /**
     * 使用fsockopen发送URL请求
     * @param $url
     * @param $method : GET、POST等
     * @param array $params
     * @param array $header
     * @param int $timeout
     * @return array|bool
     */
    public function sendHttpRequestAction($url = "http://www.myshop.com/test/log", $method = 'POST', $params = [1, 2, 3, 4], $header = [], $timeout = 30)
    {
        $urlInfo = parse_url($url);

        if (isset($urlInfo['scheme']) && strcasecmp($urlInfo['scheme'], 'https') === 0) //HTTPS
        {
            $prefix = 'ssl://';
            $port = 443;
        } else {
            $prefix = 'tcp://';
            $port = isset($urlInfo['port']) ? $urlInfo['port'] : 80;
        }

        $host = $urlInfo['host'];
        $path = isset($urlInfo['path']) ? $urlInfo['path'] : '/';

        if (!empty($params) && is_array($params)) {
            // $params = http_build_query($params);
            $params = json_encode($params);
        }

        $contentType = '';
        $contentLength = '';
        $requestBody = '';
        if ($method === 'GET') {
            $params = $params ? '?' . $params : '';
            $path .= $params;
        } else {
            $requestBody = $params;
            $contentType = "Content-Type: application/x-www-form-urlencoded\r\n";
            $contentLength = "Content-Length: " . strlen($requestBody) . "\r\n";
        }

        $auth = '';
        if (!empty($urlInfo['user'])) {
            $auth = 'Authorization: Basic ' . base64_encode($urlInfo['user'] . ':' . $urlInfo['pass']) . "\r\n";
        }

        if ($header && is_array($header)) {
            $tmpString = '';
            foreach ($header as $key => $value) {
                $tmpString .= $key . ': ' . $value . "\r\n";
            }
            $header = $tmpString;
        } else {
            $header = '';
        }

        $out = "$method $path HTTP/1.1\r\n";
        $out .= "Host: $host\r\n";
        $out .= $auth;
        $out .= $header;
        $out .= $contentType;
        $out .= $contentLength;
        $out .= "Connection: Close\r\n\r\n";
        $out .= $requestBody;//post发送数据前必须要有两个换行符\r\n

        $fp = fsockopen($prefix . $host, $port, $errno, $errstr, $timeout);
        if (!$fp) {
            return false;
        }

        if (!fwrite($fp, $out)) {
            return false;
        }

        $response = '';
        while (!feof($fp)) {
            $response .= fread($fp, 1024);
        }

        if (!$response) {
            return false;
        }

        fclose($fp);

        $separator = '/\r\n\r\n|\n\n|\r\r/';

        list($responseHeader, $responseBody) = preg_split($separator, $response, 2);

        $httpResponse = [
            'header' => $responseHeader,
            'body' => $responseBody,
        ];

        return $this->success($httpResponse);
        // return $httpResponse;
    }

    public function logAction()
    {

        echo '<pre>';
        $class = new \ReflectionClass('Asa\\Erp\\TbProduct');
        $modelObject = $class->newInstance();
        $metaData = $modelObject->getModelsMetaData();
        $attributes = $metaData->getAttributes($modelObject);
        foreach ($attributes as $k => $v) {
            if ($v == 'id') {
                unset($attributes[$k]);
            }
        }
        print_r($attributes);
        echo '</pre>';
        exit;

        $test = [null, 4, 3, 5, null, '', "", 2, 3, 3, null];
        $test2 = [null, null, '', "", null];

        $data = ['name' => 1, 'score' => 2.2];

        echo '<pre>';
        print_r(array_keys($data));
        echo '</pre>';
        exit;

        return $this->success(array_keys($data));

        return $this->success(max($test2));
        return $this->success(array_filter($test2));
        // 使用原生sql查询
        // $query = $this->modelsManager->createQuery("select id,concat(ifnull(wordcode_1,''),ifnull(wordcode_2,''),ifnull(wordcode_3,''),ifnull(wordcode_4,'')) as wordcode from \Asa\Erp\TbProduct limit 10");
        // $result = $query->execute()->toArray();
        // return $this->success($result);

        $model = TbProduct::findFirst([
            "CONCAT(IFNULL(wordcode_1, ''), IFNULL(wordcode_2, ''), IFNULL(wordcode_3, ''), IFNULL(wordcode_4, '')) = '111aaabbb' and companyid = 0",
        ]);

        return $this->success($model);

        $a = '111aaabbb';
        echo substr($a, 0, 3);
        echo '<br>';
        echo substr($a, 3, 3);
        echo '<br>';
        echo substr($a, 6, 3);
        exit;
        $data = [
            ['name' => 1, 'score' => 2.2],
            ['name' => 2, 'score' => 3.3],
            ['name' => 4, 'score' => 2.5],
            ['name' => 1, 'score' => 1.1],
            ['name' => 0, 'score' => 4],
        ];
        // Util::sort_array_multi($data, ['name', 'score'], ['asc', 'desc']);

        // 排序
        $a = [
            "1" => 29,
            "2" => 27,
            "3" => 30,
            "4" => 26,
            "5" => 25,
            "6" => 25,
            "7" => 24,
        ];
        // 键名键值互换
        // $temp = [];
        // foreach ($a as $k => $v) {
        //     $temp[$v] = $k;
        // }
        // return $this->success($temp);

        // $array = array_values($a);
        // $count = count($a);
        // for ($i = 0; $i < $count - 1; $i++) {
        //     for ($j = 0; $j < $count - 1 - $i; $j++) {
        //         if ($array[$j] > $array[$j + 1]) {
        //             $temp = $array[$j + 1];
        //             $array[$j + 1] = $array[$j];
        //             $array[$j] = $temp;
        //         }
        //     }
        // }
        //
        // return $this->success($array);

        $k = Util::getArrayMaxKey($a);
        return $this->success($k);

        $new = array_flip($a);
        $max = max($a);
        return $this->success($new[$max]);
        // $data = file_get_contents('php://input');
        // var_dump($data);
        // EXIT;

        $data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        var_dump($data);

        // file_put_contents("time.txt", "local time is:" . date("Y-m-d H:i:s", time()) . PHP_EOL, FILE_APPEND);
        // sleep(10);
        // file_put_contents("time.txt", "local time is:" . date("Y-m-d H:i:s", time()) . PHP_EOL, FILE_APPEND);
    }


    /**
     * 测试假数据填充
     * @return false|string
     */
    public function testfakerAction()
    {
        // 逻辑
        $faker = Factory::create('zh_CN');  //选择中文
        $wordcode_1 = [
            '111',
        ];
        $wordcode_2 = [
            'aaa',
        ];
        $wordcode_3 = [
            'bbb',
            'ccc',
            'ddd',
            'eee',
            'fff',
        ];
        $brandgroupid = [1, 2, 3, 4, 5, 6, 7];
        $gender = [0, 1, 2];
        $brandid = [1, 2, 3, 4, 5];
        $childbrand = [2, 4, 5, 6, 7];
        $brandcolor = [1, 2, 3, 4, 5, 6];
        $wordprice = [100.5, 120, 150, 134];
        $countries = [
            '1,2',
            '1',
            '2',
            '6',
            '7',
        ];
        $sizecontentids = [
            '4,5',
            '10,11,12',
            '5,1,3,4',
        ];
        $ageseason = [1, 2, 3, 4];
        $material = [1, 2, 3, 4];
        $series = [1, 2, 3, 4];
        $series2 = [1, 2, 3, 4];
        // 生成5000条假数据
        for ($i = 0; $i < 1000; $i++) {
            $model = new TbProduct();
            $data = [
                'productname' => '女士黄色长袖T恤衫' . $faker->randomNumber(),
                'wordcode_1' => $faker->randomElement($array = $wordcode_1),
                'wordcode_2' => $faker->randomElement($array = $wordcode_2),
                'wordcode_3' => $faker->randomElement($array = $wordcode_3),
                'brandgroupid' => $faker->randomElement($array = $brandgroupid),
                'gender' => $faker->randomElement($array = $gender),
                'brandid' => $faker->randomElement($array = $brandid),
                'childbrand' => $faker->randomElement($array = $childbrand),
                'brandcolor' => $faker->randomElement($array = $brandcolor),
                'countries' => $faker->randomElement($array = $countries),
                'sizecontentids' => $faker->randomElement($array = $sizecontentids),
                'companyid' => '1',
                'wordprice' => $faker->randomElement($array = $wordprice),
                'ageseason' => $faker->randomElement($array = $ageseason),
                'material' => $faker->randomElement($array = $material),
                'series' => $faker->randomElement($array = $series),
                'series2' => $faker->randomElement($array = $series2),
            ];
            if (!$model->save($data)) {
                return $this->error('写入失败');
            }
        }
        // 生成成功
        return $this->success();
    }


    /**
     * 生成公共产品库
     * @return false|string
     * @throws \ReflectionException
     */
    public function createCommonProducts2Action()
    {
        // 逻辑
        // 首先拿到全部商品
        $products = TbProduct::find()->toArray();
        // 国际码合并处理
        // 并且进行分组
        $return = [];
        foreach ($products as $k => $product) {
            $product['wordcode'] = $product['wordcode_1'] . $product['wordcode_2'] . $product['wordcode_3'] . $product['wordcode_4'];
            $products[$k] = $product;
            // 然后按照wordcode字段进行分组
            if (!isset($return[$product['wordcode']]) || !isset($return[$product['wordcode']][$product['id']])) {
                // 如果不存在，则压入新数组
                $return[$product['wordcode']][$product['id']] = $product;
            }
        }

        // 拿到数据库的全部字段，并且去掉id和companyid字段
        $class = new \ReflectionClass('Asa\\Erp\\TbProduct');
        $modelObject = $class->newInstance();
        $metaData = $modelObject->getModelsMetaData();
        $attributes = $metaData->getAttributes($modelObject);
        foreach ($attributes as $k => $v) {
            if ($v == 'id' || $v == 'companyid') {
                unset($attributes[$k]);
            }
        }

        // 寻找是否存在名为“虚拟公司”的公司
        $companyModel = TbCompany::findFirst("name_cn='虚拟公司'");
        if (!$companyModel) {
            $companyModel = new TbCompany();
            $companyModel->create([
                'name_cn' => '虚拟公司',
            ]);
        }

        // 取出虚拟公司ID
        $companyid = $companyModel->id;

        // 转成一维数组
        $combime = [];
        // 先把键名去掉，以便后面方便处理
        foreach ($return as $k => $groupby) {
            $values = array_values($groupby);
            // 开始统计每个属性值出现的次数
            foreach ($attributes as $attribute) {
                $combime[$k][$attribute] = Util::getArrayMaxKey(array_count_values(array_filter(array_column($values, $attribute))));
            }
        }

        // 然后查找数据库，并且依次替换
        foreach ($combime as $wordcode => $item) {
            $model = TbProduct::findFirst([
                "CONCAT(IFNULL(wordcode_1, ''), IFNULL(wordcode_2, ''), IFNULL(wordcode_3, ''), IFNULL(wordcode_4, '')) = '$wordcode' and companyid = $companyid",
            ]);

            // 如果不存在就新建模型
            if (!$model) {
                $model = new TbProduct();
            }

            // 开始更新
            $item['companyid'] = $companyid;
            if (!$model->save($item)) {
                return $this->error($model);
            }
        }
        // 返回成功
        return $this->success();
    }


    public function createCommonProductsAction()
    {
        // 逻辑
        // 启用事务处理
        $this->db->begin();

        // 首先拿到全部商品
        $products = TbProduct::find()->toArray();
        // 国际码合并处理
        // 并且进行分组
        $return = [];
        foreach ($products as $k => $product) {
            $product['wordcode'] = $product['wordcode_1'] . $product['wordcode_2'] . $product['wordcode_3'] . $product['wordcode_4'];
            $products[$k] = $product;
            // 然后按照wordcode字段进行分组
            if (!isset($return[$product['wordcode']]) || !isset($return[$product['wordcode']][$product['id']])) {
                // 如果不存在，则压入新数组
                $return[$product['wordcode']][$product['id']] = $product;
            }
        }

        // 拿到数据库的全部字段，并且去掉id和companyid字段
        $class = new \ReflectionClass('Asa\\Erp\\TbProduct');
        $modelObject = $class->newInstance();
        $metaData = $modelObject->getModelsMetaData();
        $attributes = $metaData->getAttributes($modelObject);
        foreach ($attributes as $k => $v) {
            if ($v == 'id' || $v == 'companyid') {
                unset($attributes[$k]);
            }
        }

        // 寻找是否存在名为“虚拟公司”的公司
        if (!$companyModel = TbCompany::findFirst("name_cn='虚拟公司'")) {
            $companyModel = new TbCompany();
            if (!$companyModel->create([
                'name_cn' => '虚拟公司',
            ])) {
                $this->db->rollback();
                return json_encode(['code' => '200', 'messages' => ['ERROR']]);
            }
        }

        // 取出虚拟公司ID
        $companyid = $companyModel->id;

        // 建立一个管理员并关联上虚拟公司id
        if (!$userModel = TbUser::findFirst("login_name='VirtualCorporation'")) {
            $userModel = new TbUser();
            if (!$userModel->create([
                'login_name' => 'VirtualCorporation',
                'password' => md5('VirtualCorporation'),
                'e_mail' => md5('virtualcorporation@gmail.com'),
                'companyid' => $companyid,
                'real_name' => '虚拟公司管理员',
            ])) {
                $this->db->rollback();
                return json_encode(['code' => '200', 'messages' => ['ERROR']]);
            }
        }

        // 转成一维数组
        $combime = [];
        // 先把键名去掉，以便后面方便处理
        foreach ($return as $k => $groupby) {
            $values = array_values($groupby);
            // 开始统计每个属性值出现的次数
            foreach ($attributes as $attribute) {
                $combime[$k][$attribute] = Util::getArrayMaxKey(array_count_values(array_filter(array_column($values, $attribute))));
            }
        }

        // 然后查找数据库，并且依次替换
        foreach ($combime as $wordcode => $item) {
            $model = TbProduct::findFirst([
                "CONCAT(IFNULL(wordcode_1, ''), IFNULL(wordcode_2, ''), IFNULL(wordcode_3, ''), IFNULL(wordcode_4, '')) = '$wordcode' and companyid = $companyid",
            ]);

            // 如果不存在就新建模型
            if (!$model) {
                $model = new TbProduct();
            }

            // 开始更新
            $item['companyid'] = $companyid;
            if (!$model->save($item)) {
                $this->db->rollback();
                return json_encode(['code' => '200', 'messages' => ['ERROR']]);
            }
        }

        // 提交
        $this->db->commit();
        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['SUCCESS']]) . PHP_EOL;
    }

    /**
     * 测试
     */
    public function test12Action()
    {
        $a = [
            [
                'name' => 'zhansan',
                'sex' => 'boy',
                'age' => '23',
            ],
            [
                'name' => 'lisi',
                'sex' => 'boy',
                'age' => '25',
            ],
        ];
        $b = [
            [
                'name' => 'zhansan',
                'score' => '88',
            ],
            [
                'name' => 'wangwu',
                'score' => '60',
            ],
            [
                'name' => 'zhaoliu',
                'score' => '70',
            ],
        ];
        // 测试
        $return = [];
        foreach ($a as $k => $v) {
            foreach ($b as $key => $value) {
                if (!isset($return[$value['name']])) {
                    $return[$value['name']] = $value;
                }
            }
            if (!isset($return[$v['name']])) {
                $v['score'] = '0';
                $return[$v['name']] = $v;
            } else {
                $return[$v['name']]['sex'] = $v['sex'];
                $return[$v['name']]['age'] = $v['age'];
            }
        }
        return $this->success($return);
    }

    /**
     * 测试数据结构
     */
    public function testdataAction()
    {
        $test = 1;
    }

}


