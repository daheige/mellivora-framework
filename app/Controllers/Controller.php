<?php

namespace App\Controllers;

use Mellivora\Application\Controller as ParentController;
use Mellivora\Http\Response;

class Controller extends ParentController
{

    /**
     * 通用 AJAX 错误代码定义
     */
    const SUCCEED         = 200; // 响应成功
    const AUTH_FAILED     = 401; // 认证失败
    const FORBIDDEN       = 403; // 禁止访问
    const INVALID_REQUEST = 404; // 无效请求
    const INTERNAL_ERROR  = 500; // 内部错误

    /**
     * 初始化方法，当返回 false 时停止执行 action
     *
     * @return false|void
     */
    public function initialize() {}

    /**
     * action 完成后将会执行该方法
     * 如果对 $response 进行修改并 return，可以对输出结果进行调整
     *
     * @param  \Mellivora\Http\Response        $response
     * @return \Mellivora\Http\Response|void
     */
    public function finalize(Response $response) {}

    /**
     * 响应错误信息
     *
     * @param string $message
     * @param array  $data
     */
    public function ajax($code, $message = null, $data = null)
    {
        return response()->withJson([
            'code'      => (int) $code,
            'message'   => $message,
            'data'      => $data,
            'timestamp' => time(),
        ]);
    }

    /**
     * 响应错误信息
     *
     * @param string $message
     * @param array  $data
     */
    public function error($message = null, $data = null)
    {
        return $this->ajax(static::INTERNAL_ERROR, $message, $data);
    }

    /**
     * 响应成功信息
     *
     * @param string $message
     * @param array  $data
     */
    public function success($message = null, $data = null)
    {
        return $this->ajax(static::SUCCEED, $message, $data);
    }
}
