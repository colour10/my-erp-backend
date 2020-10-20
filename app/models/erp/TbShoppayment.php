<?php

namespace Asa\Erp;

/**
 * ERP附带商城支付配置表
 *
 * Class TbShoppayment
 * @package Asa\Erp
 * @property int $id 主键ID
 * @property int|null $companyid 所属公司id
 * @property string|null $config 支付配置
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 * @property-read TbCompany|null $company 公司
 */
class TbShoppayment extends BaseModel
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
    protected $companyid;

    /**
     *
     * @var string
     */
    protected $config;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $updated_at;

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
     * Method to set the value of field config
     *
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = json_encode($config);

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field updated_at
     *
     * @param string $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

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
     * Returns the value of field companyid
     *
     * @return integer
     */
    public function getCompanyid()
    {
        return $this->companyid;
    }

    /**
     * Returns the value of field config
     *
     * @return array
     */
    public function getConfig()
    {
        return json_decode($this->config, true);
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("tb_shoppayment");

        // 支付配置表-公司表，一对一
        $this->belongsTo(
            'companyid',
            TbCompany::class,
            'id',
            [
                'alias' => 'company',
            ]
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tb_shoppayment';
    }

}
