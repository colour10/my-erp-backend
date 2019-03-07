<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbDepartment;
use Asa\Erp\TbUser;
use Phalcon\Mvc\Controller;
use Phalcon\Db\Column;
use  Phalcon\Mvc\Model\Message;

class AdminController extends BaseController
{
    protected $modelName;
    protected $modelObject;
    protected $list_key_column;
    protected $list_columns;


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

    function getCondition()
    {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = array();

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
        $result = $findFirst->invokeArgs(null, array("sys_delete_flag=0"));

        $this->view->setVar("result", $result->toArray());
    }

    public function listAction()
    {
        $this->doList();
    }

    public function doList($columns = array())
    {
        if ($this->request->isAjax()) {
            $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
            $result = $findFirst->invokeArgs(null, array());

            if ($this->list_key_column != "" && count($this->list_columns) > 0) {
                $column_name = $this->list_key_column;
                $list = array();
                foreach ($result as $row) {
                    $line = array();

                    foreach ($this->list_columns as $name) {
                        $line[$name] = $row->$name;
                    }
                    $list[$row->$column_name] = $line;
                }

                echo json_encode($list);
            } else {
                echo json_encode($result->toArray());
            }
        }
        $this->view->disable();
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
            //�������ݿ�
            $row = $this->getModelObject();

            $fields = $this->getAttributes();
            foreach ($fields as $name) {
                if (isset($_POST[$name])) {
                    $row->$name = $_POST[$name];
                }
            }

            $result = array("code" => 200, "messages" => array());
            if ($row->create() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            } else {
                $result['is_add'] = "1";
                $result['id'] = $row->id;
                //$message['idd'] = "999";
            }
            echo json_encode($result);
            $this->view->disable();
        }

    }

    function doEdit()
    {
        if ($this->request->isPost()) {
            //�������ݿ�
            $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
            $row = $findFirst->invokeArgs(null, array($this->getCondition()));

            if ($row != false) {
                $fields = $this->getAttributes();
                foreach ($fields as $name) {
                    if (isset($_POST[$name])) {
                        $row->$name = $_POST[$name];
                    }
                }

                $result = array("code" => 200, "messages" => array());
                if ($row->save() === false) {
                    $messages = $row->getMessages();

                    foreach ($messages as $message) {
                        $result["messages"][] = $message->getMessage();
                    }
                }
                echo json_encode($result);
            } else {
                $result = array("code" => 200, "messages" => array("���ݲ�����"));

                echo json_encode($result);
                exit;
            }
            $this->view->disable();
        } else {
            //�����ݿ��в������ݣ�����ģ��
            $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
            $info = $findFirst->invokeArgs(null, array($this->getCondition()));

            if ($info != false) {
                $this->view->setVar("info", $info);
            }
        }
    }

    function doDelete()
    {
        $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
        $row = $findFirst->invokeArgs(null, array($this->getCondition()));

        $result = array("code" => 200, "messages" => array());
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
     * 取出公司内部部门目录树
     * @return false|string
     */
    public function departmentsAction()
    {
        // 判断是否登录
        if (!$this->session->get('user')) {
            return $this->error(['login is required']);
        }

        // 取出用户相关数据
        $user_id = $this->session->get('user')['id'];
        $user = TbUser::findFirst(['id' => $user_id, 'sys_delete_flag' => '0']);
        if (!$user) {
            return $this->error(['user is not exist']);
        }

        // 取出公司下面的所有部门
        $departments = TbDepartment::find([
            'companyid' => $user->companyid,
            'sys_delete_flag' => '0',
        ]);
        if (!$departments) {
            return $this->error(['departments are not exist']);
        }

        // 交给下面的格式化为目录树处理并返回
        return json_encode($this->format_tree($departments->toArray()));
    }


}
