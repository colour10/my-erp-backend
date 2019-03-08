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
    "language" => "zh-cn",
    
    "languages" => array(
        "zh-cn" => "简体中文",
        "zh-hk" => "繁体中文",
        "en-us" => "英文"
    ),

    // 权限控制
    'permissions' => [
        // 用户管理模块
        [
            // id：编号
            'id' => '1',
            'name' => 'usermanager',
            'description' => '用户管理',
            'children' => [
                [
                    // 员工信息
                    'id' => '2',
                    'name' => 'user/*',
                    'description' => '用户模块',
                    'children' => [
                        [
                            'id' => '3',
                            'name' => 'user',
                            'description' => '用户查看',
                        ],
                        [
                            'id' => '4',
                            'name' => 'user/add',
                            'description' => '用户新增',
                        ],
                        [
                            'id' => '5',
                            'name' => 'user/edit',
                            'description' => '用户编辑',
                        ],
                        [
                            'id' => '6',
                            'name' => 'user/delete',
                            'description' => '用户删除',
                        ],
                    ],
                ],
                [
                    // 角色模块
                    'id' => '7',
                    'name' => 'role/*',
                    'description' => '角色模块',
                    'children' => [
                        [
                            'id' => '8',
                            'name' => 'role',
                            'description' => '角色查看',
                        ],
                        [
                            'id' => '9',
                            'name' => 'role/add',
                            'description' => '角色新增',
                        ],
                        [
                            'id' => '10',
                            'name' => 'user/edit',
                            'description' => '角色编辑',
                        ],
                        [
                            'id' => '11',
                            'name' => 'user/delete',
                            'description' => '角色删除',
                        ],
                    ],
                ],
                [
                    // 部门模块
                    'id' => '12',
                    'name' => 'depart/*',
                    'description' => '部门模块',
                    'children' => [
                        [
                            'id' => '13',
                            'name' => 'depart',
                            'description' => '部门查看',
                        ],
                        [
                            'id' => '14',
                            'name' => 'depart/add',
                            'description' => '部门新增',
                        ],
                        [
                            'id' => '15',
                            'name' => 'depart/edit',
                            'description' => '部门编辑',
                        ],
                        [
                            'id' => '16',
                            'name' => 'depart/delete',
                            'description' => '部门删除',
                        ],
                    ],
                ],
            ],
        ],

        // 基础数据
        [
            'id' => '17',
            'name' => 'product',
            'description' => '基础数据',
            'children' => [
                [
                    // 商品相关
                    'id' => '17',
                    'name' => 'product',
                    'description' => '商品相关',
                    'children' => [
                        // 品牌维护
                        [
                            'id' => '18',
                            'name' => 'brand/*',
                            'description' => '品牌维护',
                            'children' => [
                                [
                                    'id' => '19',
                                    'name' => 'brand',
                                    'description' => '品牌查看',
                                ],
                                [
                                    'id' => '20',
                                    'name' => 'brand/add',
                                    'description' => '品牌新增',
                                ],
                                [
                                    'id' => '21',
                                    'name' => 'brand/edit',
                                    'description' => '品牌编辑',
                                ],
                                [
                                    'id' => '22',
                                    'name' => 'brand/delete',
                                    'description' => '品牌删除',
                                ],
                            ],
                        ],

                        // 品类维护
                        [
                            'id' => '23',
                            'name' => 'brandgroup/*',
                            'description' => '品类维护',
                            'children' => [
                                [
                                    'id' => '24',
                                    'name' => 'brandgroup',
                                    'description' => '品类查看',
                                ],
                                [
                                    'id' => '25',
                                    'name' => 'brandgroup/add',
                                    'description' => '品类新增',
                                ],
                                [
                                    'id' => '26',
                                    'name' => 'brandgroup/edit',
                                    'description' => '品类编辑',
                                ],
                                [
                                    'id' => '27',
                                    'name' => 'brandgroup/delete',
                                    'description' => '品类删除',
                                ],
                            ],
                        ],

                        // 颜色模板
                        [
                            'id' => '28',
                            'name' => 'colortemplate/*',
                            'description' => '颜色模板',
                            'children' => [
                                [
                                    'id' => '29',
                                    'name' => 'colortemplate',
                                    'description' => '颜色查看',
                                ],
                                [
                                    'id' => '30',
                                    'name' => 'colortemplate/add',
                                    'description' => '颜色新增',
                                ],
                                [
                                    'id' => '31',
                                    'name' => 'colortemplate/edit',
                                    'description' => '颜色编辑',
                                ],
                                [
                                    'id' => '32',
                                    'name' => 'colortemplate/delete',
                                    'description' => '颜色删除',
                                ],
                            ],
                        ],

                        // 商品尺码
                        [
                            'id' => '33',
                            'name' => 'sizetop/*',
                            'description' => '商品尺码',
                            'children' => [
                                [
                                    'id' => '34',
                                    'name' => 'sizetop',
                                    'description' => '商品尺码查看',
                                ],
                                [
                                    'id' => '35',
                                    'name' => 'sizetop/add',
                                    'description' => '商品尺码新增',
                                ],
                                [
                                    'id' => '36',
                                    'name' => 'sizetop/edit',
                                    'description' => '商品尺码编辑',
                                ],
                                [
                                    'id' => '37',
                                    'name' => 'sizetop/delete',
                                    'description' => '商品尺码删除',
                                ],
                            ],
                        ],

                        // 材质
                        [
                            'id' => '38',
                            'name' => 'sizetop/*',
                            'description' => '材质',
                            'children' => [
                                [
                                    'id' => '39',
                                    'name' => 'sizetop',
                                    'description' => '材质查看',
                                ],
                                [
                                    'id' => '40',
                                    'name' => 'sizetop/add',
                                    'description' => '材质新增',
                                ],
                                [
                                    'id' => '41',
                                    'name' => 'sizetop/edit',
                                    'description' => '材质编辑',
                                ],
                                [
                                    'id' => '42',
                                    'name' => 'sizetop/delete',
                                    'description' => '材质删除',
                                ],
                            ],
                        ],
                    ],
                ],

            ],
        ],

    ],

);