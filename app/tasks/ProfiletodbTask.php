<?php

use Asa\Erp\TbLanguage;
use Asa\Erp\Util;

/**
 * 配置文件导入数据库
 * Class ReplaceTask
 */
class ProfiletodbTask extends \Phalcon\CLI\Task
{
    /**
     * 临时表替换真实数据
     * @return false|string
     */
    public function mainAction()
    {
        // 逻辑
        // 启用事务处理
        $this->db->begin();
        // $languages = ['cn', 'en', 'hk', 'fr', 'it', 'sp', 'de'];
        $languages = ['cn'];
        // 遍历文件
        foreach ($languages as $language) {
            // 语言字段
            $name = 'name_' . $language;
            // 检查文件是否存在
            $language_file = APP_PATH . "/app/config/languages/{$language}.php";
            if (!file_exists($language_file)) {
                continue;
            }
            // 取出特定的语言文件
            $system_language = new \Phalcon\Config\Adapter\Php($language_file);
            // 转成数组
            $system_language_array = $system_language->toArray();
            // 处理数据，并转换成一维数组
            $return = Util::multiarray_to_assocarray($system_language_array);
            // 查看是否已经提交了
            foreach ($return as $k => $item) {
                // 键名、键值分别赋值
                list($key, $value) = [$k, $item];
                // 如果数据库存在此条记录，则无需新增
                if (!$model = TbLanguage::findFirst("code='" . $key . "'")) {
                    // 开始新增
                    $tblanguage = new TbLanguage();
                    $tblanguage->code = $key;
                    $tblanguage->$name = $value;
                    if (!$tblanguage->create()) {
                        $this->db->rollback();
                        // 报错
                        return json_encode(['code' => '200', 'messages' => ['ERROR']]);
                    }
                }

                // 取消更新逻辑
                // else {
                //     // 如果找到了，但是当前的记录为null，并且当配置文件不为空， 那么就覆盖
                //     if (empty($model->$name) && !empty($value)) {
                //         $model->$name = $value;
                //         if (!$model->save()) {
                //             $this->db->rollback();
                //             // 报错
                //             return json_encode(['code' => '200', 'messages' => ['ERROR']]);
                //         }
                //     }
                // }
            }
        }
        // 提交
        $this->db->commit();
        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['SUCCESS']]) . PHP_EOL;
    }
}