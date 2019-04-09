<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductcode;
use Asa\Erp\TbPicture;
use Asa\Erp\TbProductSizeProperty;

/**
 * 商品表
 */
class ProductController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbProduct');
    }
    
    function searchAction() {
        if($this->request->isPost()) {
            $where = array(
                sprintf("companyid=%d", $this->companyid)
            );
            if(isset($_POST["productname"]) && trim($_POST["productname"])!="") {
                $where[] = sprintf("productname like '%%%s%%'", addslashes($_POST["productname"]));
            }
            
            $result = TbProduct::find(
                implode(" and ", $where)
            );    
            
            return $this->success($result->toArray());
        }        
    }
    
    public function beforeExecuteRoute($dispatcher)
    {
        // 这个方法会在每一个能找到的action前执行
        $action = $dispatcher->getActionName();
        if ($action=='add') {
            $_POST["adduserid"] = $this->currentUser;
        }
    }

    /*function loadnameAction() {
        $array = explode(",", $_POST['ids']);
        foreach($array as &$row) {
            $row = (int)$row;
        }

        $products = TbProduct::find(
            sprintf("id in (%s)", implode(',', $array))
        );

        $columns = explode(",", $_POST['columns']);
        $output = [];
        foreach($products as $row) {
            $line = [];
            foreach ($columns as $value) {
                $line[$value] = $row->$value;
            }
            $output[$row->id] = $line;
        }

        echo json_encode($output);
    }*/

    function codelistAction() {
        $result = TbProductcode::find(
            sprintf("productid=%d", $_POST['id'])
        );

        echo $this->success($result->toArray());
    }

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
}
