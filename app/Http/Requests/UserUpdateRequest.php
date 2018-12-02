<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //如果返回false就出现This action is unauthorized[提示未经授权]
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //sometimes只是有值才会验证
        $id = $this->route('id');

        return [
//            'name' => 'required|max:15|unique:users',
            'name' => [
                'required',
                'max:15',
                Rule::unique('users')->ignore($id)
            ],
            'desc' => 'required|between:3,255',
            'cover' => 'sometimes|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名为 :input 的名称已经存在 请更换',
            'desc.required' => '描述不能为空'
        ];
    }
}
