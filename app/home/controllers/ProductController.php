<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\CreateImg;
use Asa\Erp\Sql;
use Asa\Erp\TbAgeseason;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbBrandgroupchildProperty;
use Asa\Erp\TbBrandSize;
use Asa\Erp\TbColortemplate;
use Asa\Erp\TbCountry;
use Asa\Erp\TbCurrency;
use Asa\Erp\TbDownload;
use Asa\Erp\TbExchangeRate;
use Asa\Erp\TbMaterial;
use Asa\Erp\TbMaterialnote;
use Asa\Erp\TbPicture;
use Asa\Erp\TbPrice;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductcode;
use Asa\Erp\TbProductMaterial;
use Asa\Erp\TbProductMemo;
use Asa\Erp\TbProductPrice;
use Asa\Erp\TbProductSizeProperty;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbProductType;
use Asa\Erp\TbProperty;
use Asa\Erp\TbSaleType;
use Asa\Erp\TbSeries;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbSizetop;
use Asa\Erp\TbUlnarinch;
use Asa\Erp\TbWinterproofing;
use Exception;
use Phalcon\Paginator\Adapter\Model;

/**
 * 商品表
 *
 * Class ProductController
 * @package Multiple\Home\Controllers
 */
class ProductController extends CadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProduct');
    }

    /**
     * 普通分页逻辑
     */
    function pageAction()
    {
        $this->before_page();
        $params = [$this->getSearchCondition()];
        if (isset($_POST['__orderby'])) {
            $params['order'] = $_POST['__orderby'];
        }

        $result = TbProduct::find($params);

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new Model(
            [
                "data"  => $result,
                "limit" => $pageSize,
                "page"  => $page,
            ]
        );

        // Get the paginated results
        $pageObject = $paginator->getPaginate();

        $data = [];
        foreach ($pageObject->items as $row) {
            $rowData = $row->toArray();
            // 添加缩略图，缩略图默认都存在 tb_picture 表中
            // 主图
            if ($pictureModel = TbPicture::findFirst("filename = '" . $rowData['picture'] . "'")) {
                $rowData['picture_40'] = $pictureModel->filename_40;
                $rowData['picture_150'] = $pictureModel->filename_150;
            } else {
                $rowData['picture_40'] = $rowData['picture'] ? $rowData['picture'] . '_40x40.jpg' : '';
                $rowData['picture_150'] = $rowData['picture'] ? $rowData['picture'] . '_150x150.jpg' : '';
            }
            // 附图
            if ($pictureModel = TbPicture::findFirst("filename = '" . $rowData['picture2'] . "'")) {
                $rowData['picture2_40'] = $pictureModel->filename_40;
                $rowData['picture2_150'] = $pictureModel->filename_150;
            } else {
                $rowData['picture2_40'] = $rowData['picture2'] ? $rowData['picture2'] . '_40x40.jpg' : '';
                $rowData['picture2_150'] = $rowData['picture2'] ? $rowData['picture2'] . '_150x150.jpg' : '';
            }

            $rowData['name'] = $row->getName();
            $rowData['season'] = $row->getSeason();
            $rowData['worldcode'] = $row->getWorldCode();
            $rowData['type'] = $row->getType();
            $rowData['fpCurrencyCode'] = $row->getFactoryPriceCurrencyLabel();
            $rowData['times'] = $row->getTimes();
            $rowData['wpCurrencyCode'] = $row->getWordPriceCurrencyLabel();
            $rowData['discountRate'] = $row->getDiscountRate();
            $rowData['npCurrencyCode'] = $row->getNationalPriceCurrencyLabel();
            $rowData['saleType'] = $row->getSaleType();
            $rowData['colors'] = $row->getColors();
            $rowData['seriesTitle'] = $row->getSeries();
            $data[] = $rowData;
        }

        $pageinfo = [
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];

        // 返回
        echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
    }

    /**
     * 根据国际码前 2 段的分页逻辑
     */
    function secondWordcodeSearchPageAction()
    {
        $this->before_page();
        // 只根据国际码搜索，而且不限制公司
        $params = [$this->getOnlyWordcodeCondition()];

        $result = TbProduct::find($params);

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new Model(
            [
                "data"  => $result,
                "limit" => $pageSize,
                "page"  => $page,
            ]
        );

        // Get the paginated results
        $pageObject = $paginator->getPaginate();

        $data = [];
        foreach ($pageObject->items as $row) {
            $rowData = $row->toArray();
            // 添加缩略图，缩略图默认都存在 tb_picture 表中
            // 主图
            if ($pictureModel = TbPicture::findFirst("filename = '" . $rowData['picture'] . "'")) {
                $rowData['picture_40'] = $pictureModel->filename_40;
                $rowData['picture_150'] = $pictureModel->filename_150;
            } else {
                $rowData['picture_40'] = $rowData['picture'] ? $rowData['picture'] . '_40x40.jpg' : '';
                $rowData['picture_150'] = $rowData['picture'] ? $rowData['picture'] . '_150x150.jpg' : '';
            }
            // 附图
            if ($pictureModel = TbPicture::findFirst("filename = '" . $rowData['picture2'] . "'")) {
                $rowData['picture2_40'] = $pictureModel->filename_40;
                $rowData['picture2_150'] = $pictureModel->filename_150;
            } else {
                $rowData['picture2_40'] = $rowData['picture2'] ? $rowData['picture2'] . '_40x40.jpg' : '';
                $rowData['picture2_150'] = $rowData['picture2'] ? $rowData['picture2'] . '_150x150.jpg' : '';
            }

            $rowData['name'] = $row->getName();
            $rowData['season'] = $row->getSeason();
            $rowData['worldcode'] = $row->getWorldCode();
            $rowData['type'] = $row->getType();
            $rowData['fpCurrencyCode'] = $row->getFactoryPriceCurrencyLabel();
            $rowData['times'] = $row->getTimes();
            $rowData['wpCurrencyCode'] = $row->getWordPriceCurrencyLabel();
            $rowData['discountRate'] = $row->getDiscountRate();
            $rowData['npCurrencyCode'] = $row->getNationalPriceCurrencyLabel();
            $rowData['saleType'] = $row->getSaleType();
            $rowData['colors'] = $row->getColors();
            $rowData['seriesTitle'] = $row->getSeries();
            // 把副颜色处理成数组格式
            if ($row->second_color_id && $colorModel = TbColortemplate::findFirstById($row->second_color_id)) {
                $rowData['second_color_id'] = [
                    (int)$colorModel->color_system_id,
                    (int)$row->second_color_id,
                ];
            }
            $data[] = $rowData;
        }

        $pageinfo = [
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];

        // 返回
        echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
    }

    /**
     * 根据国际码请求所有的记录，包含所有的公司
     * 分页逻辑
     */
    function wordcodepageAction()
    {
        $result = TbProduct::find([
            'conditions' => 'wordcode = :wordcode:',
            'bind'       => [
                'wordcode' => trim($this->request->getPost('wordcode')),
            ],
        ]);

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new Model(
            [
                "data"  => $result,
                "limit" => $pageSize,
                "page"  => $page,
            ]
        );

        // Get the paginated results
        $pageObject = $paginator->getPaginate();

        $data = [];
        foreach ($pageObject->items as $row) {
            $rowData = $row->toArray();
            $rowData['name'] = $row->getName();
            $rowData['season'] = $row->getSeason();
            $rowData['worldcode'] = $row->getWorldCode();
            $rowData['type'] = $row->getType();
            $rowData['fpCurrencyCode'] = $row->getFactoryPriceCurrencyLabel();
            $rowData['times'] = $row->getTimes();
            $rowData['wpCurrencyCode'] = $row->getWordPriceCurrencyLabel();
            $rowData['discountRate'] = $row->getDiscountRate();
            $rowData['npCurrencyCode'] = $row->getNationalPriceCurrencyLabel();
            $rowData['saleType'] = $row->getSaleType();
            $rowData['colors'] = $row->getColors();
            $rowData['seriesTitle'] = $row->getSeries();
            $data[] = $rowData;
        }

        $pageinfo = [
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];

        // 返回
        echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
    }

    /**
     * 新建商品，需要和 OMS 同步，这个是标准的商品新增
     *
     * @return false|string|void
     * @throws Exception
     */
    function addAction()
    {
        // 拿到请求的参数
        $params = json_decode($_POST["params"], true);
        // 记录 params 的值，方便纠错
        $this->logFile->log("\$add-params = " . json_encode($params));

        $products = [];
        $colors = [];
        $keys = [
            "brandid",
            "series", "factoryprice", "nationalpricecurrency",
            "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender",
            "spring", "summer", "fall", "winter",
            "sizetopid",
            "nationalfactoryprice", "wordprice", "wordpricecurrency",
            "saletypeid", "producttypeid", "winterproofingid",
        ];

        // ageseason不能为空，之所以在这里重新写一遍，是怕前台封不住
        if (empty($params['form']['ageseason'])) {
            throw new Exception($this->getValidateMessage('ageseason') . $this->getValidateMessage('8000'));
        }

        // 开启事务
        $this->db->begin();

        // $params['colors']是待录入的商品，如果是多个则是同款不同色
        foreach ($params['colors'] as $row) {
            // 没有 id 字段说明是新增
            if (!empty($row['id'])) {
                $product = TbProduct::findFirstById($row['id']);
            } else {
                $product = new TbProduct();
            }

            $product->companyid = $this->companyid;
            // 时间字段
            $product->created_at = date("Y-m-d H:i:s");
            $product->updated_at = date("Y-m-d H:i:s");
            $product->makestaff = $this->userId;
            $product->wordcode_1 = $this->filterCode($row['wordcode_1']);
            $product->wordcode_2 = $this->filterCode($row['wordcode_2']);
            $product->wordcode_3 = $this->filterCode($row['wordcode_3']);
            $product->wordcode_4 = $this->filterCode($row['wordcode_4']);
            // 色系，以 colorSystemId 为准
            // $product->brandcolor = $row['brandcolor'];
            $product->colorname = $row['colorname'];
            $product->picture = $row['picture'];
            $product->picture2 = $row['picture2'];
            $product->wordcode = $this->filterCode($row['wordcode_1']) . $this->filterCode($row['wordcode_2']) . $this->filterCode($row['wordcode_3']);

            // 色系
            $product->brandcolor = $row['brandcolor'];
            // 再复制一遍，防止系统有用到这个字段的地方
            $product->color_system_id = $row['brandcolor'];
            // 主颜色
            $product->color_id = $row['color_id'];
            // 副颜色
            $product->second_color_id = isset($row['second_color_id'][1]) ? (int)$row['second_color_id'][1] : 0;

            // 不放在一起了，分开存储
            $product->brandgroupid = $params['form']['brandgroupid'];
            $product->childbrand = $params['form']['childbrand'];
            $product->ageseason = implode(',', $params['form']['ageseason']);
            // 这里之所以赋值为空，原因是下面有函数会修改这两个值
            $product->ageseason_season = '';
            $product->ageseason_year = '';
            $product->countries = implode(',', $params['form']['countries']);
            $product->ulnarinch = implode(',', $params['form']['ulnarinch']);
            $product->productmemoids = implode(',', $params['form']['productmemoids']);

            foreach ($keys as $key) {
                $product->$key = $params['form'][$key];
            }
            $product->factorypricecurrency = $params['form']["wordpricecurrency"];
            $product->nationalfactorypricecurrency = $params['form']["nationalpricecurrency"];

            // 判断是否存在 id 字段
            // 检验国际码是否重复
            if (empty($row['id'])) {
                // 如果是新增
                $where = sprintf("companyid=%d and wordcode='%s'", $this->companyid, addslashes($product->wordcode));
            } else {
                // 如果是编辑
                $where = sprintf("companyid=%d and wordcode='%s' and id<>%d", $this->companyid, addslashes($product->wordcode), $product->id);
            }
            // 有记录说明国际码重复
            if (TbProduct::count($where) > 0) {
                $this->db->rollback();
                throw new Exception("/11160101/国际码不能重复/");
            }

            // 开始执行新增或删除操作
            // 判断是否存在 id 字段
            if (empty($row['id'])) {
                // id为空，说明为新增
                if ($product->create() == false) {
                    // 新增失败
                    $this->db->rollback();
                    return $this->error($product);
                } else {
                    // 新增成功
                    // 添加材质信息
                    if (is_array($params["materials"])) {
                        foreach ($params['materials'] as $material) {
                            $productMaterial = new TbProductMaterial();
                            $productMaterial->productid = $product->id;
                            $productMaterial->materialid = $material["materialid"];
                            $productMaterial->materialnoteid = $material["materialnoteid"];
                            $productMaterial->percent = $material["percent"];
                            if ($productMaterial->save() == false) {
                                $this->db->rollback();
                                return $this->error($productMaterial);
                            }
                        }
                    }
                }
            } else {
                if ($product->update() == false) {
                    $this->db->rollback();
                    return $this->error($product);
                } else {
                    $product->updateMaterial($params["materials"]);
                }
            }

            // 同步修改商品
            $product->syncBrandSugest();
            // 更新ageseason_season,ageseason_year两个字段
            $product->updateAgeseason();
            // 更新尺码
            $product->updateSizecontentids();

            // 记录要更新的商品列表，因为更新同款不同色还要用到它。
            $products[] = $product;
            // 第一个数代表 productid, 第二个数代表 主颜色id
            $colors[] = $product->id . "," . $product->color_id;
        }
        // 保存最后的输出变量
        $output = [];
        // | 后面的变量代表颜色
        $product_group = implode('|', $colors);
        // 逐个更新，绑定关系
        foreach ($products as $row) {
            $row->product_group = $product_group;
            if ($row->update() == false) {
                $this->db->rollback();
                throw new Exception("/1002/更新product_group字段失败/");
            }
            $output[] = $row->toArray();
        }

        // 如果到这里没有出错，那么就推送该商品到 OMS，这里采用队列处理
        if ($this->queue) {
            $this->queue->choose('oms_inventory_update');
            // 把 $output的id 传递给队列即可，剩下的逻辑交给Beanstalk吧。
            $this->queue->put($output['id'], $this->config->queue->toArray());
        }

        // 无错误则提交
        $this->db->commit();
        // 返回
        return $this->success($output);
    }

    /**
     * 新建商品并且需要保存图片，需要和 OMS 同步
     *
     * @return false|string|void
     * @throws Exception
     */
    function addWithSavePicturesAction()
    {
        // 拿到请求的参数
        $params = json_decode($_POST["params"], true);
        // 记录 params 的值，方便纠错
        $this->logFile->log("\$add-params = " . json_encode($params));

        $products = [];
        $colors = [];
        $keys = [
            "brandid",
            "series", "factoryprice", "nationalpricecurrency",
            "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender",
            "spring", "summer", "fall", "winter",
            "sizetopid",
            "nationalfactoryprice", "wordprice", "wordpricecurrency",
            "saletypeid", "producttypeid", "winterproofingid",
        ];

        // ageseason不能为空，之所以在这里重新写一遍，是怕前台封不住
        if (empty($params['form']['ageseason'])) {
            throw new Exception($this->getValidateMessage('ageseason') . $this->getValidateMessage('8000'));
        }

        // 开启事务
        $this->db->begin();

        // $params['colors']是待录入的商品，如果是多个则是同款不同色
        foreach ($params['colors'] as $row) {
            // 检验国际码是否重复
            if (TbProduct::findFirst("wordcode = '" . $row['wordcode'] . "' AND companyid = " . $this->companyid)) {
                $this->db->rollback();
                $this->logFile->log("国际码" . $row['wordcode'] . "重复了：");
                throw new Exception($this->getValidateMessage('guojima', 'template', 'uniqueness'));
            }

            // 不重复执行创建
            $product = new TbProduct();
            // 预处理
            $product->companyid = $this->companyid;
            // 时间字段
            $product->created_at = date("Y-m-d H:i:s");
            $product->updated_at = date("Y-m-d H:i:s");
            $product->makestaff = $this->userId;
            $product->wordcode_1 = $this->filterCode($row['wordcode_1']);
            $product->wordcode_2 = $this->filterCode($row['wordcode_2']);
            $product->wordcode_3 = $this->filterCode($row['wordcode_3']);
            $product->wordcode_4 = $this->filterCode($row['wordcode_4']);
            // 色系，以 colorSystemId 为准
            // $product->brandcolor = $row['brandcolor'];
            $product->colorname = $row['colorname'];
            $product->picture = $row['picture'];
            $product->picture2 = $row['picture2'];
            $product->wordcode = $this->filterCode($row['wordcode_1']) . $this->filterCode($row['wordcode_2']) . $this->filterCode($row['wordcode_3']);

            // 色系
            $product->brandcolor = $row['brandcolor'];
            // 再复制一遍，防止系统有用到这个字段的地方
            $product->color_system_id = $row['brandcolor'];
            // 主颜色
            $product->color_id = $row['color_id'];
            // 副颜色
            $product->second_color_id = isset($row['second_color_id'][1]) ? (int)$row['second_color_id'][1] : 0;

            // 不放在一起了，分开存储
            $product->brandgroupid = $params['form']['brandgroupid'];
            $product->childbrand = $params['form']['childbrand'];
            $product->ageseason = implode(',', $params['form']['ageseason']);
            // 这里之所以赋值为空，原因是下面有函数会修改这两个值
            $product->ageseason_season = '';
            $product->ageseason_year = '';
            $product->countries = implode(',', $params['form']['countries']);
            $product->ulnarinch = implode(',', $params['form']['ulnarinch']);
            $product->productmemoids = implode(',', $params['form']['productmemoids']);

            foreach ($keys as $key) {
                $product->$key = $params['form'][$key];
            }
            $product->factorypricecurrency = $params['form']["wordpricecurrency"];
            $product->nationalfactorypricecurrency = $params['form']["nationalpricecurrency"];

            // 开始执行新增或修改操作
            if ($product->save() == false) {
                // 新增失败
                $this->db->rollback();
                $this->logFile->log("\$product => create 操作失败了，错误原因是：" . json_encode($product->getMessages()));
                throw new Exception($product->getMessages()[0]);
            }

            // 如果材质有录入，那么就更新材质
            if (count($params["materials"]) > 0) {
                // 先把原来的材质都清除掉
                foreach ($product->productMaterial as $obj) {
                    if ($obj->delete() == false) {
                        $this->db->rollback();
                        $this->logFile->log("\$productMaterial => delete 操作失败了，错误原因是：" . json_encode($obj->getMessages()));
                        throw new Exception($obj->getMessages()[0]);
                    }
                }

                // 添加材质
                foreach ($params['materials'] as $material) {
                    $productMaterial = new TbProductMaterial();
                    $productMaterial->productid = $product->id;
                    $productMaterial->materialid = $material["materialid"];
                    $productMaterial->materialnoteid = $material["materialnoteid"];
                    $productMaterial->percent = $material["percent"];
                    $productMaterial->created_at = date('Y-m-d H:i:s');
                    $productMaterial->updated_at = date('Y-m-d H:i:s');
                    // 开始添加
                    if ($productMaterial->create() == false) {
                        $this->db->rollback();
                        $this->logFile->log("\$productMaterial => create 操作失败了，错误原因是：" . json_encode($productMaterial->getMessages()));
                        throw new Exception($productMaterial->getMessages()[0]);
                    }
                }
            }

            // 开始处理图片下载的逻辑
            // 如果存在id，就把图片导入进来
            if (isset($params['isNeedSavePictures']) && $params['isNeedSavePictures']) {
                if (isset($row['id']) && $row['id']) {
                    // 商品模型
                    $originProductModel = TbProduct::findFirstById($row['id']);
                    // 图片模型
                    $originPictureModel = $originProductModel->pictures;
                    // 图片模型转数组
                    $originPictures = $originPictureModel->toArray();

                    // 添加新图片之前，先把 $product 所属的图片全部删除
                    foreach ($product->pictures as $currentPictureModel) {
                        if ($currentPictureModel->delete() === false) {
                            $this->db->rollback();
                            $this->logFile->log("\$currentPictureModel => delete 操作失败了，错误原因是：" . json_encode($currentPictureModel->getMessages()));
                            throw new Exception($currentPictureModel->getMessages()[0]);
                        }
                    }

                    // 添加新图片, 遍历
                    foreach ($originPictures as $originPicture) {
                        // 图片表新增
                        $pictureModel = new TbPicture();
                        $pictureModel->name = $originPicture['name'];
                        $pictureModel->filename = $originPicture['filename'];
                        $pictureModel->filename_40 = $originPicture['filename_40'];
                        $pictureModel->filename_150 = $originPicture['filename_150'];
                        // productid 要写新商品的 id
                        $pictureModel->productid = $product->id;
                        // 更新
                        if ($pictureModel->create() === false) {
                            $this->db->rollback();
                            $this->logFile->log("\$pictureModel => create 操作失败了，错误原因是：" . json_encode($pictureModel->getMessages()));
                            throw new Exception($pictureModel->getMessages()[0]);
                        }

                        // 下载表新增
                        $downloadModel = new TbDownload();
                        $downloadModel->picture_id = $originPicture['id'];
                        $downloadModel->user_id = $this->userId;
                        $downloadModel->created_at = date('Y-m-d H:i:s');
                        $downloadModel->updated_at = date('Y-m-d H:i:s');
                        if ($downloadModel->create() === false) {
                            $this->db->rollback();
                            $this->logFile->log("\$downloadModel => create 操作失败了，错误原因是：" . json_encode($downloadModel->getMessages()));
                            throw new Exception($downloadModel->getMessages()[0]);
                        }
                    }
                }
            }

            // 同步修改商品
            $product->syncBrandSugest();
            // 更新ageseason_season,ageseason_year两个字段
            $product->updateAgeseason();
            // 更新尺码
            $product->updateSizecontentids();

            // 记录要更新的商品列表，因为更新同款不同色还要用到它。
            $products[] = $product;
            // 第一个数代表 productid, 第二个数代表 主颜色id
            $colors[] = $product->id . "," . $product->color_id;
        }
        // 保存最后的输出变量
        $output = [];
        // | 后面的变量代表颜色
        $product_group = implode('|', $colors);
        // 逐个更新，绑定关系
        foreach ($products as $row) {
            $row->product_group = $product_group;
            if ($row->update() == false) {
                $this->db->rollback();
                throw new Exception("/1002/更新product_group字段失败/");
            }
            $output[] = $row->toArray();
        }

        // 如果到这里没有出错，那么就推送该商品到 OMS，这里采用队列处理
        if ($this->queue) {
            $this->queue->choose('oms_inventory_update');
            // 把 $output的id 传递给队列即可，剩下的逻辑交给Beanstalk吧。
            $this->queue->put($output['id'], $this->config->queue->toArray());
        }

        // 无错误则提交
        $this->db->commit();
        // 返回
        return $this->success($output);
    }

    /**
     * 批量修改，需要和 OMS 同步
     *
     * @return false|string [type] [description]
     * @throws Exception
     */
    function modifyAction()
    {
        $params = json_decode($_POST["params"], true);
        // 记录 params 的值，方便纠错
        $this->logFile->log("\$modify-params = " . json_encode($params));

        $productids = implode(',', $params['products']);

        if (!preg_match("#^\d+(,\d+)*$#", $productids)) {
            throw new Exception("/11160601/参数错误/");
        }

        $products = TbProduct::find(
            sprintf("companyid=%d and id in (%s)", $this->companyid, addslashes($productids))
        );

        $this->db->begin();

        try {
            $keys = ["brandid", "brandgroupid", "childbrand", "countries", "series", "ulnarinch", "factoryprice", "factorypricecurrency", "nationalpricecurrency", "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender", "spring", "summer", "fall", "winter", "ageseason", "sizetopid", "sizecontentids", "productmemoids", "nationalfactorypricecurrency", "nationalfactoryprice", "saletypeid", "producttypeid", "winterproofingid"];
            foreach ($products as $row) {
                foreach ($keys as $key) {
                    if (isset($params['form'][$key]) && $params['form'][$key] != "") {
                        $row->$key = trim($params['form'][$key]);
                    }
                }
                $row->updated_at = date("Y-m-d H:i:s");


                if ($row->update() == false) {
                    throw new Exception("/11160602/批量更新失败。/");
                }

                if (count($params["materials"])) {
                    $row->updateMaterial($params["materials"]);
                }
            }

            $this->db->commit();
            return $this->success();
        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    /**
     * 编辑商品，需要和 OMS 同步
     *
     * @return false|string|void
     * @throws Exception
     */
    function editAction()
    {
        $params = json_decode($_POST["params"], true);
        $product = TbProduct::findFirstById($params['form']['id']);
        $product_tootip = isset($params['form']['producttypeid_tootip']) ? $params['form']['producttypeid_tootip'] : 0;

        // ageseason不能为空
        if (empty($params['form']['ageseason'])) {
            throw new Exception($this->getValidateMessage('ageseason') . $this->getValidateMessage('8000'));
        }
        // 商品存在并且只能修改当前公司的商品
        if ($product != false && $product->companyid == $this->companyid) {
            // 启用事务
            $this->db->begin();

            //更新同款多色
            if ($product->product_group == "") {
                $products = [$product];
            } else {
                $products = TbProduct::find(
                    sprintf("product_group='%s'", $product->product_group)
                );
            }

            $wordcode = $this->filterCode($params['form']['wordcode_1']) . $this->filterCode($params['form']['wordcode_2']) . $this->filterCode($params['form']['wordcode_3']);
            //检验国际码是否重复
            $where = sprintf("companyid=%d and wordcode='%s' and id<>%d", $this->companyid, addslashes($wordcode), $product->id);
            if (TbProduct::count($where) > 0) {
                $this->db->rollback();
                throw new Exception("/11160201/国际码不能重复/");
            }

            //生成绑定的颜色组的字符串
            $data = [];
            foreach ($products as $row) {
                // 如果是当前的 sku，需要单独修改的字段
                if ($row->id == $product->id) {
                    $row->colorname = $params['form']["colorname"];
                    $row->wordcode_1 = $this->filterCode($params['form']["wordcode_1"]);
                    $row->wordcode_2 = $this->filterCode($params['form']["wordcode_2"]);
                    $row->wordcode_3 = $this->filterCode($params['form']["wordcode_3"]);
                    $row->wordcode_4 = $this->filterCode($params['form']["wordcode_4"]);
                    // 色系、颜色、副颜色只针对当前商品修改，其他的同款多色保持不变
                    // 色系
                    $row->brandcolor = $params['form']["brandcolor"];
                    $row->color_system_id = $params['form']["brandcolor"];
                    // 颜色
                    $row->color_id = $params['form']['color_id'];
                    // 副颜色，分两种情况
                    // 1、如果是一个数，说明没有修改 second_color_id
                    // 2、如果是个数组，说明已经修改
                    if (is_array($params['form']['second_color_id'])) {
                        // 取数组第二个数
                        $second_color_id = (int)$params['form']['second_color_id'][1];
                    } else {
                        // 直接保持现状
                        $second_color_id = (int)$params['form']['second_color_id'];
                    }
                    // 副颜色赋值
                    $row->second_color_id = $second_color_id;
                    $row->picture = $params['form']["picture"];
                    $row->picture2 = $params['form']["picture2"];
                    $row->laststoragedate = $params['form']["laststoragedate"];
                    // 品牌属性
                    $row->producttypeid = $params['form']["producttypeid"];
                    $row->wordcode = $wordcode;
                }

                // 下面是更新同款多色的数据
                $row->brandid = $params['form']["brandid"];
                $row->series = $params['form']["series"];
                $row->factoryprice = $params['form']["factoryprice"];
                $row->factorypricecurrency = $params['form']["wordpricecurrency"];
                $row->nationalpricecurrency = $params['form']["nationalpricecurrency"];
                $row->nationalprice = $params['form']["nationalprice"];
                $row->memo = $params['form']["memo"];
                $row->wordprice = $params['form']["wordprice"];
                $row->wordpricecurrency = $params['form']["wordpricecurrency"];
                $row->gender = $params['form']["gender"];
                $row->spring = $params['form']["spring"];
                $row->summer = $params['form']["summer"];
                $row->fall = $params['form']["fall"];
                $row->winter = $params['form']["winter"];
                $row->sizetopid = $params['form']["sizetopid"];
                $row->productmemoids = $params['form']["productmemoids"];
                $row->nationalfactorypricecurrency = $params['form']["nationalpricecurrency"];
                $row->nationalfactoryprice = $params['form']["nationalfactoryprice"];
                $row->saletypeid = $params['form']["saletypeid"];
                $row->winterproofingid = $params['form']["winterproofingid"];
                $row->updated_at = date("Y-m-d H:i:s");
                $row->brandgroupid = $params['form']['brandgroupid'];
                $row->childbrand = $params['form']['childbrand'];
                $row->ageseason = empty($params['form']['ageseason']) ? '' : implode(',', $params['form']['ageseason']);
                $row->countries = empty($params['form']['countries']) ? '' : implode(',', $params['form']['countries']);
                $row->ulnarinch = empty($params['form']['ulnarinch']) ? '' : implode(',', $params['form']['ulnarinch']);
                $row->productmemoids = empty($params['form']['productmemoids']) ? '' : implode(',', $params['form']['productmemoids']);

                if ($row->update() == false) {
                    $this->db->rollback();
                    return $this->error($row);
                }

                // 更新材质列表，内部会使用遍历处理，注意，这里使用的是$params["materials"]，而不是$params['form']["materials"]
                $row->updateMaterial($params["materials"]);

                $data[] = $row->id . "," . $row->brandcolor;

                //更新颜色提示数据
                $row->syncBrandSugest();

                $row->updateAgeseason();
                $row->updateSizecontentids();
            }

            if (count($products) > 1) {
                $product_group = implode('|', $data);

                //逐个更新，绑定关系
                foreach ($products as $row) {
                    $row->product_group = $product_group;
                    // 除了更新同款不同色之外，再写入一个商品属性值
                    if ($product_tootip) {
                        $row->producttypeid = $params['form']['producttypeid'];
                    }
                    if ($row->update() == false) {
                        throw new Exception("#1002#更新product_group字段失败#");
                    }
                }
            }

            // 无错则提交
            $this->db->commit();
            // 返回
            return $this->success();
        }
    }

    /**
     * 删除商品
     *
     * @return false|string
     * @throws Exception
     */
    function deleteAction()
    {
        $product = TbProduct::findFirstById($_POST['id']);
        if ($product == false || $product->companyid != $this->companyid) {
            throw new Exception('/11160501/数据非法/');
        }

        // 启用事务
        $this->db->begin();

        $product_group = $product->product_group;
        if ($product->delete() === false) {
            throw new Exception('/11160502/删除失败/');
        }

        // 更新同款不同色
        $products = TbProduct::find(
            sprintf("companyid=%d and product_group='%s'", $this->companyid, addslashes($product_group))
        );

        $data = [];
        foreach ($products as $row) {
            $data[] = $row->id . "," . $row->brandcolor;
        }
        $product_group = implode('|', $data);
        foreach ($products as $row) {
            $row->product_group = $product_group;
            if ($row->update() == false) {
                throw new Exception('/11160503/删除失败/');
            }
        }

        // 无错则提交
        $this->db->commit();
        // 返回
        return $this->success();
    }


    private
    function reverseOrderMethod($orderMethod)
    {
        return $orderMethod == 'asc' ? 'desc' : 'asc';
    }

    function before_page()
    {
        if (!empty($this->request->getPost('sort')) && !empty($this->request->getPost('order'))) {
            switch ($this->request->getPost('order')) {
                case 'ascending':
                    $orderMethod = ' asc';
                    break;
                case 'descending':
                    $orderMethod = ' desc';
                    break;
                default:
                    $orderMethod = ' asc';
                    break;
            }

            $orderby = $this->request->getPost('sort');
            if ($orderby == 'ageseason') {
                $orderMethodReversed = $this->reverseOrderMethod($orderMethod);
                $orderby = "ageseason_year $orderMethod, ageseason_season $orderMethodReversed";
            } else {
                $orderby .= $orderMethod;
            }
            $_POST["__orderby"] = $orderby;

        } else {
            $_POST["__orderby"] = "id desc";
        }

        if (isset($_POST['wordcode'])) {
            $_POST['wordcode'] = $this->filterCode($_POST['wordcode']);
        }
    }

    /**
     * 搜索商品
     */
    function searchAction()
    {
        if ($this->request->isPost()) {
            $where = [
                sprintf("companyid=%d", $this->companyid),
            ];

            if (isset($_POST["wordcode"]) && trim($_POST["wordcode"]) != "") {
                $where[] = sprintf("wordcode like '%%%s%%'", addslashes($_POST["wordcode"]));
            }

            if (isset($_POST["brandid"]) && trim($_POST["brandid"]) != "") {
                $where[] = sprintf("brandid=%d", $_POST["brandid"]);
            }

            if (isset($_POST["brandgroupid"]) && trim($_POST["brandgroupid"]) != "") {
                $where[] = sprintf("brandgroupid=%d", $_POST["brandgroupid"]);
            }

            if (isset($_POST["childbrand"]) && trim($_POST["childbrand"]) != "") {
                $where[] = sprintf("childbrand=%d", $_POST["childbrand"]);
            }

            $names = ['countries', 'ageseason'];
            foreach ($names as $name) {
                if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                    $where[] = Sql::isMatch($name, $_POST[$name]);
                }
            }

            $result = TbProduct::find([
                implode(" and ", $where),
                "order" => "id desc",
            ]);

            $page = $this->request->getPost("page", "int", 1);
            $pageSize = $this->request->getPost("pageSize", "int", 20);

            $paginator = new Model(
                [
                    "data"  => $result,
                    "limit" => $pageSize,
                    "page"  => $page,
                ]
            );

            // Get the paginated results
            $pageObject = $paginator->getPaginate();


            $data = [];
            foreach ($pageObject->items as $row) {
                $data[] = $row->toArray();
            }

            $pageinfo = [
                //"previous"      => $pageObject->previous,
                "current"    => $pageObject->current,
                "totalPages" => $pageObject->total_pages,
                //"next"          => $pageObject->next,
                "total"      => $pageObject->total_items,
                "pageSize"   => $pageSize,
            ];
            echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
        }
    }

    /**
     * 获取搜索条件
     *
     * @return string
     */
    function getSearchCondition()
    {
        // 逻辑
        $where = [
            sprintf("companyid=%d", $this->companyid),
        ];

        if (isset($_POST["wordcode"]) && trim($_POST["wordcode"]) != "") {
            $where[] = sprintf("wordcode like '%%%s%%'", addslashes(strtoupper($_POST["wordcode"])));
        }

        if (isset($_POST['brandid'])) {
            if (is_array($_POST['brandid'])) {
                $_POST['brandid'] = implode(',', $_POST['brandid']);
            }
        }
        if (isset($_POST['brandgroupid'])) {
            if (is_array($_POST['brandgroupid'])) {
                $_POST['brandgroupid'] = implode(',', $_POST['brandgroupid']);
            }
        }
        if (isset($_POST['childbrand'])) {
            if (is_array($_POST['childbrand'])) {
                $_POST['childbrand'] = implode(',', $_POST['childbrand']);
            }
        }

        $names = ['brandid', 'brandgroupid', 'childbrand', 'brandcolor', 'saletypeid', 'producttypeid', 'gender'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = Sql::isInclude($name, $_POST[$name]);
            }
        }

        if (isset($_POST['ageseason'])) {
            if (is_array($_POST['ageseason'])) {
                $_POST['ageseason'] = implode(',', $_POST['ageseason']);
            }
        }
        if (isset($_POST['productmemoids'])) {
            if (is_array($_POST['productmemoids'])) {
                $_POST['productmemoids'] = implode(',', $_POST['productmemoids']);
            }
        }
        if (isset($_POST['series'])) {
            if (is_array($_POST['series'])) {
                $_POST['series'] = implode(',', $_POST['series']);
            }
        }

        $names = ['ulnarinch', 'productsize', 'countries', 'ageseason', 'productparst', 'series', 'productmemoids'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = Sql::isMatch($name, $_POST[$name]);
            }
        }

        if (isset($_POST["season"]) && preg_match("#^\d+(,\d+)*$#", $_POST["season"])) {
            $columns = [
                "1" => "spring",
                "2" => "summer",
                "3" => "fall",
                "4" => "winter",
            ];
            $array = explode(',', $_POST["season"]);
            foreach ($array as $value) {
                $where[] = sprintf("%s=1", $columns[$value]);
            }
        }

        return implode(' and ', $where);
    }

    /**
     * 获得商品货号数据
     *
     * @return void [type] [description]
     */
    function codelistAction()
    {
        $result = TbProductcode::find(
            sprintf("productid=%d", $this->request->get('id'))
        );
        // 然后把 sizecontentid 换成名称
        $items = $result->toArray();
        foreach ($items as &$item) {
            $item['sizecontent_name'] = ($model = TbSizecontent::findFirstById($item['sizecontentid'])) ? $model->name : '';
        }
        // 返回
        echo $this->success($items);
    }

    /**
     * 保存商品货号
     *
     * @return false|string [type] [description]
     */
    function savecodeAction()
    {
        $form = json_decode($_POST["params"], true);

        $this->db->begin();
        $product = TbProduct::findFirstById($form['productid']);
        if ($product != false) {
            try {
                foreach ($form['list'] as $key => $value) {
                    $product->setProjectCode($value['sizecontentid'], $value['goods_code']);
                }
            } catch (Exception $e) {
                $this->db->rollback();
                return $this->error([$e->getMessage()]);
            }
        }
        $this->db->commit();
        return $this->success();
    }

    /**
     * 保存同款不同色数据
     *
     * @return false|string [type] [description]
     * @throws \Asa\Erp\Exception
     */
    function savecolorgroupAction()
    {
        $form = json_decode($_POST["params"], true);
        // 记录 params 的值，方便纠错
        error_log("\$savecolorgroup-params = " . print_r($form, true));

        $product = TbProduct::findFirstById($form['productid']);
        if ($product != false && $product->companyid == $this->companyid) {

            // 使用事务
            $this->db->begin();

            //先解绑颜色组
            $product->cancelBindColor();

            $products = [];
            $data = [];//[$product->id.",".$product->brandcolor];
            //处理新增的记录
            foreach ($form['list'] as &$row) {
                if ($row['id'] == '') {
                    $product_else = $product->cloneByColor($row);
                } else {
                    $product_else = TbProduct::findFirstById($row['id']);
                    if ($product_else == false) {
                        $this->db->rollback();
                        throw new Exception("/11160304/绑定的商品不存在/");
                    }

                    $product_else->brandid = $product->brandid;
                    $product_else->brandgroupid = $product->brandgroupid;
                    $product_else->childbrand = $product->childbrand;
                    $product_else->countries = $product->countries;
                    $product_else->series = $product->series;
                    $product_else->ulnarinch = $product->ulnarinch;
                    $product_else->factoryprice = $product->factoryprice;
                    $product_else->factorypricecurrency = $product->factorypricecurrency;
                    $product_else->nationalpricecurrency = $product->nationalpricecurrency;
                    $product_else->nationalprice = $product->nationalprice;
                    $product_else->memo = $product->memo;
                    $product_else->wordprice = $product->wordprice;
                    $product_else->wordpricecurrency = $product->wordpricecurrency;
                    $product_else->gender = $product->gender;
                    $product_else->spring = $product->spring;
                    $product_else->summer = $product->summer;
                    $product_else->fall = $product->fall;
                    $product_else->winter = $product->winter;
                    $product_else->ageseason = $product->ageseason;
                    $product_else->ageseason_season = $product->ageseason_season;
                    $product_else->ageseason_year = $product->ageseason_year;
                    $product_else->sizetopid = $product->sizetopid;
                    $product_else->sizecontentids = $product->sizecontentids;
                    $product_else->productmemoids = $product->productmemoids;
                    $product_else->nationalfactorypricecurrency = $product->nationalfactorypricecurrency;
                    $product_else->nationalfactoryprice = $product->nationalfactoryprice;
                    $product_else->saletypeid = $product->saletypeid;
                }

                // 色系统一用 brandcolor
                $product_else->brandcolor = $row['brandcolor'];
                $product_else->color_id = $row['color_id'];
                $product_else->second_color_id = isset($row['second_color_id'][1]) ? (int)$row['second_color_id'][1] : 0;
                $product_else->wordcode_1 = $this->filterCode($row['wordcode_1']);
                $product_else->wordcode_2 = $this->filterCode($row['wordcode_2']);
                $product_else->wordcode_3 = $this->filterCode($row['wordcode_3']);
                $product_else->wordcode_4 = $this->filterCode($row['wordcode_4']);
                $product_else->colorname = $row['colorname'];
                $product_else->picture = $row['picture'];
                $product_else->picture2 = $row['picture2'];
                $product_else->wordcode = $product_else->wordcode_1 . $product_else->wordcode_2 . $product_else->wordcode_3;

                $products[] = $product_else;
                $data[] = $product_else->id . "," . $product_else->color_id;
            }

            if (count($data) == 1) {
                $product_group = "";
            } else {
                $product_group = implode('|', $data);
            }

            // 逐个更新，绑定关系
            foreach ($products as $row) {
                // 不知道怎么了，突然缺少了 brandcolor，暂时补上
                $row->brandcolor = isset($row->brandcolor) ? $row->brandcolor : null;

                $row->product_group = $product_group;

                //检验国际码是否重复
                $where = sprintf("companyid=%d and wordcode='%s' and id<>%d", $this->companyid, addslashes($row->wordcode), $row->id);

                if (TbProduct::count($where) > 0) {
                    $this->db->rollback();
                    throw new Exception("/11160301/国际码不能重复/");
                }

                $row->updated_at = date("Y-m-d H:i:s");
                if ($row->update() == false) {
                    $this->db->rollback();
                    throw new Exception("/11160302/更新product_group字段失败/");
                }

                $row->syncMaterial($product);
                $row->syncBrandSugest();
            }

            // 无错则提交
            $this->db->commit();

            // 返回
            $product = TbProduct::findFirstById($form['productid']);
            return $this->success(["list" => $product->getColorGroupList(), "form" => $product->toArray()]);
        } else {
            return $this->error("/11160303/产品数据不存在/");
        }
    }

    private
    function filterCode($code)
    {
        return preg_replace("#\s+#msi", "", $code);
    }

    /**
     * 获取商品的同款多色的产品列表
     * @return false|string [type] [description]
     */
    function getcolorgrouplistAction()
    {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if ($product != false) {
            // 处理副颜色
            // 把副颜色处理成数组格式
            $products = $product->getColorGroupList();
            $products = is_array($products) ? $products : $products->toArray();
            foreach ($products as $k => $product) {
                if ($product['second_color_id'] && $colorModel = TbColortemplate::findFirstById($product['second_color_id'])) {
                    $products[$k]['second_color_id'] = [
                        (int)$colorModel->color_system_id,
                        (int)$product['second_color_id'],
                    ];
                }
            }
            // 返回成功
            return $this->success($products);
        } else {
            // 返回错误
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 获取商品的图片列表
     * @return [type] [description]
     */
    function pictureAction()
    {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if ($product != false && $product->companyid == $this->companyid) {
            return $this->success($product->getPictureList());
        } else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * tab标签 - 商品尺寸保存逻辑
     *
     * @return false|string [type] [description]
     */
    function savepropertyAction()
    {
        $params = json_decode($_POST['params'], true);

        $id = (int)$params['id'];
        $product = TbProduct::findFirstById($id);
        if ($product != false && $product->companyid == $this->companyid) {

            // 取出所有的同款不同色商品，做统一修改
            // 取出分组数据
            $groups = explode('|', $product->product_group);
            // 然后把每一项逗号前面的 productid 取出来即可
            $productIds = [];
            foreach ($groups as $group) {
                $productIds[] = substr($group, 0, strpos($group, ','));
            }

            // 启用事务
            $this->db->begin();

            // 接下来就是修改所有的同款不同色的商品属性数据
            foreach ($productIds as $productId) {
                // 商品必须存在
                $product = TbProduct::findFirstById($productId);
                if ($product != false && $product->companyid == $this->companyid) {
                    $result = [];
                    foreach ($params['list'] as $key => $row) {
                        // 按照sizecontentid_propertyid进行拆分
                        if (preg_match("#^(\d+)_(\d+)$#", $key, $match)) {
                            $object = TbProductSizeProperty::findFirst(
                                sprintf("productid=%d and sizecontentid=%d and propertyid=%d", $productId, $match[1], $match[2])
                            );
                            if ($object == false) {
                                $object = new  TbProductSizeProperty();
                                $object->productid = $productId;
                                $object->sizecontentid = $match[1];
                                $object->propertyid = $match[2];
                            }
                            $object->content = $row;
                            if ($object->save() == false) {
                                $this->db->rollback();
                                return $this->error("/1002/更新或者新增商品属性失败/");
                            }

                            $result[] = $object->toArray();
                        }
                    }
                }
            }
            // 提交
            $this->db->commit();
            return $this->success($result);
        } else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 获取商品的尺码描述信息
     *
     * @return false|string [type] [description]
     */
    function getpropertiesAction()
    {
        // 如果参数没传过来，则报错
        if (!isset($_POST['id'])) {
            return $this->error("#1001#产品数据不存在#");
        }
        // 然后取出 id
        $id = (int)$_POST['id'];
        // 查找是否存在这条记录
        $product = TbProduct::findFirstById($id);
        // 取出记录的详细信息
        if ($product != false && $product->companyid == $this->companyid) {
            return $this->success($product->productSizeProperty);
        } else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    function getpricesAction()
    {
        $product_array = explode(",", $_POST['productids']);

        $result = [];
        foreach ($product_array as $productid) {
            $product = TbProduct::findFirstById($productid);
            if ($product != false && $product->companyid == $this->companyid) {
                foreach ($product->getPriceList() as $price) {
                    $result[] = $price;
                }
            }
        }

        return $this->success($result);
    }

    function savepriceAction()
    {
        $id = (int)$_POST['productid'];
        $product = TbProduct::findFirstById($id);
        if ($product != false && $product->companyid == $this->companyid) {
            if ($product->savePrice($_POST["priceid"], $_POST["currencyid"], $_POST["price"])) {
                return $this->success();
            } else {
                return $this->error("/1002/设置产品价格失败/");
            }

        } else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    function getproductstockAction()
    {
        $conditions = [
            sprintf("companyid=%d and productid=%d and number>0", $this->companyid, $_POST['productid']),
        ];
        $result = TbProductstock::find([
            implode(" and ", $conditions),
            "order" => "number desc",
        ]);

        echo $this->success($result->toArray());
    }

    /**
     * 通过商品条码搜索商品信息
     * @return false|string [type] [description]
     */
    function searchcodeAction()
    {
        if (isset($_POST['code'])) {
            $result = TbProductcode::findFirst(
                sprintf("companyid=%d and goods_code='%s'", $this->companyid, $_POST['code'])
            );

            if ($result != false) {
                return $this->success($result->toArray());
            }
        }

        return $this->success();
    }

    function getcodeAction()
    {
        if (isset($_POST['productid']) && isset($_POST['sizecontentid'])) {
            $result = TbProductcode::findFirst(
                sprintf("productid=%d and sizecontentid=%d", $_POST['productid'], $_POST['sizecontentid'])
            );

            if ($result != false && $result->companyid == $this->companyid) {
                return $this->success($result->goods_code);
            }
        }

        return $this->success('');
    }

    /**
     * 批量修改商品价格
     * @return false|string [type] [description]
     * @throws Exception
     */
    function modifypricesAction()
    {
        $params = $this->request->get('params');
        if (!$params) {
            throw new Exception("/11160401/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        if (!preg_match("#^\d+(,\d+)*$#", $submitData['products'])) {
            throw new Exception("/11160402/参数错误/");
        }

        $products = TbProduct::find(
            sprintf("companyid=%d and id in (%s)", $this->companyid, $submitData['products'])
        );

        $this->db->begin();
        try {
            foreach ($submitData['prices'] as $row) {
                $price = TbPrice::getInstance($row['id']);
                if ($price == false || $price->companyid != $this->companyid) {
                    throw new Exception("/11160403/价格未定义/");
                }

                foreach ($products as $product) {
                    $priceValue = 0;
                    if ($row['price'] > 0) {
                        $priceValue = $row['price'];
                    } else if ($row['discount'] > 0) {
                        //国际零售价*系数
                        $priceValue = TbExchangeRate::convert($this->companyid, $product->wordpricecurrency, $price->currencyid, $row['discount'] * $product->wordprice);
                        $priceValue = $priceValue['number'];
                    } else if ($row['discountCost'] > 0 && $product->costcurrency > 0) {
                        //成本价*系数
                        $priceValue = TbExchangeRate::convert($this->companyid, $product->costcurrency, $price->currencyid, $row['discountCost'] * $product->cost);
                        $priceValue = $priceValue['number'];
                    }

                    if ($priceValue > 0) {
                        // 更新价格信息
                        $productPrice = TbProductPrice::findFirst(
                            sprintf("productid=%d and priceid=%d", $product->id, $price->id)
                        );

                        if ($productPrice == false) {
                            $productPrice = new TbProductPrice();
                            $productPrice->productid = $product->id;
                            $productPrice->priceid = $price->id;
                            $productPrice->companyid = $this->companyid;
                            $productPrice->currencyid = $price->currencyid;
                        }

                        $productPrice->price = $priceValue;
                        $productPrice->updated_at = date('Y-m-d H:i:s');
                        $productPrice->updatestaff = $this->currentUser;

                        if ($productPrice->save() == false) {
                            throw new Exception("/11160404/价格更新失败/");
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $this->db->rollback();
            echo $this->error($e->getMessage());
        }
        $this->db->commit();
        return $this->success();
    }

    /**
     * 返回OMS同步需要的价格列表
     * @return false|string [type] [description]
     */
    function getomspricesAction()
    {
        $result = ['hkgcost' => '', 'eurcost' => '', 'chncost' => '', 'bdacost' => ''];
        $auth = $this->auth;
        if (isset($auth['company'])) {
            $company = $auth['company'];

            $product = TbProduct::findFirstById($_POST['productid']);
            if ($product != false && $product->companyid == $this->companyid) {
                foreach ($product->getPriceList() as $row) {
                    if ($row['id'] == $company->hkgcost) {
                        $result['hkgcost'] = $row['price'];
                    } else if ($row['id'] == $company->eurcost) {
                        $result['eurcost'] = $row['price'];
                    } else if ($row['id'] == $company->chncost) {
                        $result['chncost'] = $row['price'];
                    } else if ($row['id'] == $company->bdacost) {
                        $result['bdacost'] = $row['price'];
                    }
                }

            }
        }

        return $this->success($result);
    }

    /**
     * 生成图片逻辑
     * 需要外部传入三个参数
     * 1、int productid 产品id
     * 2、string pic 右侧图片相对地址，如果不传默认为/assets/img/cloth.png，这个图片后期会和品类进行关联，也就是固定的，逻辑待定...
     * 3、string model 款式，如果不传默认为新款
     * @return false|string|void
     */
    public
    function createimageAction()
    {
        // 采用post接收
        if ($this->request->isPost()) {
            // 产品id
            $productid = $this->request->get('productid', 'int');
            if (empty($productid)) {
                return $this->error($this->getValidateMessage('params-error'));
            }
            // 右侧图片
            $pic = $this->request->get('pic', 'string', '/assets/img/cloth.png');
            // 款式
            $model = $this->request->get('model', 'string', '新款');

            // 多语言字段
            $name = $this->getlangfield('name');

            // 判断产品是否存在
            if (($product = TbProduct::findFirst("id=" . $productid)) == false) {
                return $this->error($this->getValidateMessage('product-doesnot-exist'));
            }

            // 品牌
            if ($product->brandid) {
                if (($brand = TbBrand::findFirst("id=" . $product->brandid)) == false) {
                    $brandname = '';
                } else {
                    $brandname = $brand->$name;
                }
            } else {
                $brandname = '';
            }

            // 产地
            if ($product->countries) {
                if (($country = TbCountry::findFirst("id=" . $product->countries)) == false) {
                    $countryname = '';
                } else {
                    $countryname = $country->$name;
                }
            } else {
                $countryname = '';
            }

            // 材质
            $materials = TbProductMaterial::find("productid=" . $productid);
            $materials_toarray = [];
            foreach ($materials as $k => $material) {
                $tbmaterial = TbMaterial::findFirst("id=" . $material->materialid);
                $materials_toarray[] = $tbmaterial ? '%' . $material->percent . $tbmaterial->$name : '';
            }
            $materialname = implode(',', $materials_toarray);

            // 自定义属性名称以及属性值
            // 尺码表
            // 如果尺码表为空，那么就从数据库重新读取
            $sizecontents = [];
            if (!empty($product->sizecontentids)) {
                $sizecontentids = explode(',', $product->sizecontentids);
                foreach ($sizecontentids as $sizecontentid) {
                    $sizecontents[$sizecontentid] = ($sizecontentModel = TbSizecontent::findFirst('id=' . $sizecontentid)) ? $sizecontentModel->name : '';
                }
            }

            // 属性表
            $properties = TbBrandgroupchildProperty::find([
                'columns'    => 'propertyid',
                'conditions' => 'brandgroupchildid = :brandgroupchildid:',
                'bind'       => [
                    'brandgroupchildid' => $product->brandgroupid,
                ],
            ])->toArray();
            // 防止name为空，重新在tb_property主表查询一次
            foreach ($properties as $k => $property) {
                $properties[$k]['name'] = ($propertyModel = TbProperty::findFirst("id=" . $property['propertyid'])) ? $propertyModel->$name : '';
            }

            // 为了过滤脏数据，把$properties中单独的propertyid提取出来
            $propertyids = array_map('array_shift', $properties);

            // 实际已经录入有值的部分
            $records = $product->productSizeProperty->toArray();
            // 并且按照sizecontent进行归档
            $lists = [];
            foreach ($records as $record) {
                // 如果propertyid不在$propertyids数组中，则说明是脏数据，废弃
                if (!in_array($record['propertyid'], $propertyids)) {
                    continue;
                }
                if (!isset($lists[$record['sizecontentid']][$record['propertyid']])) {
                    $lists[$record['sizecontentid']][$record['propertyid']] = $record['content'];
                }
            }

            // 把不存在的组合设置为空
            if (!empty($sizecontentids)) {
                foreach ($sizecontentids as $sizecontentid) {
                    foreach ($properties as $property) {
                        if (!isset($lists[$sizecontentid][$property['propertyid']])) {
                            $lists[$sizecontentid][$property['propertyid']] = ' - ';
                        }
                    }
                    // 因为上面的操作会导致key值错位，所以需要重新排序
                    // 但是必须要有数据，否则会出错
                    if (!empty($lists)) {
                        ksort($lists[$sizecontentid]);
                    }
                }
            }

            // 接着把$lists里面的key值变成sizecontentname值
            foreach ($lists as $key => $list) {
                // 还要判断$sizecontents中是否有这个key，如果没有则放弃
                if (!isset($sizecontents[$key])) {
                    unset($lists[$key]);
                    continue;
                }
                $lists[$sizecontents[$key]] = $list;
                unset($lists[$key]);
            }

            // 开始生成
            $data = [
                'productid'    => $productid,
                'brandname'    => '品牌：' . $brandname,
                'countryname'  => '产地：' . $countryname,
                'materialname' => '材质：' . $materialname,
                'colorname'    => '颜色：' . str_replace("\t", '', $product->colorname),
                'model'        => '款式：' . $model,
                'pic'          => $pic,
                'properties'   => $properties,
                'lists'        => $lists,
            ];

            // 生成png，默认保存在public/upload/thumb文件夹下面
            $createImg = new CreateImg();
            $createImg->createSharePng($data);
        }
    }

    /**
     * 取出对应的语言字段名称
     * @param $fieldname
     * @return string
     */
    public
    function getlangfield($fieldname)
    {
        // 默认语言是cn
        $lang = $this->session->get('language') ?: 'cn';
        return $fieldname . '_' . $lang;
    }

    /**
     * 获取商品相关内容
     * 年代、品牌、系列、品类、尺码组、材质备注与材质id对照表
     */
    public
    function getProductRelatedOptionsAction()
    {
        // 如果未登录，那么默认为 cn
        if (!$lang = $this->getDI()->get("session")->get("language")) {
            $lang = 'cn';
        }

        $result = [];

        $result['ageseasons'] = [];
        $ageseasons = TbAgeseason::find([
            "order" => "name desc,sessionmark asc",
        ]);
        foreach ($ageseasons as $ageseason) {
            $title = $ageseason->sessionmark . $ageseason->name;
            $result['ageseasons'][] = [
                'id'    => (int)$ageseason->id,
                'title' => $title,
            ];
        }

        $brands = [];
        $brandsTmp = TbBrand::find();
        foreach ($brandsTmp as $brand) {
            $brands[$brand->id]['id'] = $brand->id;
            $brands[$brand->id]['title'] = $brand->name_en;
            $brands[$brand->id]['series'] = [];
            $brands[$brand->id]['sizes'] = [];
            $brands[$brand->id]['worldcode1'] = $brand->worldcode1;
            $brands[$brand->id]['worldcode2'] = $brand->worldcode2;
            $brands[$brand->id]['worldcode3'] = $brand->worldcode3;
        }
        $series = TbSeries::find([
            "order" => "name_en asc",
        ]);
        foreach ($series as $s) {
            if (isset($brands[$s->brandid])) {
                $title = $s->{'name_' . $lang};
                $child = [
                    'id'    => (int)$s->id,
                    'title' => $title,
                ];
                $brands[$s->brandid]['series'][] = $child;
            }
        }

        $sizes = TbBrandSize::find([
            "order" => "id DESC",
        ]);
        foreach ($sizes as $s) {
            if (isset($brands[$s->brand_id])) {
                $size = $s->toArray();
                $brands[$s->brand_id]['sizes'][] = $size;
            }
        }
        $result['brands'] = array_values($brands);

        $categories = [];
        $brandgroups = TbBrandgroup::find([
            "order" => "displayindex asc",
        ]);
        foreach ($brandgroups as $bg) {
            $title = $bg->{'name_' . $lang};
            $categories[$bg->id]['id'] = (int)$bg->id;
            $categories[$bg->id]['title'] = $title;
            $categories[$bg->id]['children'] = [];
        }

        $brandgroupchildren = TbBrandgroupchild::find([
            "order" => "displayindex asc",
        ]);
        foreach ($brandgroupchildren as $bgc) {
            if (isset($categories[$bgc->brandgroupid])) {
                $title = $bgc->{'name_' . $lang};
                $productMemoIds = $bgc->getProductMemoIds();
                $child = [
                    'id'             => (int)$bgc->id,
                    'title'          => $title,
                    'productMemoids' => $productMemoIds,
                ];
                $categories[$bgc->brandgroupid]['children'][] = $child;
            }
        }
        $result['categories'] = array_values($categories);

        $sizes = [];
        $sizetops = TbSizetop::find([
            "order" => "displayindex asc",
        ]);
        foreach ($sizetops as $st) {
            $sizes[$st->id]['id'] = $st->id;
            $sizes[$st->id]['title'] = $st->name_cn;
            $sizes[$st->id]['children'] = [];
        }

        $sizecontents = TbSizecontent::find([
            "order" => "displayindex asc",
        ]);
        foreach ($sizecontents as $sc) {
            if (isset($sizes[$sc->topid])) {
                $child = [
                    'id'    => (int)$sc->id,
                    'title' => $sc->name,
                ];
                $sizes[$sc->topid]['children'][] = $child;
            }
        }
        $result['sizes'] = array_values($sizes);

        $materials = TbMaterial::find([
            "order" => "name_en asc",
        ]);
        foreach ($materials as $material) {
            $title = $material->{'name_' . $lang};
            $result['materials'][] = [
                'id'              => (int)$material->id,
                'title'           => $title,
                'materialnoteids' => $material->materialnoteids,
            ];
        }

        $materialnotes = TbMaterialnote::find([
            "order" => "displayindex asc",
        ]);
        foreach ($materialnotes as $mn) {
            $title = $mn->{'content_' . $lang};
            $brandgroupids = empty($mn->brandgroupids) ? [] : explode(',', $mn->brandgroupids);
            $result['materialnotes'][] = [
                'id'            => (int)$mn->id,
                'title'         => $title,
                'brandgroupids' => $brandgroupids,
            ];
        }

        $result['productMemos'] = [];
        $productMemos = TbProductMemo::find([
            "order" => "displayindex asc",
        ]);
        foreach ($productMemos as $pm) {
            $title = $pm->{'name_' . $lang};
            $result['productMemos'][] = [
                'id'                => (int)$pm->id,
                'title'             => $title,
                'brandgroupchildid' => (int)$pm->brandgroupchildid,
            ];
        }

        $result['countries'] = [];
        $countries = TbCountry::find([
            "order" => "name_en ASC",
        ]);
        foreach ($countries as $country) {
            if ($lang != 'en') {
                $title = $country->name_en . ' / ' . $country->{'name_' . $lang};
            } else {
                $title = $country->name_en;
            }

            $result['countries'][] = [
                'id'    => (int)$country->id,
                'title' => $title,
            ];
        }

        $result['ulnarinches'] = [];
        $ulnarinches = TbUlnarinch::find([
            "order" => "displayindex ASC",
        ]);
        foreach ($ulnarinches as $ulnarinch) {
            $title = $ulnarinch->{'name_' . $lang};
            $result['ulnarinches'][] = [
                'id'    => (int)$ulnarinch->id,
                'title' => $title,
            ];
        }

        $result['currencies'] = [];
        $currencies = TbCurrency::find([
            "order" => "code ASC",
        ]);
        foreach ($currencies as $currency) {
            $result['currencies'][] = [
                'id'   => (int)$currency->id,
                'code' => $currency->code,
            ];
        }

        $result['saletypes'] = [];
        $saletypes = TbSaleType::find([
            "order" => "displayindex ASC",
        ]);
        foreach ($saletypes as $saletype) {
            $title = $saletype->{'name_' . $lang};
            $result['saletypes'][] = [
                'id'    => (int)$saletype->id,
                'title' => $title,
            ];
        }

        $result['productTypes'] = [];
        $productTypes = TbProductType::find([
            "order" => "displayindex ASC",
        ]);
        foreach ($productTypes as $productType) {
            $title = $productType->{'name_' . $lang};
            $result['productTypes'][] = [
                'id'    => (int)$productType->id,
                'title' => $title,
            ];
        }

        $result['winterProofings'] = [];
        $winterProofings = TbWinterproofing::find([
            "order" => "displayindex ASC",
        ]);
        foreach ($winterProofings as $wp) {
            $title = $wp->{'name_' . $lang};
            $result['winterProofings'][] = [
                'id'    => (int)$wp->id,
                'title' => $title,
            ];
        }

        // // 材质备注与材质id对照表
        // // 名称多语言字段
        // $name = $this->getlangfield('name');
        // // 只取出有关联的数据
        // $productMaterials = TbProductMaterial::find([
        //     'conditions' => 'materialnoteid > 0',
        //     'columns'    => 'percent, materialid, materialnoteid',
        // ])->toArray();
        // // 然后调出材质中文名称
        // foreach ($productMaterials as $k => $v) {
        //     // 多语言字段
        //     if ($model = TbMaterial::findFirstById($v['materialid'])) {
        //         $productMaterials[$k]['material_name'] = $model->$name;
        //     }
        // }
        // // 去重处理
        // $result['productmaterial'] = Util::arrayUniqueMulti($productMaterials);

        // 返回
        return $this->success($result);
    }

    /**
     * 获取商品信息
     */
    public
    function infoAction()
    {
        $id = $this->request->get('id', 'int', 0);

        if (!$product = TbProduct::findFirstById($id)) {
            // 传递错误
            return $this->error($this->getValidateMessage('product-doesnot-exist'));
        }
        // 转成数组
        $result = $product->toArray();
        // 材质列表
        $result['materials'] = $product->productMaterial->toArray();
        // 尺码列表
        $sizecontents = explode(',', $product->sizecontentids);
        foreach ($sizecontents as $sizecontent) {
            // 把 id 和 name 添加进去
            if ($sizecontent_model = TbSizecontent::findFirstById($sizecontent)) {
                $result['sizecontents'][] = [
                    'id'   => $sizecontent,
                    'name' => $sizecontent_model->name,
                ];
            } else {
                $result['sizecontents'][] = [
                    'id'   => $sizecontent,
                    'name' => '',
                ];
            }
        }
        // 返回
        return $this->success($result);
    }

    /**
     * 获取商品尺码和尺码规格
     */
    public
    function sizecontentsAndPropertiesAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$product = TbProduct::findFirst("id=$id")) {
            // 传递错误
            return $this->error($this->getValidateMessage('product-doesnot-exist'));
        }
        $result = [];

        $result['sizecontents'] = TbSizecontent::find("id IN ({$product->sizecontentids})");

        $builder = $this->modelsManager->createBuilder();
        $name = $this->getlangfield('name');
        $builder->from(['bp' => TbBrandgroupchildProperty::class])
            ->join(TbProperty::class, 'bp.propertyid = p.id', 'p')
            ->columns("p.$name AS title, p.id")
            ->where("bp.brandgroupchildid = {$product->childbrand}")
            ->orderBy("p.displayindex ASC");
        $query = $builder->getQuery();
        $result['properties'] = $query->execute()->toArray();

        return $this->success($result);
    }

    /**
     * 获取商品尺码数据
     */
    public
    function sizecontentsAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$product = TbProduct::findFirst("id=$id")) {
            // 传递错误
            return $this->error($this->getValidateMessage('product-doesnot-exist'));
        }

        $result = TbSizecontent::find("id IN ({$product->sizecontentids})");
        return $this->success($result);
    }

    /**
     * 获取商品条码信息
     */
    public
    function getProductCodesAction()
    {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if ($product != false && $product->companyid == $this->companyid) {
            return $this->success($product->productCode);
        } else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 保存商品条码
     * @return false|string [type] [description]
     */
    public
    function saveProductCodeAction()
    {
        $form = json_decode($_POST["params"], true);
        // 记录 params 的值，方便纠错
        error_log("\$saveProductCode-params = " . print_r($form, true));

        $this->db->begin();
        $product = TbProduct::findFirstById($form['id']);
        if ($product != false) {
            try {
                foreach ($form['list'] as $key => $value) {
                    $product->setProjectCode($key, $value);
                }
            } catch (Exception $e) {
                $this->db->rollback();
                return $this->error([$e->getMessage()]);
            }
        }
        $this->db->commit();
        return $this->success();
    }

    /**
     * 获取商品标题
     */
    public
    function titleAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$product = TbProduct::findFirst("id=$id")) {
            // 传递错误
            return $this->error($this->getValidateMessage('product-doesnot-exist'));
        }

        return $this->success($product->getName());
    }

    /**
     * 添加尺码组
     *
     * @return false|string
     */
    public
    function addSizeAction()
    {
        if ($this->request->isPost()) {
            // 验证
            $brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
            $brandgroup_id = filter_input(INPUT_POST, 'brandgroup_id', FILTER_VALIDATE_INT);
            $brandgroupchild_id = filter_input(INPUT_POST, 'brandgroupchild_id', FILTER_VALIDATE_INT);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);

            $name_en = filter_input(INPUT_POST, 'name_en');
            $sizes = filter_input(INPUT_POST, 'sizes', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            // 尺码组
            $sizetop = new TbSizetop;
            $sizetop->name_cn = $name_en;
            $sizetop->name_en = $name_en;
            $sizetop->displayindex = 100;
            $sizetop->create();

            // 尺码明细
            foreach ($sizes as $key => $size) {
                $sizecontent = new TbSizecontent;

                $sizecontent->topid = $sizetop->id;
                $sizecontent->name = $size['name'];
                $sizecontent->displayindex = $key;

                $sizecontent->create();
            }

            // 品牌尺码表
            $brandSize = new TbBrandSize;

            $brandSize->brand_id = $brand_id;
            $brandSize->brandgroup_id = $brandgroup_id;
            $brandSize->brandgroupchild_id = $brandgroupchild_id;
            $brandSize->gender = $gender;
            $brandSize->sizetop_id = $sizetop->id;

            $brandSize->create();

            return $this->success();
        }
    }

    /**
     * 只根据国际码第二位搜索
     */
    public
    function getOnlyWordcodeCondition()
    {
        // 逻辑
        $where = [];
        if (isset($_POST["wordcode"]) && trim($_POST["wordcode"]) != "") {
            $where[] = sprintf("wordcode like '%%%s%%' ORDER BY companyid asc", addslashes(strtoupper($_POST["wordcode"])));
        }
        // 返回
        return implode(' and ', $where);
    }
}
