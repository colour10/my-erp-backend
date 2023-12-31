<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbPriceSetting;

/**
 *
 */
class PricesettingController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbPriceSetting');
    }

    function before_page()
    {
        $_POST['companyid'] = $this->companyid;
        $_POST["__orderby"] = "priceid desc,sort_value asc";
    }

    /**
     * 格式化排序字段
     * @return [type] [description]
     */
    private function getSortValue()
    {
        $brandid = $this->request->getPost("brandid", "int", 0);
        $brandgroupid = $this->request->getPost("brandgroupid", "int", 0);
        $brandgroupchildid = $this->request->getPost("brandgroupchildid", "int", 0);
        $ageseasonid = $this->request->getPost("ageseasonid", "int", 0);
        $seriesid = $this->request->getPost("seriesid", "int", 0);
        return sprintf("%012d%012d%012d%012d%012d", $brandid, $brandgroupid, $brandgroupchildid, $ageseasonid, $seriesid);
    }

    /**
     * 取出列表
     *
     * @return false|string
     */
    function loadAction()
    {
        $result = TbPriceSetting::find([
            sprintf("companyid=%d and (brandid=%d or brandid=0) and (ageseasonid=%d or ageseasonid=0) and discount>0", $this->companyid, $_POST['brandid'], $_POST['ageseasonid']),
            "order" => "brandgroupchildid asc,producttypeid asc",
        ]);
        return $this->success($result->toArray());
    }

    /**
     * 添加或修改价格
     *
     * @return false|string|void
     * @throws \Exception
     */
    function addAction()
    {
        $params = $this->request->get('params');
        $submitData = json_decode($params, true);

        // 记录这个值
        error_log('PricesettingController => addAction => $submitData的结果是： ' . print_r($submitData, true));

        $this->db->begin();
        foreach ($submitData['list'] as $row) {
            // 需要查询 6 个唯一
            $setting = TbPriceSetting::findFirst(
                sprintf(
                    "companyid=%d and brandid=%d and ageseasonid=%d and producttypeid=%d and brandgroupchildid=%d and priceid=%d",
                    $this->companyid,
                    $submitData["brandid"],
                    $submitData["ageseasonid"],
                    $submitData["producttypeid"],
                    $row["brandgroupchildid"],
                    $row["priceid"]
                )
            );

            if ($setting == false) {
                $setting = new TbPriceSetting();
                $setting->companyid = $this->companyid;
            }
            $setting->brandid = $submitData["brandid"];
            $setting->ageseasonid = $submitData["ageseasonid"];
            $setting->producttypeid = $submitData["producttypeid"];
            $setting->brandgroupchildid = $row["brandgroupchildid"];
            $setting->priceid = $row["priceid"];
            $setting->discount = $row["discount"];

            if ($setting->save() == false) {
                $this->db->rollback();
                throw new \Exception("/1001/更新失败/");
            }
        }
        $this->db->commit();

        return $this->success();
    }
}
