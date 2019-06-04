<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbProductLastmodify;

/**
 * 商品按照companyid、brandid、brandcolor分组的最后修改记录表
 */
class ProductlastmodifyController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProductLastmodify');
    }


    /**
     * 当更新tb_product表时，同步更新tb_product_lastmodify表记录
     * @param int $companyid 公司id
     * @param int $brandid 品牌id
     * @param int $brandcolor 色系id
     * @param string $colorname 颜色名称
     * @return false|string
     */
    public function saveAction($companyid, $brandid, $brandcolor, $colorname)
    {
        // 逻辑
        // 这里要求companyid、brandid、brandcolor具有唯一性
        // 如果参数合法，则对数据库进行操作，存在则新增，不存在则创建
        if ($model = TbProductLastmodify::findFirst([
            "companyid = :companyid: AND brandid = :brandid: AND brandcolor = :brandcolor:",
            'bind' => [
                'companyid' => $companyid,
                'brandid' => $brandid,
                'brandcolor' => $brandcolor,
            ],
        ])) {
            $data = [
                'colorname' => $colorname,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        } else {
            // 如果不存在，则新增
            $model = new TbProductLastmodify();
            $data = [
                'companyid' => $companyid,
                'brandid' => $brandid,
                'brandcolor' => $brandcolor,
                'colorname' => $colorname,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        // 开始更新
        if (!$model->save($data)) {
            return $this->error($model);
        }

        // 最终返回成功
        return $this->success();
    }

}
