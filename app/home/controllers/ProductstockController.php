<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\Sql;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbProductstockSearch;
use Asa\Erp\TbProductstockSummary;
use Asa\Erp\Util;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

// 数组分页

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

    /**
     * 搜索
     */
    function searchAction()
    {
        $conditions = [
            sprintf("companyid=%d", $this->companyid),
        ];

        if (isset($_POST["wordcode"]) && trim($_POST["wordcode"]) != "") {
            $wordcode = preg_replace("#\s#msi", '', strtoupper($_POST["wordcode"]));
            $conditions[] = sprintf("wordcode like '%%%s%%'", addslashes($wordcode));
        }

        // 添加仓库
        if (isset($_POST["warehouseid"]) && $_POST["warehouseid"] > 0) {
            $conditions[] = sprintf("warehouseid=%d", $_POST["warehouseid"]);
        }

        $names = ['brandid', 'brandgroupid', 'childbrand', 'brandcolor', 'saletypeid', 'producttypeid', 'gender', 'property', 'defective_level'];
        foreach ($names as $name) {
            if (isset($_POST[$name]) && preg_match("#^\d+(,\d+)*$#", $_POST[$name])) {
                $conditions[] = Sql::isInclude($name, $_POST[$name]);
            }
        }

        // 添加仓库
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

        // // 以前的 type 判断，注释掉
        // if (isset($_POST['type'])) {
        //     if ($_POST['type'] == '1') {
        //         $conditions[] = "number>reserve_number";
        //     } elseif ($_POST['type'] == '2') {
        //         $conditions[] = "reserve_number>0";
        //     } else {
        //         $conditions[] = "number>0";
        //     }
        // } else {
        //     $conditions[] = "number>0";
        // }

        // 新库存状态判断 1-待售 2-预售 4-在途，增加在途的判断
        if (isset($_POST['type'])) {
            if ($_POST['type'] == '1') {
                // 待售：数量 > 预售，保持之前的逻辑，可能有争议
                $conditions[] = "number>reserve_number";
            } elseif ($_POST['type'] == '2') {
                // 预售：预售 > 0
                $conditions[] = "reserve_number>0";
            } elseif ($_POST['type'] == '4') {
                // 在途：在途 > 0
                $conditions[] = "shipping_number>0";
            } elseif ($_POST['type'] == '3') {
                // 待售+预售
                $conditions[] = "(number>reserve_number or reserve_number>0)";
            } elseif ($_POST['type'] == '5') {
                // 待售+在途
                $conditions[] = "(number>reserve_number or shipping_number>0)";
            } elseif ($_POST['type'] == '6') {
                // 预售+在途
                $conditions[] = "(reserve_number>0 or shipping_number>0)";
            } else {
                // 待售+预售+在途
                $conditions[] = "(number>reserve_number or reserve_number>0 or shipping_number>0)";
            }
        } else {
            $conditions[] = "number>0";
        }

        // 记录下sql，方便跟踪
        $sql = implode(" and ", $conditions);
        error_log('库存查询的sql为：' . $sql);

        // 需要在库存表中查找
        $result = TbProductstockSummary::find(
            $sql
        );

        // 然后按照 productid 汇总
        $return = Util::getGroupArray(
            $result->toArray(),
            'productid',
            [
                'companyid',
                'productid',
                'wordcode',
                'ageseason',
                'countries',
                'brandid',
                'brandgroupid',
                'childbrand',
                'brandcolor',
                'ulnarinch',
                'saletypeid',
                'producttypeid',
                'gender',
                'spring',
                'summer',
                'fall',
                'winter',
                'series',
                'number',
                'reserve_number',
                'sales_number',
                'shipping_number',
                'sizecontentid',
                'defective_level',
            ],
            [
                'number',
                'reserve_number',
                'sales_number',
                'shipping_number',
            ],
            [
                'sizecontentid',
                'defective_level',
            ],
            [
                ['name' => 'sizecontent_data', 'fields' => ['sizecontentid', 'number', 'reserve_number', 'sales_number', 'shipping_number'], 'connector' => ','],
            ]
        );

        // 需要处理为原来的格式
        // 把查询的结果按照productid分组
        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        // // 对象分页，原来的处理方法不用了
        // $paginator = new Model(
        //     [
        //         "data"  => $result,
        //         "limit" => $pageSize,
        //         "page"  => $page,
        //     ]
        // );

        // // Get the paginated results
        // $pageObject = $paginator->getPaginate();
        //
        // $data = [];
        // foreach ($pageObject->items as $row) {
        //     $data[] = $row->toArray();
        // }
        //
        // $pagination = [
        //     //"previous"      => $pageObject->previous,
        //     "current"    => $pageObject->current,
        //     "totalPages" => $pageObject->total_pages,
        //     //"next"          => $pageObject->next,
        //     "total"      => $pageObject->total_items,
        //     "pageSize"   => $pageSize,
        // ];
        //
        // echo $this->success(["data" => $data, "pagination" => $pagination]);

        // 创建分页对象，使用数组分页
        $paginator = new PaginatorArray(
            [
                "data"  => $return,
                "limit" => $pageSize,
                "page"  => $page,
            ]
        );

        // 展示分页
        $pageObject = $paginator->getPaginate();
        $pagination = [
            //"previous"      => $pageObject->previous,
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            //"next"          => $pageObject->next,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];
        // 返回
        echo $this->success(["data" => $return, "pagination" => $pagination]);
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
