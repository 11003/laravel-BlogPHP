<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AritcleValidateRequest extends FormRequest
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
            'content' => 'required',
            'title' => 'required',
            'desc' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => '图书文摘名称不能为空',
            'desc.required' => '文摘描述不能为空',
            'content.required' => '内容不能为空',
        ];
    }
}
