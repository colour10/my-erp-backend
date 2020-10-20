<?php

namespace Asa\Erp;

/**
 * 商品查询表
 *
 * Class TbProductSearch
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $productname 商品名称
 * @property int|null $productid 商品id
 * @property int|null $sizetopid 尺码组id
 * @property int|null $brandid 品牌id
 * @property string|null $gender 性别
 * @property int|null $brandgroupid 品类id
 * @property int|null $childbrand 子品类id
 * @property int|null $number 库存数量
 * @property string|null $picture 主图
 * @property string|null $picture2 副图
 * @property string|null $color 颜色
 * @property string|null $color_group 同组颜色
 * @property int|null $companyid 公司id
 */
class TbProductSearch extends BaseCompanyModel
{
    // 属性修饰符暂时用public，防止其他模块不能调用
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
     * @var integer
     */
    public $productid;

    /**
     *
     * @var integer
     */
    public $sizetopid;

    /**
     *
     * @var integer
     */
    public $brandid;

    /**
     *
     * @var string
     */
    public $gender;

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
    public $number;

    /**
     *
     * @var string
     */
    public $picture;

    /**
     *
     * @var string
     */
    public $picture2;

    /**
     *
     * @var string
     */
    public $color;

    /**
     *
     * @var string
     */
    public $color_group;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field productname
     *
     * @param string $productname
     * @return $this
     */
    public function setProductname($productname)
    {
        $this->productname = $productname;

        return $this;
    }

    /**
     * Method to set the value of field productid
     *
     * @param integer $productid
     * @return $this
     */
    public function setProductid($productid)
    {
        $this->productid = $productid;

        return $this;
    }

    /**
     * Method to set the value of field sizetopid
     *
     * @param integer $sizetopid
     * @return $this
     */
    public function setSizetopid($sizetopid)
    {
        $this->sizetopid = $sizetopid;

        return $this;
    }

    /**
     * Method to set the value of field brandid
     *
     * @param integer $brandid
     * @return $this
     */
    public function setBrandid($brandid)
    {
        $this->brandid = $brandid;

        return $this;
    }

    /**
     * Method to set the value of field gender
     *
     * @param string $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Method to set the value of field brandgroupid
     *
     * @param integer $brandgroupid
     * @return $this
     */
    public function setBrandgroupid($brandgroupid)
    {
        $this->brandgroupid = $brandgroupid;

        return $this;
    }

    /**
     * Method to set the value of field childbrand
     *
     * @param integer $childbrand
     * @return $this
     */
    public function setChildbrand($childbrand)
    {
        $this->childbrand = $childbrand;

        return $this;
    }

    /**
     * Method to set the value of field number
     *
     * @param integer $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Method to set the value of field picture
     *
     * @param string $picture
     * @return $this
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Method to set the value of field picture2
     *
     * @param string $picture2
     * @return $this
     */
    public function setPicture2($picture2)
    {
        $this->picture2 = $picture2;

        return $this;
    }

    /**
     * Method to set the value of field color
     *
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Method to set the value of field color_group
     *
     * @param string $color_group
     * @return $this
     */
    public function setColorGroup($color_group)
    {
        $this->color_group = $color_group;

        return $this;
    }

    /**
     * Method to set the value of field companyid
     *
     * @param integer $companyid
     * @return $this
     */
    public function setCompanyid($companyid)
    {
        $this->companyid = $companyid;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field productname
     *
     * @return string
     */
    public function getProductname()
    {
        // 如果productname为空，就进行拼接显示
        if (!$this->productname) {
            // 多语言字段
            $name = $this->getDI()->get('obj')->getlangfield('name');
            // 品牌model
            $brandModel = $this->brand;
            // 商品model
            $productModel = $this->product;
            // 品牌名称
            $brandName = $brandModel->$name ?: $brandModel->name_en;
            // 性别
            $genderName = $this->getDI()->getShared('language')['list']['gender'][$this->getGender()];
            // 色系
            $brandcolorName = TbColortemplate::findFirst($productModel->brandcolor)->$name;
            // 商品描述
            $des = $productModel->memo;
            // 子类
            $childbrand = $this->brandgroupchild->$name;

            // 因为标题是拼接上的，可能变化比较频繁，所以我们规定，一旦有外部调用这个功能，就重新写入一遍标题，时刻保持最新
            $productName = $brandName . $genderName . $brandcolorName . $des . $childbrand;
            // 写入新标题
            $sql = sprintf("UPDATE tb_product_search SET productname = '%s'", $productName);
            $this->getDI()->getShared('db')->execute($sql);
            // 返回
            return $productName;
        }
        // 返回
        return $this->productname;
    }

    /**
     * Returns the value of field productid
     *
     * @return integer
     */
    public function getProductid()
    {
        return $this->productid;
    }

    /**
     * Returns the value of field sizetopid
     *
     * @return integer
     */
    public function getSizetopid()
    {
        return $this->sizetopid;
    }

    /**
     * Returns the value of field brandid
     *
     * @return integer
     */
    public function getBrandid()
    {
        return $this->brandid;
    }

    /**
     * Returns the value of field gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Returns the value of field brandgroupid
     *
     * @return integer
     */
    public function getBrandgroupid()
    {
        return $this->brandgroupid;
    }

    /**
     * Returns the value of field childbrand
     *
     * @return integer
     */
    public function getChildbrand()
    {
        return $this->childbrand;
    }

    /**
     * Returns the value of field number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Returns the value of field picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Returns the value of field picture2
     *
     * @return string
     */
    public function getPicture2()
    {
        return $this->picture2;
    }

    /**
     * Returns the value of field color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Returns the value of field color_group
     *
     * @return string
     */
    public function getColorGroup()
    {
        return $this->color_group;
    }

    /**
     * Returns the value of field companyid
     *
     * @return integer
     */
    public function getCompanyid()
    {
        return $this->companyid;
    }

    /**
     * 初始化
     */
    public function initialize()
    {
        $this->setSource('tb_product_search');

        // 查询表-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product',
            ]
        );

        // 查询表-品牌表，一对多反向
        $this->belongsTo(
            'brandid',
            '\Asa\Erp\TbBrand',
            'id',
            [
                'alias' => 'brand',
            ]
        );

        // 查询表-子品类表，一对多反向
        $this->belongsTo(
            'childbrand',
            '\Asa\Erp\TbBrandgroupchild',
            'id',
            [
                'alias' => 'brandgroupchild',
            ]
        );
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbProductSearch[]|TbProductSearch|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbProductSearch|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'productname' => 'productname',
            'productid' => 'productid',
            'sizetopid' => 'sizetopid',
            'brandid' => 'brandid',
            'gender' => 'gender',
            'brandgroupid' => 'brandgroupid',
            'childbrand' => 'childbrand',
            'number' => 'number',
            'picture' => 'picture',
            'picture2' => 'picture2',
            'color' => 'color',
            'color_group' => 'color_group',
            'companyid' => 'companyid',
        ];
    }
}
