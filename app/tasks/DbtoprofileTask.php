<?php

use Asa\Erp\TbLanguage;
use Asa\Erp\Util;

/**
 * 数据库生成配置文件
 * Class ReplaceTask
 */
class DbtoprofileTask extends \Phalcon\CLI\Task
{
    /**
     * 逻辑
     * @return false|string
     */
    public function mainAction()
    {
        // 逻辑
        // 取出所有语言配置
        $datas = TbLanguage::find();
        // 当前语言配置文件内容
        $profiles = [];
        // $languages = ['cn', 'en', 'hk', 'fr', 'it', 'sp', 'de'];
        // 中文配置文件不覆盖
        $languages = ['en', 'hk', 'fr', 'it', 'sp', 'de'];
        // 遍历文件
        foreach ($languages as $language) {
            // 语言字段
            $name = 'name_' . $language;
            // 检查文件是否存在
            $language_file = APP_PATH . "/app/config/languages/{$language}.php";

            // // 备份文件，暂时不需要
            // $backup_file = APP_PATH . "/app/config/languages/backup/{$language}." . date('Y-m-d-H-i-s') . ".php";
            // // 如果文件存在，则备份
            // if (file_exists($language_file)) {
            //     rename($language_file, $backup_file);
            // }

            // 组装配置内容
            foreach ($datas as $k => $data) {
                $profiles[$data->code] = $data->$name;
            }

            // 数据转换
            $simpleLanguages = Util::multiarray_to_simplearray($profiles);
            $return = Util::simplearray_to_multiarray($simpleLanguages);

            // 执行写入
            // 缓存
            $text = "<?php\nreturn " . var_export($return, true) . ';';
            if (false !== fopen($language_file, 'w+')) {
                if (!file_put_contents($language_file, $text)) {
                    // 报错
                    echo json_encode(['code' => '200', 'messages' => ['ERROR']]);
                }
            }
        }
        // 返回成功
        echo json_encode(['code' => '200', 'messages' => ['SUCCESS']]) . PHP_EOL;
    }
}