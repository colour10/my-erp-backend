<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\Sql;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbProductstockSearch;
use Asa\Erp\TbProductstockSummary;
use Phalcon\Paginator\Adapter\Model;

/**
 * 库存表
 * Class ProductstockController
 * @package Multiple\Home\Controllers
 */
class ProductstockController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }

    function searchAction()
    {
        $conditions = [
            sprintf("companyid=%d", $this->companyid),
        ];

        if (isset($_POST["wordcode"]) && trim($_POST["wordcode"]) != "") {
            $wordcode = preg_replace("#\s#msi", '', strtoupper($_POST["wordcode"]));
            $conditions[] = sprintf("wordcode like '%%%s%%'", addslashes($wordcode));
        }

        $names = ['brandid', 'brandgroupid', 'childbrand', 'brandcolor', 'saletypeid', 'producttypeid', 'gender', 'property', 'defective_level'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $conditions[] = Sql::isInclude($name, $_POST[$name]);
            }
        }

        $names = ['ulnarinch', 'productsize', 'countries', 'ageseason', 'productparst', 'series', 'productmemoids'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $conditions[] = Sql::isMatch($name, $_POST[$name]);
            }
        }

        if (isset($_POST["season"]) && preg_match("#^\d+(,\d+)*$#", $_POST["season"])) {
            $columns = [
                "1" => "spring",
                "2" => "summer",
                "3" => "fall",
                "4" => "winter",
            ];
            $array = explode(',', $_POST["season"]);
            foreach ($array as $value) {
                $conditions[] = sprintf("%s=1", $columns[$value]);
            }
        }

        if (isset($_POST['type'])) {
            if ($_POST['type'] == '1') {
                $conditions[] = "number>reserve_number";
            } elseif ($_POST['type'] == '2') {
                $conditions[] = "reserve_number>0";
            } else {
                $conditions[] = "number>0";
            }
        } else {
            $conditions[] = "number>0";
        }

        $result = TbProductstockSummary::find(
            implode(" and ", $conditions)
        );

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new Model(
            [
                "data"  => $result,
                "limit" => $pageSize,
                "page"  => $page,
            ]
        );

        // Get the paginated results
        $pageObject = $paginator->getPaginate();

        $data = [];
        foreach ($pageObject->items as $row) {
            $data[] = $row->toArray();
        }

        $pagination = [
            //"previous"      => $pageObject->previous,
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            //"next"          => $pageObject->next,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];

        echo $this->success(["data" => $data, "pagination" => $pagination]);
    }

    function searchstockAction()
    {
        $conditions = [
            sprintf("companyid=%d", $this->companyid),
        ];

        if (isset($_POST["productid"]) && $_POST["productid"] > 0) {
            $conditions[] = sprintf("productid=%d", $_POST["productid"]);
        }

        if (isset($_POST["sizecontentid"]) && $_POST["sizecontentid"] > 0) {
            $conditions[] = sprintf("sizecontentid=%d", $_POST["sizecontentid"]);
        }

        if (isset($_POST["warehouseid"]) && $_POST["warehouseid"] > 0) {
            $conditions[] = sprintf("warehouseid=%d", $_POST["warehouseid"]);
        }

        $conditions[] = "number>0";
        $result = TbProductstock::find(
            implode(" and ", $conditions)
        );
        echo $this->success($result->toArray());
    }

    function searchproductAction()
    {
        $conditions = [
            sprintf("companyid=%d", $this->companyid),
        ];

        $conditions[] = sprintf("productid=%d", $_POST["productid"]);
        $conditions[] = sprintf("property=%d", $_POST["property"]);
        $conditions[] = sprintf("defective_level=%d", $_POST["defective_level"]);
        $conditions[] = "number>0";

        $result = TbProductstockSearch::find(
            implode(" and ", $conditions)
        );
        echo $this->success($result->toArray());
    }
}
