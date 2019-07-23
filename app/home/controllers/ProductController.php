<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductcode;
use Asa\Erp\TbPicture;
use Asa\Erp\TbProductSizeProperty;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbProductMaterial;

/**
 * 商品表
 */
class ProductController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbProduct');
    }

    function addAction() {
        //print_r($_POST["params"]);
        $params = json_decode($_POST["params"], true);
        //print_r($params);

        $products = [];
        $colors = [];
        $keys = ["brandid", "brandgroupid", "childbrand", "productsize", "countries", "productparst", "laststoragedate", "series", "ulnarinch", "factoryprice", "factorypricecurrency", "nationalpricecurrency", "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender", "spring", "summer", "fall", "winter", "ageseason", "sizetopid", "sizecontentids", "productmemoids", "nationalfactorypricecurrency", "nationalfactoryprice","saletypeid","producttypeid", "winterproofingid"];

        $this->db->begin();
        foreach($params['colors'] as $row){
            $product = new TbProduct();
            $product->companyid = $this->companyid;
            $product->maketime = date("Y-m-d H:i:s");
            $product->makestaff = $this->currentUser;
            $product->wordcode_1 = trim($row['wordcode_1']);
            $product->wordcode_2 = trim($row['wordcode_2']);
            $product->wordcode_3 = trim($row['wordcode_3']);
            $product->wordcode_4 = trim($row['wordcode_4']);
            $product->brandcolor = $row['brandcolor'];
            $product->colorname = $row['colorname'];
            $product->picture = $row['picture'];
            $product->picture2 = $row['picture2'];
            $product->wordcode = $row['wordcode_1'].$row['wordcode_2'].$row['wordcode_3'];

            foreach($keys as $key) {
                $product->$key = $params['form'][$key];
            }
            $product->factorypricecurrency = $params['form']["wordpricecurrency"];
            $product->nationalfactorypricecurrency = $params['form']["nationalpricecurrency"];

            if($product->create()==false) {
                $this->db->rollback();
                return $this->error($product);
            }
            else {
                //添加材质信息
                if(is_array($params["materials"])) {
                    foreach($params['materials'] as $row) {
                        $productMaterial = new TbProductMaterial();
                        $productMaterial->productid = $product->id;
                        $productMaterial->materialid = $row["materialid"];
                        $productMaterial->materialnoteid = $row["materialnoteid"];
                        $productMaterial->percent = $row["percent"];
                        if($productMaterial->save()==false) {
                            $this->db->rollback();
                            return $this->error($productMaterial);
                        }
                    }
                }

                $products[] = $product;
                $colors[] = $product->id.",".$product->brandcolor;
            }

            $product->syncBrandSugest();
        }

        $output = [];
        $product_group = implode('|', $colors);
        //逐个更新，绑定关系
        foreach($products as $row) {
            $row->product_group = $product_group;
            if($row->update()==false) {
                throw new \Exception("/1002/更新product_group字段失败/");
            }
            $output[] = $row->toArray();
        }

        $this->db->commit();
        return $this->success($output);
    }

    function editAction() {
        $params = json_decode($_POST["params"], true);
        //print_r($params);

        $product = TbProduct::findFirstById($params['form']['id']);
        if($product!=false && $product->companyid==$this->companyid) {
            $this->db->begin();
            //更新同款多色
            if($product->product_group=="") {
                $products =[$product];
            }
            else {
                $products = TbProduct::find(
                    sprintf("product_group='%s'", $product->product_group)
                );
            }


            //生成绑定的颜色组的字符串
            $data = [];
            foreach($products as $row) {
                if($row->id==$product->id) {
                    $row->colorname = $params['form']["colorname"];
                    $row->wordcode_1 = trim($params['form']["wordcode_1"]);
                    $row->wordcode_2 = trim($params['form']["wordcode_2"]);
                    $row->wordcode_3 = trim($params['form']["wordcode_3"]);
                    $row->wordcode_4 = trim($params['form']["wordcode_4"]);
                    $row->brandcolor = $params['form']["brandcolor"];
                    $row->picture = $params['form']["picture"];
                    $row->picture2 = $params['form']["picture2"];
                    $row->laststoragedate = $params['form']["laststoragedate"];
                    $row->producttypeid = $params['form']["producttypeid"];
                    $row->wordcode = $params['form']['wordcode_1'].$params['form']['wordcode_2'].$params['form']['wordcode_3'];
                }

                $row->brandid = $params['form']["brandid"];
                $row->brandgroupid = $params['form']["brandgroupid"];
                $row->childbrand = $params['form']["childbrand"];
                $row->productsize = $params['form']["productsize"];
                $row->countries = $params['form']["countries"];
                $row->productparst = $params['form']["productparst"];
                $row->series = $params['form']["series"];
                $row->ulnarinch = $params['form']["ulnarinch"];
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
                $row->ageseason = $params['form']["ageseason"];
                $row->sizetopid = $params['form']["sizetopid"];
                $row->sizecontentids = $params['form']["sizecontentids"];
                $row->productmemoids = $params['form']["productmemoids"];
                $row->nationalfactorypricecurrency = $params['form']["nationalpricecurrency"];
                $row->nationalfactoryprice = $params['form']["nationalfactoryprice"];
                $row->saletypeid = $params['form']["saletypeid"];
                $row->winterproofingid = $params['form']["winterproofingid"];

                if($row->update()==false) {
                    $this->db->rollback();
                    return $this->error($row);
                }

                $row->updateMaterial($params["materials"]);

                $data[] = $row->id.",".$row->brandcolor;

                //更新颜色提示数据
                $row->syncBrandSugest();
            }

            if(count($products)>1) {
                $product_group = implode('|', $data);

                //逐个更新，绑定关系
                foreach($products as $row) {
                    $row->product_group = $product_group;
                    if($row->update()==false) {
                        throw new \Exception("#1002#更新product_group字段失败#");
                    }
                }
            }


            $this->db->commit();
            return $this->success();
        }
        else {
            throw new \Exception("/1002/数据非法/");
        }
    }

    function before_delete($row) {
        if($row->companyid!=$this->companyid) {
            throw new \Exception('/1002/数据非法/');
        }
    }

    function before_page() {
        $_POST["__orderby"] = "id desc";
    }

    function searchAction() {
        if($this->request->isPost()) {
            $where = array(
                sprintf("companyid=%d", $this->companyid)
            );

            if(isset($_POST["wordcode"]) && trim($_POST["wordcode"])!="") {
                $where[] = sprintf("wordcode like '%%%s%%'", addslashes($_POST["wordcode"]));
            }

            if(isset($_POST["brandid"]) && trim($_POST["brandid"])!="") {
                $where[] = sprintf("brandid=%d", $_POST["brandid"]);
            }

            if(isset($_POST["brandgroupid"]) && trim($_POST["brandgroupid"])!="") {
                $where[] = sprintf("brandgroupid=%d", $_POST["brandgroupid"]);
            }

            if(isset($_POST["childbrand"]) && trim($_POST["childbrand"])!="") {
                $where[] = sprintf("childbrand=%d", $_POST["childbrand"]);
            }

            $names = ['countries', 'ageseason'];
            foreach ($names as $name) {
                if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                    $where[] = \Asa\Erp\Sql::isMatch($name, $_POST[$name]);
                }
            }

            $result = TbProduct::find([
                implode(" and ", $where),
                "order" => "id desc"
            ]);

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
                $data[] = $row->toArray();
            }

            $pageinfo = [
                //"previous"      => $pageObject->previous,
                "current"       => $pageObject->current,
                "totalPages"    => $pageObject->total_pages,
                //"next"          => $pageObject->next,
                "total"    => $pageObject->total_items,
                "pageSize"     => $pageSize
            ];
            echo $this->reportJson(array("data"=>$data, "pagination" => $pageinfo),200,[]);
        }
    }

    function getSearchCondition() {
        $where = array(
            sprintf("companyid=%d", $this->companyid)
        );

        if(isset($_POST["wordcode"]) && trim($_POST["wordcode"])!="") {
            $where[] = sprintf("wordcode like '%%%s%%'", addslashes(strtoupper($_POST["wordcode"])));
        }

        $names = ['brandid', 'brandgroupid', 'childbrand', 'brandcolor', 'saletypeid', 'producttypeid','gender'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isInclude($name, $_POST[$name]);
            }
        }

        $names = ['ulnarinch', 'productsize', 'countries', 'ageseason', 'productparst', 'series', 'productmemoids'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isMatch($name, $_POST[$name]);
            }
        }

        if(isset($_POST["season"]) && preg_match("#^\d+(,\d+)*$#", $_POST["season"])) {
            $columns = [
                "1" => "spring",
                "2" => "summer",
                "3" => "fall",
                "4" => "winter"
            ];
            $array = explode(',', $_POST["season"]);
            foreach($array as $value) {
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
    function codelistAction() {
        $result = TbProductcode::find(
            sprintf("productid=%d", $_POST['id'])
        );

        echo $this->success($result->toArray());
    }

    /**
     * 保存商品货号
     * @return [type] [description]
     */
    function savecodeAction() {
        $form = json_decode($_POST["params"], true);

        $this->db->begin();
        $product = TbProduct::findFirstById($form['productid']);
        if($product!=false) {
            try {
                foreach ($form['list'] as $key => $value) {
                    $product->setProjectCode($value['sizecontentid'], $value['goods_code']);
                }
            }
            catch(\Exception $e) {
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
    function savecolorgroupAction() {
        $form = json_decode($_POST["params"], true);

        $product = TbProduct::findFirstById($form['productid']);
        if($product!=false && $product->companyid==$this->companyid) {
            try {
                $this->db->begin();

                //先解绑颜色组
                $product->cancelBindColor();

                $products = [];
                $data = [];//[$product->id.",".$product->brandcolor];
                //处理新增的记录
                foreach ($form['list'] as &$row) {
                    if($row['id']=='') {
                        $product_else = $product->cloneByColor($row);
                    }
                    else {
                        $product_else = TbProduct::findFirstById($row['id']);
                        if($product_else==false) {
                            throw new \Exception("#1002#绑定的商品不存在#");
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
                        $product_else->sizetopid = $product->sizetopid;
                        $product_else->sizecontentids = $product->sizecontentids;
                        $product_else->productmemoids = $product->productmemoids;
                        $product_else->nationalfactorypricecurrency = $product->nationalfactorypricecurrency;
                        $product_else->nationalfactoryprice = $product->nationalfactoryprice;
                        $product_else->saletypeid = $product->saletypeid;
                    }

                    $product_else->brandcolor = $row['brandcolor'];
                    $product_else->wordcode_1 = $row['wordcode_1'];
                    $product_else->wordcode_2 = $row['wordcode_2'];
                    $product_else->wordcode_3 = $row['wordcode_3'];
                    $product_else->wordcode_4 = $row['wordcode_4'];
                    $product_else->colorname = $row['colorname'];
                    $product_else->picture = $row['picture'];
                    $product_else->picture2 = $row['picture2'];
                    $product_else->wordcode = $row['wordcode_1'].$row['wordcode_2'].$row['wordcode_3'];

                    $products[] = $product_else;
                    $data[] = $product_else->id.",".$product_else->brandcolor;
                }

                if(count($data)==1) {
                    $product_group = "";
                }
                else {
                    $product_group = implode('|', $data);
                }

                //逐个更新，绑定关系
                foreach($products as $row) {
                    $row->product_group = $product_group;

                    if($row->update()==false) {
                        throw new \Exception("#1002#更新product_group字段失败#");
                    }

                    $row->syncMaterial($product);
                    $row->syncBrandSugest();
                }

                $this->db->commit();

                $product = TbProduct::findFirstById($form['productid']);
                return $this->success(["list"=>$product->getColorGroupList(), "form"=>$product->toArray()]);
            }
            catch(\Exception $e) {
                $this->db->rollback();
                return $this->error($e->getMessage());
            }
        }
        else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 获取商品的同款多色的产品列表
     * @return [type] [description]
     */
    function getcolorgrouplistAction() {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if($product!=false) {
            return $this->success($product->getColorGroupList());
        }
        else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 获取商品的图片列表
     * @return [type] [description]
     */
    function pictureAction() {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if($product!=false && $product->companyid==$this->companyid) {
            return $this->success($product->getPictureList());
        }
        else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 保存商品属性
     * @return [type] [description]
     */
    function savepropertyAction() {
        $params = json_decode($_POST['params'], true);
        //print_r($params);

        $id = (int)$params['id'];
        $product = TbProduct::findFirstById($id);
        if($product!=false && $product->companyid==$this->companyid) {
            $this->db->begin();

            $result = array();
            foreach($params['list'] as $key=>$row) {
                if(preg_match("#^(\d+)_(\d+)$#", $key, $match)) {
                    $object = TbProductSizeProperty::findFirst(
                        sprintf("productid=%d and sizecontentid=%d and propertyid=%d", $product->id, $match[1], $match[2])
                    );
                    if($object==false) {
                        $object = new  TbProductSizeProperty();
                        $object->productid = $id;
                        $object->sizecontentid = $match[1];
                        $object->propertyid = $match[2];
                    }
                    $object->content = $row;
                    if($object->save()==false) {
                        $this->db->rollback();
                        return $this->error("/1002/更新或者新增商品属性失败/");
                    }

                    $result[] = $object->toArray();
                }
            }
            $this->db->commit();
            return $this->success($result);
        }
        else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    /**
     * 获取商品的尺码描述信息
     * @return [type] [description]
     */
    function getpropertiesAction() {
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if($product!=false && $product->companyid==$this->companyid) {
            return $this->success($product->productSizeProperty);
        }
        else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    function getpricesAction() {
        $product_array = explode(",", $_POST['productids']);

        $result = [];
        foreach($product_array as $productid) {
            $product = TbProduct::findFirstById($productid);
            if($product!=false && $product->companyid==$this->companyid) {
                foreach($product->getPriceList() as $price) {
                    $result[] = $price;
                }
            }
        }

        return $this->success($result);
    }

    function savepriceAction() {
        $id = (int)$_POST['productid'];
        $product = TbProduct::findFirstById($id);
        if($product!=false && $product->companyid==$this->companyid) {
            if($product->savePrice($_POST["priceid"], $_POST["currencyid"], $_POST["price"])) {
                return $this->success();
            }
            else {
                return $this->error("/1002/设置产品价格失败/");
            }

        }
        else {
            return $this->error("#1001#产品数据不存在#");
        }
    }

    function getproductstockAction() {
        $conditions = [
            sprintf("companyid=%d and productid=%d and number>0", $this->companyid, $_POST['productid'])
        ];
        $result = TbProductstock::find([
            implode(" and ", $conditions),
            "order" => "number desc"
        ]);

        echo $this->success($result->toArray());
    }

    /**
     * 通过商品条码搜索商品信息
     * @return [type] [description]
     */
    function searchcodeAction() {
        if(isset($_POST['code'])) {
            $result = TbProductcode::findFirst(
                sprintf("companyid=%d and goods_code='%s'", $this->companyid, $_POST['code'])
            );

            if($result!=false) {
                return $this->success($result->toArray());
            }
        }

        return $this->success();
    }

    function getcodeAction() {
        if(isset($_POST['productid']) && isset($_POST['sizecontentid'])) {
            $result = TbProductcode::findFirst(
                sprintf("productid=%d and sizecontentid=%d", $_POST['productid'], $_POST['sizecontentid'])
            );

            if($result!=false && $result->companyid==$this->companyid) {
                return $this->success($result->goods_code);
            }
        }

        return $this->success('');
    }
}
