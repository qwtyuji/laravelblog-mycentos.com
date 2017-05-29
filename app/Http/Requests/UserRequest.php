<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'name' => 'required',
            'name' => 'required|min:3|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6|confirmed',
//            'avtar' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.min' => '用户名不能少于三个字符',
            'name.unique' => '用户名不能重复',
            'email.unique' => '邮箱已注册',
            'email.email' => '必须是有效的邮箱地址',
            'email.required' => '邮箱必填填写',
            'password.required' => '密码必须填写',
            'password.min' => '密码不能少于6个字符',
            'password.confirmed'=>'两次密码输入必须一致'
//            'avatar.required' => '图像必须设置'
        ];
    }
}
