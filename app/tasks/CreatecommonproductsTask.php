<?php

use Asa\Erp\TbCompany;
use Asa\Erp\TbProduct;
use Asa\Erp\Util;

/**
 * 在Tb_products生成公共产品库
 * Class ReplaceTask
 */
class CreatecommonproductsTask extends \Phalcon\CLI\Task
{
    /**
     * 生成逻辑
     * @return false|string
     * @throws ReflectionException
     */
    public function mainAction()
    {
        // 逻辑
        // 启用事务处理
        $this->db->begin();

        // 首先拿到全部商品
        $products = TbProduct::find()->toArray();
        // 国际码合并处理
        // 并且进行分组
        $return = [];
        foreach ($products as $k => $product) {
            $product['wordcode'] = $product['wordcode_1'] . $product['wordcode_2'] . $product['wordcode_3'] . $product['wordcode_4'];
            $products[$k] = $product;
            // 然后按照wordcode字段进行分组
            if (!isset($return[$product['wordcode']]) || !isset($return[$product['wordcode']][$product['id']])) {
                // 如果不存在，则压入新数组
                $return[$product['wordcode']][$product['id']] = $product;
            }
        }

        // 拿到数据库的全部字段，并且去掉id和companyid字段
        $class = new \ReflectionClass('Asa\\Erp\\TbProduct');
        $modelObject = $class->newInstance();
        $metaData = $modelObject->getModelsMetaData();
        $attributes = $metaData->getAttributes($modelObject);
        foreach ($attributes as $k => $v) {
            if ($v == 'id' || $v == 'companyid') {
                unset($attributes[$k]);
            }
        }

        // 寻找是否存在名为“虚拟公司”的公司
        $companyModel = TbCompany::findFirst("name_cn='虚拟公司'");
        if (!$companyModel) {
            $companyModel = new TbCompany();
            $companyModel->create([
                'name_cn' => '虚拟公司',
            ]);
        }

        // 取出虚拟公司ID
        $companyid = $companyModel->id;

        // 转成一维数组
        $combime = [];
        // 先把键名去掉，以便后面方便处理
        foreach ($return as $k => $groupby) {
            $values = array_values($groupby);
            // 开始统计每个属性值出现的次数
            foreach ($attributes as $attribute) {
                $combime[$k][$attribute] = Util::getArrayMaxKey(array_count_values(array_filter(array_column($values, $attribute))));
            }
        }

        // 然后查找数据库，并且依次替换
        foreach ($combime as $wordcode => $item) {
            $model = TbProduct::findFirst([
                "CONCAT(IFNULL(wordcode_1, ''), IFNULL(wordcode_2, ''), IFNULL(wordcode_3, ''), IFNULL(wordcode_4, '')) = '$wordcode' and companyid = $companyid",
            ]);

            // 如果不存在就新建模型
            if (!$model) {
                $model = new TbProduct();
            }

            // 开始更新
            $item['companyid'] = $companyid;
            if (!$model->save($item)) {
                $this->db->rollback();
                return json_encode(['code' => '200', 'messages' => ['ERROR']]);
            }
        }

        // 提交
        $this->db->commit();
        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['SUCCESS']]) . PHP_EOL;
    }
}