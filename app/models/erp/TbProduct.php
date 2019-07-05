<?php

namespace Asa\Erp;

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

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProductMaterial",
            "productid",
            [
                'alias' => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_CASCADE                ],
            ]
        );
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
        if($this->product_group=="") {
            return ;
        }

        $products = TbProduct::find(
            sprintf("product_group='%s'", addslashes($this->product_group))
        );

        foreach ($products as $key => $product) {
            $product->product_group = "";
            if($product->update()==false) {
                throw new Exception("#1002#解绑定同款不同色关系失败#");
            }
        }
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
    function cloneByColor($row) {
        $product = new TbProduct();
        $product->brandcolor = $row['brandcolor'];
        $product->wordcode_1 = $row['wordcode_1'];
        $product->wordcode_2 = $row['wordcode_2'];
        $product->wordcode_3 = $row['wordcode_3'];
        $product->wordcode_4 = $row['wordcode_4'];
        $product->colorname = $row['colorname'];
        $product->picture = $row['picture'];
        $product->picture2 = $row['picture2'];
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
        $product->ageseason = $this->ageseason;
        //$product->laststoragedate = $this->laststoragedate;
        $product->aliases = $this->aliases;
        $product->series = $this->series;
        $product->series2 = $this->series2;
        $product->ulnarinch = $this->ulnarinch;
        $product->factoryprice = $this->factoryprice;
        $product->factorypricecurrency = $this->factorypricecurrency;
        $product->nationalfactoryprice = $this->nationalfactoryprice;
        $product->nationalfactorypricecurrency = $this->nationalfactorypricecurrency;
        $product->nationalprice = $this->nationalprice;
        $product->nationalpricecurrency = $this->nationalpricecurrency;
        $product->product_group = "";
        $product->nationalprice = $this->nationalprice;
        //$product->ulnarinch_memo = $this->ulnarinch_memo;
        $product->sizetopid = $this->sizetopid;
        $product->sizecontentids = $this->sizecontentids;
        $product->spring = $this->spring;
        $product->summer = $this->summer;
        $product->fall = $this->fall;
        $product->winter = $this->winter;
        $product->companyid = $this->companyid;
        $product->makestaff = $this->getDI()->get("currentUser");
        $product->maketime = date("Y-m-d H:i:s");
        if($product->create()==false) {
            throw new Exception("/1002/复制商品失败/");
        }

        return $product;
    }

    function syncMaterial($product) {
        foreach($this->productMaterial as $row) {
            if($row->delete()==false) {
                throw new \Exception("/1001/更新商品材质信息失败/");
            }
        }

        $materials = $product->productMaterial;
        foreach($materials as $material) {
            $productMaterial = new TbProductMaterial();
            $productMaterial->productid = $this->id;
            $productMaterial->materialid = $material->materialid;
            $productMaterial->materialnoteid = $material->materialnoteid;
            $productMaterial->percent = $material->percent;
            if($productMaterial->save()==false) {
                throw new \Exception("/1001/添加商品材质信息失败/");
            }
        }
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
            return [$this];
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

    function getPriceList() {
        $prices = TbPrice::find([
            sprintf("companyid=%d", $this->companyid),
            "order" => "displayindex asc"
        ]);

        //特殊设置的价格
        $specialPrices = TbProductPrice::find(
            sprintf("productid=%d", $this->id)
        );
        $hashTable = Util::recordToHashtable($specialPrices, 'priceid');

        $result = [];

        //年代季节是多选，获得最新的年代季节id
        $temparr = explode(",", $this->ageseason);
        $ageseasonid = $temparr[0];

        foreach($prices as $row) {
            $setting = TbPriceSetting::getPriceSetting($this->brandid, $ageseasonid, $this->producttypeid, $this->childbrand, $row->id);
            if($setting!=false) {
                $value = TbExchangeRate::convert($this->companyid, $this->wordpricecurrency, $row->currencyid, $this->wordprice);
                //echo $price;exit;
                if($value==false) {
                    //没有设置汇率
                    //echo "2";
                    continue;
                }

                $autoprice = $row->getPriceValue($value["number"]*$setting->discount);

                $is_special = "0";
                if(isset($hashTable[$row->id]) && $hashTable[$row->id]->price>0) {
                    $price = TbExchangeRate::convert($this->companyid, $hashTable[$row->id]->currencyid, $row->currencyid, $hashTable[$row->id]->price);
                    if($price==false) {
                        //echo "0";
                        continue;
                    }
                    $is_special = 1;
                    $price = $price["number"];
                }
                else {
                    $price = $autoprice;
                }

                //计算Cost+
                $factoryprice = $this->factoryprice*$value["rate"];
                $costplus = round(($price-$factoryprice)*100/$factoryprice,0);

                $result[] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'currencyid' => $row->currencyid,
                    'discount' => $setting->discount,
                    'filter' => $row->filter,
                    'autoprice' => $autoprice,
                    'price' => $price,
                    "is_special"  => $is_special,
                    "rate" => $value["rate"],
                    "costplus" => $costplus,
                    "productid" => $this->id
                ];
            }
        }

        return $result;
    }

    function savePrice($priceid, $currencyid, $price) {
        $productPrice = TbProductPrice::findFirst(
            sprintf("productid=%d and priceid=%d", $this->id, $priceid)
        );

        if($productPrice!=false) {
            $productPrice->currencyid = $currencyid;
            $productPrice->price = $price;
        }
        else {
            $productPrice = new TbProductPrice();
            $productPrice->currencyid = $currencyid;
            $productPrice->price = $price;
            $productPrice->priceid = $priceid;
            $productPrice->productid = $this->id;
        }

        $productPrice->updatestaff = $this->getDI()->get("currentUser");
        $productPrice->updatetime = date("Y-m-d H:i:s");
        return $productPrice->save();
    }

    function updateMaterial($materials) {
        $rows = TbProductMaterial::find(
            sprintf("productid=%d", $this->id)
        );
        foreach($rows as $row) {
            if($row->delete()==false) {
                throw new \Exception("/1001/更新商品材质信息失败/");
            }
        }

        foreach($materials as $row) {
            $productMaterial = new TbProductMaterial();
            $productMaterial->productid = $this->id;
            $productMaterial->materialid = $row["materialid"];
            $productMaterial->materialnoteid = $row["materialnoteid"];
            $productMaterial->percent = $row["percent"];
            if($productMaterial->save()==false) {
                throw new \Exception("/1001/添加商品材质信息失败/");
            }
        }
    }

    function syncBrandSugest() {
        if($this->brandcolor!="" && $this->colorname!=""){
            TbProductLastmodify::add($this->companyid, $this->brandid, $this->wordcode_3, $this->brandcolor, $this->colorname);
        }
    }
}