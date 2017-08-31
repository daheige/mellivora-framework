<?php

$defaults = [
    /**
     * 缓存命名空间，用于项目隔离
     */
    'namespace' => 'mellivora-cache',

    /**
     * 默认的缓存生命周期 (30天)
     */
    'lifetime'  => 2592000,
];

/**
 * 缓存配置参数
 *
 * @link https://symfony.com/doc/current/components/cache.html
 */
return [

    /**
     * 默认的缓存服务
     */
    'default' => 'memcached',

    /**
     * 日志名称
     */
    'logger'  => function () {
        return new Psr\Log\NullLogger;
    },

    /**
     * 连接器驱动列表
     *
     * 格式为：[缓存名 => 驱动参数]
     *
     * @link https://symfony.com/doc/current/components/cache/cache_pools.html
     */
    'drivers' => [

        'memcached' => [
            'connector' => Mellivora\Cache\MemcachedConnector::class,
            'servers'   => [
                'memcached://127.0.0.1:11211',
            ],
        ] + $defaults,

        'redis'     => [
            'connector' => Mellivora\Cache\RedisConnector::class,
            'dsn'       => 'redis://127.0.0.1:6379',
        ] + $defaults,

        'file'      => [
            'connector' => Mellivora\Cache\FilesystemConnector::class,
            'directory' => storage_path('cache'),
        ] + $defaults,

        'php'       => [
            'connector' => Mellivora\Cache\PhpFilesConnector::class,
            'directory' => storage_path('cache'),
        ] + $defaults,

        'db'        => [
            'connector'  => Mellivora\Cache\PdoConnector::class,
            'connection' => 'mysql:dbname=mellivora;port=3306;host=127.0.0.1;charset=utf8',
            'options'    => [
                'db_username' => 'root',
                'db_password' => '',
            ],

        ] + $defaults,

    ],

];
