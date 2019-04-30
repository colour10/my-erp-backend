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
        $keys = ["brandid", "brandgroupid", "childbrand", "productsize", "countries", "productparst", "laststoragedate", "series", "ulnarinch", "factoryprice", "factorypricecurrency", "nationalpricecurrency", "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender", "spring", "summer", "fall", "winter", "ageseason", "sizetopid", "sizecontentids", "productmemoids", "nationalfactorypricecurrency", "nationalfactoryprice"];

        $this->db->begin();
        foreach($params['colors'] as $row){
            $product = new TbProduct();
            $product->companyid = $this->companyid;
            $product->maketime = date("Y-m-d H:i:s");
            $product->makestaff = $this->currentUser;
            $product->wordcode_1 = $row['wordcode_1'];
            $product->wordcode_2 = $row['wordcode_2'];
            $product->wordcode_3 = $row['wordcode_3'];
            $product->wordcode_4 = $row['wordcode_4'];
            $product->brandcolor = $row['brandcolor'];
            $product->colorname = $row['colorname'];
            $product->picture = $row['picture'];
            $product->picture2 = $row['picture2'];

            foreach($keys as $key) {
                $product->$key = $params['form'][$key];
            }
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
        }

        $product_group = implode('|', $colors);
        //逐个更新，绑定关系
        foreach($products as $row) {
            $row->product_group = $product_group;
            if($row->update()==false) {
                throw new \Exception("/1002/更新product_group字段失败/");
            }
        }

        $this->db->commit();
        return $this->success();
    }

    function editAction() {
        $params = json_decode($_POST["params"], true);
        //print_r($params);

        $products = [];
        $colors = [];
        $keys = ["colorname", "wordcode_1","wordcode_2","wordcode_3","wordcode_4","brandcolor","picture","picture2","brandid", "brandgroupid", "childbrand", "productsize", "countries", "productparst", "laststoragedate", "series", "ulnarinch", "factoryprice", "factorypricecurrency", "nationalpricecurrency", "nationalprice", "memo", "wordprice", "wordpricecurrency", "gender", "spring", "summer", "fall", "winter", "ageseason", "sizetopid", "sizecontentids", "productmemoids", "nationalfactorypricecurrency", "nationalfactoryprice"];

        
        $product = TbProduct::findFirstById($params['form']['id']);
        if($product!=false && $product->companyid==$this->companyid) {
            //检查是否更新了色系
            $isChange = $params['form']['brandcolor']==$product->brandcolor;

            foreach($keys as $key) {
                $product->$key = $params['form'][$key];
            }

            $this->db->begin();
            if($product->update()==false) {
                $this->db->rollback();
                return $this->error($product);
            }

            //更新材质信息
            if(is_array($params["materials"])) {
                foreach($params['materials'] as $row) {
                    if(isset($row['id']) && $row['id']>0) {
                        $productMaterial = TbProductMaterial::findFirstById($row['id']);
                    }
                    else {
                        $productMaterial = new TbProductMaterial();
                        $productMaterial->productid = $product->id;
                    }
                    $productMaterial->materialid = $row["materialid"];
                    $productMaterial->materialnoteid = $row["materialnoteid"];
                    $productMaterial->percent = $row["percent"];
                    if($productMaterial->save()==false) {
                        $this->db->rollback();
                        return $this->error($productMaterial);
                    }
                }
            }
            
            //更新同款多色
            if($isChange) {
                $products = TbProduct::find(
                    sprintf("product_group='%s'", $product->product_group)
                );

                //生成绑定的颜色组的字符串
                $data = [];
                foreach($products as $row) {
                    $data[] = $row->id.",".$row->brandcolor;
                }

                
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
            if(isset($_POST["productname"]) && trim($_POST["productname"])!="") {
                $where[] = sprintf("productname like '%%%s%%'", addslashes($_POST["productname"]));
            }
            
            $result = TbProduct::find([
                implode(" and ", $where),
                "order" => "id desc"
            ]);    
            
            return $this->success($result->toArray());
        }        
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
        if($product!=false) {
            try {
                $this->db->begin();

                //先解绑颜色组
                $product->cancelBindColor();   

                $products = [$product];
                $data = [$product->id.",".$product->brandcolor];
                //处理新增的记录
                foreach ($form['list'] as &$row) {
                    //当前的产品信息已经添加过了。
                    if($row['id']==$product->id) {
                        continue;
                    }

                    if($row['id']=='') {                        
                        $product_else = $product->cloneByColor($row['brandcolor'], $row['wordcode_1'], $row['wordcode_2'], $row['wordcode_3'], $row['wordcode_4']);
                    }
                    else {
                        $product_else = TbProduct::findFirstById($row['id']);
                        if($product_else==false) {
                            throw new \Exception("#1002#绑定的商品不存在#");
                        }
                    }
                    $products[] = $product_else;
                    $data[] = $product_else->id.",".$product_else->brandcolor;
                }

                $product_group = implode('|', $data);
                //逐个更新，绑定关系
                foreach($products as $row) {
                    $row->product_group = $product_group;
                    if($row->update()==false) {
                        throw new \Exception("#1002#更新product_group字段失败#");
                    }
                }

                $this->db->commit();
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
        $id = (int)$_POST['id'];
        $product = TbProduct::findFirstById($id);
        if($product!=false && $product->companyid==$this->companyid) {
            return $this->success($product->getPriceList());
        }
        else {
            return $this->error("#1001#产品数据不存在#");
        }
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
}
