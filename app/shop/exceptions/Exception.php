<?php

namespace Multiple\Shop\Exceptions;

use Phalcon\Http\Request;
use Phalcon\Mvc\View;

/**
 * 异常基类
 * Class Exception
 * @package Multiple\Shop\Exceptions
 */
abstract class Exception extends \Exception
{
    // 错误码
    protected $code;
    // 内部错误提示
    protected $message;
    // 给用户的提示信息
    protected $msgForUser;
    // 请求类
    protected $request;
    // 模板类
    protected $view;

    /**
     * 重写构造方法
     * Exception constructor.
     * @param string $message
     * @param int $code
     * @param string $msgForUser
     * @return mixed|void
     */
    public function __construct($message = '', $code = 200, $msgForUser = '系统错误')
    {
        $this->code = $code;
        $this->message = $message;
        $this->msgForUser = $msgForUser;
        $this->request = new Request();
        $this->view = new View();
        // 设置模板目录
        $this->view->setViewsDir('../app/shop/views/');
        // 如果是ajax或者post请求
        if ($this->request->isAjax() || $this->request->isPost()) {
            echo json_encode(['code' => $this->code, 'messages' => [$this->doAjax()]]);
            exit;
        } else {
            // 否则就是get请求，则调用模板
            $args = $this->doGet();
            $this->view->setVars([
                'title'   => $args[0],
                'message' => $args[1],
            ]);
            echo $this->view->getPartial('error/error');
            exit;
        }
        // 调用父类构造方法
        parent::__construct($message, $code);
    }

    /**
     * ajax请求处理逻辑，这个需要子类重写
     * @return mixed
     */
    protected function doAjax()
    {
        return '';
    }

    /**
     * get请求处理逻辑，这个需要子类重写
     * @return array
     */
    protected function doGet()
    {
        return [];
    }
}