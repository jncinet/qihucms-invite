<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'namespace' => 'Qihucms\Invite\Controllers\Api',
    'prefix' => 'invite',
    'middleware' => ['api'],
    'as' => 'api.'
], function (Router $router) {
    $router->get('my', 'InviteController@my')->name('invite.my');
    $router->get('td', 'InviteController@mySon')->name('invite.son');
    $router->get('ts', 'InviteController@myGrandson')->name('invite.grandson');
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