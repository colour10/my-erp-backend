<?php

return array(
    'app' => array(
        //项目名称
        'app_name' => 'ERP',
        //版本号
        'version' => '1.0',
        //日志根目录
        'log_path' => ROOT_PATH . '/app/cache/logs/',
        //缓存路径
        'cache_path' => ROOT_PATH . '/app/cache/data/',
    ),
    
    //数据库表配置
    'database' => array(
        //数据库连接信息
        'db' => array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "web.157WEB",
            "dbname"   => "demo"
        ),
        //表前缀
        'prefix' => '',
    ),
    
    //默认语言
    "language" => "zh-cn"
);