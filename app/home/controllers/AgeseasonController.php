<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBrandRate;
use Asa\Erp\TbPriceSetting;
use Asa\Erp\Util;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbAgeseason;

/**
 * 年代表
 */
class AgeseasonController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbAgeseason');
        //$this->configList("fullname", [ "name","sessionmark" ]);
    }

    function beforeOutputListLoop($row)
    {
        return [
            "fullname" => sprintf("%s%s", $row->sessionmark, $row->name),
        ];
    }

    function before_page()
    {
        $_POST["__orderby"] = "name desc,sessionmark asc";
    }

    /**
     * 重写doadd方法
     */
    function doAdd()
    {
        // post提交成功之后再增加一个连续操作
        if ($this->request->isPost()) {
            //更新数据库
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
                //$message['idd'] = "999";

                // 新增连表操作
                // 如果更新成功，则开始复制记录，去tb_price_setting和tb_brand_rate表中查询是否含有当前年代季节的记录
                // 首先获取上一个年代季节的节点
                $prev_ageseasonid = TbAgeseason::getPrevAgeseason($this->request->get('sessionmark'), $this->request->get('name'));
                // 采用事务处理
                $this->db->begin();
                // 更新tb_price_setting表
                $tbPriceSettings = TbPriceSetting::find("ageseasonid = " . $prev_ageseasonid);
                if (count($tbPriceSettings) > 0) {
                    foreach ($tbPriceSettings->toArray() as $tbPriceSetting) {
                        $model = new TbPriceSetting();
                        // 新纪录的ageseasonid重写
                        $tbPriceSetting['ageseasonid'] = $result['id'];
                        unset($tbPriceSetting['id']);
                        if (!$model->save($tbPriceSetting)) {
                            $this->db->rollback();
                            echo $this->error($model);
                            exit;
                        }
                    }
                }

                // 更新tb_brand_rate表
                $tbBrandRates = TbBrandRate::find("ageseasonid = " . $prev_ageseasonid);
                if (count($tbBrandRates) > 0) {
                    foreach ($tbBrandRates->toArray() as $tbBrandRate) {
                        $model = new TbBrandRate();
                        // 新纪录的ageseasonid重写
                        $tbBrandRate['ageseasonid'] = $result['id'];
                        unset($tbBrandRate['id']);
                        if (!$model->save($tbBrandRate)) {
                            $this->db->rollback();
                            echo $this->error($model);
                            exit;
                        }
                    }
                }

                // 如果没有错误，则提交
                $this->db->commit();
            }
            // 返回
            echo json_encode($result);
        }
    }
}
