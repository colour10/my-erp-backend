<?php

namespace Multiple\Shop\Controllers;

use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Db\Column;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model;

class AdminController extends Controller
{
    protected $modelName;
    protected $modelObject;

    function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

    function getModelName()
    {
        return $this->modelName;
    }

    function getModelObject()
    {
        if (!$this->modelObject) {
            $class             = new \ReflectionClass($this->getModelName());
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

    function getCondition()
    {
        $model       = $this->getModelObject();
        $metaData    = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes  = $metaData->getDataTypes($model);

        $array = [];

        foreach ($primaryKeys as $key) {
            if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER || $fieldTypes[$key] == Column::TYPE_MEDIUMINTEGER || $fieldTypes[$key] == Column::TYPE_SMALLINTEGER || $fieldTypes[$key] == Column::TYPE_TINYINTEGER) {
                $array[] = sprintf("%s=%d", $key, $this->request->get($key));
            } else if ($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR || $fieldTypes[$key] == Column::TYPE_ENUM) {
                $array[] = sprintf("%s='%s'", $key, addslashes($this->request->get($key)));
            }
        }

        return implode(' and ', $array);
    }

    public function indexAction()
    {
        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
        $result    = $findFirst->invokeArgs(null, []);

        $this->view->setVar("result", $result->toArray());
    }


    function editAction()
    {
        //print_r($this->dispatcher->getParams());exit;
        $this->doEdit();
    }

    function deleteAction()
    {
        $this->doDelete();
    }

    function addAction()
    {
        $this->doAdd();
    }

    function doAdd()
    {
        if ($this->request->isPost()) {
            // 获取模型
            $row = $this->getModelObject();

            $fields = $this->getAttributes();

            // 新增，把post过来的值重新赋值给$_POST，2019/3/21
            foreach ($this->request->get() as $key => $value) {
                $_POST[$key] = $value;
            }
            // 并清除冗余的_url键，2019/3/21
            if (array_key_exists('_url', $_POST)) {
                unset($_POST['_url']);
            }

            foreach ($fields as $name) {
                if (isset($_POST[$name])) {
                    $row->$name = $_POST[$name];
                }
            }

            $result = ["code" => 200, "messages" => []];
            if ($row->create() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    //echo 'Message: ', $message->getMessage();
                    //echo 'Field: ', $message->getField();
                    //echo 'Type: ', $message->getType();
                    $result["messages"][] = $message->getMessage();
                }
            }
            echo json_encode($result);
            $this->view->disable();
        }

    }

    function doEdit()
    {
        if ($this->request->isPost()) {
            $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
            $row       = $findFirst->invokeArgs(null, [$this->getCondition()]);

            if ($row != false) {
                $fields = $this->getAttributes();
                foreach ($fields as $name) {
                    if (isset($_POST[$name])) {
                        $row->$name = $_POST[$name];
                    }
                }

                $result = ["code" => 200, "messages" => []];
                if ($row->save() === false) {
                    $messages = $row->getMessages();

                    foreach ($messages as $message) {
                        $result["messages"][] = $message->getMessage();
                    }
                }
                echo json_encode($result);
                $this->view->disable();
            }
        } else {
            $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
            $info      = $findFirst->invokeArgs(null, [$this->getCondition()]);

            if ($info != false) {
                $this->view->setVar("info", $info);
            }
        }
    }

    function doDelete()
    {
        $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
        $row       = $findFirst->invokeArgs(null, [$this->getCondition()]);

        $result = ["code" => 200, "messages" => []];
        if ($row != false) {
            if ($row->delete() == false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            }
        }
        echo json_encode($result);
        $this->view->disable();
    }

    /**
     * 取出对应的语言字段名称
     * @param $fieldname
     * @return string
     */
    public function getlangfield($fieldname)
    {
        // 逻辑
        $lang = $this->language['lang'];
        // 返回
        return $fieldname . '_' . $lang;
    }

    /**
     * 返回正确的json信息
     * @param array $data 如果有数据返回，那么就填充数据
     * @param string $code 状态码，默认是200
     * @param array $messages 错误信息
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function success($data = [], $code = '200', array $messages = [])
    {
        // 逻辑
        return json_encode(['code' => $code, 'messages' => [], 'data' => $data]);
    }


    /**
     * 返回错误的json信息
     * @param string $code 状态码，默认是200
     * @param array $messages 如果有错误信息，这里必须填充
     * @return false|string
     */
    public function error($messages = [], $code = '200')
    {
        if ($messages instanceof Model === true) {
            $array = [];
            foreach ($messages->getMessages() as $message) {
                $array[] = $message->getMessage();
            }
        } else if (is_string($messages)) {
            $array = [$messages];
        } else {
            $array = $messages;
        }
        // 返回
        return json_encode(['code' => $code, 'messages' => $array]);
    }

    /**
     * 多语言版本配置读取函数
     * @param string $field_name 验证字段的提示名称，比如cn.php中上面的自定义变量名system_name
     * @param string $module_name 模块名称，比如cn.php中的template
     * @param string $module_rule 模块验证规则，比如cn.php中的template模块下面的uniqueness
     * @return string
     */
    public function getValidateMessage($field_name, $module_name = '', $module_rule = '')
    {
        // 逻辑
        // 定义变量
        // 取出当前语言版本
        $language = $this->getDI()->get('language');
        // 拼接变量
        // 判断是否需要取出模块部分来展示
        $human_name = $language->$field_name;
        if (!$module_name && !$module_rule) {
            return $human_name;
        }
        // 否则就展示模块和信息组合后的结果
        return sprintf($language->$module_name[$module_rule], $human_name);
    }

    /*
     * 为模板传递错误信息
     */
    public function renderError($title = 'make-an-error', $message = 'params-error')
    {
        // 逻辑
        // 传递错误，如果没有对应的语言字段，就显示当前传递的内容
        $this->view->setVars([
            'title'   => $this->getValidateMessage($title) ?: $title,
            'message' => $this->getValidateMessage($message) ?: $message,
        ]);
        return $this->view->pick('error/error');
    }

    /**
     * 注册模板
     * @param string $username 用户名
     * @param string $msg 友好提示
     * @param string $order_id 订单id
     * @return string
     */
    public function paySuccessOutputhtml($username, $msg, $order_id)
    {
        return <<<EOT
            <!Doctype html>
            <html lang="en">
            <head>
            <meta charset="UTF-8" />
            <title>{$this->getValidateMessage('notice-for-success-register')}</title>
            <style>
            a {
                display: block;
                height: 40px;
                line-height:40px;
                width: 90px;
				text-align: center;
                background: #33af7b;
                color: #ffffff;
                font-size: 14px;
                font-weight: bold;
                text-decoration: none !important;
                padding-top: 3px;
                margin-top:3px;
            }
            </style>
            </head>
            <body>
                {$this->getValidateMessage('dear')}{$username}：<br><br>
                {$msg}。<br><br>
                <a href="http://{$this->shop_host}/order/detail/{$order_id}" target="_blank">查看订单</a>
            </body>
        </html>
EOT;
    }

    /**
     * 页面初始化，压缩JS和CSS
     */
    public function onConstruct()
    {
        // 逻辑
        // 添加本地CSS资源
        $headerCollection = $this->assets->collection("header");
        $headerCollection->setTargetPath(APP_PATH . "/public/shop/assets/static/css/final.css")->setTargetUri("/shop/assets/static/css/final.css");
        $headerCollection
            ->addCss(APP_PATH . "/public/shop/assets/plugins/bootstrap/css/bootstrap.min.css")
            ->addCss(APP_PATH . "/public/shop/assets/pages/css/animate.css")
            ->addCss(APP_PATH . "/public/shop/assets/plugins/fancybox/source/jquery.fancybox.css")
            ->addCss(APP_PATH . "/public/shop/assets/plugins/owl.carousel/assets/owl.carousel.css")
            ->addCss(APP_PATH . "/public/shop/assets/pages/css/components.css")
            ->addCss(APP_PATH . "/public/shop/assets/pages/css/slider.css")
            ->addCss(APP_PATH . "/public/shop/assets/pages/css/style-shop.css")
            ->addCss(APP_PATH . "/public/shop/assets/corporate/css/style.css")
            ->addCss(APP_PATH . "/public/shop/assets/corporate/css/style-responsive.css")
            ->addCss(APP_PATH . "/public/shop/assets/corporate/css/themes/red.css")
            ->addCss(APP_PATH . "/public/shop/assets/static/css/bootstrap-submenu.css")
            ->addCss(APP_PATH . "/public/shop/assets/corporate/css/custom.css")
            ->join(true)
            // 使用内置的JsMin过滤器
            ->addFilter(
                new Cssmin()
            );


        // 本地JavaScript资源压缩并合并
        $footerCollection = $this->assets->collection("footer");
        $footerCollection->setTargetPath(APP_PATH . "/public/shop/assets/custom/final.js")->setTargetUri("/shop/assets/custom/final.js");
        $footerCollection
            ->addJs(APP_PATH . "/public/shop/assets/plugins/jquery.min.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/jquery-migrate.min.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/bootstrap/js/bootstrap.min.js")
            ->addJs(APP_PATH . "/public/shop/assets/corporate/scripts/back-to-top.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/fancybox/source/jquery.fancybox.pack.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/owl.carousel/owl.carousel.min.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/zoom/jquery.zoom.min.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/uniform/jquery.uniform.min.js")
            ->addJs(APP_PATH . "/public/shop/assets/plugins/rateit/src/jquery.rateit.js")
            ->addJs(APP_PATH . "/public/shop/assets/corporate/scripts/layout.js")
            ->addJs(APP_PATH . "/public/shop/assets/custom/bootstrap-submenu.js")
            ->join(true)
            // 使用内置的JsMin过滤器
            ->addFilter(
                new Jsmin()
            );
    }

}
