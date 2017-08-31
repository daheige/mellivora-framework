<?php

return [
    // 语言包目录
    'paths'    => [
        resource_path('lang'),
    ],

    // 语言包别名，因为 Accept-Language 有可能获得缩写
    'aliases'  => [
        'zh-cn' => ['zh-cn', 'zh-hk', 'zh-tw', 'zh', 'zhs', 'cn', 'hk', 'tw'],
        'en-us' => ['en', 'us'],
    ],

    // 默认加载的语言包
    'required' => [],

    // 默认的语言类型
    'default'  => function () {
        return app('request')->getPreferredLanguage();
    },
];
