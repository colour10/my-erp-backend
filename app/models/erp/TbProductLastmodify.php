<?php

namespace Asa\Erp;

/**
 * 基础资料，最后一次修改产品品牌颜色的统计
 */
class TbProductLastmodify extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_lastmodify');
    }

    /**
     * 当更新tb_product表时，同步更新tb_product_lastmodify表记录
     * @param int $companyid 公司id
     * @param int $brandid 品牌id
     * @param int $brandcolor 色系id
     * @param string $colorname 颜色名称
     * @param string $wordcode_3 颜色国际码
     * @return false|string
     */
    public static function add($companyid, $brandid, $wordcode_3, $brandcolor, $colorname)
    {
        // 逻辑
        // 这里要求companyid、brandid、wordcode_3具有唯一性
        // 操作逻辑：存在则修改，不存在则新增
        if ($model = TbProductLastmodify::findFirst([
            "companyid = :companyid: AND brandid = :brandid: AND wordcode_3 = :wordcode_3:",
            'bind' => [
                'companyid'  => $companyid,
                'brandid'    => $brandid,
                'wordcode_3' => $wordcode_3,
            ],
        ])) {
            // 存在则修改
            $data = [
                'brandcolor' => $brandcolor,
                'colorname'  => $colorname,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        } else {
            // 如果不存在，则新增
            $model = new TbProductLastmodify();
            $data = [
                'companyid'  => $companyid,
                'brandid'    => $brandid,
                'wordcode_3' => $wordcode_3,
                'brandcolor' => $brandcolor,
                'colorname'  => $colorname,
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
}
