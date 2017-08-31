<?php

return [
    'saveHandler' => [
        // session save handler
        'handler' => Mellivora\Session\SimpleCacheHandler::class,

        // constructor options
        'options' => [
            // 独立的 session namespace
            'namespace' => 'mellivora-session',

            // session 生命周期
            'lifetime'  => 259200,

            // memcached
            'connector' => Mellivora\Cache\MemcachedConnector::class,
            'servers'   => 'memcached://127.0.0.1:11212',

            // redis
            // 'connector' => Mellivora\Cache\RedisConnector::class,
            // 'dsn'       => 'redis://127.0.0.1:6379',

            // pdo
            // 'connector'  => Mellivora\Cache\PdoConnector::class,
            // 'connection' => 'mysql:dbname=formax_oa_v3;port=3306;host=127.0.0.1;charset=utf8',
            // 'options'    => [
            //     'db_username' => 'root',
            //     'db_password' => '',
            // ],

            // filesystem
            // 'connector' => Mellivora\Cache\FilesystemConnector::class,
            // 'directory' => storage_path('sessions'),

            // phpfiles
            // 'connector' => Mellivora\Cache\PhpFilesConnector::class,
            // 'directory' => storage_path('sessions'),
        ],
    ],

    'cookies'     => [
        'lifetime' => 604800,        // 默认生存周期 7 天，单位：秒
        'path'     => '/',           // 存储路径
        'domain'   => '.myhost.com', // 域名
        'httponly' => false,         // 仅允许 http 访问，禁止 javascript 访问
        'secure'   => false,         // 启用 https 连接传输
        'encrypt'  => false,         // 是否使用 crypt 加密
    ],
];
