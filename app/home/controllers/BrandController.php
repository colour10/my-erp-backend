<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandSize;
use Asa\Erp\TbCountry;
use Asa\Erp\TbProduct;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

/**
 * 品牌表控制器
 * Class BrandController
 * @package Multiple\Home\Controllers
 */
class BrandController extends ZadminController
{
    private $orderBy = 'name_en ASC';

    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\Erp\TbBrand');
    }

    public function getSearchCondition()
    {
        $where = [];

        $name_en = filter_input(INPUT_POST, 'name_en');
        if ($name_en) {
            $where[] = sprintf("name_en like '%%%s%%'", addslashes(strtoupper($name_en)));
        }

        $countryid = filter_input(INPUT_POST, 'countryid', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($countryid) {
            $countryid = implode(',', $countryid);
            $where[] = \Asa\Erp\Sql::isMatch('countryid', $countryid);
        }

        return implode(' and ', $where);
    }

    public function before_page()
    {
        $sort = filter_input(INPUT_POST, 'sort');
        $order = filter_input(INPUT_POST, 'order');
        if ($sort && $order) {
            switch ($order) {
                case 'ascending':
                    $orderMethod = ' asc';
                    break;
                case 'descending':
                    $orderMethod = ' desc';
                    break;
                default:
                    $orderMethod = ' asc';
                    break;
            }

            $this->orderBy = $sort . $orderMethod;
        }
    }

    public function pageAction()
    {
        $this->before_page();
        $params = [$this->getSearchCondition()];
        $params['order'] = $this->orderBy;

        $result = TbBrand::find($params);

        $page = $this->request->getPost("page", "int", 1);
        $pageSize = $this->request->getPost("pageSize", "int", 20);

        $paginator = new PaginatorModel(
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
            $rowData = $this->recordToArray($row);
            $rowData['country'] = $row->getCountry();
            $data[] = $rowData;
        }

        $pageinfo = [
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];
        echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
    }

    /**
     * 获取品牌信息
     */
    public function infoAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$brand = TbBrand::findFirst("id=$id")) {
            return $this->renderError('make-an-error', 'brand-doesnot-exist');
        }
        $result = $brand->toArray();

        return $this->success($result);
    }

    /**
     * 获取品牌归属的国家集合
     */
    public function countriesAction()
    {
        $sql = sprintf("SELECT distinct countryid FROM tb_brand");
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $countryIds = [];
        foreach ($rows as $row) {
            $countryIds[] = $row['countryid'];
        }
        $countryIds = implode(',', $countryIds);
        $countries = TbCountry::find([
            sprintf("id IN (%s)", $countryIds),
            "order" => "name_en asc",
        ]);

        $lang = $this->getDI()->get("session")->get("language");
        $result = [];
        foreach ($countries as $country) {
            if ($lang != 'en') {
                $title = $country->name_en . ' / ' . $country->{'name_' . $lang};
            } else {
                $title = $country->name_en;
            }
            $result[] = [
                'id'    => (int)$country->id,
                'title' => $title,
            ];
        }

        return $this->success($result);
    }

    /**
     * 更新品牌国际码规则
     */
    public function updateWorldcodeSettingAction()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $setting = filter_input(INPUT_POST, 'setting', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $brand = TbBrand::findFirstById($id);
        if ($brand) {
            $brand->worldcode1 = $setting['worldcode1']['action'] . ',' . $setting['worldcode1']['length'];
            $brand->worldcode2 = $setting['worldcode2']['action'] . ',' . $setting['worldcode2']['length'];
            $brand->worldcode3 = $setting['worldcode3']['action'] . ',' . $setting['worldcode3']['length'];

            $result = ["code" => 200, "messages" => []];
            if ($brand->update() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            }

            echo json_encode($result);
        } else {
            $result = ["code" => 200, "messages" => ["数据不存在"]];
            echo json_encode($result);
            exit;
        }
    }

    /**
     * 获取品牌国际码长度设置
     */
    public function worldcodeSettingAction()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $brand = TbBrand::findFirstById($id);
        $worldcode1 = (strpos($brand->worldcode1, ',') === false) ? false : explode(',', $brand->worldcode1);
        $worldcode2 = (strpos($brand->worldcode2, ',') === false) ? false : explode(',', $brand->worldcode2);
        $worldcode3 = (strpos($brand->worldcode3, ',') === false) ? false : explode(',', $brand->worldcode3);

        $setting = [];
        if ($worldcode1) {
            $action = isset($worldcode1[0]) ? $worldcode1[0] : '';
            $length = isset($worldcode1[1]) ? $worldcode1[1] : '';
            $setting['worldcode1'] = [
                'length' => $length,
                'action' => $action,
            ];
        } else {
            $setting['worldcode1'] = [
                'length' => '',
                'action' => '',
            ];
        }

        if ($worldcode2) {
            $action = isset($worldcode2[0]) ? $worldcode2[0] : '';
            $length = isset($worldcode2[1]) ? $worldcode2[1] : '';
            $setting['worldcode2'] = [
                'length' => $length,
                'action' => $action,
            ];
        } else {
            $setting['worldcode2'] = [
                'length' => '',
                'action' => '',
            ];
        }

        if ($worldcode3) {
            $action = isset($worldcode3[0]) ? $worldcode3[0] : '';
            $length = isset($worldcode3[1]) ? $worldcode3[1] : '';
            $setting['worldcode3'] = [
                'length' => $length,
                'action' => $action,
            ];
        } else {
            $setting['worldcode3'] = [
                'length' => '',
                'action' => '',
            ];
        }

        return $this->success($setting);
    }

    public function sizesAction()
    {
        $brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
        $result = [];
        $rows = TbBrandSize::find("brand_id = " . $brand_id);
        foreach ($rows as $row) {
            $rowData = [];

            $rowData['id'] = $row->id;
            $rowData['brandgroup'] = $row->getBrandgroup();
            $rowData['brandgroupchild'] = $row->getBrandgroupchild();
            $rowData['gender'] = $row->getGender();
            $rowData['sizetop'] = $row->getSizetop();

            $result[] = $rowData;
        }
        return $this->success($result);
    }

    public function addSizeAction()
    {
        if ($this->request->isPost()) {
            $brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
            $brandgroup_id = filter_input(INPUT_POST, 'brandgroup_id', FILTER_VALIDATE_INT);
            $brandgroupchild_id = filter_input(INPUT_POST, 'brandgroupchild_id', FILTER_VALIDATE_INT);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
            $sizetop_id = filter_input(INPUT_POST, 'sizetop_id', FILTER_VALIDATE_INT);

            $model = new TbBrandSize;
            $model->brand_id = $brand_id;
            $model->brandgroup_id = $brandgroup_id;
            $model->brandgroupchild_id = $brandgroupchild_id;
            $model->gender = $gender;
            $model->sizetop_id = $sizetop_id;

            $result = ["code" => 200, "messages" => []];
            if ($model->create() === false) {
                $messages = $model->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            } else {
                $result['is_add'] = "1";
                $result['id'] = $model->id;
            }

            echo json_encode($result);
        }
    }

    public function sizeInfoAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$brandSize = TbBrandSize::findFirst("id=$id")) {
            return $this->renderError('make-an-error', 'brand-size-doesnot-exist');
        }
        $result = $brandSize->toArray();

        return $this->success($result);
    }

    /**
     * 颜色码对应的颜色名称
     *
     * @return false|string
     */
    public function getSuggestColorNameAction()
    {
        $brandid = filter_input(INPUT_POST, 'brandid', FILTER_VALIDATE_INT);
        if ($brandid) {
            $builder = $this->modelsManager->createBuilder();
            $builder->from([TbProduct::class])
                ->columns("wordcode_3, colorname, COUNT(*) AS total")
                ->where("brandid = {$brandid}")
                ->orderBy("total DESC");
            $query = $builder->getQuery();
            $result = $query->execute()->toArray();
            return $this->success($result);
        } else {
            return $this->success();
        }
    }
}
