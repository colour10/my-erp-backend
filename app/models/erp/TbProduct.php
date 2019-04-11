<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品表
 */
class TbProduct extends BaseCompanyModel
{
    private static $box;
    
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product');

        // 商品-公司表，一对多反向
        $this->belongsTo(
            'companyid',
            '\Asa\Erp\TbCompany',
            'id',
            [
                'alias' => 'company'
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProductSizeProperty",
            "productid",
            [
                'alias' => 'productSizeProperty',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_CASCADE
                ],
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProductstock",
            "productid",
            [
                'alias' => 'productstock',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => "/1003/商品信息存在库存，不能删除。/"
                ],
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbOrderdetails",
            "productid",
            [
                'alias' => 'orderdetails',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => "/1003/商品信息存在订单记录，不能删除。/"
                ],
            ]
        );
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//            "age",
//            new Between(
//                [
//                    "minimum" => 18,
//                    "maximum" => 60,
//                    "message" => "年龄必须是18~60岁",
//                ]
//            )
//        );
//
//        $validator->add(
//            'name',
//            new Uniqueness(
//                [
//                    'message' => '姓名不能重复',
//                ]
//            )
//        );

        return $this->validate($validator);
    }

    public static function getInstance($productid) {
        if(!isset(self::$box[$productid])) {
            self::$box[$productid] = TbProduct::findFirstById($productid);
        }

        return self::$box[$productid];
    }

    /**
     * 设置货号
     * @param [type] $sizecontentid [description]
     * @param [type] $goods_code    [description]
     */
    function setProjectCode($sizecontentid, $goods_code) {
        if($this->companyid!=$this->getCompanyid()) {
            throw new Exception("#1001#访问非被公司数据#");
            
        }
        $obj = TbProductcode::findFirst(
            sprintf("productid=%d and sizecontentid=%d", $this->id, $sizecontentid)
        );
        if($obj!=false) {
            $obj->goods_code = $goods_code;
        }
        else {
            $obj = new TbProductcode();
            $obj->goods_code = $goods_code;
            $obj->sizecontentid = $sizecontentid;
            $obj->productid = $this->id;
        }

        if($obj->save()==false) {
            throw new Exception("#1002#保存失败#");
        }

        return $obj;
    }

    /**
     * 解绑定同款不同色关系
     * @return [type] [description]
     */
    function cancelBindColor() {
        $db = $this->getDI()->get('db');

        $db->begin();
        $products = TbProduct::find(
            sprintf("product_group='%s'", addslashes($this->product_group))
        );

        foreach ($products as $key => $product) {
            $product->product_group = "";
            if($product->update()==false) {
                throw new Exception("#1002#解绑定同款不同色关系失败#");
            }
        }
        return $db->commit();
    }

    /**
     * 复制同款商品
     * @param  [type] $brandcolor [description]
     * @param  [type] $wordcode_1 [description]
     * @param  [type] $wordcode_2 [description]
     * @param  [type] $wordcode_3 [description]
     * @param  [type] $wordcode_4 [description]
     * @return [type]             [description]
     */
    function cloneByColor($brandcolor, $wordcode_1, $wordcode_2, $wordcode_3, $wordcode_4) {
        $product = new TbProduct();
        $product->brandcolor = $brandcolor;
        $product->wordcode_1 = $wordcode_1;
        $product->wordcode_2 = $wordcode_2;
        $product->wordcode_3 = $wordcode_3;
        $product->wordcode_4 = $wordcode_4;
        $product->productname = $this->productname;
        $product->wordprice = $this->wordprice;
        $product->wordpricecurrency = $this->wordpricecurrency;
        $product->gender = $this->gender;
        $product->brandid = $this->brandid;
        $product->brandgroupid = $this->brandgroupid;
        $product->childbrand = $this->childbrand;
        $product->picture2 = "";
        $product->picture = "";
        $product->ageseason = $this->ageseason;
        $product->countries = $this->countries;
        $product->material = $this->material;
        $product->producttemplate = $this->producttemplate;
        $product->season = $this->season;
        //$product->laststoragedate = $this->laststoragedate;
        $product->aliases = $this->aliases;
        $product->series = $this->series;
        $product->series2 = $this->series2;
        $product->ulnarinch = $this->ulnarinch;
        $product->factoryprice = $this->factoryprice;
        $product->factorypricecurrency = $this->factorypricecurrency;
        $product->retailprice = $this->retailprice;
        $product->retailpricecurrency = $this->retailpricecurrency;
        $product->product_group = "";
        $product->nationalprice = $this->nationalprice;
        $product->ulnarinch_memo = $this->ulnarinch_memo;
        $product->sizetopid = $this->sizetopid;
        $product->companyid = $this->companyid;
        $product->adduserid = $this->getDI()->get("currentUser");
        if($product->create()==false) {
            throw new Exception("#1002#复制商品失败#");
        }

        return $product;
    }

    /**
     * 获取同款多色的颜色分组数组
     * @return [type] [description]
     */
    function getColorGroupArray() {
        $result = [];

        if($this->product_group=='') {
            return $result;
        }

        $array = explode('|', $this->product_group);
        foreach ($array as $key => $value) {
            # code...
            $temp = explode(",", $value);
            $result[$temp[0]] = $temp[1];
        }
        return $result;
    }

    /**
     * 获取同款多色的各个产品的产品数据
     * @return [type] [description]
     */
    function getColorGroupList() {
        $ids = array_keys($this->getColorGroupArray());
        if(count($ids)>0) {
            return static::findByIdString($ids,'id');
        }
        else {
            return [];
        }
    }

    /**
     * 获取商品的图片列表
     * @return [type] [description]
     */
    function getPictureList() {
        return TbPicture::find([
            sprintf("productid=%d", $this->id),
            "order" => 'id desc'
        ]);
    }
}
