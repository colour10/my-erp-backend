<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbProductBase;

/**
 * 商品国际码库
 */
class ProductbaseController extends BaseController
{
    /**
     * 实时下拉搜索框
     * @return false|string
     */
    public function suggestAction()
    {
        if ($keyword = $this->request->get('keyword')) {
            $rows = TbProductBase::find([
                sprintf("wordcode like '%s%%'", addslashes($keyword)),
                "order" => "wordcode asc",
            ]);

            $array = [];
            foreach ($rows as $row) {
                $array[] = $row->product->toArray();
            }
            return $this->success($array);
        } else {
            return $this->success();
        }
    }
}
