<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Model;

class BaseController extends Controller
{
    protected $default_language;
    protected $companyid;

    public function initialize()
    {
        //允许跨域请求
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        header('Access-Control-Allow-Methods: Get,Post,Put,OPTIONS');

        $auth = $this->auth;
        if($auth) {
            $this->companyid = (int)$auth["companyid"];
        }
    }

    function indexAction(){}

    /**
     * 返回正确的json信息
     * @param string $code 状态码，默认是200
     * @param array $data 如果有数据返回，那么就填充数据
     * @return false|string
     */
    public function success($data = [], $code = '200')
    {
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
        if($messages instanceof Model===true) {
            $array = [];
            foreach ($messages->getMessages() as $message) {
                $array[] = $message->getMessage();
            }
        }
        else if(is_string($messages)) {
            $array = [$messages];
        }
        else {
            $array = $messages;
        }

        return json_encode(['code' => $code, 'messages' => $array]);
    }


    /**
     * 返回输出的json信息
     * @return false|string
     */
    public function reportJson($data=[],$code=200, $messages=[])
    {
        $result = array(
            "code" => $code,
            "messages" => $messages
        );

        if(is_array($data)) {
            $result = array_merge($data, $result);
        }

        return json_encode($result);
    }


    /**
     * 多语言版本配置读取函数
     * @param $field_name 验证字段的提示名称，比如cn.php中上面的自定义变量名system_name
     * @param $module_name 模块名称，比如cn.php中的template
     * @param $module_rule 模块验证规则，比如cn.php中的template模块下面的uniqueness
     * @return string
     */
    public function getValidateMessage($field_name, $module_name='', $module_rule='')
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

    /**
     * 对单个模型的单个记录的修改、更新或者删除，并返回标准json输出
     * @param  [type] $callback 需要调用的方法
     * @return [type]           [description]
     */
    function doTableAction($model, $action) {
        if (call_user_func([$model, $action]) === false) {
            echo $this->error($model);
        }
        else {
            echo $this->success();
        }
    }

    function debug($message, $flag="") {
        print_r($message);
    }
}
