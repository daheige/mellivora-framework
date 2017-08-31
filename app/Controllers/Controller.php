<?php

namespace App\Controllers;

use Mellivora\Application\Controller as ParentController;

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
     * 响应错误信息
     *
     * @param string $message
     * @param array  $data
     */
    public function ajaxResponse($code, $message = null, $data = null)
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
    public function ajaxError($message = null, $data = null)
    {
        return $this->ajaxResponse(static::INTERNAL_ERROR, $message, $data);
    }

    /**
     * 响应成功信息
     *
     * @param string $message
     * @param array  $data
     */
    public function ajaxSuccess($message = null, $data = null)
    {
        return $this->ajaxResponse(static::SUCCEED, $message, $data);
    }
}
