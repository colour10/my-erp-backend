<?php

namespace Asa\Erp;

/**
 * 会员相关，地址信息表
 */
class TbMemberAddress extends BaseModel
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
    protected $member_id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $idno;

    /**
     *
     * @var string
     */
    protected $tel;

    /**
     *
     * @var string
     */
    protected $zipcode;

    /**
     *
     * @var string
     */
    protected $address;

    /**
     *
     * @var string
     */
    protected $province;

    /**
     *
     * @var string
     */
    protected $city;

    /**
     *
     * @var string
     */
    protected $is_default;

    /**
     *
     * @var string
     */
    protected $last_used_at;

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
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field idno
     *
     * @param string $idno
     * @return $this
     */
    public function setIdno($idno)
    {
        $this->idno = $idno;

        return $this;
    }

    /**
     * Method to set the value of field tel
     *
     * @param string $tel
     * @return $this
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Method to set the value of field zipcode
     *
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Method to set the value of field address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Method to set the value of field province
     *
     * @param string $province
     * @return $this
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Method to set the value of field city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Method to set the value of field is_default
     *
     * @param string $is_default
     * @return $this
     */
    public function setIsDefault($is_default)
    {
        $this->is_default = $is_default;

        return $this;
    }

    /**
     * Method to set the value of field last_used_at
     *
     * @param string $last_used_at
     * @return $this
     */
    public function setLastUsedAt($last_used_at)
    {
        $this->last_used_at = $last_used_at;

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
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field idno
     *
     * @return string
     */
    public function getIdno()
    {
        return $this->idno;
    }

    /**
     * Returns the value of field tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Returns the value of field zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Returns the value of field address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Returns the value of field province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Returns the value of field city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the value of field is_default
     *
     * @return string
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Returns the value of field last_used_at
     *
     * @return string
     */
    public function getLastUsedAt()
    {
        return $this->last_used_at;
    }

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_member_address');

        // 会员地址表-会员表，一对多反向
        $this->belongsTo(
            'member_id',
            '\Asa\Erp\TbMember',
            'id',
            [
                'alias' => 'member',
            ]
        );
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbMemberAddress[]|TbMemberAddress|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbMemberAddress|\Phalcon\Mvc\Model\ResultInterface
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
            'member_id' => 'member_id',
            'name' => 'name',
            'idno' => 'idno',
            'tel' => 'tel',
            'zipcode' => 'zipcode',
            'address' => 'address',
            'province' => 'province',
            'city' => 'city',
            'is_default' => 'is_default',
            'last_used_at' => 'last_used_at',
        ];
    }

    /**
     * 取出完整的收货地址
     * @return string
     */
    public function getFullAddress()
    {
        // 逻辑
        return "{$this->province}{$this->city}{$this->address}";
    }
}
