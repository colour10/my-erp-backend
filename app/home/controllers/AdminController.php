<?php

namespace Multiple\Home\Controllers;

use Exception;
use Phalcon\Db\Column;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use ReflectionException;
use ReflectionMethod;

/**
 * 后台控制器基类
 *
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

    /**
     * 通过反射获取对象的实例
     *
     * @return object
     * @throws ReflectionException
     */
    function getModelObject()
    {
        if (!$this->modelObject) {
            $class = new \ReflectionClass($this->getModelName());
            $this->modelObject = $class->newInstance();
        }

        return $this->modelObject;
    }

    /**
     * 获取动态属性
     *
     * @return mixed
     * @throws ReflectionException
     */
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

    /**
     * 获取搜索条件
     *
     * @return string
     * @throws ReflectionException
     */
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

    /**
     * 获得逻辑执行的条件
     *
     * @return string
     * @throws ReflectionException
     */
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

    /**
     * 分页, 这个几乎是90%以上功能的默认接口
     * 但是，这里传过来的 page 要经过计算，最大只能为实际分页的最大 page 值，否则超过最大值的话，数据将为空，体验很不好，用户还以为数据都被清空了呢
     *
     *
     * @throws ReflectionException
     */
    function pageAction()
    {
        $this->before_page();
        $params = [$this->getSearchCondition()];
        if (isset($_POST['__orderby'])) {
            $params['order'] = $_POST['__orderby'];
        }

        $findFirst = new ReflectionMethod($this->getModelName(), 'find');
        $result = $findFirst->invokeArgs(null, [$params]);

        // 当前页码
        $page = $this->request->getPost("page", "int", 1);
        // 每页显示条数
        $pageSize = $this->request->getPost("pageSize", "int", 20);
        // 数据条数
        $count = count($result->toArray());
        $page = $this->getPage($count, $pageSize, $page);

        // 分页方法
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

    /**
     * 取出实际的有效页码
     *
     * @param int $count 记录条数
     * @param int $currentPage 传过来的页码
     * @param int $pageSize 每页显示条数
     * @return float
     */
    function getPage($count, $pageSize, $currentPage = 1)
    {
        // 向上取整
        $maxPage = ceil($count / $pageSize);
        // 页码最小值为1
        // 页码如果超过最大值，那么就取最大值
        if ($currentPage < 1) {
            $currentPage = 1;
        } else if ($currentPage > $maxPage) {
            $currentPage = $maxPage;
        }
        // 返回
        return $currentPage;
    }

    /**
     * 编辑
     */
    function editAction()
    {
        $this->doEdit();
    }

    /**
     * 删除
     *
     * @return false|string
     * @throws ReflectionException
     */
    function deleteAction()
    {
        return $this->doDelete();
    }

    /**
     * 新增
     */
    function addAction()
    {
        try {
            $this->doAdd();
        } catch (Exception $e) {
            echo $this->error($e->getMessage());
        }
    }

    /**
     * 增加逻辑
     */
    function doAdd()
    {
        if ($this->request->isPost()) {
            // 新增逻辑
            // 防止有数据库本身的错误，这里使用 try-catch 捕捉
            try {
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

                // 返回信息
                echo json_encode($result);
                exit();
            } catch (Exception $e) {
                // 记录日志
                error_log("当前 doAdd 操作执行失败，原始错误为：" . $e->getMessage());
                error_log("当前 doAdd 操作用户提交的原始数据为：" . print_r($this->request->get(), true));
                // 返回错误
                echo $this->error($this->getValidateMessage('data', 'db', 'add-failed'));
                exit();
            }
        }
    }

    /**
     * 修改逻辑
     */
    public function doEdit()
    {
        if ($this->request->isPost()) {
            // 更新逻辑
            // 防止有数据库本身的错误，这里使用 try-catch 捕捉
            try {
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
            } catch (Exception $e) {
                // 记录日志
                error_log("当前 doEdit 操作执行失败，原始错误为：" . $e->getMessage());
                error_log("当前 doEdit 操作用户提交的原始数据为：" . print_r($this->request->get(), true));
                // 返回错误
                echo $this->error($this->getValidateMessage('data', 'db', 'edit-failed'));
                exit();
            }
        }
    }

    /**
     * 删除逻辑
     *
     * @return false|string
     */
    public function doDelete()
    {
        // 删除逻辑
        // 防止有数据库本身的错误，这里使用 try-catch 捕捉
        try {
            $findFirst = new ReflectionMethod($this->getModelName(), 'findFirst');
            $row = $findFirst->invokeArgs(null, [$this->getCondition()]);

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
            // 返回真
            return $this->success();
        } catch (Exception $e) {
            // 记录日志
            error_log("当前 doDelete 操作执行失败，原始错误为：" . $e->getMessage());
            error_log("当前 doDelete 操作用户提交的原始数据为：" . print_r($this->request->get(), true));
            // 返回错误
            echo $this->error($this->getValidateMessage('data', 'db', 'delete-failed'));
            exit();
        }
    }

    /**
     * 编辑前的钩子
     *
     * @param $row
     */
    function before_edit($row)
    {

    }

    /**
     * 新增前的钩子
     */
    function before_add()
    {

    }

    function before_delete($row)
    {

    }

    /**
     * 分页前的钩子
     */
    function before_page()
    {

    }

    /**
     * 对象转数组
     *
     * @param $row
     * @return mixed
     */
    function recordToArray($row)
    {
        return $row->toArray();
    }

    /**
     * 选择是 post 还是 get 的判断封装方法
     *
     * @param $name
     * @param $value
     * @param string $method
     */
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
