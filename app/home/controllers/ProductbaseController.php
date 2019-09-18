<?php
namespace Multiple\Home\Controllers;

use Asa\Erp\TbProductBase;


/**
 * 商品国际码库
 */
class ProductbaseController extends BaseController {
    function suggestAction() {
        if(isset($_POST['keyword']) && strlen($_POST['keyword'])>=4) {
            $rows = TbProductBase::find([
                sprintf("wordcode like '%s%%'", addslashes($_POST['keyword'])),
                "order" => "wordcode asc"
            ]);

            $array = [];
            foreach($rows as $row) {
                $array[] = $row->product->toArray();
            }
            return $this->success($array);
        }
        else {
            return $this->success();
        }
    }
}
