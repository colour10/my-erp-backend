<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\ResultsetInterface;

/**
 * 商品表
 * Class TbProduct
 * @package Asa\Erp
 */
class TbProduct extends BaseCompanyModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $productname;

    /**
     *
     * @var string
     */
    public $wordcode_1;

    /**
     *
     * @var string
     */
    public $wordcode_2;

    /**
     *
     * @var string
     */
    public $wordcode_3;

    /**
     *
     * @var string
     */
    public $wordcode_4;

    /**
     *
     * @var string
     */
    public $wordcode;

    /**
     *
     * @var double
     */
    public $wordprice;

    /**
     *
     * @var integer
     */
    public $wordpricecurrency;

    /**
     *
     * @var string
     */
    public $gender;

    /**
     *
     * @var integer
     */
    public $brandid;

    /**
     *
     * @var integer
     */
    public $brandgroupid;

    /**
     *
     * @var integer
     */
    public $childbrand;

    /**
     *
     * @var integer
     */
    public $brandcolor;

    /**
     *
     * @var string
     */
    public $picture2;

    /**
     *
     * @var string
     */
    public $picture;

    /**
     *
     * @var string
     */
    public $ageseason;

    /**
     *
     * @var string
     */
    public $ageseason_season;

    /**
     *
     * @var string
     */
    public $ageseason_year;

    /**
     *
     * @var string
     */
    public $countries;

    /**
     *
     * @var integer
     */
    public $material;

    /**
     *
     * @var integer
     */
    public $producttemplate;

    /**
     *
     * @var integer
     */
    public $spring;

    /**
     *
     * @var integer
     */
    public $summer;

    /**
     *
     * @var integer
     */
    public $fall;

    /**
     *
     * @var integer
     */
    public $winter;

    /**
     *
     * @var string
     */
    public $laststoragedate;

    /**
     *
     * @var string
     */
    public $aliases;

    /**
     *
     * @var string
     */
    public $series;

    /**
     *
     * @var string
     */
    public $series2;

    /**
     *
     * @var string
     */
    public $ulnarinch;

    /**
     *
     * @var double
     */
    public $factoryprice;

    /**
     *
     * @var integer
     */
    public $factorypricecurrency;

    /**
     *
     * @var double
     */
    public $nationalfactoryprice;

    /**
     *
     * @var integer
     */
    public $nationalfactorypricecurrency;

    /**
     *
     * @var string
     */
    public $product_group;

    /**
     *
     * @var integer
     */
    public $nationalpricecurrency;

    /**
     *
     * @var double
     */
    public $nationalprice;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var string
     */
    public $sizecontentids;

    /**
     *
     * @var integer
     */
    public $sizetopid;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $makestaff;

    /**
     *
     * @var string
     */
    public $productmemoids;

    /**
     *
     * @var string
     */
    public $updatetime;

    /**
     *
     * @var string
     */
    public $maketime;

    /**
     *
     * @var string
     */
    public $colorname;

    /**
     *
     * @var integer
     */
    public $saletypeid;

    /**
     *
     * @var integer
     */
    public $producttypeid;

    /**
     *
     * @var integer
     */
    public $winterproofingid;

    /**
     *
     * @var double
     */
    public $cost;

    /**
     *
     * @var integer
     */
    public $costcurrency;

    /**
     * 这个已经用 brandcolor 代替了
     * @var integer
     */
    public $color_system_id;

    /**
     *
     * @var integer
     */
    public $color_id;

    /**
     *
     * @var integer
     */
    public $second_color_id;

    /**
     *
     * @var integer
     */
    public $oms_update_status;

    /**
     *
     * @var string
     */
    public $oms_update_extra;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    // 单例模型
    private static $box;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product');

        // 商品-公司表，一对多反向
        $this->belongsTo(
            'companyid',
            TbCompany::class,
            'id',
            [
                'alias' => 'company',
            ]
        );

        // 商品-系列，一对多反向
        $this->belongsTo(
            'series',
            TbSeries::class,
            'id',
            [
                'alias' => 'tbseries',
            ]
        );

        // 商品-品牌，一对多反向
        $this->belongsTo(
            'brandid',
            TbBrand::class,
            'id',
            [
                'alias' => 'brand',
            ]
        );

        // 商品-色系，一对多反向
        $this->belongsTo(
            'color_id',
            TbColortemplate::class,
            'id',
            [
                'alias' => 'color',
            ]
        );

        // 商品-子品类，一对多反向
        $this->belongsTo(
            'childbrand',
            TbBrandgroupchild::class,
            'id',
            [
                'alias' => 'subbrand',
            ]
        );

        // 商品-商品类型，一对多反向
        $this->belongsTo(
            'producttypeid',
            TbProductType::class,
            'id',
            [
                'alias' => 'type',
            ]
        );

        // 商品-出厂价格表，一对多反向
        $this->belongsTo(
            'factorypricecurrency',
            TbCurrency::class,
            'id',
            [
                'alias' => 'fpcurrency',
            ]
        );

        // 商品-国际零售价格，一对多反向
        $this->belongsTo(
            'wordpricecurrency',
            TbCurrency::class,
            'id',
            [
                'alias' => 'wpcurrency',
            ]
        );

        // 商品-国内价格，一对多反向
        $this->belongsTo(
            'nationalpricecurrency',
            TbCurrency::class,
            'id',
            [
                'alias' => 'npcurrency',
            ]
        );

        // 商品-销售属性，一对多反向
        $this->belongsTo(
            'saletypeid',
            TbSaleType::class,
            'id',
            [
                'alias' => 'saleType',
            ]
        );

        // 商品-销货号表，一对多
        $this->hasMany(
            "id",
            TbProductcode::class,
            "productid",
            [
                'alias' => 'productCode',
            ]
        );

        // 商品-商品尺码描述主表，一对多
        $this->hasMany(
            "id",
            TbProductSizeProperty::class,
            "productid",
            [
                'alias'      => 'productSizeProperty',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_CASCADE,
                ],
            ]
        );

        // 商品-商品库存表，一对多
        $this->hasMany(
            "id",
            TbProductstock::class,
            "productid",
            [
                'alias'      => 'productstock',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/商品信息存在库存，不能删除。/",
                ],
            ]
        );

        // 商品-订单详情表，一对多
        $this->hasMany(
            "id",
            TbOrderdetails::class,
            "productid",
            [
                'alias'      => 'orderdetails',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/商品信息存在订单记录，不能删除。/",
                ],
            ]
        );

        // 商品-商品材质表，一对多
        $this->hasMany(
            "id",
            TbProductMaterial::class,
            "productid",
            [
                'alias'      => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_CASCADE],
            ]
        );
    }

    /**
     * 商品单例模式
     *
     * @param $productid
     * @return mixed
     */
    public static function getInstance($productid)
    {
        if (!isset(self::$box[$productid])) {
            self::$box[$productid] = TbProduct::findFirstById($productid);
        }

        return self::$box[$productid];
    }

    /**
     * 设置货号
     * @param [type] $sizecontentid [description]
     * @param [type] $goods_code    [description]
     * @return TbProductcode|Model
     * @throws \Exception
     */
    function setProjectCode($sizecontentid, $goods_code)
    {
        if ($this->companyid != $this->getCompanyid()) {
            throw new \Exception("/11130101/非法访问。/");

        }
        $obj = TbProductcode::findFirst(
            sprintf("productid=%d and sizecontentid=%d", $this->id, $sizecontentid)
        );
        if ($obj != false) {
            $obj->goods_code = $goods_code;
        } else {
            $obj = new TbProductcode();
            $obj->goods_code = $goods_code;
            $obj->sizecontentid = $sizecontentid;
            $obj->productid = $this->id;
            $obj->companyid = $this->companyid;
        }

        if ($obj->save() == false) {
            throw new \Exception("/11130102/商品货号保存失败/");
        }

        return $obj;
    }

    /**
     * 解绑定同款不同色关系
     *
     * @return void [type] [description]
     * @throws Exception
     */
    function cancelBindColor()
    {
        if ($this->product_group == "") {
            return;
        }

        $products = TbProduct::find(
            sprintf("product_group='%s'", addslashes($this->product_group))
        );

        foreach ($products as $key => $product) {
            $product->product_group = "";
            if ($product->update() == false) {
                throw new Exception("#1002#解绑定同款不同色关系失败#");
            }
        }
    }

    /**
     * 复制同款商品
     *
     * @param  [type] $brandcolor [description]
     * @return TbProduct [type]             [description]
     * @throws Exception
     */
    function cloneByColor($row)
    {
        $product = new TbProduct();
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
        $product->ageseason_season = $this->ageseason_season;
        $product->ageseason_year = $this->ageseason_year;
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
        if ($product->create() == false) {
            throw new Exception("/1002/复制商品失败/");
        }

        return $product;
    }

    /**
     * 同步商品材质
     *
     * @param $product
     * @throws \Exception
     */
    function syncMaterial($product)
    {
        foreach ($this->productMaterial as $row) {
            if ($row->delete() == false) {
                throw new \Exception("/1001/更新商品材质信息失败/");
            }
        }

        $materials = $product->productMaterial;
        foreach ($materials as $material) {
            $productMaterial = new TbProductMaterial();
            $productMaterial->productid = $this->id;
            $productMaterial->materialid = $material->materialid;
            $productMaterial->materialnoteid = $material->materialnoteid;
            $productMaterial->percent = $material->percent;
            if ($productMaterial->save() == false) {
                throw new \Exception("/1001/添加商品材质信息失败/");
            }
        }
    }

    /**
     * 获取同款多色的颜色分组数组
     * @return array [type] [description]
     */
    function getColorGroupArray()
    {
        $result = [];

        if ($this->product_group == '') {
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
     *
     * @return array|ResultsetInterface [type] [description]
     */
    function getColorGroupList()
    {
        $ids = array_keys($this->getColorGroupArray());
        if (count($ids) > 0) {
            return static::findByIdString($ids, 'id');
        } else {
            return [$this];
        }
    }

    /**
     * 获取商品的图片列表
     * @return ResultsetInterface [type] [description]
     */
    function getPictureList()
    {
        return TbPicture::find([
            sprintf("productid=%d", $this->id),
            "order" => 'id desc',
        ]);
    }

    /**
     * 获取价格列表
     *
     * @return array
     * @throws \Exception
     */
    function getPriceList()
    {
        $prices = TbPrice::find([
            sprintf("companyid=%d", $this->companyid),
            "order" => "displayindex asc",
        ]);

        //特殊设置的价格
        $specialPrices = TbProductPrice::find(
            sprintf("productid=%d", $this->id)
        );
        $hashTable = Util::recordToHashtable($specialPrices, 'priceid');

        $result = [];

        //年代季节是多选，获得最新的年代季节id
        $tempArr = explode(",", $this->ageseason);
        $ageseasonid = $tempArr[0];

        foreach ($prices as $row) {
            if (isset($hashTable[$row->id]) && $hashTable[$row->id]->price > 0) {
                $is_special = 1;
                $price = $hashTable[$row->id]->price;

                try {
                    $value = TbExchangeRate::convert($this->companyid, $this->factorypricecurrency, $row->currencyid, $this->factoryprice);

                    if ($value['number'] > 0) {
                        $costplus = round(($price - $value['number']) * 100 / $value['number'], 0);
                    } else {
                        $costplus = 0;
                    }

                    $result[] = [
                        'id'         => $row->id,
                        'name'       => $row->name,
                        'currencyid' => $row->currencyid,
                        'discount'   => '',
                        'filter'     => $row->filter,
                        'autoprice'  => 0,
                        'price'      => $price,
                        "is_special" => 1,
                        "rate"       => '',
                        "costplus"   => $costplus,
                        "productid"  => $this->id,
                    ];
                } catch (\Exception $e) {
                }
            } else {
                $setting = TbPriceSetting::getPriceSetting($this->brandid, $ageseasonid, $this->producttypeid, $this->childbrand, $row->id);
                if ($setting != false) {
                    $value = TbExchangeRate::convert($this->companyid, $this->wordpricecurrency, $row->currencyid, $this->wordprice);
                    //echo $price;exit;
                    if ($value == false) {
                        //没有设置汇率
                        //echo "2";
                        continue;
                    }

                    $price = $row->getPriceValue($value["number"] * $setting->discount);

                    //计算Cost+
                    $factoryprice = $this->factoryprice * $value["rate"];
                    if ($factoryprice > 0) {
                        $costplus = round(($price - $factoryprice) * 100 / $factoryprice, 0);
                    } else {
                        $costplus = 0;
                    }

                    $result[] = [
                        'id'         => $row->id,
                        'name'       => $row->name,
                        'currencyid' => $row->currencyid,
                        'discount'   => $setting->discount,
                        'filter'     => $row->filter,
                        'autoprice'  => $price,
                        'price'      => $price,
                        "is_special" => 0,
                        "rate"       => $value["rate"],
                        "costplus"   => $costplus,
                        "productid"  => $this->id,
                    ];
                }
            }
        }

        return $result;
    }

    /**
     * 保存价格
     * @param int $priceid
     * @param int $currencyid
     * @param string $price
     * @return bool
     */
    function savePrice($priceid, $currencyid, $price)
    {
        $productPrice = TbProductPrice::findFirst(
            sprintf("productid=%d and priceid=%d", $this->id, $priceid)
        );

        if ($productPrice != false) {
            $productPrice->currencyid = $currencyid;
            $productPrice->price = $price;
        } else {
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

    /**
     * 更新商品材质
     *
     * @param $materials
     * @throws \Exception
     */
    function updateMaterial($materials)
    {
        $rows = TbProductMaterial::find(
            sprintf("productid=%d", $this->id)
        );
        foreach ($rows as $row) {
            if ($row->delete() == false) {
                throw new \Exception("/1001/更新商品材质信息失败/");
            }
        }

        foreach ($materials as $row) {
            $productMaterial = new TbProductMaterial();
            $productMaterial->productid = $this->id;
            $productMaterial->materialid = $row["materialid"];
            $productMaterial->materialnoteid = $row["materialnoteid"];
            $productMaterial->percent = $row["percent"];
            if ($productMaterial->save() == false) {
                throw new \Exception("/1001/添加商品材质信息失败/");
            }
        }
    }

    /**
     * 同步修改商品
     */
    function syncBrandSugest()
    {
        if (!empty($this->brandcolor) && !empty($this->colorname)) {
            TbProductLastmodify::add($this->companyid, $this->brandid, $this->wordcode_3, $this->brandcolor, $this->colorname);
        }
    }

    /**
     * 获取品牌名称
     */
    public function getBrandName()
    {
        return $this->brand->name_en;
    }

    /**
     * 获取性别
     */
    public function getGenderName()
    {
        $language = TbLanguage::findFirst("code='list|gender|{$this->gender}'");

        $lang = $this->getDI()->get("session")->get("language");
        return $language ? $language->{'name_' . $lang} : '';
    }

    /**
     * 获取商品颜色
     */
    public function getColorName()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->color ? $this->color->{'name_' . $lang} : '';
    }

    /**
     * 获取商品描述
     */
    public function getProductMemoNames()
    {
        if ($this->productmemoids) {
            $lang = $this->getDI()->get("session")->get("language");
            $product_memos = TbProductMemo::find("id IN ({$this->productmemoids})");
            foreach ($product_memos as $memo) {
                $str[] = $memo->{'name_' . $lang};
            }
            $str = implode('', $str);
            return $str;
        }

        return '';
    }

    /**
     * 获取子品类
     */
    public function getSubbrand()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->subbrand ? $this->subbrand->{'name_' . $lang} : '';
    }

    /**
     * 获取商品名称
     */
    public function getName()
    {
        $brand = $this->getBrandName();
        $gender = $this->getGenderName();
        $color = $this->getColorName();
        $product_memo = $this->getProductMemoNames();
        $subbrand = $this->getSubbrand();
        return $brand . $gender . $color . $product_memo . $subbrand;
    }

    /**
     * 获取年代
     */
    public function getSeason()
    {
        if ($this->ageseason) {
            $seasons = TbAgeseason::find("id IN ({$this->ageseason})");
            foreach ($seasons as $season) {
                $str[] = $season->sessionmark . $season->name;
            }
            $str = implode(',', $str);
            return $str;
        }

        return '';
    }

    /**
     * 获取国际码
     */
    public function getWorldCode()
    {
        $arr = [$this->wordcode_1, $this->wordcode_2, $this->wordcode_3, $this->wordcode_4];
        return implode(' ', $arr);
    }

    /**
     * 获取商品属性
     */
    public function getType()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->type ? $this->type->{'name_' . $lang} : '';
    }

    /**
     * 获取国际出厂价币种
     */
    public function getFactoryPriceCurrencyLabel()
    {
        return $this->fpcurrency ? $this->fpcurrency->code : '';
    }

    /**
     * 获取倍率
     */
    public function getTimes()
    {
        if ($this->factoryprice != 0) {
            return round($this->wordprice / $this->factoryprice, 2);
        }
        return '';
    }

    /**
     * 获取国际零售价币种
     */
    public function getWordPriceCurrencyLabel()
    {
        return $this->wpcurrency ? $this->wpcurrency->code : '';
    }

    /**
     * 获取折扣率
     */
    public function getDiscountRate()
    {
        if ($this->wordprice != 0) {
            return round($this->factoryprice / $this->wordprice, 2);
        }
        return '';
    }

    /**
     * 获取本国零售价币种
     */
    public function getNationalPriceCurrencyLabel()
    {
        return $this->npcurrency ? $this->npcurrency->code : '';
    }

    /**
     * 获取销售属性
     */
    public function getSaleType()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->saleType ? $this->saleType->{'name_' . $lang} : '';
    }

    /**
     * 获取同款不同色的商品
     *
     * @return array [
     *     'id' => picture
     * ]
     */
    public function getColors()
    {
        $result = [];
        $productGroup = explode('|', $this->product_group);
        foreach ($productGroup as $pg) {
            $pgArray = explode(',', $pg);
            $product = TbProduct::findFirst($pgArray[0]);
            $productModel = TbProduct::findFirst("filename = '".$product->picture."'");
            $result[] = [
                'id'      => $product->id,
                'picture' => $product->picture,
                // 暂时注释
                // 'picture_40' => $product->picture ? $product->picture . '_40x40.jpg' : '',
                'picture_40' => $productModel->filename_40,
            ];
        }

        return $result;
    }

    /**
     * 更新ageseason_season,ageseason_year两个字段
     */
    public function updateAgeSeason()
    {
        $ageseason = TbAgeseason::findFirst(
            [
                "id in ($this->ageseason)",
                "order" => "name desc, sessionmark asc",
            ]
        );
        $this->ageseason_year = $ageseason->name;
        $this->ageseason_season = $ageseason->sessionmark;
        $this->update();
    }

    /**
     * 获取商品系列名称
     */
    public function getSeries()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->tbseries ? $this->tbseries->{'name_' . $lang} : '';
    }

    /**
     * 更新尺码
     *
     * @return void
     */
    public function updateSizecontentids()
    {
        $sizecontentids = [];
        $sizecontents = TbSizecontent::find("topid = {$this->sizetopid}");
        foreach ($sizecontents as $value) {
            $sizecontentids[] = $value->id;
        }
        $this->sizecontentids = implode(',', $sizecontentids);
        $this->update();
    }
}
