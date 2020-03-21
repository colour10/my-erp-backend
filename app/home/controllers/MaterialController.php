<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbMaterial;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

/**
 * 基础资料，材质表
 * Class MaterialController
 * @package Multiple\Home\Controllers
 */
class MaterialController extends ZadminController
{
    private $orderBy = 'code ASC';

    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbMaterial');
    }

    public function getSearchCondition()
    {
        $where = [];

        $keyword = filter_input(INPUT_POST, 'keyword');
        if ($keyword) {
            $where[] = sprintf("name_cn LIKE '%%%s%%' OR name_en LIKE '%%%s%%' OR name_it LIKE '%%%s%%'", addslashes(strtoupper($keyword)), addslashes(strtoupper($keyword)), addslashes(strtoupper($keyword)));
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

        $result = TbMaterial::find($params);

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
            $rowData['materialnotes'] = $row->getMaterialnotes();
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
     * 获取材质信息
     */
    public function infoAction()
    {
        $id = $this->request->getPost('id', 'int', 0);

        if (!$material = TbMaterial::findFirst("id=$id")) {
            return $this->renderError('make-an-error', 'material-doesnot-exist');
        }
        $result = $material->toArray();

        return $this->success($result);
    }

    /**
     * 保存材质备注
     */
    public function saveMaterialnoteidsAction()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $materialnoteids = filter_input(INPUT_POST, 'materialnoteids', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($id && $materialnoteids) {
            $material = TbMaterial::findFirstById($id);
            if (!$material) {
                return $this->renderError('make-an-error', 'material-doesnot-exist');
            }
            $material->materialnoteids = implode(',', $materialnoteids);

            $result = ["code" => 200, "messages" => []];
            if ($material->update() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            }

            echo json_encode($result);
        } else {
            return $this->success();
        }
    }
}
