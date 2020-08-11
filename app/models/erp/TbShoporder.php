<?php

namespace Asa\Erp;

/**
 * 附带ERP商城订单详情表
 * Class TbShoporder
 * @package Asa\Erp
 */
class TbShoporder extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $product_id;

    /**
     *
     * @var integer
     */
    protected $order_commonid;

    /**
     *
     * @var string
     */
    protected $product_name;

    /**
     *
     * @var double
     */
    protected $price;

    /**
     *
     * @var integer
     */
    protected $number;

    /**
     *
     * @var double
     */
    protected $total_price;

    /**
     *
     * @var string
     */
    protected $picture;

    /**
     *
     * @var string
     */
    protected $picture2;

    /**
     *
     * @var string
     */
    protected $color_id;

    /**
     *
     * @var string
     */
    protected $color_name;

    /**
     *
     * @var integer
     */
    protected $size_id;

    /**
     *
     * @var string
     */
    protected $size_name;

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
     * Method to set the value of field product_id
     *
     * @param integer $product_id
     * @return $this
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Method to set the value of field order_commonid
     *
     * @param integer $order_commonid
     * @return $this
     */
    public function setOrderCommonid($order_commonid)
    {
        $this->order_commonid = $order_commonid;

        return $this;
    }

    /**
     * Method to set the value of field product_name
     *
     * @param string $product_name
     * @return $this
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param double $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

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
     * Method to set the value of field total_price
     *
     * @param double $total_price
     * @return $this
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;

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
     * Method to set the value of field color_id
     *
     * @param string $color_id
     * @return $this
     */
    public function setColorId($color_id)
    {
        $this->color_id = $color_id;

        return $this;
    }

    /**
     * Method to set the value of field color_name
     *
     * @param string $color_name
     * @return $this
     */
    public function setColorName($color_name)
    {
        $this->color_name = $color_name;

        return $this;
    }

    /**
     * Method to set the value of field size_id
     *
     * @param integer $size_id
     * @return $this
     */
    public function setSizeId($size_id)
    {
        $this->size_id = $size_id;

        return $this;
    }

    /**
     * Method to set the value of field size_name
     *
     * @param string $size_name
     * @return $this
     */
    public function setSizeName($size_name)
    {
        $this->size_name = $size_name;

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
     * Returns the value of field product_id
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Returns the value of field order_commonid
     *
     * @return integer
     */
    public function getOrderCommonid()
    {
        return $this->order_commonid;
    }

    /**
     * Returns the value of field product_name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
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
     * Returns the value of field total_price
     *
     * @return double
     */
    public function getTotalPrice()
    {
        return $this->total_price;
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
     * Returns the value of field color_id
     *
     * @return string
     */
    public function getColorId()
    {
        return $this->color_id;
    }

    /**
     * Returns the value of field color_name
     *
     * @return string
     */
    public function getColorName()
    {
        return $this->color_name;
    }

    /**
     * Returns the value of field size_id
     *
     * @return integer
     */
    public function getSizeId()
    {
        return $this->size_id;
    }

    /**
     * Returns the value of field size_name
     *
     * @return string
     */
    public function getSizeName()
    {
        return $this->size_name;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource("tb_shoporder");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tb_shoporder';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbShoporder[]|TbShoporder|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbShoporder|\Phalcon\Mvc\Model\ResultInterface
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
            'id'             => 'id',
            'product_id'     => 'product_id',
            'order_commonid' => 'order_commonid',
            'product_name'   => 'product_name',
            'price'          => 'price',
            'number'         => 'number',
            'total_price'    => 'total_price',
            'picture'        => 'picture',
            'picture2'       => 'picture2',
            'color_id'       => 'color_id',
            'color_name'     => 'color_name',
            'size_id'        => 'size_id',
            'size_name'      => 'size_name',
        ];
    }

}
