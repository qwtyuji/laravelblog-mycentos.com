<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body'=>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'body.required'=>'评论内容不能为空',
            'body.min'=>'评论不要少于6个字符'
        ];
    }
}
