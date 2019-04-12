<?php

use Asa\Models\Temp\TempTbAliases;
use Asa\Models\Temp\TempTbBrand;
use Asa\Models\Temp\TempTbSeries;
use Asa\Models\Temp\TempTbSeries2;
use Asa\Models\Temp\TempTbSizecontent;

/**
 * 临时表替换
 * Class ReplaceTask
 */
class ReplaceTask extends \Phalcon\CLI\Task
{
    /**
     * 临时表替换真实数据
     * @return false|string
     */
    public function mainAction() {
        // 逻辑
        // 采用事务处理
        $this->db->begin();

        // 首先生成所有品牌表的countryid
        $brands = TempTbBrand::find();
        // 遍历替换品牌表的countryid
        foreach ($brands as $brand) {
            // 写入countryid，如果不存在记做NULL
            $country = $brand->country;
            if (!$country) {
                $countryid = NULL;
            } else {
                $countryid = $country->id;
            }
            // 写入countryid
            $data = [
                'countryid' => $countryid,
            ];
            if (!$brand->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return json_encode(['code' => '200', 'messages' => ['生成品牌表的countryid出错了']]);
            }
        }

        // 接着生成所有别名表的brandid
        $aliases = TempTbAliases::find();
        // 遍历替换别名表的brandid
        foreach ($aliases as $alias) {
            // 写入brandid，如果不存在记做NULL
            $brand = $alias->brand;
            if (!$brand) {
                $brandid = NULL;
            } else {
                $brandid = $brand->id;
            }
            // 写入brandid
            $data = [
                'brandid' => $brandid,
            ];
            if (!$alias->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return json_encode(['code' => '200', 'messages' => ['生成别名表的brandid出错了']]);
            }
        }

        // 接着生成所有尺码明细表的topid
        $sizecontents = TempTbSizecontent::find();
        // 遍历替换尺码明细表的topid
        foreach ($sizecontents as $sizecontent) {
            // 写入topid，如果不存在记做NULL
            $sizetop = $sizecontent->sizetop;
            if (!$sizetop) {
                $topid = NULL;
            } else {
                $topid = $sizetop->id;
            }
            $data = [
                'topid' => $topid,
            ];
            if (!$sizecontent->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return json_encode(['code' => '200', 'messages' => ['生成尺码明细表的topid出错了']]);
            }
        }

        // 给系列表添加品牌id-brandid
        $series = TempTbSeries::find();
        // 遍历替换系列表的brandid
        foreach ($series as $serie) {
            // 写入brandid，如果不存在记做NULL
            $brand = $serie->brand;
            if (!$brand) {
                $brandid = NULL;
            } else {
                $brandid = $brand->id;
            }
            $data = [
                'brandid' => $brandid,
            ];
            if (!$serie->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return json_encode(['code' => '200', 'messages' => ['生成系列表的brandid出错了']]);
            }
        }

        // 给子系列表添加系列表id-seriesid
        $serie2s = TempTbSeries2::find();
        // 遍历替换系列表的seriesid
        foreach ($serie2s as $serie2) {
            // 写入seriesid，如果不存在记做NULL
            $serie = $serie2->serie;
            if (!$serie) {
                $seriesid = NULL;
            } else {
                $seriesid = $serie->id;
            }
            $data = [
                'seriesid' => $seriesid,
            ];
            if (!$serie2->save($data)) {
                // 回滚
                $this->db->rollback();
                // 报错
                return json_encode(['code' => '200', 'messages' => ['生成子系列表的seriesid出错了']]);
            }
        }

        // 提交事务
        $this->db->commit();
        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['操作成功']]);
    }
}