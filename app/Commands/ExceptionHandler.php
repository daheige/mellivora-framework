<?php

namespace App\Commands;

/**
 * 命令行脚本异常处理
 */
class ExceptionHandler
{
    /**
     * 可在此将异常信息写入到日志文件
     *
     * @param  \Exception $e
     * @return void
     */
    public function __invoke(\Exception $e) {}
}
