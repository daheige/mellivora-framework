<?php

/**
 * 扫描 app/Commands 目录下的 command，并自动注册
 */
$commands = [];
foreach (new DirectoryIterator(app_path('Commands')) as $file) {
    if ($file->isFile() && $file->getExtension() == 'php') {
        $commands[] = 'App\\Commands\\' . $file->getBasename('.php');
    }
}

return [
    /**
     * Slim 核心配置，一般情况下无需修改
     */
    'settings'  => [
        'environment'         => ENVIRONMENT,
        'displayErrorDetails' => !PRODUCTION,
    ],

    /**
     * Provider 服务提供者
     */
    'providers' => [
        Mellivora\Config\ConfigServiceProvider::class,
        Mellivora\Encryption\CryptServiceProvider::class,
        Mellivora\Cache\CacheServiceProvider::class,
        Mellivora\Events\EventServiceProvider::class,
        Mellivora\Database\DatabaseServiceProvider::class,
        Mellivora\Translation\TranslatorServiceProvider::class,
        Mellivora\Database\MigrationServiceProvider::class,

        App\Providers\AppServiceProvider::class,
        App\Providers\MiddlewareServiceProvider::class,
    ],

    /**
     * Facades 类别名
     */
    'facades'   => [
        'App'    => Mellivora\Support\Facades\App::class,
        'Cache'  => Mellivora\Support\Facades\Cache::class,
        'Config' => Mellivora\Support\Facades\Config::class,
        'Crypt'  => Mellivora\Support\Facades\Crypt::class,
        'DB'     => Mellivora\Support\Facades\DB::class,
        'Schema' => Mellivora\Support\Facades\Schema::class,
        'Lang'   => Mellivora\Support\Facades\Translator::class,
    ],

    /**
     * 注册 Commands 列表
     */
    'commands'  => $commands,

];
