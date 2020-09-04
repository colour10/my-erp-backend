<?php

namespace Asa\Erp;

/**
 * 临时商品表，使用其他的 tpk 数据库
 */
class Product extends BaseModel
{
    // 性别
    public static $gender = [
        // 男性
        'Man'    => 1,
        // 女性
        'Woman'  => 2,
        // 儿童
        'Kid'    => 6,
        // 不限
        'Unisex' => 3,
    ];

    /**
     * 初始化
     */
    public function initialize()
    {
        $this->setConnectionService('tpk');
        $this->setSource('products');
    }
}
