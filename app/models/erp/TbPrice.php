<?php
namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * 价格定义表
 */
class TbPrice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price');
    }

    function toArrayPipe() {
        $country = TbCountry::fetchById($this->countryid);
        if($country==false) {
            throw new Exception("/1001/国家地区不存在/");
        }

        return [
            "id" => $this->id,
            "name"=>sprintf("%s-%s",$country['name_cn'], $this->getDI()->get("listReader")->get("pricetype", $this->pricetype))
        ];
    }

    function getPi() {
        return 3.14;
    }
}
