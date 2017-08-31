<?php
/**
 * API 通用路由
 */
$app->any('/api/[{controller}[/{action}[/{id:[\w\-]+}]]]', Mellivora\Application\Dispatcher::class)
    ->setArguments(['module' => 'api'])
    ->setName('api');

/**
 * 通用基础路由，该路由尽量放在最后执行
 *
 * URL格式：
 *
 * "/" => App\Controllers\IndexController:indexAction
 *
 * "/user" => App\Controllers\UserController:indexAction
 * "/user/login" => App\Controllers\UserController:loginAction
 * "/user/edit/1" => App\Controllers\UserController:editAction($id = 1)
 */
$app->any('/[{controller}[/{action}[/{id:[\w\-]+}]]]', Mellivora\Application\Dispatcher::class)
    ->setName('default');
