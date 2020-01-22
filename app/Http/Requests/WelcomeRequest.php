<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WelcomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $type = $this->request->get('type');

        switch($type){
            case 'email':
                $contact = 'required|email:rfc,dns,strict,spoof,filter';
                break;
            case 'mobile':
                $contact = 'required|regex:/^1[345789][0-9]{9}$/';
                break;
            case 'wechat':
                $contact = 'required|digits_between:4,40';
                break;
            case 'qq':
                $contact = 'required|numeric|digits_between:5,14';
                break;
            default:
                $contact = 'required';
        }

        return [
            'type'=>'required|in:email,mobile,wechat,qq',
            'contact'=>$contact,
            'content'=>'required|between:3,200'
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'type.required' => '请选择联系方式',
            'type.in'=>'联系方式错误',
            'contact.required' => '请填写联系方式',
            'contact.email' => '邮箱格式错误',
            'contact.regex' => '手机号格式错误',
            'contact.numeric' => '输入错误',
            'contact.digits_between' => '长度错误',
            'content.required' => '请填写留言内容',
            'content.between' => '内容长度请控制在3~200个字符之间'
        ];
    }
}
