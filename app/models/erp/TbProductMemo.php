<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 商品描述
 */
class TbProductMemo extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_memo');
    }

    public function validation() {
        $validation = new Validation;

        $validation->add('name_cn', $this->getValidatorFactory()->presenceOfMultiple('mingcheng'));
        return $this->validate($validation);
    }
}
