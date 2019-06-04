<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbProductLastmodify;

/**
 * 商品按照companyid、brandid、brandcolor分组的最后修改记录表
 */
class ProductlastmodifyController extends AdminController
{
    public function initialize()
    {
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
    public function save($companyid, $brandid, $brandcolor, $colorname)
    {
        // 逻辑
        // 这里要求companyid、brandid、brandcolor具有唯一性
        // 操作逻辑：存在则修改，不存在则新增
        if ($model = TbProductLastmodify::findFirst([
            "companyid = :companyid: AND brandid = :brandid: AND brandcolor = :brandcolor:",
            'bind' => [
                'companyid' => $companyid,
                'brandid' => $brandid,
                'brandcolor' => $brandcolor,
            ],
        ])) {
            // 存在则修改
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
            return false;
        }

        // 如果上面无措，则返回成功
        return true;
    }


    /**
     * 根据companyid、brandid查询对应的颜色规格列表
     * @return false|string
     */
    public function loadAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 根据companyid、brandid获取一个列表
            $datas = TbProductLastmodify::find([
                "companyid = :companyid: AND brandid = :brandid:",
                'bind' => [
                    // 如果不传companyid，则默认为当前用户所属companyid
                    'companyid' => $this->request->get('companyid') ?: $this->currentCompany,
                    'brandid' => $this->request->get('brandid'),
                ],
            ]);
            // 返回
            return $this->success($datas->toArray());
        }
    }

}
