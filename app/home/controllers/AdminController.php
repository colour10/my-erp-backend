<?php

namespace Multiple\Home\Controllers;

use Exception;
use Phalcon\Db\Column;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use ReflectionException;

/**
 * 后台控制器基类
 * Class AdminController
 * @package Multiple\Home\Controllers
 */
class AdminController extends BaseController
{
    protected $modelName;
    protected $modelObject;
    protected $list_key_column;
    protected $list_columns;
    protected $is_language = false;

    public function initialize()
    {
        parent::initialize();
    }

    function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

    function configList($key_column, $columns)
    {
        $this->list_key_column = $key_column;
        $this->list_columns = $columns;
    }

    function setLanguageFlag($boolValue)
    {
        $this->is_language = $boolValue;
    }

    function getModelName()
    {
        return $this->modelName;
    }

    function getModelObject()
    {
        if (!$this->modelObject) {
            $class = new \ReflectionClass($this->getModelName());
            $this->modelObject = $class->newInstance();
        }

        return $this->modelObject;
    }

    function getAttributes()
    {
        $model = $this->getModelObject();

        try {
            $metaData = $model->getModelsMetaData();
            return $metaData->getAttributes($model);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function getSearchCondition()
    {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = $model->getSearchBaseCondition();

        $keyword = $this->request->get("keyword", "trim");
        $keywords = [];
        foreach ($fieldTypes as $key => $value) {
            if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER) {

                if (isset($_REQUEST[$key]) && $_REQUEST[$key] !== "") {
                    $array[] = sprintf("%s=%d", $key, $_REQUEST[$key]);
                }
            } else { //($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR) {
                if (isset($_REQUEST[$key]) && $_REQUEST[$key] != "") {
                    $array[] = sprintf("%s='%s'", $key, addslashes($_REQUEST[$key]));
                }
                $keywords[] = sprintf("%s like '%%%s%%'", $key, addslashes($keyword));
            }
        }

        if ($keyword != "" && count($keywords) > 0) {
            $array[] = '(' . implode(" or ", $keywords) . ')';
        }

        return implode(' and ', $array);
    }

    function getCondition()
    {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = [];

        foreach ($primaryKeys as $key) {
            if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER) {
                $array[] = sprintf("%s=%d", $key, $this->request->get($key));
            } else {//if ($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR || $fieldTypes[$key] == Column::TYPE_ENUM) {
                $array[] = sprintf("%s='%s'", $key, addslashes($this->request->get($key)));
            }
        }

        return implode(' and ', $array);
    }

    public function indexAction()
    {
    }

    function pageAction()
    {
        $this->before_page();
        $params = [$this->getSearchCondition()];
        if (isset($_POST['__orderby'])) {
            $params['order'] = $_POST['__orderby'];
        }

        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
        $result = $findFirst->invokeArgs(null, [$params]);

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
            $data[] = $this->recordToArray($row);
        }

        $pageinfo = [
            //"previous"      => $pageObject->previous,
            "current"    => $pageObject->current,
            "totalPages" => $pageObject->total_pages,
            //"next"          => $pageObject->next,
            "total"      => $pageObject->total_items,
            "pageSize"   => $pageSize,
        ];
        echo $this->reportJson(["data" => $data, "pagination" => $pageinfo], 200, []);
    }

    function editAction()
    {
        $this->doEdit();
    }

    function deleteAction()
    {
        return $this->doDelete();
    }

    function addAction()
    {
        try {
            $this->doAdd();
        } catch (Exception $e) {
            echo $this->error($e->getMessage());
        }
    }

    /**
     * 增加
     */
    function doAdd()
    {
        if ($this->request->isPost()) {
            // 更新数据库
            $row = $this->getModelObject();

            $this->before_add();

            $fields = $this->getAttributes();

            foreach ($fields as $name) {
                if (isset($_POST[$name])) {
                    $row->$name = $_POST[$name];
                }
            }

            $result = ["code" => 200, "messages" => []];
            if ($row->create() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            } else {
                $result['is_add'] = "1";
                $result['id'] = $row->id;

                // 成功之后，这里可能会有后续的一些操作，暂时命名为 after_add 吧
                $this->after_add([
                    'post'   => $_POST,
                    'result' => $result,
                ]);
            }

            echo json_encode($result);
        }
    }

    /**
     * 修改
     */
    public function doEdit()
    {
        if ($this->request->isPost()) {
            $row = call_user_func_array("{$this->modelName}::findFirst", [$this->getCondition()]);
            if ($row != false) {
                $this->before_edit($row);

                $fields = $this->getAttributes();
                foreach ($fields as $name) {
                    if (isset($_POST[$name])) {
                        $row->$name = $_POST[$name];
                    }
                }

                $result = ["code" => 200, "messages" => []];
                if ($row->update() === false) {
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
    }

    /**
     * 删除
     * @return false|string
     * @throws ReflectionException
     */
    public function doDelete()
    {
        $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
        $row = $findFirst->invokeArgs(null, [$this->getCondition()]);

        $result = ["code" => 200, "messages" => []];
        if ($row != false) {
            try {
                $this->before_delete($row);

                if ($row->delete() == false) {
                    return $this->error($row);
                }
            } catch (Exception $e) {
                return $this->error($e->getMessage());
            }
        }
        return $this->success();
    }

    function before_edit($row)
    {

    }

    function before_add()
    {

    }

    function before_delete($row)
    {

    }

    function before_page()
    {

    }

    function recordToArray($row)
    {
        return $row->toArray();
    }

    function injectParam($name, $value, $method = 'POST')
    {
        $_REQUEST[$name] = $value;
        if ($method == 'POST') {
            $_POST[$name] = $value;
        } else {
            $_GET[$name] = $value;
        }
    }

    /**
     * 新增之后的后续操作
     *
     * @param $result
     */
    public function after_add($result)
    {

    }
}
