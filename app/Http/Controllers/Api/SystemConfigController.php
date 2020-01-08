<?php

namespace App\Http\Controllers\Api;


use App\Models\SystemConfig;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemConfigController extends Controller
{
  	/**
     * 获取变量类型
     */
	public function getVariableType(){
      
      	$array = [
            [
              	'id'=>'string',
                'text'=>'字符串'
            ],
            [
                'id'=>'number',
                'text'=>'数字'
            ],
            [
                'id'=>'image',
                'text'=>'图片'
            ],
            [
                'id'=>'switch',
                'text'=>'开关'
            ],
            [
              	'id'=>'select',
                'text'=>'下拉选框'
            ],
            [
                'id'=>'radio',
                'text'=>'单选'
            ],
          	[
                'id'=>'check',
                'text'=>'多选'
            ],
            [
                'id'=>'text',
                'text'=>'多行文本框'
            ],
            [
                'id'=>'array',
                'text'=>'自定义'
            ]
        ];
    	return $array;
    }
  
  	/**
     * 获取变量分组
     */
  	public function getVariableGroup(){
    	$array = [
            [
                'id'=>'base',
                'text'=>'基础配置'
            ],
            [
                'id'=>'email',
                'text'=>'邮箱配置'
            ],
          	[
            	'id'=>'wx_app',
              	'text'=>'小程序配置'
            ]
        ];
    	return $array;
    }
  
  	/**
     * 获取变量规则
     */
  	public function getVariableRule(){
    	$array = [
            [
                'id'=>'required',
                'text'=>'必选'
            ],
            [
                'id'=>'digits',
                'text'=>'数字'
            ],
          	[
                'id'=>'mobile',
                'text'=>'手机号'
            ]
        ];
    	return $array;
    }
}
