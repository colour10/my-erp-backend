<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbAgeseason;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbColorSystem;
use Asa\Erp\TbColortemplate;
use Asa\Erp\TbCountry;
use Asa\Erp\TbCurrency;
use Asa\Erp\TbMaterial;
use Asa\Erp\TbMaterialnote;
use Asa\Erp\TbPicture;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductMaterial;
use Asa\Erp\TbProductMemo;
use Asa\Erp\TbProductType;
use Asa\Erp\TbSaleType;
use Asa\Erp\TbSeries;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbSizetop;
use Asa\Erp\TbUlnarinch;
use Asa\Erp\TbUser;
use Asa\Erp\TbWinterproofing;
use Asa\Erp\Util;
use Phalcon\Config\Adapter\Php;

/**
 * 公共控制器
 *
 * Class CommonController
 * @package Multiple\Home\Controllers
 */
class CommonController extends BaseController
{
    // 定义图片路径
    protected $pictureDir;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        // 图片文件夹初始化
        $this->pictureDir = APP_PATH . '/public/upload/product';
        // 不存在则创建
        if (!file_exists($this->pictureDir)) {
            mkdir($this->pictureDir);
        }
    }

    public function indexAction()
    {

    }

    /**
     * 获取语言列表
     *
     * @return false|string
     */
    function systemlanguageAction()
    {
        $config = $this->config;
        $auth = $this->auth;

        $language = $config->language;
        if (isset($_POST['language']) && preg_match("#^[a-z]{2}$#", $_POST['language'])) {
            $language = $_POST['language'];
        } else if ($auth && isset($auth['language']) && $auth['language'] != "" && preg_match("#^[a-z]{2}$#", $auth['language'])) {
            $language = $auth['language'];
        }

        $this->session->set('language', $language);

        $lang = new Php(APP_PATH . "/app/config/languages/{$language}.php");
        $lang->lang = $language;


        $lang["_image_url_prex"] = $config->file_prex;
        $lang["languages"] = $config->languages;

        $lang["_datetime"] = date("Y-m-d H:i:s");
        $lang["_date"] = date("Y-m-d");

        // 返回
        return $this->success($lang);
    }

    /**
     * 个人设置
     *
     * @return false|string
     */
    public function settingAction()
    {
        $config = $this->config;
        $auth = $this->auth;

        $setting = [];
        $setting["_currentUsername"] = $auth['username'];
        $setting["_currentid"] = $auth['id'];
        if (isset($auth['company']) && isset($auth['company']->currencyid)) {
            $setting["hkgcost"] = $auth['company']->hkgcost;
            $setting["eurcost"] = $auth['company']->eurcost;
            $setting["chncost"] = $auth['company']->chncost;
            $setting["bdacost"] = $auth['company']->bdacost;
            $setting["_currencyid"] = $auth['company']->currencyid;
        }

        $user = TbUser::findFirstById($this->currentUser);
        if ($user != false) {
            $setting['saleportid'] = $user->saleportid;
            $setting['warehouseid'] = $user->warehouseid;
            $setting['priceid'] = $user->priceid;
        }
        return $this->success($setting);
    }

    /**
     * 上传文件逻辑
     *
     * @throws \Exception
     */
    public function uploadAction()
    {
        $result = [
            "code"  => 200,
            "files" => [],
        ];

        $files = $result['files'];
        if ($this->request->hasFiles()) {
            $path = $this->config->upload_dir . $_GET["category"] . "/";
            if (!is_dir($path)) {
                mkdir($path);
            }

            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {
                $filename = sprintf(
                    "%s/%s.%s",
                    $_GET["category"],
                    md5(sprintf("%s_%s_%s", $_GET["category"], time(), rand(1, 1000000))),
                    strtolower($file->getExtension())
                );

                // Move the file into the application
                $file->moveTo($this->config->upload_dir . $filename);
                $files[$file->getName()] = $filename;

                // 如果上传到产品目录，则进行图片尺寸处理，裁剪为40*40和150*150两种分辨率
                if ($_GET["category"] == 'product') {
                    Util::convertPics($this->config->upload_dir . $filename, ['40', '150']);
                }
            }

            $result["files"] = $files;
        }

        echo json_encode($result);
    }

    /**
     * 核心程序
     *
     * @throws \ReflectionException
     */
    public function loadnameAction()
    {
        $services = [
            "product"         => ["table" => "Asa\\Erp\\TbProduct", "columns" => []],
            "productstock"    => ["table" => "Asa\\Erp\\TbProductstock", "columns" => []],
            "country"         => ["table" => "Asa\\Erp\\TbCountry", "columns" => ["code", "name_cn"]],
            "warehouse"       => ["table" => "Asa\\Erp\\TbWarehouse", "columns" => ["code", "name"]],
            "user"            => ["table" => "Asa\\Erp\\TbUser", "columns" => ["login_name", "real_name"]],
            "goods"           => ["table" => "Asa\\Erp\\TbGoods", "columns" => ["price", "productid"]],
            "orderdetails"    => ["table" => "Asa\\Erp\\TbOrderdetails", "columns" => []],
            "order"           => ["table" => "Asa\\Erp\\TbOrder", "columns" => []],
            "orderpayment"    => ["table" => "Asa\\Erp\\TbOrderPayment", "columns" => []],
            "sales"           => ["table" => "Asa\\Erp\\TbSales", "columns" => []],
            "productmaterial" => ["table" => "Asa\\Erp\\TbProductMaterial", "columns" => []],
            "saletype"        => ["table" => "Asa\\Erp\\TbSaleType", "columns" => []],
            "member"          => ["table" => "Asa\\Erp\\TbMember", "columns" => []],
            "supplierinvoice" => ["table" => "Asa\\Erp\\TbSupplierInvoice", "columns" => []],
        ];

        $params = json_decode($_POST['params']);

        $output = [];
        foreach ($params as $service_name => $id_array) {
            if (count($id_array) > 0 && isset($services[$service_name])) {
                $service_output = [];
                $idstring = implode(",", $id_array);
                if (!preg_match("#^\d+(,\d+)*$#", $idstring)) {
                    continue;
                }

                if (isset($services[$service_name]['method'])) {
                    $method = $services[$service_name]['method'];
                } else {
                    $method = "findByIdString";
                }

                if (isset($services[$service_name]['key'])) {
                    $key = $services[$service_name]['key'];
                } else {
                    $key = "id";
                }

                $findByIdString = new \ReflectionMethod($services[$service_name]['table'], $method);
                $result = $findByIdString->invokeArgs(null, [$idstring, $key]);


                foreach ($result as $row) {
                    $line = [];
                    if (count($services[$service_name]['columns']) > 0) {
                        foreach ($services[$service_name]['columns'] as $value) {
                            $line[$value] = $row->$value;
                        }
                    } else {
                        $line = $row->toArray();
                    }
                    $service_output[$row->$key] = $line;
                }

                $output[$service_name] = $service_output;
            }
        }

        echo json_encode($output);
    }

    /**
     * 公共列表
     */
    public function listAction()
    {
        $maps = [
            "confirmorderdetails" => ["model" => 'Asa\Erp\TbConfirmorderdetails', "company" => true],
            "confirmorder"        => ["model" => 'Asa\Erp\TbConfirmorder', "company" => true],
            "orderdetails"        => ["model" => 'Asa\Erp\TbOrderdetails', "company" => true],
            "order"               => ["model" => 'Asa\Erp\TbOrder', "company" => true],
            "buycar"              => ["model" => 'Asa\Erp\TbBuycar', "company" => true],
            "company"             => ["model" => 'Asa\Erp\TbCompany', "company" => false],
            "department"          => ["model" => 'Asa\Erp\TbDepartment', "company" => true],
            "goods"               => ["model" => 'Asa\Erp\TbGoods', "company" => true],
            "group"               => ["model" => 'Asa\Erp\TbGroup', "company" => true],
            "member_address"      => ["model" => 'Asa\Erp\TbMemberAddress', "company" => true],
            "member"              => ["model" => 'Asa\Erp\TbMember', "company" => true],
            "permission_group"    => ["model" => 'Asa\Erp\TbPermissionGroup', "company" => false],
            "permission_module"   => ["model" => 'Asa\Erp\TbPermissionModule', "company" => false],
            "permission"          => ["model" => 'Asa\Erp\TbPermission', "company" => false],
            "picture"             => ["model" => 'Asa\Erp\TbPicture', "company" => true],
            "product"             => ["model" => 'Asa\Erp\TbProduct', "company" => true],
            "productstock_log"    => ["model" => 'Asa\Erp\TbProductstockLog', "company" => true],
            "productstock"        => ["model" => 'Asa\Erp\TbProductstock', "company" => true],
            "productmemo"         => ["model" => 'Asa\Erp\TbProductMemo', "company" => false, "orderby" => "displayindex asc"],
            "requisition_detail"  => ["model" => 'Asa\Erp\TbRequisitionDetail', "company" => true],
            "requisition"         => ["model" => 'Asa\Erp\TbRequisition', "company" => true],
            "saleport"            => ["model" => 'Asa\Erp\TbSaleport', "company" => true],
            "saleport_user"       => ["model" => 'Asa\Erp\TbSaleportUser', "company" => true],
            "salesdetails"        => ["model" => 'Asa\Erp\TbSalesdetails', "company" => true],
            "sales"               => ["model" => 'Asa\Erp\TbSales', "company" => true],
            "supplier"            => ["model" => 'Asa\Erp\TbSupplier', "company" => true],
            "supplierlinkman"     => ["model" => 'Asa\Erp\TbSupplierLinkman', "company" => true],
            "user"                => ["model" => 'Asa\Erp\TbUser', "company" => true],
            "warehouse"           => ["model" => 'Asa\Erp\TbWarehouse', "company" => true],
            "warehouse_user"      => ["model" => 'Asa\Erp\TbWarehouseUser', "company" => true],
            "ageseason"           => ["model" => 'Asa\Erp\TbAgeseason', "company" => false, "orderby" => "name desc,sessionmark asc"],
            //"aliases" => ["model"=>'Asa\Erp\TbAliases',"company"=>false],
            "brandgroup"          => ["model" => 'Asa\Erp\TbBrandgroup', "company" => false, "orderby" => "displayindex asc"],
            "brand"               => ["model" => 'Asa\Erp\TbBrand', "company" => false],
            "brandgroupchild"     => ["model" => 'Asa\Erp\TbBrandgroupchild', "company" => false, "orderby" => "displayindex asc"],
            "colortemplate"       => ["model" => 'Asa\Erp\TbColortemplate', "company" => false, "orderby" => "code asc"],
            "country"             => ["model" => 'Asa\Erp\TbCountry', "company" => false, "orderby" => "name_en asc"],
            //"materialnote" => ["model"=>'Asa\Erp\TbMaterialnote',"company"=>false],
            "material"            => ["model" => 'Asa\Erp\TbMaterial', "company" => false, "orderby" => "name_en asc"],
            "materialnote"        => ["model" => 'Asa\Erp\TbMaterialnote', "company" => false, "orderby" => "displayindex asc"],
            "productinnards"      => ["model" => 'Asa\Erp\TbProductinnards', "company" => false],
            "property"            => ["model" => 'Asa\Erp\TbProperty', "company" => false, "orderby" => "displayindex asc"],
            "producttemplate"     => ["model" => 'Asa\Erp\TbProducttemplate', "company" => false],
            //"series2" => ["model"=>'Asa\Erp\TbSeries2',"company"=>false],
            "series"              => ["model" => 'Asa\Erp\TbSeries', "company" => false, "orderby" => "name_en asc"],
            "sizecontent"         => ["model" => 'Asa\Erp\TbSizecontent', "company" => false],
            "sizetop"             => ["model" => 'Asa\Erp\TbSizetop', "company" => false],
            //"templatemanage" => ["model"=>'Asa\Erp\TbTemplatemanage',"company"=>false],
            "ulnarinch"           => ["model" => 'Asa\Erp\TbUlnarinch', "company" => false, "orderby" => "displayindex asc"],
            "currency"            => ["model" => 'Asa\Erp\TbCurrency', "company" => false, "orderby" => "code asc"],
            "price"               => ["model" => 'Asa\Erp\TbPrice', "company" => false, "orderby" => "displayindex asc"],
            "saletype"            => ["model" => 'Asa\Erp\TbSaleType', "company" => false, "orderby" => "displayindex asc"],
            "producttype"         => ["model" => 'Asa\Erp\TbProductType', "company" => false, "orderby" => "displayindex asc"],
            "winterproofing"      => ["model" => 'Asa\Erp\TbWinterproofing', "company" => false, "orderby" => "displayindex asc"],
            "feename"             => ["model" => 'Asa\Erp\TbFeename', "company" => false, "orderby" => "displayindex asc"],
            "userprice"           => ["model" => 'Asa\Erp\TbUserPrice', "company" => false],
            "paymentway"          => ["model" => 'Asa\Erp\TbPaymentway', "company" => true, "orderby" => "displayindex asc"],
            "customsunit"         => ["model" => 'Asa\Erp\TbCustomsUnit', "company" => false, "orderby" => "displayindex asc"],
            "customswrap"         => ["model" => 'Asa\Erp\TbCustomsWrap', "company" => false, "orderby" => "displayindex asc"],
        ];
        $table = $this->dispatcher->getParam("table");
        $model = $maps[$table];

        if ($model) {
            $where = call_user_func_array($model['model'] . '::getSearchCondition', [$_REQUEST]);

            $params = [$where];
            if (isset($model['orderby'])) {
                $params['order'] = $model['orderby'];
            }
            $result = call_user_func_array($model['model'] . '::find', [$params]);

            $list = [];
            foreach ($result as $row) {
                // 去掉 $row 中的时间变量，以及 displayindex
                $row_array = $row->toArrayPipe();
                unset($row_array['created_at']);
                unset($row_array['updated_at']);
                unset($row_array['displayindex']);
                $list[] = $row_array;
            }

            echo $this->reportJson(["data" => $list]);
        } else {
            echo $this->error(["error"]);
        }

    }

    /**
     * 获取性别列表
     *
     * @return false|string
     */
    public function gendersAction()
    {
        $language = $this->getDI()->get("session")->get("language");
        $lang = new Php(APP_PATH . "/app/config/languages/{$language}.php");

        $genders = isset($lang['list']['gender']) ? $lang['list']['gender'] : [];
        return $this->success($genders);
    }

    /**
     * 删除文件
     */
    public function deleteAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            $path = $this->request->get('path');
            @unlink(APP_PATH . '/public/upload/' . $path);
        }
        // 返回成功
        return $this->success();
    }

    /**
     * 导入 excel 结果预览
     *
     * @return false|string
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function importExcelPreviewAction()
    {
        // 逻辑
        // 如果未登录
        if (!$this->currentCompany) {
            return $this->error($this->getValidateMessage('model-delete-message'));
        }

        // 如果参数不对
        if (!$this->request->isPost() || !$path = $this->request->getPost('path')) {
            return $this->error($this->getValidateMessage('params-error'));
        }

        // 参数定义
        // 忽略，插入失败
        $ignore = 0;
        // 新增
        $insert = 0;
        // 修改
        $modify = 0;

        // 判断是否存在该商品
        if ($datas = Util::importExcelWithoutPictures(APP_PATH . '/public/upload/' . $path)) {
            foreach ($datas as $data) {
                // 必填字段必须存在，否则插入失败
                if (
                    !isset($data[0]) ||
                    !isset($data[1]) ||
                    !isset($data[2]) ||
                    !isset($data[3]) ||
                    !isset($data[4]) ||
                    !isset($data[5]) ||
                    !isset($data[6]) ||
                    !isset($data[7]) ||
                    !$data[0] ||
                    !$data[1] ||
                    !$data[2] ||
                    !$data[3] ||
                    !$data[4] ||
                    !$data[5] ||
                    !$data[6] ||
                    !$data[7]
                ) {
                    $ignore++;
                    continue;
                }

                // 国际码存在了，那么再判断数据库是否存在
                if ($product = TbProduct::findFirst("wordcode = '" . $data[0] . "' and companyid = " . $this->companyid)) {
                    // 如果存在该商品，那么就是修改
                    $modify++;
                    continue;
                }

                // 以上都不符合，那么就插入成功
                $insert++;
            }
        }
        // 返回
        return $this->success($this->getValidateMessages('template', 'import-excel-result', $insert, $modify, $ignore));
    }

    /**
     * 导入 excel 逻辑
     *
     * @return false|string
     * @throws \Exception
     */
    public function importExcelAction()
    {
        // 逻辑
        // 如果未登录
        if (!$this->companyid) {
            return $this->error($this->getValidateMessage('model-delete-message'));
        }

        // 如果参数不对
        if (!$this->request->isPost() || !$path = $this->request->get('path')) {
            return $this->error($this->getValidateMessage('params-error'));
        }

        // 导入 excel 数据
        if ($datas = Util::importExcelWithoutPictures(APP_PATH . '/public/upload/' . $path)) {
            // 遍历
            foreach ($datas as $data) {
                // 采用事务处理
                $this->db->begin();

                // 必填字段必须存在，否则插入失败
                if (
                    !isset($data[0]) ||
                    !isset($data[1]) ||
                    !isset($data[2]) ||
                    !isset($data[3]) ||
                    !isset($data[4]) ||
                    !isset($data[5]) ||
                    !isset($data[6]) ||
                    !$data[0] ||
                    !$data[1] ||
                    !$data[2] ||
                    !$data[3] ||
                    !$data[4] ||
                    !$data[5] ||
                    !$data[6]
                ) {
                    // 提示
                    $this->logFile->log('必填资料不全，直接忽略，当前处理的数据是：' . json_encode($data));
                    // 忽略
                    continue;
                }

                // 开始处理
                // // 判断companyid=1的商品国际码是否存在，如果存在，则更新，不存在则创建
                // if (TbProduct::find("wordcode = '" . $data[0] . "' AND companyid = " . $this->companyid)) {
                //     // 记录日志
                //     $this->logFile->log('wordcode = ' . $data[0] . '的商品已经存在，接下来将进行更新操作');
                //     // 忽略
                //     continue;
                // }

                // 品牌，先转换成小写再统一比较，如果不存在则忽略
                if (!$brandid = $this->getIds($data[1], TbBrand::class, function ($value) {
                    return "lower(name_en) = '" . strtolower($value) . "'";
                })) {
                    // 提示
                    $this->logFile->log('品牌 ' . $data[1] . ' 不存在');
                    // 忽略
                    continue;
                }

                // 年代季节
                // 季节
                $ageseason_season = substr($data[2], 0, 2);
                // 年代
                $ageseason_year = substr($data[2], 2);
                if (!$ageseason = $this->getIds($data[2], TbAgeseason::class, function ($value) use ($ageseason_season, $ageseason_year) {
                    return "sessionmark = '" . $ageseason_season . "' AND name = '" . $ageseason_year . "'";
                })) {
                    // 提示
                    $this->logFile->log('年代季节 ' . $data[2] . ' 不存在');
                    // 忽略
                    continue;
                }

                // 品类，中文
                if (!$brandgroupid = $this->getIds($data[3], TbBrandgroup::class, function ($value) {
                    return "name_cn = '" . $value . "'";
                })) {
                    // 提示
                    $this->logFile->log('品类 ' . $data[3] . ' 不存在');
                    // 忽略
                    continue;
                }

                // 子品类，中文
                if (!$childbrand = $this->getIds($data[4], TbBrandgroupchild::class, function ($value) {
                    return "name_cn = '" . $value . "'";
                })) {
                    // 提示
                    $this->logFile->log('子品类 ' . $data[4] . ' 不存在');
                    // 忽略
                    continue;
                }

                // 尺码明细
                // 生成默认尺码组名称，格式为品牌_子品类
                $defaultSizetop = $data[1] . '_' . $data[4];
                $size = $this->_createSizetop($data[5], $defaultSizetop);
                $sizetopid = $size['sizetopid'];
                $sizecontentids = $size['sizecontentids'];

                // 主颜色，英文
                if (!$color_id = $this->getIds($data[6], TbColortemplate::class, function ($value) {
                    return "lower(name_en) = '" . strtolower($value) . "'";
                })) {
                    // 提示
                    $this->logFile->log('主颜色 ' . $data[6] . ' 不存在');
                    // 忽略
                    continue;
                }

                // 以下为选填字段
                // 副颜色
                $second_color_id = $this->getIds($data[9], TbColortemplate::class, function ($value) {
                    return "lower(name_en) = '" . strtolower($value) . "'";
                });

                // 性别，中文
                $gender = TbProduct::$genderName[$data[7]] ?? null;

                // 产地
                $countries = $this->getIds($data[13], TbCountry::class, function ($value) {
                    return "name_cn = '" . $value . "'";
                });

                // 商品尺寸
                $ulnarinch = $this->getIds($data[14], TbUlnarinch::class, function ($value) {
                    return "name_cn = '" . $value . "'";
                });

                // 商品描述
                $productmemoids = $this->getIds($data[15], TbProductMemo::class, function ($value) {
                    return "name_cn = '" . $value . "'";
                });

                // 系列
                $series = $this->getIds($data[24], TbSeries::class, function ($value) {
                    return "name_en= '" . $value . "' AND companyid = " . $this->companyid;
                });

                // 销售属性
                $saletypeid = $this->getIds($data[25], TbSaleType::class, function ($value) {
                    return "name_cn= '" . $value . "'";
                });

                // 商品属性
                $producttypeid = $this->getIds($data[26], TbProductType::class, function ($value) {
                    return "name_cn= '" . $value . "'";
                });

                // 防寒指数
                $winterproofingid = $this->getIds($data[27], TbWinterproofing::class, function ($value) {
                    return "name_cn= '" . $value . "'";
                });

                // 国际出厂价币种
                $factorypricecurrency = $this->getIds($data[16], TbCurrency::class, function ($value) {
                    return "name_cn= '" . $value . "'";
                });

                // 国际零售价币种
                $wordpricecurrency = $this->getIds($data[18], TbCurrency::class, function ($value) {
                    return "name_cn= '" . $value . "'";
                });

                // 国内出厂价币种
                $nationalfactorypricecurrency = $this->getIds($data[20], TbCurrency::class, function ($value) {
                    return "name_cn= '" . $value . "'";
                });

                // 国内零售价币种
                $nationalpricecurrency = $this->getIds($data[22], TbCurrency::class, function ($value) {
                    return "name_cn= '" . $value . "'";
                });

                // 写入数据预处理
                $insertData = [
                    // 公司
                    'companyid'                    => $this->companyid,
                    // 建档人
                    'makestaff'                    => $this->userId,
                    // 国际码
                    'wordcode'                     => $data[0],
                    // 品牌
                    'brandid'                      => $brandid,
                    // 年代季节
                    'ageseason'                    => $ageseason,
                    // 季节
                    'ageseason_season'             => $ageseason_season,
                    // 年代
                    'ageseason_year'               => $ageseason_year,
                    // 品类
                    'brandgroupid'                 => $brandgroupid,
                    // 子品类
                    'childbrand'                   => $childbrand,
                    // 尺码组
                    'sizetopid'                    => $sizetopid,
                    // 尺码明细
                    'sizecontentids'               => $sizecontentids,
                    // 主颜色
                    'color_id'                     => $color_id,
                    // 性别
                    'gender'                       => $gender,
                    // 副颜色
                    'second_color_id'              => $second_color_id,
                    // 主图
                    'picture'                      => $data[11],
                    // 附图
                    'picture2'                     => $data[12],
                    // 产地
                    'countries'                    => $countries,
                    // 商品尺寸
                    'ulnarinch'                    => $ulnarinch,
                    // 商品尺码描述
                    'producttemplate'              => $productmemoids,
                    // 国际出厂价币种
                    'factorypricecurrency'         => $factorypricecurrency,
                    // 国际出厂价
                    'factoryprice'                 => $data[17],
                    // 国际零售价币种
                    'wordpricecurrency'            => $wordpricecurrency,
                    // 国际零售价
                    'wordprice'                    => $data[19],
                    // 本国出厂价币种
                    'nationalfactorypricecurrency' => $nationalfactorypricecurrency,
                    // 本国出厂价
                    'nationalfactoryprice'         => $data[21],
                    // 本国零售价币种
                    'nationalpricecurrency'        => $nationalpricecurrency,
                    // 本国零售价
                    'nationalprice'                => $data[23],
                    // 商品系列
                    'series'                       => $series,
                    // 销售属性
                    'saletypeid'                   => $saletypeid,
                    // 商品属性
                    'producttypeid'                => $producttypeid,
                    // 防寒指数
                    'winterproofingid'             => $winterproofingid,
                    // 季节，这个放在下面处理
                    // 备注
                    'memo'                         => $data[29],
                    // 创建时间
                    'created_at'                   => date('Y-m-d H:i:s'),
                    // 更新时间
                    'updated_at'                   => date('Y-m-d H:i:s'),
                ];

                // 季节，这个单独处理
                $seasons = ($data[28] !== '四季') ? $data[28] : '春季,夏季,秋季,冬季';
                $seasons = explode(',', $seasons);
                foreach ($seasons as $season) {
                    $insertData[TbProduct::$seasonName[$season]] = 1;
                }

                // 色系及主颜色
                // 回添加的 model 和 id
                $productColorsResults = $this->_createColor($insertData);
                $productModels = $productColorsResults['models'];
                $productIds = $productColorsResults['ids'];
                // 数据库查询 sql语句
                $productIds_string = '(' . implode(',', $productIds) . ')';

                // 材质及备注
                $this->_createComposition($data[8], $insertData['brandgroupid'], $productIds, $productIds_string);

                // 最后处理主图、附图、详情图列表
                $this->_createPictures($data, $productModels, $productIds_string);

                // 无错误则提交
                $this->db->commit();
            }
        }

        // 返回
        return $this->success();
    }

    /**
     * 生成尺码组
     *
     * @param $sizeContents -尺码明细
     * @param $sizetopName -默认尺码组名称
     * @return array
     * @throws \Exception
     */
    private function _createSizetop($sizeContents, $sizetopName)
    {
        // 初始化
        $sizetop_id = '';
        $sizecontentids = '';
        // 必须是数组
        $sizes = explode(',', $sizeContents);
        // 尺码组列表
        $sizeTops = [];
        // 返回值
        $return = [];
        foreach (TbSizetop::find() as $sizetop) {
            $sizeTops[$sizetop->id] = array_column($sizetop->sizecontents->toArray(), 'name');
        }
        foreach ($sizeTops as $k => $sizeTop) {
            // 查找当前商品的尺码明细和循环的尺码明细是否一致，如果一致，说明找到了
            // 如果找到了，则尺码组的名称和当前的名称一致，程序退出
            // 这个方法是判断两个数组的值完全相等的算法
            if (!array_diff($sizes, $sizeTop) && !array_diff($sizeTop, $sizes)) {
                $sizetop_id = $k;
                $sizecontentids = implode(',', array_column(TbSizetop::findFirstById($sizetop_id)->sizecontents->toArray(), 'id'));
                break;
            }
        }

        // 循环结束之后，判断 $sizetop_id 是否有值，如果有值，则保持不变，否则就新增
        if ($sizetop_id !== '') {
            // 但是需要填充 sizetopid 和 sizecontentids
            $return['sizetopid'] = $sizetop_id;
            $return['sizecontentids'] = $sizecontentids;
        } else {
            // 新增尺码组和尺码明细
            $name_en = $name_cn = $sizetopName;
            $displayindex = 0;
            $sizetopModel = new TbSizetop();
            if (!$sizetopModel->create(compact('name_cn', 'name_en', 'displayindex'))) {
                // 记录错误信息
                $this->db->rollback();
                $this->logFile->log('sizetop => create 失败了，错误信息为：' . json_encode($sizetopModel->getMessages()));
            }
            // 然后添加 displayindex 为 id 的 10 倍
            $displayindex = $sizetopModel->id * 10;
            if (!$sizetopModel->update(compact('displayindex'))) {
                // 记录错误信息
                $this->db->rollback();
                $this->logFile->log('sizetop => update 失败了，错误信息为：' . json_encode($sizetopModel->getMessages()));
            }

            // 拿到 sizetopid
            $return['sizetopid'] = $sizetopModel->id;

            // 尺码明细
            foreach ($sizes as $size) {
                // 开始添加尺码
                $topid = $return['sizetopid'];
                $name = $size;
                $sizecontentModel = new TbSizecontent();
                if (!$sizecontentModel->create(compact('topid', 'name'))) {
                    // 记录错误信息
                    $this->db->rollback();
                    $this->logFile->log('sizecontent => create 失败了，错误信息为：' . json_encode($sizecontentModel->getMessages()));
                }
                // 然后添加 displayindex 为 id 的 10 倍
                $displayindex = $sizecontentModel->id * 10;
                if (!$sizecontentModel->update(compact('displayindex'))) {
                    // 记录错误信息
                    $this->db->rollback();
                    $this->logFile->log('sizecontent => update 失败了，错误信息为：' . json_encode($sizecontentModel->getMessages()));
                }
            }

            // 拿到 sizecontentids
            $return['sizecontentids'] = implode(',', array_column($sizetopModel->sizecontents->toArray(), 'id'));
        }
        // 返回
        return $return;
    }

    /**
     * 创建颜色
     *
     * @param array $data
     * @return array|TbProduct
     * @throws \Exception
     */
    private function _createColor(array $data)
    {
        // 定义一个包含model的空数组 + id列表
        $productModels = [];
        $productIds = [];
        // 英文颜色
        $colorEnArr = explode(',', $data['color_id']);
        // 可能会有多个颜色，这个时候要用遍历获取
        // 如果颜色为空，那么就单纯添加一条记录即可。
        if (count($colorEnArr) == 0) {
            // 如果没有颜色，那么就只需要增加一条记录即可
            $productModel = new TbProduct();
            if (!$productModel->create($data)) {
                // 记录错误信息
                $this->db->rollback();
                $this->logFile->log('product => create 失败了，错误信息为：' . json_encode($productModel->getMessages()));
            }
            // 返回 $productModel 和 $productId，单条记录
            return [
                'models' => [$productModel],
                'ids'    => [$productModel->id],
            ];
        }

        // 否则至少有一种颜色，预计多次写入
        foreach ($colorEnArr as $k => $colorName) {
            if (!$colorModel = TbColortemplate::findFirst([
                'conditions' => 'lower(name_en) = :name_en:',
                'bind'       => [
                    'name_en' => strtolower($colorName),
                ],
            ])) {
                // 涉及到颜色新增，但是色系不知道，这个时候需要预测色系，我们规定，如果颜色当中有任何一个字存在某个色系文字里，那么就属于该色系的颜色
                $color_system_id = 0;
                foreach (TbColorSystem::find() as $colorSystem) {
                    // 去掉色系中的“色”字
                    $outColor = str_replace('色', '', $colorSystem->title);
                    // 还有 蓝 和 兰 也是通用的，如果颜色中含有任何一个 lan 字，那么就匹配所有的 lan
                    $outColor = (strpos($outColor, '兰') !== false || strpos($outColor, '蓝') !== false) ? $outColor . '兰蓝' : $outColor;
                    // 如果找到了, 则记录下来
                    if (Util::stringDiff($colorName, $outColor) === true) {
                        $color_system_id = $colorSystem->id;
                        continue;
                    }
                }
                // 添加颜色，英文和中文都默认为小写传入的颜色
                $colorModel = new TbColortemplate();
                if (!$colorModel->create([
                    'name_cn'         => strtolower($colorName),
                    'name_en'         => strtolower($colorName),
                    // 理论上 color_system_id 的值不能为 0，否则会有意想不到的 bug，这个时候我们强行规定其为混色好了
                    'color_system_id' => $color_system_id === 0 ? 9 : $color_system_id,
                ])) {
                    $this->db->rollback();
                    $this->logFile->log('Colortemplate => create 失败了，错误信息为：' . json_encode($colorModel->getMessages()));
                }
            }

            // 颜色赋值
            $data['color_id'] = $colorModel->id;
            // 色系赋值
            $data['brandcolor'] = $data['color_system_id'] = $colorModel->color_system_id;

            // 开始写入
            // 因为要统计同款不同色，所以，先把每个 $productModel 的值缓存起来，便于更新
            $productModels[$k] = new TbProduct();
            if (!$productModels[$k]->create($data)) {
                // 记录错误信息
                $this->db->rollback();
                $this->logFile->log('product => create 失败了，错误信息为：' . json_encode($productModels[$k]->getMessages()));
            }
            // 记录包含 product_id 的列表
            $productIds[$k] = $productModels[$k]->id;
        }

        // 更新同款不同色数据
        if (count($productModels) > 0) {
            // 获取 product_group
            $product_group = [];
            // 几个新增的模型
            foreach ($productModels as $productModel) {
                $product_group[] = $productModel->id . ',' . $productModel->color_id;
            }
            $product_group = implode('|', $product_group);
            // 每个模型填充 product_group
            foreach ($productModels as $productModel) {
                if (!$productModel->update(compact('product_group'))) {
                    $this->db->rollback();
                    $this->logFile->log('productModel => update => product_group失败了，错误信息为：' . json_encode($productModel->getMessages()));
                }
            }
        }

        // 返回 $productModels 和 $productIds，多条记录
        return [
            'models' => $productModels,
            'ids'    => $productIds,
        ];
    }

    /**
     * 处理材质
     *
     * @param $composition
     * @param string $lang
     * @return array
     * @throws \Exception
     */
    private function _doComposition($composition, $lang = 'cn')
    {
        // 逻辑
        $composition_array = explode(';', $composition);
        // 把 表面 材质写进去，因为这个是默认的
        if (!$materialNoteModel = TbMaterialnote::findFirst("content_en = 'OUTER'")) {
            $materialNoteModel = new TbMaterialnote();
            if (!$materialNoteModel->create([
                'content_cn' => '表面',
                'content_en' => 'OUTER',
            ])) {
                $this->db->rollback();
                $this->logFile->log('TbMaterialnote 添加表面材质失败，错误信息为：' . json_encode($materialNoteModel->getMessages()));
            }
        }
        // content 字段
        $content_lang = 'content_' . $lang;
        $content = $materialNoteModel->$content_lang ?? '';
        $results = array_map(function ($value) use ($content) {
            // 判断是否有材质备注
            // 如果没有，就把材质备注补充进去
            if (strpos($value, ':') === false) {
                $value = $content . ':' . $value;
            }

            // 经过以上的判断，材质备注和材质详情都齐了，继续
            $val = explode(':', $value);
            // 取出值
            // 材质备注，默认：表面
            $materialNote = $val[0];
            // 材质详情
            $materialInfo = $val[1];
            // 如果有多个材质，比如珍珠,金属之类的，那么上一步处理之后的数据类似于 表面:珍珠,金属, 接下来是把多个材质分开
            $secondValue = explode(',', $materialInfo);
            // 返回
            return array_map(function ($v) use ($materialNote) {
                // 判断是否有百分号 %，没有则补充
                if (strpos($v, '%') === false) {
                    $v = $v . ' 100%';
                }
                return $materialNote . ' ' . $v;
            }, $secondValue);
        }, $composition_array);

        // 二维数组->一维数组
        $simpleResult = [];
        array_map(function ($value) use (&$simpleResult) {
            $simpleResult = array_merge($simpleResult, array_values($value));
        }, $results);

        // 按照空格切割材质和百分比
        $return = [];
        array_map(function ($value) use (&$return) {
            // 开始切割
            $pattern = '/(\S+)\s+(\S+)\s+(\S+)/';
            preg_match_all($pattern, $value, $matches);
            // 材质名称和材质百分比都存在的情况下，才有效，同时去掉空格
            if (isset($matches[1][0]) && isset($matches[2][0]) && isset($matches[3][0]) && $matches[1][0] && $matches[2][0] && $matches[3][0]) {
                $return[] = [
                    strtoupper(trim($matches[1][0])),
                    strtoupper(trim($matches[2][0])),
                    trim(str_replace('%', '', $matches[3][0])),
                ];
            } else {
                $return[] = [];
            }
        }, $simpleResult);
        // 返回
        return $return;
    }

    /**
     * 写入不存在的材质备注 + 材质
     *
     * @param string $composition_cn -中文材质
     * @param int $brandgroupid -品类id
     * @param array $productIds -$productIds 列表
     * @return void
     * @throws \Exception
     */
    private function _createComposition(string $composition_cn, int $brandgroupid, array $productIds, $productIds_string)
    {
        // 材质一维数组列表
        $composition_array = $this->_doComposition($composition_cn, 'cn');

        // 先删除原来的记录
        foreach (TbProduct::find("id in " . $productIds_string) as $product) {
            foreach ($product->productMaterial as $material) {
                if (!$material->delete()) {
                    $this->db->rollback();
                    $this->logFile->log('material 删除失败，错误信息为：' . json_encode($material->getMessages()));
                }
            }
        }

        // 写入材质和材质备注
        foreach ($productIds as $productId) {
            foreach ($composition_array as $k => $v) {
                // 材质
                if (!$materialModel = TbMaterial::findFirst("name_cn = '" . $v[1] . "'")) {
                    // 添加
                    $materialModel = new TbMaterial();
                    if (!$materialModel->create([
                        'name_cn' => $v[1],
                        'name_en' => $v[1],
                    ])) {
                        $this->db->rollback();
                        $this->logFile->log('materialModel create插入材质失败，错误信息为：' . json_encode($materialModel->getMessages()));
                    }
                }

                // 材质备注
                if (!$materialnoteModel = TbMaterialnote::findFirst("content_cn = '" . $v[0] . "'")) {
                    // 添加
                    $materialnoteModel = new TbMaterialnote();
                    if (!$materialnoteModel->create([
                        'content_cn'    => $v[0],
                        'content_en'    => $v[0],
                        'brandgroupids' => $brandgroupid,
                    ])) {
                        $this->db->rollback();
                        $this->logFile->log('materialnoteModel create插入材质备注失败，错误信息为：' . json_encode($materialnoteModel->getMessages()));
                    }
                    // 添加排序字段
                    $displayindex = $materialnoteModel->id * 10;
                    if (!$materialnoteModel->update(compact('displayindex'))) {
                        $this->db->rollback();
                        $this->logFile->log('materialnoteModel update displayindex 失败，错误信息为：' . json_encode($materialnoteModel->getMessages()));
                    }
                } else {
                    // 如果材质备注存在，那么就检查该条记录的 brandgroupids 字段是否包含当前循环记录的 brandgroup
                    $brandgroupids_array = explode(',', $materialnoteModel->brandgroupids);
                    if (!in_array($brandgroupid, $brandgroupids_array)) {
                        array_push($brandgroupids_array, $brandgroupid);
                        if (!$materialnoteModel->update([
                            'brandgroupids' => implode(',', $brandgroupids_array),
                        ])) {
                            $this->db->rollback();
                            $this->logFile->log('materialnoteModel update brandgroupids 失败，错误信息为：' . json_encode($materialnoteModel->getMessages()));
                        }
                    }
                }

                // 都存在之后，写入关联表: tb_product_material
                // 添加
                $TbProductMaterialModel = new TbProductMaterial();
                if (!$TbProductMaterialModel->create([
                    'productid'      => $productId,
                    'percent'        => $v[2],
                    'materialid'     => $materialModel->id,
                    'materialnoteid' => $materialnoteModel->id,
                ])) {
                    $this->db->rollback();
                    $this->logFile->log('TbProductMaterial create失败了，错误信息为：' . json_encode($TbProductMaterialModel->getMessages()));
                }
            }
        }
    }

    /**
     * 下载 excel 中的图片
     *
     * @param $data -每一行的数据，主要是用里面的图片
     * @param $productModels -添加的新模型
     * @param $product_ids_string -sql查询字符串
     * @throws \Exception
     */
    private
    function _createPictures($data, $productModels, $product_ids_string)
    {
        // 逻辑
        // 先删除原来的图片
        // 首先先将原来的下载记录清空
        foreach (TbPicture::find("productid in " . $product_ids_string) as $model) {
            // 首先删除文件
            @unlink(dirname($this->pictureDir) . '/' . $model->filename);
            if (!$model->delete()) {
                $this->db->rollback();
                $this->logFile->log('TbPictureModel => delete失败了，错误信息为：' . json_encode($model->getMessages()));
            }
        }

        // 主图名字
        $picture = pathinfo($data[10], PATHINFO_BASENAME);
        // 附图名字
        $picture2 = pathinfo($data[11], PATHINFO_BASENAME);

        // 待添加的所有图片，$data[12] 是所有的详情图图片，并且以逗号隔开的，把元素统一添加到这里
        $detailImages = explode(',', $data[12]);
        array_push($detailImages, $data[10], $data[11]);
        // 如果有重复的图片，则只下载一次
        $detailImages = array_unique($detailImages);

        // 如果有图片，则开始下载所有图片
        foreach ($detailImages as $image) {
            // 取出文件名
            $imageName = pathinfo($image, PATHINFO_BASENAME);
            // 开始下载, 并写入数据库
            if (($downloadResult = Util::downloadImage($image)) !== false) {
                // 获取图片的真实尺寸
                $imageInfo = Util::myGetImageSize($image);
                // 如果下载的图片高度不是 800px，则处理成 800*800
                if (isset($imageInfo['width']) && $imageInfo['width'] != 800 && isset($imageInfo['height']) && $imageInfo['height'] != 800) {
                    Util::makeImage($this->pictureDir . '/' . $downloadResult);
                }
                // 所有的 product_ids 都添加一遍
                foreach ($productModels as $productModel) {
                    // 添加
                    $TbPictureModel = new TbPicture();
                    if (!$TbPictureModel->create([
                        'name'      => $imageName,
                        'filename'  => 'product/' . $downloadResult,
                        'productid' => $productModel->id,
                    ])) {
                        $this->db->rollback();
                        $this->logFile->log('TbPictureModel => create失败了，错误信息为：' . json_encode($TbPictureModel->getMessages()));
                    }

                    // 如果当前下载的文件就是主图，还要写入主图url字段
                    if ($picture == $imageName) {
                        if (!$productModel->update([
                            'picture' => 'product/' . $downloadResult,
                        ])) {
                            $this->db->rollback();
                            $this->logFile->log('productModel => update picture失败了，错误信息为：' . json_encode($productModel->getMessages()));
                        }
                    }

                    // 如果当前下载的文件就是附图，还要写入附图url字段
                    if ($picture2 == $imageName) {
                        if (!$productModel->update([
                            'picture2' => 'product/' . $downloadResult,
                        ])) {
                            $this->db->rollback();
                            $this->logFile->log('productModel => update picture2失败了，错误信息为：' . json_encode($productModel->getMessages()));
                        }
                    }
                }
            }
        }
    }

    /**
     * 获取单个或者多个结果
     *
     * @param $value -待处理变量
     * @param $className -类名称
     * @param $callback -回调函数，这里的 sql 是不确定的，所以用回调函数来进行处理
     * @return string
     */
    public function getIds($value, $className, $callback)
    {
        // 先转成数组
        $datas = explode(',', $value);
        // 返回值
        $return = [];
        // 循环遍历
        foreach ($datas as $data) {
            if ($model = $className::findFirst($callback(trim($data)))) {
                $return[] = $model->id;
            }
        }
        // 返回字符串格式
        return implode(',', $return);
    }
}
