<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbProductLastmodify;

/**
 * 商品按照 companyid、brandid、brandcolor分组的最后修改记录表
 */
class ProductlastmodifyController extends AdminController
{
    public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\TbProductLastmodify');
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
                    'brandid'   => $this->request->get('brandid'),
                ],
            ]);
            // 返回
            return $this->success($datas->toArray());
        }
    }

}
