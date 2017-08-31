<?php

return [
    /**
     * Slim 核心配置，一般情况下无需修改
     */
    'settings'  => [
        'environment'                       => ENVIRONMENT,
        'displayErrorDetails'               => !PRODUCTION,
        'determineRouteBeforeAppMiddleware' => true,
    ],

    /**
     * Provider 服务提供者
     */
    'providers' => [
        Mellivora\Config\ConfigServiceProvider::class,
        Mellivora\Events\EventServiceProvider::class,
        Mellivora\Encryption\CryptServiceProvider::class,
        Mellivora\Cache\CacheServiceProvider::class,
        Mellivora\Session\SessionServiceProvider::class,
        Mellivora\Http\HttpServiceProvider::class,
        Mellivora\Database\DatabaseServiceProvider::class,
        Mellivora\Translation\TranslatorServiceProvider::class,
        Mellivora\View\ViewServiceProvider::class,
        Mellivora\Pagination\PaginationServiceProvider::class,

        App\Providers\AppServiceProvider::class,
        App\Providers\MiddlewareServiceProvider::class,
    ],

    /**
     * Facades 类别名
     */
    'facades'   => [
        'App'      => Mellivora\Support\Facades\App::class,
        'Cache'    => Mellivora\Support\Facades\Cache::class,
        'Config'   => Mellivora\Support\Facades\Config::class,
        'Cookies'  => Mellivora\Support\Facades\Cookies::class,
        'Crypt'    => Mellivora\Support\Facades\Crypt::class,
        'DB'       => Mellivora\Support\Facades\DB::class,
        'Request'  => Mellivora\Support\Facades\Request::class,
        'Response' => Mellivora\Support\Facades\Response::class,
        'Schema'   => Mellivora\Support\Facades\Schema::class,
        'Session'  => Mellivora\Support\Facades\Session::class,
        'Lang'     => Mellivora\Support\Facades\Translator::class,
    ],

];
