<?php

use Illuminate\Http\Request;

const SystemConfig = 'Api\SystemConfigController@';

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//获取变量类型
Route::get('getVariableType',SystemConfig.'getVariableType');
//获取变量分组
Route::get('getVariableGroup',SystemConfig.'getVariableGroup');
//获取变量规则
Route::get('getVariableRule',SystemConfig.'getVariableRule');

Route::post('messagePost','WelcomeController@messagePost');