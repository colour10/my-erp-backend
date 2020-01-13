<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\CreateImg;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroupchildProperty;
use Asa\Erp\TbCountry;
use Asa\Erp\TbExchangeRate;
use Asa\Erp\TbMaterial;
use Asa\Erp\TbPrice;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductcode;
use Asa\Erp\TbProductMaterial;
use Asa\Erp\TbProductPrice;
use Asa\Erp\TbProductSizeProperty;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbProperty;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbAgeseason;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbSizetop;
use Asa\Erp\TbMaterialnote;
use Asa\Erp\TbProductMemo;
use Asa\Erp\TbSeries;
use Asa\Erp\TbUlnarinch;
use Asa\Erp\TbCurrency;
use Asa\Erp\TbSaleType;
use Asa\Erp\TbProductType;
use Asa\Erp\TbWinterproofing;

/**
 * 商品表
 * ErrorCode 1116
 */
class ProductController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProduct');
    }

    function pageAction() {
        $this->before_page();
        $params = [$this->getSearchCondition()];
        if(isset($_POST['__orderby'])) {
            $params['order'] = $_POST['__orderby'];
        }

        $result = TbProduct::find($params);

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new \Phalcon\Paginator\Adapter\Model(
            [
                "data"  => $result,
                "limit" => $pageSize,
                "page"  => $page,
            ]
        );

        // Get the paginated results
        $pageObject = $paginator->getPaginate();

        $data = [];
        foreach($pageObject->items as $row) {
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
            $data[] = $rowData;
        }

        $pageinfo = [
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize
        ];
        echo $this->reportJson(array("data"=>$data, "pagination" => $pageinfo),200,[]);
	}

    function addAction()
    {
        $params = json_decode($_POST["params"], true);

        $products = [];
        $colors = [];
        $keys = [
            "brandid",
            "series", "factoryprice", "nationalpricecurrency",
            "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender",
            "spring", "summer", "fall", "winter",
            "sizetopid",
            "nationalfactoryprice", "wordprice", "wordpricecurrency",
            "saletypeid","producttypeid", "winterproofingid"
        ];

        $this->db->begin();
        foreach ($params['colors'] as $row) {
            $product = new TbProduct();
            $product->companyid = $this->companyid;
            $product->maketime = date("Y-m-d H:i:s");
            $product->updatetime = date("Y-m-d H:i:s");
            $product->makestaff = $this->currentUser;
            $product->wordcode_1 = $this->filterCode($row['wordcode_1']);
            $product->wordcode_2 = $this->filterCode($row['wordcode_2']);
            $product->wordcode_3 = $this->filterCode($row['wordcode_3']);
            $product->wordcode_4 = $this->filterCode($row['wordcode_4']);
            $product->brandcolor = $row['brandcolor'];
            $product->colorname = $row['colorname'];
            $product->picture = $row['picture'];
            $product->picture2 = $row['picture2'];
            $product->wordcode = $this->filterCode($row['wordcode_1']) . $this->filterCode($row['wordcode_2']) . $this->filterCode($row['wordcode_3']);

            $product->color_system_id = $row['colorId'][0];
            $product->color_id = $row['colorId'][1];
            $product->second_color_id = isset($row['secondColorId'][1]) ? (int)$row['secondColorId'][1] : 0;

            $product->brandgroupid = $params['form']['childbrand'][0];
            $product->childbrand = $params['form']['childbrand'][1];
            $product->sizecontentids = implode(',', $params['form']['sizecontentids']);
            $product->ageseason = implode(',', $params['form']['ageseason']);
            $product->ageseason_season = '';
            $product->ageseason_year = '';
            $product->countries = implode(',', $params['form']['countries']);
            $product->ulnarinch = implode(',', $params['form']['ulnarinch']);
            $product->productmemoids = implode(',', $params['form']['productmemoids']);

            foreach ($keys as $key) {
                $product->$key = trim($params['form'][$key]);
            }
            $product->factorypricecurrency = $params['form']["wordpricecurrency"];
            $product->nationalfactorypricecurrency = $params['form']["nationalpricecurrency"];

            //检验国际码是否重复
            $where = sprintf("companyid=%d and wordcode='%s'", $this->companyid, addslashes($product->wordcode));
            if (TbProduct::count($where) > 0) {
                $this->db->rollback();
                throw new \Exception("/11160101/国际码不能重复/");
            }

            if ($product->create() == false) {
                $this->db->rollback();
                return $this->error($product);
            } else {
                //添加材质信息
                if (is_array($params["materials"])) {
                    foreach ($params['materials'] as $row) {
                        $productMaterial = new TbProductMaterial();
                        $productMaterial->productid = $product->id;
                        $productMaterial->materialid = $row["materialid"];
                        $productMaterial->materialnoteid = $row["materialnoteid"];
                        $productMaterial->percent = $row["percent"];
                        if ($productMaterial->save() == false) {
                            $this->db->rollback();
                            return $this->error($productMaterial);
                        }
                    }
                }

                $products[] = $product;
                $colors[] = $product->id . "," . $product->color_id;
            }

            $product->syncBrandSugest();
        }

        $output = [];
        $product_group = implode('|', $colors);
        //逐个更新，绑定关系
        foreach ($products as $row) {
            $row->product_group = $product_group;
            if ($row->update() == false) {
                throw new \Exception("/1002/更新product_group字段失败/");
            }
            $output[] = $row->toArray();
        }

        $this->db->commit();
        return $this->success($output);
    }

    /**
     * 批量修改
     * @return [type] [description]
     */
    function modifyAction() {
        $params = json_decode($_POST["params"], true);
        //print_r($params);

        $productids = implode(',', $params['products']);

        if(!preg_match("#^\d+(,\d+)*$#", $productids)) {
            throw new \Exception("/11160601/参数错误/");
        }

        $products = TbProduct::find(
            sprintf("companyid=%d and id in (%s)", $this->companyid, addslashes($productids))
        );

        $this->db->begin();

        try {
            $keys = ["brandid", "brandgroupid", "childbrand", "countries", "series", "ulnarinch", "factoryprice", "factorypricecurrency", "nationalpricecurrency", "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender", "spring", "summer", "fall", "winter", "ageseason", "sizetopid", "sizecontentids", "productmemoids", "nationalfactorypricecurrency", "nationalfactoryprice","saletypeid","producttypeid", "winterproofingid"];
            foreach($products as $row) {
                foreach($keys as $key) {
                    if(isset($params['form'][$key]) && $params['form'][$key]!="") {
                        $row->$key = trim($params['form'][$key]);
                    }
                }
                $row->updatetime = date("Y-m-d H:i:s");


                if($row->update()==false) {
                    throw new \Exception("/11160602/批量更新失败。/");
                }

                if(count($params["materials"])) {
                    $row->updateMaterial($params["materials"]);
                }
            }

            $this->db->commit();
            return $this->success();
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    function editAction() {
        $params = json_decode($_POST["params"], true);
        //print_r($params);

        $product = TbProduct::findFirstById($params['form']['id']);
        if ($product != false && $product->companyid == $this->companyid) {
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
                throw new \Exception("/11160201/国际码不能重复/");
            }


            //生成绑定的颜色组的字符串
            $data = [];
            foreach ($products as $row) {
                if ($row->id == $product->id) {
                    $row->colorname = $params['form']["colorname"];
                    $row->wordcode_1 = $this->filterCode($params['form']["wordcode_1"]);
                    $row->wordcode_2 = $this->filterCode($params['form']["wordcode_2"]);
                    $row->wordcode_3 = $this->filterCode($params['form']["wordcode_3"]);
                    $row->wordcode_4 = $this->filterCode($params['form']["wordcode_4"]);
                    $row->brandcolor = $params['form']["brandcolor"];
                    $row->picture = $params['form']["picture"];
                    $row->picture2 = $params['form']["picture2"];
                    $row->laststoragedate = $params['form']["laststoragedate"];
                    $row->producttypeid = $params['form']["producttypeid"];
                    $row->wordcode = $wordcode;
                }

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
                $row->updatetime = date("Y-m-d H:i:s");

                $row->color_system_id = $params['form']['colorId'][0];
                $row->color_id        = $params['form']['colorId'][1];
                $row->second_color_id = isset($params['form']['secondColorId'][1]) ? (int)$params['form']['secondColorId'][1] : 0;
                $row->brandgroupid    = $params['form']['childbrand'][0];
                $row->childbrand      = $params['form']['childbrand'][1];
                $row->sizecontentids  = empty($params['form']['sizecontentids']) ? '' : implode(',', $params['form']['sizecontentids']);
                $row->ageseason       = empty($params['form']['ageseason']) ? '' : implode(',', $params['form']['ageseason']);
                $row->countries       = empty($params['form']['countries']) ? '' :implode(',', $params['form']['countries']);
                $row->ulnarinch       = empty( $params['form']['ulnarinch']) ? '' : implode(',', $params['form']['ulnarinch']);
                $row->productmemoids  = empty($params['form']['productmemoids']) ? '' : implode(',', $params['form']['productmemoids']);

                if ($row->update() == false) {
                    $this->db->rollback();
                    return $this->error($row);
                }

                $row->updateMaterial($params["materials"]);

                $data[] = $row->id . "," . $row->brandcolor;

                //更新颜色提示数据
                $row->syncBrandSugest();
            }

            if (count($products) > 1) {
                $product_group = implode('|', $data);

                //逐个更新，绑定关系
                foreach ($products as $row) {
                    $row->product_group = $product_group;
                    if ($row->update() == false) {
                        throw new \Exception("#1002#更新product_group字段失败#");
                    }
                }
            }


            $this->db->commit();
            return $this->success();
        } else {
            throw new \Exception("/1002/数据非法/");
        }
    }

    function deleteAction() {
        $product = TbProduct::findFirstById($_POST['id']);
        if($product==false || $product->companyid!=$this->companyid) {
            throw new \Exception('/11160501/数据非法/');
        }

        $this->db->begin();

        try {
            $product_group = $product->product_group;
            if($product->delete()===false) {
                throw new \Exception('/11160502/删除失败/');
            }

            //更新同款不同色
            $products = TbProduct::find(
                sprintf("companyid=%d and product_group='%s'", $this->companyid, addslashes($product_group))
            );

            $data = [];
            foreach($products as $row) {
                $data[] = $row->id.",".$row->brandcolor;
            }
            $product_group = implode('|', $data);
            foreach($products as $row) {
                $row->product_group = $product_group;
                if($row->update()==false) {
                    throw new  \Exception('/11160503/删除失败/');
                }
            }

            $this->db->commit();
            return $this->success();
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    private function reverseOrderMethod($orderMethod)
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
            }
            $_POST["__orderby"] = $orderby;

        } else {
            $_POST["__orderby"] = "id desc";
        }

        if (isset($_POST['wordcode'])) {
            $_POST['wordcode'] = $this->filterCode($_POST['wordcode']);
        }
    }

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
                    $where[] = \Asa\Erp\Sql::isMatch($name, $_POST[$name]);
                }
            }

            $result = TbProduct::find([
                implode(" and ", $where),
                "order" => "id desc",
            ]);

            $page = $this->request->getPost("page", "int", 1);
            $pageSize = $this->request->getPost("pageSize", "int", 20);

            $paginator = new \Phalcon\Paginator\Adapter\Model(
                [
                    "data" => $result,
                    "limit" => $pageSize,
                    "page" => $page,
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
                "current" => $pageObject->current,
                "totalPages" => $pageObject->total_pages,
                //"next"          => $pageObject->next,
                "total" => $pageObject->total_items,
                "pageSize" => $pageSize,
            ];
            echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
        }
    }

    function getSearchCondition()
    {
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
                $where[] = \Asa\Erp\Sql::isInclude($name, $_POST[$name]);
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
                $where[] = \Asa\Erp\Sql::isMatch($name, $_POST[$name]);
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

        //echo implode(' and ', $where);
        return implode(' and ', $where);
    }

    /**
     * 获得商品货号数据
     * @return [type] [description]
     */
    function codelistAction()
    {
        $result = TbProductcode::find(
            sprintf("productid=%d", $_POST['id'])
        );

        echo $this->success($result->toArray());
    }

    /**
     * 保存商品货号
     * @return [type] [description]
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
            } catch (\Exception $e) {
                $this->db->rollback();
                return $this->error([$e->getMessage()]);
            }
        }
        $this->db->commit();
        return $this->success();
    }

    /**
     * 保存同款不同色数据
     * @return [type] [description]
     */
    function savecolorgroupAction()
    {
        $form = json_decode($_POST["params"], true);

        $product = TbProduct::findFirstById($form['productid']);
        if ($product != false && $product->companyid == $this->companyid) {
            try {
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
                            throw new \Exception("/11160304/绑定的商品不存在/");
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

                    $product_else->color_system_id = $row['colorId'][0];
                    $product_else->color_id = $row['colorId'][1];
                    $product_else->second_color_id = isset($row['secondColorId'][1]) ? (int)$row['secondColorId'][1] : 0;
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

                //逐个更新，绑定关系
                foreach ($products as $row) {
                    $row->product_group = $product_group;

                    //检验国际码是否重复
                    $where = sprintf("companyid=%d and wordcode='%s' and id<>%d", $this->companyid, addslashes($row->wordcode), $row->id);
                    if (TbProduct::count($where) > 0) {
                        throw new \Exception("/11160301/国际码不能重复/");
                    }

                    $row->updatetime = date("Y-m-d H:i:s");
                    if($row->update()==false) {
                        throw new \Exception("/11160302/更新product_group字段失败/");
                    }

                    $row->syncMaterial($product);
                    $row->syncBrandSugest();
                }

                $this->db->commit();

                $product = TbProduct::findFirstById($form['productid']);
                return $this->success(["list" => $product->getColorGroupList(), "form" => $product->toArray()]);
            } catch (\Exception $e) {
                $this->db->rollback();
                return $this->error($e->getMessage());
            }
        } else {
            return $this->error("/11160303/产品数据不存在/");
        }
    }

    private function filterCode($code)
    {
        return preg_replace("#\s+#msi", "", $code);
    }

    /**
     * 获取商品的同款多色的产品列表
     * @return [type] [description]
     */
    function getcolorgrouplistAction()
    {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if ($product != false) {
            return $this->success($product->getColorGroupList());
        } else {
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
     * 保存商品属性
     * @return [type] [description]
     */
    function savepropertyAction()
    {
        $params = json_decode($_POST['params'], true);
        //print_r($params);

        $id = (int)$params['id'];
        $product = TbProduct::findFirstById($id);
        if ($product != false && $product->companyid == $this->companyid) {
            $this->db->begin();

            $result = [];
            foreach ($params['list'] as $key => $row) {
                if (preg_match("#^(\d+)_(\d+)$#", $key, $match)) {
                    $object = TbProductSizeProperty::findFirst(
                        sprintf("productid=%d and sizecontentid=%d and propertyid=%d", $product->id, $match[1], $match[2])
                    );
                    if ($object == false) {
                        $object = new  TbProductSizeProperty();
                        $object->productid = $id;
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
            $this->db->commit();
            return $this->success($result);
        } else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 获取商品的尺码描述信息
     * @return [type] [description]
     */
    function getpropertiesAction()
    {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
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
     * @return [type] [description]
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
     * @return [type] [description]
     */
    function modifypricesAction()
    {
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/11160401/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        if (!preg_match("#^\d+(,\d+)*$#", $submitData['products'])) {
            throw new \Exception("/11160402/参数错误/");
        }

        $products = TbProduct::find(
            sprintf("companyid=%d and id in (%s)", $this->companyid, $submitData['products'])
        );

        //print_r($products->toArray());

        $this->db->begin();
        try {
            foreach ($submitData['prices'] as $row) {
                //echo "{$row['name']}\n";
                $price = TbPrice::getInstance($row['id']);
                if ($price == false || $price->companyid != $this->companyid) {
                    throw new \Exception("/11160403/价格未定义/");
                }
                //echo "{$row['name']}\n";

                foreach ($products as $product) {
                    //echo "do {$product->id}\n";
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
                        $productPrice->updatetime = date('Y-m-d H:i:s');
                        $productPrice->updatestaff = $this->currentUser;

                        if ($productPrice->save() == false) {
                            //echo "xxxx";
                            throw new \Exception("/11160404/价格更新失败/");
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $this->db->rollback();
            echo $this->error($e->getMessage());
        }
        $this->db->commit();
        return $this->success();
    }

    /**
     * 返回OMS同步需要的价格列表
     * @return [type] [description]
     */
    function getomspricesAction() {
        $result = ['hkgcost'=>'', 'eurcost'=>'', 'chncost'=>'', 'bdacost'=>''];
        $auth = $this->auth;
        if(isset($auth['company'])) {
            $company = $auth['company'];

            $product = TbProduct::findFirstById($_POST['productid']);
            if($product!=false && $product->companyid==$this->companyid) {
                foreach($product->getPriceList() as $row) {
                    if($row['id']==$company->hkgcost) {
                        $result['hkgcost'] = $row['price'];
                    }
                    else if($row['id']==$company->eurcost) {
                        $result['eurcost'] = $row['price'];
                    }
                    else if($row['id']==$company->chncost) {
                        $result['chncost'] = $row['price'];
                    }
                    else if($row['id']==$company->bdacost) {
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
    public function createimageAction()
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
                'columns' => 'propertyid',
                'conditions' => 'brandgroupchildid = :brandgroupchildid:',
                'bind' => [
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
                'productid' => $productid,
                'brandname' => '品牌：' . $brandname,
                'countryname' => '产地：' . $countryname,
                'materialname' => '材质：' . $materialname,
                'colorname' => '颜色：' . str_replace("\t", '', $product->colorname),
                'model' => '款式：' . $model,
                'pic' => $pic,
                'properties' => $properties,
                'lists' => $lists,
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
    public function getlangfield($fieldname)
    {
        // 默认语言是cn
        $lang = $this->session->get('language') ?: 'cn';
        return $fieldname . '_' . $lang;
    }

    /**
     * 获取商品相关内容
     * 年代
     */
    public function getProductRelatedOptionsAction()
    {
        $lang = $this->getDI()->get("session")->get("language");
        $result = [];

        $result['ageseasons'] = [];
        $ageseasons = TbAgeseason::find([
            "order" => "name desc,sessionmark asc"
        ]);
        foreach ($ageseasons as $ageseason) {
            $title = $ageseason->sessionmark . $ageseason->name;
            $result['ageseasons'][] = [
                'id' => (int)$ageseason->id,
                'title' => $title
            ];
        }

        $brands = [];
        $brandsTmp = TbBrand::find();
        foreach ($brandsTmp as $brand) {
            $title = $brand->{'name_' . $lang};
            $brands[$brand->id]['id'] = (int)$brand->id;
            $brands[$brand->id]['title'] = $title;
            $brands[$brand->id]['series'] = [];
        }
        $series = TbSeries::find([
            "order" => "name_en asc"
        ]);
        foreach ($series as $s) {
            if (isset($brands[$s->brandid])) {
                $title = $s->{'name_' . $lang};
                $child = [
                    'id' => (int)$s->id,
                    'title' => $title
                ];
                $brands[$s->brandid]['series'][] = $child;
            }
        }
        $result['brands'] = array_values($brands);

        $categories = [];
        $brandgroups = TbBrandgroup::find([
            "order" => "displayindex asc"
        ]);
        foreach ($brandgroups as $bg) {
            $title = $bg->{'name_' . $lang};
            $categories[$bg->id]['id'] = (int)$bg->id;
            $categories[$bg->id]['title'] = $title;
            $categories[$bg->id]['children'] = [];
        }

        $brandgroupchildren = TbBrandgroupchild::find([
            "order" => "displayindex asc"
        ]);
        foreach ($brandgroupchildren as $bgc) {
            if (isset($categories[$bgc->brandgroupid])) {
                $title = $bgc->{'name_' . $lang};
                $child = [
                    'id' => (int)$bgc->id,
                    'title' => $title
                ];
                $categories[$bgc->brandgroupid]['children'][] = $child;
            }
        }
        $result['categories'] = array_values($categories);

        $sizes = [];
        $sizetops = TbSizetop::find([
            "order" => "displayindex asc"
        ]);
        foreach ($sizetops as $st) {
            $title = $st->{'name_' . $lang};
            $sizes[$st->id]['id'] = (int)$st->id;
            $sizes[$st->id]['title'] = $title;
            $sizes[$st->id]['children'] = [];
        }

        $sizecontents = TbSizecontent::find([
            "order" => "displayindex asc"
        ]);
        foreach ($sizecontents as $sc) {
            if (isset($sizes[$sc->topid])) {
                $child = [
                    'id' => (int)$sc->id,
                    'title' => $sc->name
                ];
                $sizes[$sc->topid]['children'][] = $child;
            }
        }
        $result['sizes'] = array_values($sizes);

        $materials = TbMaterial::find([
            "order" => "name_en asc"
        ]);
        foreach ($materials as $material) {
            $title = $material->{'name_' . $lang};
            $result['materials'][] = [
                'id' => (int)$material->id,
                'title' => $title
            ];
        }

        $materialnotes = TbMaterialnote::find([
            "order" => "displayindex asc"
        ]);
        foreach ($materialnotes as $mn) {
            $title = $mn->{'content_' . $lang};
            $result['materialnotes'][] = [
                'id' => (int)$mn->id,
                'title' => $title
            ];
        }

        $result['productMemos'] = [];
        $productMemos = TbProductMemo::find([
            "order" => "displayindex asc"
        ]);
        foreach ($productMemos as $pm) {
            $title = $pm->{'name_' . $lang};
            $result['productMemos'][] = [
                'id' => (int)$pm->id,
                'title' => $title
            ];
        }

        $result['countries'] = [];
        $countries = TbCountry::find([
            "order" => "name_en ASC"
        ]);
        foreach ($countries as $country) {
            $title = $country->{'name_' . $lang};
            $result['countries'][] = [
                'id' => (int)$country->id,
                'title' => $title
            ];
        }

        $result['ulnarinches'] = [];
        $ulnarinches = TbUlnarinch::find([
            "order" => "displayindex ASC"
        ]);
        foreach ($ulnarinches as $ulnarinch) {
            $title = $ulnarinch->{'name_' . $lang};
            $result['ulnarinches'][] = [
                'id' => (int)$ulnarinch->id,
                'title' => $title
            ];
        }

        $result['currencies'] = [];
        $currencies = TbCurrency::find([
            "order" => "code ASC"
        ]);
        foreach ($currencies as $currency) {
            $result['currencies'][] = [
                'id' => (int)$currency->id,
                'code' => $currency->code
            ];
        }

        $result['saletypes'] = [];
        $saletypes = TbSaleType::find([
            "order" => "displayindex ASC"
        ]);
        foreach ($saletypes as $saletype) {
            $title = $saletype->{'name_' . $lang};
            $result['saletypes'][] = [
                'id' => (int)$saletype->id,
                'title' => $title
            ];
        }

        $result['productTypes'] = [];
        $productTypes = TbProductType::find([
            "order" => "displayindex ASC"
        ]);
        foreach ($productTypes as $productType) {
            $title = $productType->{'name_' . $lang};
            $result['productTypes'][] = [
                'id' => (int)$productType->id,
                'title' => $title
            ];
        }

        $result['winterProofings'] = [];
        $winterProofings = TbWinterproofing::find([
            "order" => "displayindex ASC"
        ]);
        foreach ($winterProofings as $wp) {
            $title = $wp->{'name_' . $lang};
            $result['winterProofings'][] = [
                'id' => (int)$wp->id,
                'title' => $title
            ];
        }

        return $this->success($result);
    }

    /**
     * 获取商品信息
     */
    public function infoAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$product = TbProduct::findFirst("id=$id")) {
            // 传递错误
            return $this->renderError('make-an-error', 'product-doesnot-exist');
        }
        $result = $product->toArray();
        $result['materials'] = $product->productMaterial->toArray();

        return $this->success($result);
    }

    /**
     * 获取商品尺码和尺码规格
     */
    public function sizecontentsAndPropertiesAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$product = TbProduct::findFirst("id=$id")) {
            return $this->renderError('make-an-error', 'product-doesnot-exist');
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
    public function sizecontentsAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$product = TbProduct::findFirst("id=$id")) {
            return $this->renderError('make-an-error', 'product-doesnot-exist');
        }

        $result = TbSizecontent::find("id IN ({$product->sizecontentids})");
        return $this->success($result);
    }

    /**
     * 获取商品条码信息
     */
    public function getProductCodesAction()
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
     * @return [type] [description]
     */
    public function saveProductCodeAction()
    {
        $form = json_decode($_POST["params"], true);

        $this->db->begin();
        $product = TbProduct::findFirstById($form['id']);
        if ($product != false) {
            try {
                foreach ($form['list'] as $key => $value) {
                    $product->setProjectCode($key, $value);
                }
            } catch (\Exception $e) {
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
    public function titleAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$product = TbProduct::findFirst("id=$id")) {
            return $this->renderError('make-an-error', 'product-doesnot-exist');
        }

        return $this->success($product->getName());
    }
}
