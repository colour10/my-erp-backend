<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\ResultInterface;
use Phalcon\Mvc\Model\ResultSetInterface;

/**
 * 超级管理员表
 * Class TbManager
 * @package Asa\Erp
 */
class TbManager extends BaseCompanyModel
{
    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $login_name;

    /**
     *
     * @var string
     */
    protected $password;

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
     * Method to set the value of field login_name
     *
     * @param string $login_name
     * @return $this
     */
    public function setLoginName($login_name)
    {
        $this->login_name = $login_name;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Returns the value of field login_name
     *
     * @return string
     */
    public function getLoginName()
    {
        return $this->login_name;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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

    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_manager');
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbManager[]|TbManager|ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TbManager|ResultInterface
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
            'id'         => 'id',
            'login_name' => 'login_name',
            'password'   => 'password',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
        ];
    }
}
