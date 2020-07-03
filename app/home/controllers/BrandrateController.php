<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBrandRate;
use Exception;

/**
 * 品牌倍率表
 * Class BrandrateController
 * @package Multiple\Home\Controllers
 */
class BrandrateController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBrandRate');
    }

    function getrateAction()
    {
        $rate = TbBrandRate::findFirst(
            sprintf("brandid=%d and ageseasonid=%d and brandgroupid=%d", $_POST['brandid'], $_POST['ageseason'], $_POST['brandgroupid'])
        );

        if ($rate != false) {
            return $this->success($rate->rate);
        } else {
            return $this->success("");
        }
    }

    /**
     * 新增逻辑
     *
     * @return false|string|void
     * @throws Exception
     */
    function addAction()
    {
        // 提交逻辑
        $this->db->begin();
        // 防止出现其他的一些未知错误，使用 try-catch 来捕捉更为稳妥
        try {
            $array = explode(",", $_POST['brandgroupid']);
            foreach ($array as $brandgroupid) {
                $obj = new TbBrandRate();
                $obj->brandid = $_POST['brandid'];
                $obj->ageseasonid = $_POST['ageseasonid'];
                $obj->rate = $_POST['rate'];
                $obj->modifystaff = $this->currentUser;
                $obj->modifytime = date("Y-m-d H:i:s");
                $obj->brandgroupid = $brandgroupid;

                if ($obj->create() == false) {
                    $this->db->rollback();
                    throw new Exception("/1002/添加品牌倍率失败/");
                }
            }
            $this->db->commit();
            return $this->success();
        } catch (Exception $e) {
            // 记录错误日志
            error_log('添加出错了，具体错误为：' . print_r($e->getMessage(), true));
            $this->db->rollback();
            throw new Exception($this->getValidateMessage('data-exists'));
        }
    }

    function before_page()
    {
        $this->injectParam('__orderby', "ageseasonid desc");
    }

    /**
     * 更新之前先定义好 修改人 + 修改时间，但是这两个字段数据库中没有，需要先建立字段才行
     *
     * @param $row
     */
    function before_edit($row)
    {
        $_POST["modifytime"] = date("Y-m-d H:i:s");
        $_POST["modifystaff"] = $this->currentUser;
    }
}
