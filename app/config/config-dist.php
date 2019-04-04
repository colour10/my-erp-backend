<?php

return array(
    'app' => array(
        //项目名称
        'app_name' => 'ERP',
        //版本号
        'version' => '1.0',
        //日志根目录
        'log_path' => APP_PATH . '/app/cache/logs/',
        //缓存路径
        'cache_path' => APP_PATH . '/app/cache/data/',

         //主域名，ERP系统访问的域名
        'main_host' => 'erp.localhost.com',

        //Shop系统域名
        'shop_host' => 'shop.localhost.com'
    ),

    'mode' => 'develop',//product
    
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
    "language" => "zh-cn",
    
    "languages" => array(
        "zh-cn" => "简体中文",
        "zh-hk" => "繁体中文",
        "en-us" => "英文"
    ),
    
    //上传文件的保存目录
    "upload_dir" => APP_PATH ."/public/upload/",
    
    //访问上传文件的浏览路径前缀
    "file_prex" => "http://erp.localhost.com/upload/"

);