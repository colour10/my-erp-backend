<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbProduct;

/**
 * 库存表
 */
class ProductstockController extends BaseController {
    public function initialize() {
        parent::initialize();
    }

    function searchAction() {
        $productids = $this->getProductIds();
        $conditions = [
            sprintf("companyid=%d", $this->companyid)
        ];

        if($productids!==false) {
            if($productids=='') {
                return $this->success([]);
            }
            $conditions[] = sprintf("productid in (%s)", $productids);
        }

        if(isset($_POST["productid"]) && $_POST["productid"]>0) {
            $conditions[] = sprintf("productid=%d", $_POST["productid"]);
        }

        if(isset($_POST["sizecontentid"]) && $_POST["sizecontentid"]>0) {
            $conditions[] = sprintf("sizecontentid=%d", $_POST["sizecontentid"]);
        }

        if(isset($_POST["warehouseid"]) && $_POST["warehouseid"]>0) {
            $conditions[] = sprintf("warehouseid=%d", $_POST["warehouseid"]);
        }

        $conditions[] = "number>0";
        $result = TbProductstock::find(
            implode(" and ", $conditions)
        );
        echo $this->success($result->toArray());
    }

    function getProductIds() {
        $where = [sprintf("companyid=%d", $this->companyid)];

        if(isset($_POST["wordcode"]) && trim($_POST["wordcode"])!="") {
            $wordcode = preg_replace("#\s#msi", '', strtoupper($_POST["wordcode"]));
            $where[] = sprintf("wordcode like '%%%s%%'", addslashes($wordcode));
        }

        $names = ['brandid', 'brandgroupid', 'childbrand', 'brandcolor', 'saletypeid', 'producttypeid','gender'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isInclude($name, $_POST[$name]);
            }
        }

        $names = ['ulnarinch', 'productsize', 'countries', 'ageseason', 'productparst', 'series', 'productmemoids'];
        foreach ($names as $name) {
            if(isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $where[] = \Asa\Erp\Sql::isMatch($name, $_POST[$name]);
            }
        }

        if(isset($_POST["season"]) && preg_match("#^\d+(,\d+)*$#", $_POST["season"])) {
            $columns = [
                "1" => "spring",
                "2" => "summer",
                "3" => "fall",
                "4" => "winter"
            ];
            $array = explode(',', $_POST["season"]);
            foreach($array as $value) {
                $where[] = sprintf("%s=1", $columns[$value]);
            }
        }

        if(count($where)>0) {
            $result = TbProduct::find([
                implode(" and ", $where),
                "column" => "id"
            ]);

            $array = [];
            foreach($result as $row) {
                $array[] = $row->id;
            }

            return implode(',', $array);
        }
        else {
            return false;
        }
    }
}
