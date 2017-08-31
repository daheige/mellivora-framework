<?php

namespace App;

use ErrorException;
use Mellivora\Application\App as WebApp;
use Mellivora\Console\App as ConsoleApp;

/**
 * 项目引导程序
 */
class Bootstrap
{

    /**
     * 载入定义常量
     */
    public static function loadConstants()
    {
        // 项目根目录
        defined('__ROOT__') || define('__ROOT__', dirname(__DIR__));

        // 定义项目开始时间
        defined('START_TIME') || define('START_TIME', microtime(true));

        // 定义项目初始内存
        defined('START_MEMORY') || define('START_MEMORY', memory_get_usage(true));

        // 生产环境
        defined('PRODUCTION') || define('PRODUCTION', is_file('/etc/php.env.production'));

        // 预发环境
        defined('STAGING') || define('STAGING', is_file('/etc/php.env.staging'));

        // 测试环境
        defined('TESTING') || define('TESTING', is_file('/etc/php.env.testing'));

        // 开发环境
        defined('DEVELOPMENT') || define('DEVELOPMENT', !(PRODUCTION || STAGING || TESTING));

        // 项目环境
        if (!defined('ENVIRONMENT')) {
            switch (true) {
                case PRODUCTION:
                    define('ENVIRONMENT', 'production');
                    break;
                case STAGING:
                    define('ENVIRONMENT', 'staging');
                    break;
                case TESTING:
                    define('ENVIRONMENT', 'testing');
                    break;
                default:
                    define('ENVIRONMENT', 'development');
            }
        }

        // 定义是否 CLI 模式
        define('IS_CLI', php_sapi_name() === 'cli' || php_sapi_name() == 'phpdbg');

        // 定义是否 AJAX 请求
        define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']));

        // 定义是否 CURL 请求
        define('IS_CURL', isset($_SERVER['HTTP_USER_AGENT']) &&
            stripos($_SERVER['HTTP_USER_AGENT'], 'curl') !== false);

        // 定义 json_encode 的默认选项
        define('JSON_ENCODE_OPTION', PRODUCTION
                ? JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                : JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // 定义当前是否为 API 模式
        define('API_MODE', isset($_SERVER['REQUEST_URI']) &&
            strpos($_SERVER['REQUEST_URI'], '/api/') !== false);
    }

    /**
     * 注册 ErrorHandler，将 WARING, NOTICE 等错误转换为 ErrorException
     */
    public static function registerErrorHandler()
    {
        set_error_handler(function ($code, $error, $file, $line) {
            throw new ErrorException($error, $code, 0, $file, $line);

            return true;
        });
    }

    /**
     * 加载环境设置
     */
    public static function loadEnvironmentSettings()
    {
        // 默认时区定义
        date_default_timezone_set('Asia/Shanghai');

        // 设置错误报告模式
        error_reporting(E_ALL);

        // 设置默认区域
        setlocale(LC_ALL, 'zh_CN.utf-8');

        // 设置内部字符默认编码为 UTF-8
        mb_internal_encoding('UTF-8');

        // 打开/关闭错误显示
        ini_set('display_errors', !PRODUCTION);

        // 避免 cli 或 curl 模式下 xdebug 输出 html 调试信息
        ini_set('html_errors', !(IS_CLI || IS_CURL));

        // 使得在 api|ajax 模式下，输出 json 格式的错误信息
        if (API_MODE || IS_AJAX) {
            $_SERVER['HTTP_ACCEPT'] = 'application/json';
        }
    }

    /**
     * 加载 web 项目配置
     */
    public static function loadWebSettings()
    {
        return require __ROOT__ . '/config/web.php';
    }

    /**
     * 执行 WEP 项目引导
     */
    public static function runWebApp()
    {
        self::loadConstants();
        self::registerErrorHandler();
        self::loadEnvironmentSettings();

        $app = new WebApp(self::loadWebSettings());

        // 加载路由配置
        require __ROOT__ . '/config/routes.php';

        return $app->run();
    }

    /**
     * 加载命令行配置
     */
    public static function loadConsoleSettings()
    {
        // 定义 Command 下的参数常量
        defined('ARG_REQUIRED') || define('ARG_REQUIRED', 1);
        defined('ARG_OPTIONAL') || define('ARG_OPTIONAL', 2);
        defined('ARG_IS_ARRAY') || define('ARG_IS_ARRAY', 4);
        defined('OPT_NONE') || define('OPT_NONE', 1);
        defined('OPT_REQUIRED') || define('OPT_REQUIRED', 2);
        defined('OPT_OPTIONAL') || define('OPT_OPTIONAL', 4);
        defined('OPT_IS_ARRAY') || define('OPT_IS_ARRAY', 8);

        return require __ROOT__ . '/config/console.php';
    }

    /**
     * 执行命令行项目引导
     */
    public static function runConsoleApp()
    {
        self::loadConstants();
        self::registerErrorHandler();
        self::loadEnvironmentSettings();

        $app = new ConsoleApp(self::loadConsoleSettings());
        $app->setExceptionHandler(new \App\Commands\ExceptionHandler);

        return $app->run();
    }
}
