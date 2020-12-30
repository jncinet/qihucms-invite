<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'namespace' => 'Qihucms\Invite\Controllers\Api',
    'prefix' => config('qihu.invite_prefix', 'invite'),
    'middleware' => ['api'],
    'as' => 'api.invite.'
], function (Router $router) {
    $router->get('my', 'InviteController@my')->name('my');
    $router->get('td', 'InviteController@mySon')->name('son');
    $router->get('ts', 'InviteController@myGrandson')->name('grandson');
});

// 后台
Route::group([
    'prefix' => config('admin.route.prefix') . '/invite',
    'namespace' => 'Qihucms\Invite\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
    $router->resource('invites', 'InviteController');
});