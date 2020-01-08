<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
  
 	$router->resource('articles', ArticleController::class);
  
  	$router->resource('categories', CategoryController::class);
  
  	$router->resource('banner', BannerController::class);
  
  	$router->resource('member', MemberController::class);
  
  	$router->resource('system_config_group', SystemConfigGroupController::class);
  	$router->resource('system_config', SystemConfigController::class);
  	$router->resource('variable_type', VariableTypeController::class);
});
