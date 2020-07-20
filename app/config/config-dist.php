<?php

return [
    'app' => [
        //项目名称
        'app_name'   => '',
        //版本号
        'version'    => '',
        //日志根目录
        'log_path'   => '',
        //缓存路径
        'cache_path' => '',

        //主域名，ERP系统访问的域名
        'main_host'  => '',

        //Shop系统域名
        'shop_host'  => '',
    ],

    'mode'     => '',   //product

    //数据库表配置
    'database' => [
        //数据库连接信息
        'db'     => [
            "host"     => "",
            "username" => "",
            "password" => "",
            "dbname"   => "",
        ],
        //表前缀
        'prefix' => '',
    ],

    //默认语言
    "language" => "cn",

    "languages"            => [
        "cn" => ["code" => "cn", "name" => "简体中文", "shortName" => "简"],
        //"hk" => array("code"=>"hk","name"=>"繁体中文","shortName" => "繁"),
        "en" => ["code" => "en", "name" => "English", "shortName" => "英"],
        //"it" => array("code"=>"it","name"=>"意大利语","shortName" => "意")
    ],

    //上传文件的保存目录
    "upload_dir"           => "",

    //访问上传文件的浏览路径前缀
    "file_prex"            => "",

    //email发信设置，注册成功后发送邮件
    'email_config'         => [
        'secure'   => '',     //链接加密方式 Options: "", "ssl" or "tls"; 为空时, 端口一般是25; ssl , 端口一般为 465;
        'host'     => '',     //SMTP 服务器
        'port'     => '',    //SMTP 端口, 一般为25, QQ为465或587
        'username' => '', //邮箱帐号
        'psw'      => '', //邮箱密码 QQ使用SMTP授权码
        'From'     => '', //发件人地址
        'FromName' => '', //发件人姓名
    ],

    //aliyun-cdn相关
    'alibabacloud'         => [
        'accessKeyId'     => '',
        'accessKeySecret' => '',
    ],

    //支付相关参数
    'pay'                  => [
        // 微信原生支付配置参数
        'wechat' => [
            // 公众号 APPID
            'app_id'      => '',
            // APP 引用的 appid
            'appid'       => '',
            // 小程序 APPID
            'miniapp_id'  => '',
            // 商户号
            'mch_id'      => '',
            'key'         => '',
            // 微信异步通知地址
            'notify_url'  => '',
            // 证书相关，退款的时候会用到
            'cert_client' => '',
            'cert_key'    => '',
            'log'         => [
                'file'     => '',
                'level'    => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
                'type'     => 'daily', // optional, 可选 daily.
                'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
            ],
            'http'        => [
                // optional
                'timeout'         => 5.0,
                'connect_timeout' => 5.0,
                // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
            ],
            // 设置为service为服务商模式
            'mode'        => 'service',
        ],

        // 支付宝相关参数，这个是正式环境
        'alipay' => [
            // 服务商app_id，如果有需要的话，还需要在具体的业务逻辑中获取商户的app_id
            'app_id'         => '',
            // 异步通知地址
            'notify_url'     => '',
            // 同步通知地址
            'return_url'     => '',
            // 千万记住，这里填写支付宝公钥，而不是应用公钥
            'ali_public_key' => '',
            // 应用私钥，加密方式： **RSA2**
            'private_key'    => '',
            'log'            => [
                'file'     => '',
                'level'    => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
                'type'     => 'daily', // optional, 可选 daily.
                'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
            ],
            'http'           => [
                'timeout'         => 5.0,
                'connect_timeout' => 5.0,
                // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
            ],
            // 'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
            // 支付宝网关，新增属性
            'gateway'        => 'https://openapi.alipay.com/gateway.do',
            // 授权请求根域名
            'auth_url'       => 'openauth.alipay.com',
        ],
    ],

    // 库存变动服务配置
    "productstock_service" => [
        "server" => "",
    ],

    // OMS 配置
    'oms'                  => [
        // token接口
        'token'            => [
            'remote_url' => '',
            'grant_type' => '',
            'username'   => '',
            'password'   => '',
        ],
        // 客户端id
        'ClientGuid'       => '',
        // 客户端名称
        'ClientName'       => '',
        // 商品档案上新和更新接口
        'Inventory_update' => [
            // 远程请求 url
            'remote_url' => '',
        ],
    ],

];
